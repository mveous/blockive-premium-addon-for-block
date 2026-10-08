<?php
/**
 * Site Tools (Blockive Templates → Site Tools):
 *
 * - Element Manager: the only section that actually works in the free
 *   plugin. Blockive blocks turned off here are hidden from the inserter
 *   (blocks already on pages keep working). The grid also lists every
 *   block only Blockive Pro has (self::LOCKED_BLOCKS), tagged "PRO", the
 *   same way Bpafb_Locked_Blocks advertises them in the inserter itself.
 * - Custom Code, Custom Fonts, Page Transitions, and Template Builder
 *   Access (Bpafb_Custom_Fonts / Bpafb_Role_Manager) are Blockive Pro
 *   features: their tabs stay in the sidebar, tagged "PRO", but render a
 *   locked teaser instead of the real form. The underlying classes and
 *   settings still exist and still run (so nothing breaks if Pro is later
 *   installed over this data), they are just never reachable through this
 *   UI.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Bpafb_Site_Tools
{
	const PAGE = 'bpafb-site-tools';
	const OPTION_CODE = 'bpafb_custom_code';
	const OPTION_DISABLED = 'bpafb_disabled_blocks';
	const OPTION_TRANSITIONS = 'bpafb_page_transitions';
	const NAMESPACE_PREFIX = 'blockive-premium-addon-for-block/';
	const CODE_PLACES = ['head', 'body', 'footer'];

	/**
	 * The regular blocks only Blockive Pro has, shown in Element Manager
	 * tagged "PRO" so free users can see what Pro adds. Slug and title
	 * must be kept in sync by hand with src/locked-blocks/block-list.js
	 * (the inserter's own copy of this same list) - there is no single
	 * source both PHP and that JS bundle can read from.
	 *
	 * @var array<int,array{slug:string,title:string}>
	 */
	const LOCKED_BLOCKS = [
		['slug' => 'animated-headline', 'title' => 'Animated Headline'],
		['slug' => 'blockquote', 'title' => 'Blockquote'],
		['slug' => 'call-to-action', 'title' => 'Call to Action'],
		['slug' => 'code-highlight', 'title' => 'Code Highlight'],
		['slug' => 'flip-box', 'title' => 'Flip Box'],
		['slug' => 'icon', 'title' => 'Icon'],
		['slug' => 'icon-list', 'title' => 'Icon List'],
		['slug' => 'price-list', 'title' => 'Price List'],
		['slug' => 'progress-tracker', 'title' => 'Progress Tracker'],
		['slug' => 'table-of-contents', 'title' => 'Table of Contents'],
		['slug' => 'template', 'title' => 'Template'],
		['slug' => 'gallery', 'title' => 'Gallery'],
		['slug' => 'hotspot', 'title' => 'Hotspot'],
		['slug' => 'media-carousel', 'title' => 'Media Carousel'],
		['slug' => 'nested-carousel', 'title' => 'Nested Carousel'],
		['slug' => 'slides', 'title' => 'Slides'],
		['slug' => 'testimonial-carousel', 'title' => 'Testimonial Carousel'],
		['slug' => 'reviews', 'title' => 'Reviews'],
		['slug' => 'video-playlist', 'title' => 'Video Playlist'],
		['slug' => 'google-maps', 'title' => 'Google Maps'],
		['slug' => 'facebook-embed', 'title' => 'Facebook Embed'],
		['slug' => 'loop-grid', 'title' => 'Loop Grid'],
		['slug' => 'loop-carousel', 'title' => 'Loop Carousel'],
		['slug' => 'loop-filter', 'title' => 'Loop Filter'],
		['slug' => 'portfolio', 'title' => 'Portfolio'],
		['slug' => 'menu', 'title' => 'Menu'],
		['slug' => 'mega-menu', 'title' => 'Mega Menu'],
		['slug' => 'off-canvas', 'title' => 'Off-Canvas'],
		['slug' => 'form', 'title' => 'Form'],
		['slug' => 'floating-buttons', 'title' => 'Floating Buttons'],
		['slug' => 'link-in-bio', 'title' => 'Link in Bio'],
		['slug' => 'share-buttons', 'title' => 'Share Buttons'],
		['slug' => 'products', 'title' => 'Products'],
		['slug' => 'product-categories', 'title' => 'Product Categories'],
		['slug' => 'add-to-cart', 'title' => 'Add to Cart Button'],
	];

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
		add_action('admin_init', [$this, 'register_settings']);
		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
		add_filter('register_block_type_args', [$this, 'hide_disabled_blocks'], 20, 2);
		add_action('enqueue_block_editor_assets', [$this, 'enqueue_hidden_blocks_script']);

		add_action('wp_head', [$this, 'print_head'], 99);
		add_action('wp_body_open', [$this, 'print_body'], 1);
		add_action('wp_footer', [$this, 'print_footer'], 99);
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

	public function register_settings()
	{
		register_setting(self::PAGE, self::OPTION_CODE, [
			'type'              => 'array',
			'sanitize_callback' => [$this, 'sanitize_code'],
			'default'           => [],
		]);
		register_setting(self::PAGE, self::OPTION_DISABLED, [
			'type'              => 'array',
			'sanitize_callback' => [$this, 'sanitize_disabled'],
			'default'           => [],
		]);
		register_setting(self::PAGE, Bpafb_Custom_Fonts::OPTION, [
			'type'              => 'array',
			'sanitize_callback' => ['Bpafb_Custom_Fonts', 'sanitize'],
			'default'           => [],
		]);
		register_setting(self::PAGE, Bpafb_Role_Manager::OPTION, [
			'type'              => 'array',
			'sanitize_callback' => ['Bpafb_Role_Manager', 'sanitize'],
			'default'           => [],
		]);
		register_setting(self::PAGE, self::OPTION_TRANSITIONS, [
			'type'              => 'array',
			'sanitize_callback' => [$this, 'sanitize_transitions'],
			'default'           => [],
		]);
	}

	/**
	 * Keeps the saved code unless the user may post unfiltered HTML (the
	 * code is printed as it is, script included).
	 *
	 * @param mixed $value Submitted value.
	 * @return array
	 */
	public function sanitize_code($value)
	{
		$saved = get_option(self::OPTION_CODE, []);
		if (!current_user_can('unfiltered_html')) {
			return is_array($saved) ? $saved : [];
		}
		$clean = [];
		foreach (self::CODE_PLACES as $place) {
			$clean[$place] = isset($value[$place]) && is_string($value[$place]) ? $value[$place] : '';
		}
		return $clean;
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

	/**
	 * @param mixed $value Submitted settings.
	 * @return array
	 */
	public function sanitize_transitions($value)
	{
		return [
			'enabled'  => !empty($value['enabled']),
			'duration' => isset($value['duration']) ? max(100, min(1500, (int) $value['duration'])) : 300,
		];
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

	/**
	 * self::LOCKED_BLOCKS with each entry's full block name and Element
	 * Manager category filled in.
	 *
	 * @return array<int,array{slug:string,title:string,name:string,category:string}>
	 */
	private static function locked_blocks()
	{
		return array_map(function ($block) {
			$block['name'] = self::NAMESPACE_PREFIX . $block['slug'];
			$block['category'] = self::get_block_category($block['name']);
			return $block;
		}, self::LOCKED_BLOCKS);
	}

	/**
	 * A locked teaser card for a whole Site Tools section (Custom Code,
	 * Custom Fonts, Page Transitions, Template Builder Access), the same
	 * "(Pro)" treatment self::LOCKED_BLOCKS gives individual blocks.
	 *
	 * @param string $title       Section title, e.g. "Custom Code Snippets".
	 * @param string $description One line under the title.
	 */
	private static function render_locked_section($title, $description)
	{
		?>
		<div class="bpafb-card">
			<div class="bpafb-card-body bpafb-locked-section">
				<span class="dashicons dashicons-lock" aria-hidden="true"></span>
				<h2>
					<?php echo esc_html($title); ?>
					<span class="bpafb-badge-pro"><?php esc_html_e('PRO', 'blockive-premium-addon-for-block'); ?></span>
				</h2>
				<p><?php echo esc_html($description); ?></p>
				<p class="bpafb-locked-section-note"><?php esc_html_e('This feature is part of Blockive Pro and is not available in the free version.', 'blockive-premium-addon-for-block'); ?></p>
			</div>
		</div>
		<?php
	}

	// -- Front end -------------------------------------------------------------

	/**
	 * @param string $place head, body, or footer.
	 * @return string
	 */
	private static function code($place)
	{
		$code = get_option(self::OPTION_CODE, []);
		return is_array($code) && isset($code[$place]) ? (string) $code[$place] : '';
	}

	public function print_head()
	{
		if (is_admin()) {
			return;
		}
		$transitions = get_option(self::OPTION_TRANSITIONS, []);
		if (!empty($transitions['enabled'])) {
			$duration = isset($transitions['duration']) ? (int) $transitions['duration'] : 300;
			printf(
				'<style id="bpafb-page-transitions">@media (prefers-reduced-motion: no-preference) { @view-transition { navigation: auto; } ::view-transition-old(root), ::view-transition-new(root) { animation-duration: %dms; } }</style>' . "\n",
				max(100, min(1500, $duration))
			);
		}
		echo self::code('head'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- saved only by users with unfiltered_html.
	}

	public function print_body()
	{
		if (!is_admin()) {
			echo self::code('body'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- saved only by users with unfiltered_html.
		}
	}

	public function print_footer()
	{
		if (!is_admin()) {
			echo self::code('footer'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- saved only by users with unfiltered_html.
		}
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
		$locked_blocks = self::locked_blocks();
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
						<p><?php esc_html_e('Manage the active blocks in your inserter. Custom code, fonts, transitions, and role permissions are Blockive Pro features.', 'blockive-premium-addon-for-block'); ?></p>
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
					<!-- Sidebar Tabs Navigation -->
					<div class="bpafb-nav-tabs" role="tablist" aria-orientation="vertical" aria-label="<?php esc_attr_e('Site Tools sections', 'blockive-premium-addon-for-block'); ?>">
						<button type="button" class="bpafb-tab-btn is-active" id="bpafb-tab-btn-element-manager" data-tab="element-manager" role="tab" aria-controls="tab-element-manager" aria-selected="true" tabindex="0">
							<span class="bpafb-tab-icon dashicons dashicons-screenoptions"></span>
							<span><?php esc_html_e('Element Manager', 'blockive-premium-addon-for-block'); ?></span>
						</button>
						<button type="button" class="bpafb-tab-btn" id="bpafb-tab-btn-custom-code" data-tab="custom-code" role="tab" aria-controls="tab-custom-code" aria-selected="false" tabindex="-1">
							<span class="bpafb-tab-icon dashicons dashicons-editor-code"></span>
							<span><?php esc_html_e('Custom Code', 'blockive-premium-addon-for-block'); ?></span>
							<span class="bpafb-badge-pro"><?php esc_html_e('PRO', 'blockive-premium-addon-for-block'); ?></span>
						</button>
						<button type="button" class="bpafb-tab-btn" id="bpafb-tab-btn-custom-fonts" data-tab="custom-fonts" role="tab" aria-controls="tab-custom-fonts" aria-selected="false" tabindex="-1">
							<span class="bpafb-tab-icon dashicons dashicons-editor-customchar"></span>
							<span><?php esc_html_e('Custom Fonts', 'blockive-premium-addon-for-block'); ?></span>
							<span class="bpafb-badge-pro"><?php esc_html_e('PRO', 'blockive-premium-addon-for-block'); ?></span>
						</button>
						<button type="button" class="bpafb-tab-btn" id="bpafb-tab-btn-page-transitions" data-tab="page-transitions" role="tab" aria-controls="tab-page-transitions" aria-selected="false" tabindex="-1">
							<span class="bpafb-tab-icon dashicons dashicons-image-rotate"></span>
							<span><?php esc_html_e('Page Transitions', 'blockive-premium-addon-for-block'); ?></span>
							<span class="bpafb-badge-pro"><?php esc_html_e('PRO', 'blockive-premium-addon-for-block'); ?></span>
						</button>
						<button type="button" class="bpafb-tab-btn" id="bpafb-tab-btn-role-manager" data-tab="role-manager" role="tab" aria-controls="tab-role-manager" aria-selected="false" tabindex="-1">
							<span class="bpafb-tab-icon dashicons dashicons-shield"></span>
							<span><?php esc_html_e('Role Access', 'blockive-premium-addon-for-block'); ?></span>
							<span class="bpafb-badge-pro"><?php esc_html_e('PRO', 'blockive-premium-addon-for-block'); ?></span>
						</button>
					</div>

					<!-- Tab Contents -->
					<div class="bpafb-tab-contents">
						<!-- 1. Custom Code Tab (Pro) -->
						<div class="bpafb-tab-panel" id="tab-custom-code" role="tabpanel" aria-labelledby="bpafb-tab-btn-custom-code" tabindex="0">
							<?php
							self::render_locked_section(
								__('Custom Code Snippets', 'blockive-premium-addon-for-block'),
								__('Inject scripts, tracking tags, and pixels site-wide without editing theme files.', 'blockive-premium-addon-for-block')
							);
							?>
						</div>
						<!-- 2. Custom Fonts Tab (Pro) -->
						<div class="bpafb-tab-panel" id="tab-custom-fonts" role="tabpanel" aria-labelledby="bpafb-tab-btn-custom-fonts" tabindex="0">
							<?php
							self::render_locked_section(
								__('Custom Fonts Manager', 'blockive-premium-addon-for-block'),
								__('Upload local font files (WOFF2, WOFF, TTF, OTF). Registered fonts automatically load in the editor and on the front end.', 'blockive-premium-addon-for-block')
							);
							?>
						</div>

						<!-- 3. Page Transitions Tab (Pro) -->
						<div class="bpafb-tab-panel" id="tab-page-transitions" role="tabpanel" aria-labelledby="bpafb-tab-btn-page-transitions" tabindex="0">
							<?php
							self::render_locked_section(
								__('Native Page Transitions', 'blockive-premium-addon-for-block'),
								__('Smooth, zero-JavaScript page transitions using the modern browser View Transitions API.', 'blockive-premium-addon-for-block')
							);
							?>
						</div>

						<!-- 4. Role Manager Tab (Pro) -->
						<div class="bpafb-tab-panel" id="tab-role-manager" role="tabpanel" aria-labelledby="bpafb-tab-btn-role-manager" tabindex="0">
							<?php
							self::render_locked_section(
								__('Template Builder Access Control', 'blockive-premium-addon-for-block'),
								__('Select user roles allowed to design and edit site templates (Headers, Footers, Single, Archives, Popups).', 'blockive-premium-addon-for-block')
							);
							?>
						</div>

						<!-- 5. Element Manager Tab -->
						<div class="bpafb-tab-panel is-active" id="tab-element-manager" role="tabpanel" aria-labelledby="bpafb-tab-btn-element-manager" tabindex="0">
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
											<?php foreach ($locked_blocks as $locked) : ?>
												<div class="bpafb-block-card is-locked" data-name="<?php echo esc_attr(strtolower($locked['title'] . ' ' . $locked['name'])); ?>" data-category="<?php echo esc_attr($locked['category']); ?>">
													<div class="bpafb-block-info">
														<span class="bpafb-block-title" title="<?php echo esc_attr($locked['title']); ?>"><?php echo esc_html($locked['title']); ?></span>
														<span class="bpafb-block-category"><?php echo esc_html($locked['category']); ?></span>
													</div>
													<span class="bpafb-badge-pro"><?php esc_html_e('PRO', 'blockive-premium-addon-for-block'); ?></span>
												</div>
											<?php endforeach; ?>
										</div>
									</fieldset>
								</div>
							</div>
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
			// Tab Navigation
			var tabButtons = Array.prototype.slice.call( document.querySelectorAll( '.bpafb-tab-btn' ) );
			var tabPanels = document.querySelectorAll( '.bpafb-tab-panel' );
			// options.php sends us back to this field's URL after saving; the
			// browser does not post the #tab, so it is added here to reopen
			// the same tab.
			var referer = document.querySelector( '#bpafb-site-tools-form input[name="_wp_http_referer"]' );
			var refererBase = referer ? referer.value.split( '#' )[ 0 ] : '';
			function switchTab( targetId ) {
				tabButtons.forEach( function ( btn ) {
					var isActive = btn.getAttribute( 'data-tab' ) === targetId;
					btn.classList.toggle( 'is-active', isActive );
					btn.setAttribute( 'aria-selected', isActive ? 'true' : 'false' );
					btn.setAttribute( 'tabindex', isActive ? '0' : '-1' );
				} );
				tabPanels.forEach( function ( panel ) {
					panel.classList.toggle( 'is-active', panel.id === 'tab-' + targetId );
				} );
				if ( referer ) {
					referer.value = refererBase + '#' + targetId;
				}
				if ( window.history && window.history.replaceState ) {
					window.history.replaceState( null, '', '#' + targetId );
				}
			}

			tabButtons.forEach( function ( btn, index ) {
				btn.addEventListener( 'click', function () {
					switchTab( this.getAttribute( 'data-tab' ) );
				} );
				// Arrow keys, Home, and End move between tabs (WAI-ARIA tabs).
				btn.addEventListener( 'keydown', function ( event ) {
					var last = tabButtons.length - 1;
					var target = null;
					if ( 'ArrowDown' === event.key || 'ArrowRight' === event.key ) {
						target = index === last ? 0 : index + 1;
					} else if ( 'ArrowUp' === event.key || 'ArrowLeft' === event.key ) {
						target = index === 0 ? last : index - 1;
					} else if ( 'Home' === event.key ) {
						target = 0;
					} else if ( 'End' === event.key ) {
						target = last;
					}
					if ( null === target ) {
						return;
					}
					event.preventDefault();
					switchTab( tabButtons[ target ].getAttribute( 'data-tab' ) );
					tabButtons[ target ].focus();
				} );
			} );

			// Open the tab named in the URL (also after saving).
			var initialHash = window.location.hash ? window.location.hash.replace( '#', '' ) : '';
			var initialPanel = initialHash ? document.getElementById( 'tab-' + initialHash ) : null;
			if ( initialPanel && initialPanel.classList.contains( 'bpafb-tab-panel' ) ) {
				switchTab( initialHash );
			}

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

			// Page Transitions Duration Slider
			var rangeInput = document.getElementById( 'bpafb-transition-range' );
			var hiddenDuration = document.getElementById( 'bpafb-transition-duration' );
			var durationVal = document.getElementById( 'bpafb-transition-val' );
			if ( rangeInput && hiddenDuration && durationVal ) {
				rangeInput.addEventListener( 'input', function () {
					hiddenDuration.value = this.value;
					durationVal.textContent = this.value + 'ms';
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
