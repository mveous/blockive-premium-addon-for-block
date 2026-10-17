<?php
/**
 * Site Tools (Blockive Templates → Site Tools): Element Manager. Blockive
 * blocks turned off here are hidden from the inserter (blocks already on
 * pages keep working).
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Bpafb_Site_Tools
{
	const PAGE = 'bpafb-site-tools';
	const OPTION_DISABLED = 'bpafb_disabled_blocks';
	const NAMESPACE_PREFIX = 'blockive-premium-addon-for-block/';

	/**
	 * @var Bpafb_Site_Tools|null
	 */
	private static $instance = null;

	/**
	 * @return Bpafb_Site_Tools
	 */
	public static function get_instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		add_action('admin_menu', [$this, 'add_page']);
		// Late, so every submenu item under the Blockive Templates menu
		// (including WordPress's own "All Templates" / "Add New") has
		// already been added by the time this moves ours to the top.
		add_action('admin_menu', [$this, 'move_page_to_top'], 999);
		// WordPress's own "Add New" submenu row, removed since every
		// brand-new template already asks which kind to create (see
		// src/template-builder/template-kind-picker-modal.js) from the
		// "Add New Template" button already on the Blockive Templates list
		// screen itself - this row was just a second way to the same place.
		add_action('admin_menu', [$this, 'remove_add_new_submenu'], 999);
		add_action('admin_init', [$this, 'register_settings']);
		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
		add_filter('register_block_type_args', [$this, 'hide_disabled_blocks'], 20, 2);
		add_action('enqueue_block_editor_assets', [$this, 'enqueue_hidden_blocks_script']);
	}

	public function enqueue_admin_assets($hook)
	{
		if (false === strpos((string) $hook, self::PAGE)) {
			return;
		}
		wp_enqueue_style(
			'bpafb-admin-site-tools',
			plugins_url('assets/css/admin-site-tools.css', dirname(__FILE__)),
			[],
			BPAFB_VERSION
		);
	}

	private function __clone()
	{
	}

	public function __wakeup()
	{
		throw new \Exception('Cannot unserialize a singleton.');
	}

	// -- Settings ------------------------------------------------------------

	public function add_page()
	{
		add_submenu_page(
			'edit.php?post_type=' . Bpafb_Template_Post_Type::POST_TYPE,
			__('Site Tools', 'blockive-premium-addon-for-block'),
			__('Site Tools', 'blockive-premium-addon-for-block'),
			'manage_options',
			self::PAGE,
			[$this, 'render_page']
		);
	}

	/**
	 * Moves "Site Tools" to the very top of the Blockive Templates
	 * submenu, above WordPress's own "All Templates" / "Add New" items.
	 * There is no `add_submenu_page()` position argument for this - only
	 * reordering the `$submenu` global directly, after every item is
	 * already on it, works.
	 *
	 * Note: WordPress points the top-level "Blockive Templates" menu link
	 * at whichever submenu item sits in this first slot, so with Site
	 * Tools here, that top-level link and "Site Tools" now open the same
	 * page - a deliberate trade-off for having Site Tools literally first.
	 */
	public function move_page_to_top()
	{
		global $submenu;

		$parent = 'edit.php?post_type=' . Bpafb_Template_Post_Type::POST_TYPE;
		if (empty($submenu[$parent])) {
			return;
		}

		foreach ($submenu[$parent] as $key => $item) {
			if (isset($item[2]) && self::PAGE === $item[2]) {
				$entry = $item;
				unset($submenu[$parent][$key]);
				array_unshift($submenu[$parent], $entry);
				break;
			}
		}
	}

	/**
	 * Removes the "Add New" row WordPress adds automatically for any
	 * public post type (see `_add_post_type_submenus()` in
	 * wp-admin/menu.php, which runs before `admin_menu` fires at all, so
	 * this row already exists by the time any `admin_menu` callback - at
	 * any priority - runs).
	 */
	public function remove_add_new_submenu()
	{
		remove_submenu_page(
			'edit.php?post_type=' . Bpafb_Template_Post_Type::POST_TYPE,
			'post-new.php?post_type=' . Bpafb_Template_Post_Type::POST_TYPE
		);
	}

	public function register_settings()
	{
		register_setting(self::PAGE, self::OPTION_DISABLED, [
			'type'              => 'array',
			'sanitize_callback' => [$this, 'sanitize_disabled'],
			'default'           => [],
		]);
	}

	/**
	 * @param mixed $value Submitted enabled block names.
	 * @return string[] Array of disabled block names to store.
	 */
	public function sanitize_disabled($value)
	{
		// When this option's current value equals its registered 'default'
		// ([], i.e. nothing disabled - the common state right after Enable
		// All, or on a fresh install), WordPress's update_option() detects
		// that and delegates to add_option() instead of writing directly
		// (see update_option()'s `default_option_{$option}` check in
		// wp-includes/option.php). add_option() then re-runs this same
		// sanitize_option_{$option} filter on the value update_option()
		// already sanitized. Since this function's transform is a
		// complement (disabled = all_names - enabled) and complements are
		// involutive, that unwanted second pass turns the correct disabled
		// list back into the raw enabled list - which then gets saved
		// under the "disabled" option, disabling almost every block.
		// Skipping every call after the first within a request sidesteps
		// that WP-core double-sanitize without changing the stored format.
		static $already_sanitized = false;
		if ($already_sanitized) {
			return (array) $value;
		}
		$already_sanitized = true;

		$all_names = wp_list_pluck(self::manageable_blocks(), 'name');
		$enabled = [];
		foreach ((array) $value as $name) {
			$name = (string) $name;
			if (0 === strpos($name, self::NAMESPACE_PREFIX) && preg_match('#^[a-z0-9-]+/[a-z0-9-]+$#', $name)) {
				$enabled[] = $name;
			}
		}
		return array_values(array_diff($all_names, $enabled));
	}

	// -- Element Manager -----------------------------------------------------

	/**
	 * @param array  $args       Block type arguments.
	 * @param string $block_name Block name.
	 * @return array
	 */
	public function hide_disabled_blocks($args, $block_name)
	{
		static $disabled = null;
		if (0 !== strpos($block_name, self::NAMESPACE_PREFIX)) {
			return $args;
		}
		if (null === $disabled) {
			$disabled = array_flip((array) get_option(self::OPTION_DISABLED, []));
		}
		if (isset($disabled[$block_name])) {
			$args['supports'] = array_merge(isset($args['supports']) ? $args['supports'] : [], ['inserter' => false]);
		}
		return $args;
	}

	/**
	 * Blocks to leave out of the inserter: turned off here in Element
	 * Manager.
	 *
	 * @return string[]
	 */
	public static function hidden_blocks()
	{
		$hidden = (array) get_option(self::OPTION_DISABLED, []);
		return array_values(array_unique($hidden));
	}

	/**
	 * The editor registers blocks from their own block.json, so the
	 * server's "inserter: false" does not reach it. This attaches a tiny
	 * filter directly to the 'wp-blocks' script, as inline code that runs
	 * right after it, instead of enqueuing a separate sibling script.
	 *
	 * A separate script can't be relied on to run before every block's own
	 * registerBlockType() call: WordPress enqueues each block's editor
	 * script on this same `enqueue_block_editor_assets` hook (core's
	 * wp_enqueue_registered_block_scripts_and_styles(), added before any
	 * plugin runs), so a same-priority sibling here prints after them, too
	 * late to affect their registration. Every block script depends on
	 * 'wp-blocks' (directly or through further dependencies) to call
	 * registerBlockType() at all, so code attached to 'wp-blocks' itself
	 * is always guaranteed to run first, regardless of enqueue order.
	 */
	public function enqueue_hidden_blocks_script()
	{
		$hidden = self::hidden_blocks();
		if (!$hidden) {
			return;
		}

		$code = sprintf(
			'(function(){var hidden=new Set(%s);wp.hooks.addFilter("blocks.registerBlockType","blockive/hidden-blocks",function(settings,name){return hidden.has(name)?Object.assign({},settings,{supports:Object.assign({},settings.supports,{inserter:false})}):settings;});})();',
			wp_json_encode(array_values($hidden))
		);

		wp_add_inline_script('wp-blocks', $code, 'after');
	}

	/**
	 * Blockive blocks a site owner would add (not template-only pieces or
	 * child blocks), sorted by title.
	 *
	 * @return WP_Block_Type[]
	 */
	private static function manageable_blocks()
	{
		$blocks = [];
		foreach (WP_Block_Type_Registry::get_instance()->get_all_registered() as $name => $type) {
			if (0 !== strpos($name, self::NAMESPACE_PREFIX) || !empty($type->parent) || 0 === strpos($name, self::NAMESPACE_PREFIX . 'tb-')) {
				continue;
			}
			$blocks[] = $type;
		}
		usort($blocks, function ($a, $b) {
			return strcasecmp((string) $a->title, (string) $b->title);
		});
		return $blocks;
	}

	/**
	 * Categorizes a block name for Element Manager filtering.
	 *
	 * @param string $name Block name slug.
	 * @return string Category slug.
	 */
	private static function get_block_category($name)
	{
		$slug = str_replace(self::NAMESPACE_PREFIX, '', $name);
		if (false !== strpos($slug, 'product') || false !== strpos($slug, 'woo') || false !== strpos($slug, 'cart')) {
			return 'woocommerce';
		}
		if (false !== strpos($slug, 'loop') || false !== strpos($slug, 'grid') || false !== strpos($slug, 'portfolio') || false !== strpos($slug, 'archive')) {
			return 'loops';
		}
		if (false !== strpos($slug, 'menu') || false !== strpos($slug, 'search') || false !== strpos($slug, 'sitemap') || false !== strpos($slug, 'breadcrumb') || false !== strpos($slug, 'toc') || false !== strpos($slug, 'table-of-contents')) {
			return 'navigation';
		}
		if (false !== strpos($slug, 'carousel') || false !== strpos($slug, 'slides') || false !== strpos($slug, 'accordion') || false !== strpos($slug, 'tabs') || false !== strpos($slug, 'flip-box') || false !== strpos($slug, 'hotspot') || false !== strpos($slug, 'off-canvas') || false !== strpos($slug, 'form') || false !== strpos($slug, 'mailchimp')) {
			return 'interactive';
		}
		if (false !== strpos($slug, 'price') || false !== strpos($slug, 'pricing') || false !== strpos($slug, 'fun-fact') || false !== strpos($slug, 'progress') || false !== strpos($slug, 'testimonial') || false !== strpos($slug, 'review') || false !== strpos($slug, 'social') || false !== strpos($slug, 'countdown') || false !== strpos($slug, 'floating-button') || false !== strpos($slug, 'link-in-bio') || false !== strpos($slug, 'call-to-action')) {
			return 'marketing';
		}
		return 'content';
	}

	// -- Page ------------------------------------------------------------------

	public function render_page()
	{
		if (!current_user_can('manage_options')) {
			return;
		}
		$disabled = array_flip((array) get_option(self::OPTION_DISABLED, []));
		$blocks = self::manageable_blocks();
		$total_blocks = count($blocks);
		$disabled_count = count(array_intersect_key($disabled, array_flip(wp_list_pluck($blocks, 'name'))));
		$active_count = max(0, $total_blocks - $disabled_count);
		?>
		<div class="wrap bpafb-dashboard-wrap">
			<!-- Header Banner -->
			<div class="bpafb-dashboard-header">
				<div class="bpafb-dashboard-brand">
					<div class="bpafb-dashboard-logo-icon">B</div>
					<div>
						<h1>
							<?php esc_html_e('Blockive', 'blockive-premium-addon-for-block'); ?>
							<span class="bpafb-badge-pro"><?php esc_html_e('Site Tools', 'blockive-premium-addon-for-block'); ?></span>
						</h1>
						<p><?php esc_html_e('Manage the active blocks in your inserter.', 'blockive-premium-addon-for-block'); ?></p>
					</div>
				</div>
				<div class="bpafb-dashboard-header-actions">
					<a href="<?php echo esc_url(admin_url('edit.php?post_type=' . Bpafb_Template_Post_Type::POST_TYPE)); ?>" class="bpafb-btn-secondary">
						<span class="dashicons dashicons-layout" style="font-size: 16px; width: 16px; height: 16px; line-height: 16px;"></span>
						<?php esc_html_e('All Templates', 'blockive-premium-addon-for-block'); ?>
					</a>
					<button type="button" class="bpafb-btn-primary bpafb-header-save-btn">
						<span class="dashicons dashicons-saved" style="font-size: 16px; width: 16px; height: 16px; line-height: 16px;"></span>
						<?php esc_html_e('Save Changes', 'blockive-premium-addon-for-block'); ?>
					</button>
				</div>
			</div>

			<?php
			// WordPress's admin JS relocates `.notice` elements (like the
			// "Settings saved." box from settings_errors() below) to sit
			// right after the page's first <h1> when it finds no
			// `.wp-header-end` marker - which, on this page, is the one
			// inside the dark gradient header banner above. This marker
			// tells it to anchor notices here instead, after the banner.
			?>
			<hr class="wp-header-end">

			<?php settings_errors(); ?>

			<form method="post" action="options.php" id="bpafb-site-tools-form">
				<?php settings_fields(self::PAGE); ?>

				<div class="bpafb-dashboard-body">
					<div class="bpafb-card">
						<div class="bpafb-card-header">
							<div class="bpafb-card-header-left">
								<h2>
									<?php esc_html_e('Block Element Manager', 'blockive-premium-addon-for-block'); ?>
									<span style="font-size: 12px; font-weight: normal; color: var(--bpafb-slate-500); margin-left: 8px;" id="bpafb-active-count-text">
										(<?php printf(esc_html__('%d active of %d total', 'blockive-premium-addon-for-block'), $active_count, $total_blocks); ?>)
									</span>
								</h2>
								<p><?php esc_html_e('Deactivate blocks you don\'t use to keep the block inserter clean and fast. Existing blocks on published pages remain working.', 'blockive-premium-addon-for-block'); ?></p>
							</div>
							<div class="bpafb-header-actions" style="display: flex; gap: 8px;">
								<button type="button" class="bpafb-btn-secondary-sm" id="bpafb-enable-all-btn"><?php esc_html_e('Enable All', 'blockive-premium-addon-for-block'); ?></button>
								<button type="button" class="bpafb-btn-secondary-sm" id="bpafb-disable-all-btn"><?php esc_html_e('Disable All', 'blockive-premium-addon-for-block'); ?></button>
							</div>
						</div>
						<div class="bpafb-card-body">
							<div class="bpafb-elements-toolbar">
								<div class="bpafb-search-box">
									<span class="dashicons dashicons-search bpafb-search-icon"></span>
									<input type="text" class="bpafb-search-input" id="bpafb-block-search" placeholder="<?php esc_attr_e('Search blocks...', 'blockive-premium-addon-for-block'); ?>">
								</div>
								<div class="bpafb-filter-chips">
									<button type="button" class="bpafb-chip-btn is-active" data-filter="all"><?php esc_html_e('All', 'blockive-premium-addon-for-block'); ?> (<?php echo (int) $total_blocks; ?>)</button>
									<button type="button" class="bpafb-chip-btn" data-filter="content"><?php esc_html_e('Content', 'blockive-premium-addon-for-block'); ?></button>
									<button type="button" class="bpafb-chip-btn" data-filter="interactive"><?php esc_html_e('Interactive', 'blockive-premium-addon-for-block'); ?></button>
									<button type="button" class="bpafb-chip-btn" data-filter="navigation"><?php esc_html_e('Navigation', 'blockive-premium-addon-for-block'); ?></button>
									<button type="button" class="bpafb-chip-btn" data-filter="loops"><?php esc_html_e('Loops & Query', 'blockive-premium-addon-for-block'); ?></button>
									<button type="button" class="bpafb-chip-btn" data-filter="marketing"><?php esc_html_e('Marketing', 'blockive-premium-addon-for-block'); ?></button>
									<button type="button" class="bpafb-chip-btn" data-filter="woocommerce"><?php esc_html_e('WooCommerce', 'blockive-premium-addon-for-block'); ?></button>
								</div>
							</div>

							<fieldset>
								<legend class="screen-reader-text"><?php esc_html_e('Blocks List', 'blockive-premium-addon-for-block'); ?></legend>
								<input type="hidden" name="<?php echo esc_attr(self::OPTION_DISABLED); ?>" value="">
								<div class="bpafb-blocks-grid" id="bpafb-blocks-grid">
									<?php foreach ($blocks as $type) : ?>
										<?php
										$is_disabled = isset($disabled[$type->name]);
										$category = self::get_block_category($type->name);
										$title = $type->title ? $type->title : $type->name;
										?>
										<div class="bpafb-block-card <?php echo $is_disabled ? 'is-disabled' : ''; ?>" data-name="<?php echo esc_attr(strtolower($title . ' ' . $type->name)); ?>" data-category="<?php echo esc_attr($category); ?>">
											<div class="bpafb-block-info">
												<span class="bpafb-block-title" title="<?php echo esc_attr($title); ?>"><?php echo esc_html($title); ?></span>
												<span class="bpafb-block-category"><?php echo esc_html($category); ?></span>
											</div>
											<label class="bpafb-switch" title="<?php printf(esc_attr__('Toggle %s block', 'blockive-premium-addon-for-block'), esc_attr($title)); ?>">
												<input type="checkbox" class="bpafb-block-checkbox" name="<?php echo esc_attr(self::OPTION_DISABLED); ?>[]" value="<?php echo esc_attr($type->name); ?>" <?php checked(!$is_disabled); ?>>
												<span class="bpafb-slider"></span>
											</label>
										</div>
									<?php endforeach; ?>
								</div>
							</fieldset>
						</div>
					</div>
				</div>

				<div style="margin-top: 24px; display: flex; justify-content: flex-end;">
					<button type="submit" class="bpafb-btn-primary" style="padding: 12px 28px; font-size: 14px;">
						<span class="dashicons dashicons-saved" style="font-size: 18px; width: 18px; height: 18px; line-height: 18px;"></span>
						<?php esc_html_e('Save Changes', 'blockive-premium-addon-for-block'); ?>
					</button>
				</div>
			</form>
		</div>

		<script>
		( function () {
			// Header Save Button
			var headerSaveBtn = document.querySelector( '.bpafb-header-save-btn' );
			var form = document.getElementById( 'bpafb-site-tools-form' );
			if ( headerSaveBtn && form ) {
				headerSaveBtn.addEventListener( 'click', function () {
					if ( form.requestSubmit ) {
						form.requestSubmit();
					} else {
						form.submit();
					}
				} );
			}

			// Element Manager Search & Filter
			var searchInput = document.getElementById( 'bpafb-block-search' );
			var filterChips = document.querySelectorAll( '.bpafb-chip-btn' );
			var blockCards = document.querySelectorAll( '.bpafb-block-card' );
			var currentFilter = 'all';
			var currentQuery = '';

			function filterBlocks() {
				blockCards.forEach( function ( card ) {
					var matchesCategory = ( currentFilter === 'all' || card.getAttribute( 'data-category' ) === currentFilter );
					var matchesQuery = ( currentQuery === '' || card.getAttribute( 'data-name' ).indexOf( currentQuery ) !== -1 );
					card.style.display = ( matchesCategory && matchesQuery ) ? 'flex' : 'none';
				} );
			}

			if ( searchInput ) {
				searchInput.addEventListener( 'input', function () {
					currentQuery = this.value.toLowerCase().trim();
					filterBlocks();
				} );
			}

			filterChips.forEach( function ( chip ) {
				chip.addEventListener( 'click', function () {
					filterChips.forEach( function ( c ) { c.classList.remove( 'is-active' ); } );
					this.classList.add( 'is-active' );
					currentFilter = this.getAttribute( 'data-filter' );
					filterBlocks();
				} );
			} );

			// Element Card Toggle Active Style & Dynamic Counter
			var blockCheckboxes = document.querySelectorAll( '.bpafb-block-checkbox' );
			var countText = document.getElementById( 'bpafb-active-count-text' );

			function updateActiveCounter() {
				if ( ! countText || ! blockCheckboxes.length ) return;
				var activeCount = 0;
				blockCheckboxes.forEach( function ( cb ) {
					if ( cb.checked ) activeCount++;
				} );
				countText.textContent = '(' + activeCount + ' active of ' + blockCheckboxes.length + ' total)';
			}

			blockCheckboxes.forEach( function ( cb ) {
				cb.addEventListener( 'change', function () {
					var card = this.closest( '.bpafb-block-card' );
					if ( card ) {
						card.classList.toggle( 'is-disabled', ! this.checked );
					}
					updateActiveCounter();
				} );
			} );

			// Bulk Enable / Disable
			var enableAllBtn = document.getElementById( 'bpafb-enable-all-btn' );
			var disableAllBtn = document.getElementById( 'bpafb-disable-all-btn' );
			if ( enableAllBtn ) {
				enableAllBtn.addEventListener( 'click', function () {
					blockCheckboxes.forEach( function ( cb ) {
						cb.checked = true;
						var card = cb.closest( '.bpafb-block-card' );
						if ( card ) card.classList.remove( 'is-disabled' );
					} );
					updateActiveCounter();
				} );
			}
			if ( disableAllBtn ) {
				disableAllBtn.addEventListener( 'click', function () {
					blockCheckboxes.forEach( function ( cb ) {
						cb.checked = false;
						var card = cb.closest( '.bpafb-block-card' );
						if ( card ) card.classList.add( 'is-disabled' );
					} );
					updateActiveCounter();
				} );
			}
		} )();
		</script>
		<?php
	}
}
