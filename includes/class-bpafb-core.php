<?php
/**
 * Main Class for Blockive Premium Addon For Block: block registration,
 * shared container styling, and save-time security.
 *
 * Extracted out of the plugin's main file so both the free plugin and
 * Blockive Pro can require and instantiate this identical class - Pro syncs
 * this file verbatim rather than parsing the free plugin's whole bootstrap
 * file.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Blockive_Premium_Addon_For_Block
{

	/**
	 * The single instance of this class.
	 *
	 * @var Blockive_Premium_Addon_For_Block|null
	 */
	private static $instance = null;

	/**
	 * Retrieves (creating if necessary) the single instance of this class.
	 *
	 * @return Blockive_Premium_Addon_For_Block
	 */
	public static function get_instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct()
	{
		$this->bpafb_setup_hooks();
		Bpafb_Template_Post_Type::get_instance();
		Bpafb_Template_Builder::get_instance();
		Bpafb_Template_Blocks::get_instance();
		Bpafb_Template_Display_Conditions::get_instance();
		Bpafb_Template_Frontend_Render::get_instance();
	}

	/**
	 * Prevents cloning of the instance.
	 */
	private function __clone()
	{
	}

	/**
	 * Prevents unserializing of the instance.
	 */
	public function __wakeup()
	{
		throw new \Exception('Cannot unserialize a singleton.');
	}

	/**
	 * Setup WordPress hooks.
	 */
	public function bpafb_setup_hooks()
	{
		add_filter('block_categories_all', [$this, 'bpafb_register_block_categories'], 10, 2);
		add_action('init', [$this, 'bpafb_register_blocks']);
		add_action('enqueue_block_assets', [$this, 'bpafb_enqueue_global_assets']);
		add_action('enqueue_block_editor_assets', [$this, 'bpafb_enqueue_editor_assets']);
		add_action('wp_enqueue_scripts', [$this, 'bpafb_enqueue_frontend_block_spacing']);
		add_filter('render_block', [$this, 'bpafb_render_block_container'], 10, 2);
		add_filter('render_block', [$this, 'bpafb_inject_faq_schema'], 10, 3);
		add_filter('content_save_pre', [$this, 'bpafb_strip_unauthorized_custom_css']);
	}

	/**
	 * Registers the block categories.
	 *
	 * @param array $categories Array of categories for blocks.
	 * @return array
	 */
	public function bpafb_register_block_categories($categories)
	{
		return array_merge(
			[
				[
					'slug' => 'bpafb-widgets',
					'title' => esc_html__('Blockive', 'blockive-premium-addon-for-block'),
				],
			],
			$categories
		);
	}

	/**
	 * Registers the blocks based on the manifest.
	 */
	public function bpafb_register_blocks()
	{
		if (function_exists('wp_register_block_types_from_metadata_collection')) {
			wp_register_block_types_from_metadata_collection(BPAFB_PATH . 'build', BPAFB_PATH . 'build/blocks-manifest.php');
		} else {
			$block_json_files = glob(BPAFB_PATH . 'build/*/block.json');
			foreach ($block_json_files as $file) {
				register_block_type(dirname($file));
			}
		}

		$registry = WP_Block_Type_Registry::get_instance();

		// The `wp-scripts build --blocks-manifest` generator keys every block by its
		// immediate folder name only, which is what WP_Block_Metadata_Registry expects
		// to find one level under the collection root. All Template Builder blocks live
		// two levels down (build/template-blocks/<category>/<block>/), so the manifest
		// path above resolves to a non-existent block.json for them; WP core then leaves
		// `$metadata['file']` null and silently skips wiring up their `render` callback.
		// Re-register those specific blocks from their real block.json location so
		// render.php actually runs.
		foreach (glob(BPAFB_PATH . 'build/template-blocks/*/*/block.json') as $bpafb_tb_json) {
			$bpafb_tb_data = json_decode(file_get_contents($bpafb_tb_json), true);
			if (empty($bpafb_tb_data['name'])) {
				continue;
			}
			if ($registry->is_registered($bpafb_tb_data['name'])) {
				unregister_block_type($bpafb_tb_data['name']);
			}
			// The same mis-resolved nested path also breaks any script/style
			// the block declares (e.g. Related Posts' viewScript): the wrong
			// first pass above already registered its handle - with an
			// empty/incorrect URL, since asset resolution fails there too -
			// and register_block_script_handle()/register_block_style_handle()
			// silently skip re-registering a handle that already exists. Left
			// alone, register_block_type() below fixes the block's render
			// callback but the broken, empty-URL handle is still what ends up
			// enqueued on the frontend. Deregister first so the correctly
			// resolved registration below can actually take effect.
			$bpafb_tb_asset_fields = [
				'editorScript' => 'script',
				'script'       => 'script',
				'viewScript'   => 'script',
				'editorStyle'  => 'style',
				'style'        => 'style',
				'viewStyle'    => 'style',
			];
			foreach ($bpafb_tb_asset_fields as $bpafb_tb_field => $bpafb_tb_kind) {
				if (empty($bpafb_tb_data[$bpafb_tb_field])) {
					continue;
				}
				$bpafb_tb_values = is_array($bpafb_tb_data[$bpafb_tb_field]) ? $bpafb_tb_data[$bpafb_tb_field] : [$bpafb_tb_data[$bpafb_tb_field]];
				foreach ($bpafb_tb_values as $bpafb_tb_index => $bpafb_tb_value) {
					// Anything not using the "file:" convention is already a
					// handle name, not a path - nothing this plugin registered.
					if (!is_string($bpafb_tb_value) || strpos($bpafb_tb_value, 'file:') !== 0) {
						continue;
					}
					$bpafb_tb_handle = generate_block_asset_handle($bpafb_tb_data['name'], $bpafb_tb_field, $bpafb_tb_index);
					if ('script' === $bpafb_tb_kind) {
						wp_deregister_script($bpafb_tb_handle);
					} else {
						wp_deregister_style($bpafb_tb_handle);
					}
				}
			}

			register_block_type(dirname($bpafb_tb_json));
		}

		// Unregister blocks that require third-party plugins if those plugins are not active.
		// Contact Form 7
		if (!function_exists('wpcf7') && !defined('WPCF7_PLUGIN')) {
			if ($registry->is_registered('blockive-premium-addon-for-block/contact-form-7')) {
				unregister_block_type('blockive-premium-addon-for-block/contact-form-7');
			}
		}

	}

	/**
	 * Enqueue global assets for blocks.
	 */
	public function bpafb_enqueue_global_assets()
	{
		wp_enqueue_style('bpafb-font-awesome', BPAFB_URL . 'assets/vendor/fontawesome/css/all.min.css', [], '6.5.1');
		wp_enqueue_style('bpafb-container-settings', BPAFB_URL . 'assets/css/container-settings.css', [], BPAFB_VERSION);
		wp_enqueue_script(
			'bpafb-frontend-animations',
			BPAFB_URL . 'assets/js/frontend-animations.js',
			[],
			BPAFB_VERSION,
			true
		);
	}

	/**
	 * Gives every Blockive block a default top margin on the frontend,
	 * matching the ~24px gap the block editor already shows between blocks
	 * via Gutenberg's own "block gap" layout support.
	 *
	 * That editor spacing comes from a mechanism
	 * (`.is-layout-flow > * + * { margin-block-start: ... }`) that never
	 * reaches the frontend on a classic theme, and none of this plugin's
	 * blocks are semantic elements (they're all plain `<div>`s), so - unlike
	 * a paragraph or heading, which gets a real margin from the browser's
	 * own default stylesheet - two Blockive blocks placed directly next to
	 * each other rendered with zero space between them, even though the
	 * editor always showed a normal-looking gap.
	 *
	 * Mirrors Gutenberg's own selector shape - `previous + current`, adding
	 * margin-top to the second block rather than margin-bottom to the
	 * first - deliberately, not `margin-bottom` on every block: adjacent
	 * vertical margins collapse to whichever is larger, not their sum, so a
	 * block that deliberately zeroes its own margin (Post Title, Featured
	 * Image both use `margin: 0`) would otherwise cancel out a
	 * margin-bottom contributed by the block above it, leaving the block
	 * that actually wants the gap (e.g. Related Posts, which sets no margin
	 * of its own) stuck flush against it. Putting the margin on the
	 * following block's own margin-top instead means it collapses against
	 * whatever the previous block contributes and still wins (24 > 0)
	 * regardless of which side of the pair had the explicit override.
	 * `:where()` carries zero specificity, so a block that sets its own
	 * margin-top still overrides this either way, on both sides of the
	 * pair.
	 *
	 * Hooked to `wp_enqueue_scripts`, which - unlike `enqueue_block_assets`
	 * - never fires in wp-admin and is never mirrored into the block
	 * editor's iframed canvas, so this can't double up with the editor's
	 * own block-gap spacing.
	 */
	public function bpafb_enqueue_frontend_block_spacing()
	{
		wp_register_style('bpafb-frontend-block-spacing', false, [], BPAFB_VERSION);
		wp_enqueue_style('bpafb-frontend-block-spacing');
		wp_add_inline_style(
			'bpafb-frontend-block-spacing',
			':where([class*="wp-block-blockive-premium-addon-for-block-"])'
				. ' + :where([class*="wp-block-blockive-premium-addon-for-block-"])'
				. ' { margin-top: 24px; }'
		);
	}

	/**
	 * Enqueue script for block editor container settings.
	 */
	public function bpafb_enqueue_editor_assets()
	{
		wp_enqueue_style(
			'bpafb-editor-shared-controls',
			BPAFB_URL . 'assets/css/editor-shared-controls.css',
			[ 'wp-components' ],
			BPAFB_VERSION
		);
		wp_enqueue_script(
			'bpafb-editor-container-settings',
			BPAFB_URL . 'assets/js/editor-container-settings.js',
			[
				'wp-element',
				'wp-compose',
				'wp-hooks',
			],
			BPAFB_VERSION,
			true
		);

		// Lets AdvancedTab (bundled separately per block) know whether the
		// current user may use the Custom CSS field. This only controls the
		// editor UI; the actual security boundary is enforced server-side at
		// save time, see bpafb_strip_unauthorized_custom_css().
		wp_localize_script(
			'bpafb-editor-container-settings',
			'bpafbEditorSettings',
			[
				'canUseCustomCss' => current_user_can('unfiltered_html'),
			]
		);
	}

	/**
	 * Filter block rendering on frontend to apply container styles.
	 *
	 * @param string $block_content The block content.
	 * @param array  $block         The block record.
	 * @return string
	 */
	public function bpafb_render_block_container($block_content, $block)
	{
		// Only target blocks from blockive-premium-addon-for-block namespace
		if (empty($block['blockName']) || strpos($block['blockName'], 'blockive-premium-addon-for-block/') !== 0) {
			return $block_content;
		}

		$attrs = isset($block['attrs']) ? $block['attrs'] : [];

		// Check if any Advanced-tab attributes are set at all (see src/components/advanced-tab).
		$has_container_settings = false;
		foreach ($attrs as $key => $value) {
			if (strpos($key, 'bpafb') === 0 && $value !== null && $value !== '' && $value !== false) {
				$has_container_settings = true;
				break;
			}
		}

		if (!$has_container_settings) {
			return $block_content;
		}

		// Build style array
		$styles = [];
		$classes = ['bpafb-has-container-settings'];

		// Width and Alignment logic
		if (isset($attrs['bpafbContainerWidth'])) {
			$unit = isset($attrs['bpafbContainerWidthUnit']) ? $attrs['bpafbContainerWidthUnit'] : 'px';
			$styles[] = 'width: 100%;';
			$styles[] = 'max-width: ' . floatval($attrs['bpafbContainerWidth']) . esc_attr($unit) . ';';

			$align = isset($attrs['bpafbContainerAlign']) ? $attrs['bpafbContainerAlign'] : 'center';
			if ($align === 'left' || $align === 'center' || $align === 'right') {
				$classes[] = 'bpafb-align-' . $align;
			}
		} else {
			// Apply alignment even without custom width if explicitly set
			if (isset($attrs['bpafbContainerAlign'])) {
				$align = $attrs['bpafbContainerAlign'];
				if ($align === 'left' || $align === 'center' || $align === 'right') {
					$classes[] = 'bpafb-align-' . $align;
				}
			} else {
				// Fallback to custom margins left/right
				if (isset($attrs['bpafbContainerMarginLeft'])) {
					$styles[] = 'margin-left: ' . intval($attrs['bpafbContainerMarginLeft']) . 'px;';
				}
				if (isset($attrs['bpafbContainerMarginRight'])) {
					$styles[] = 'margin-right: ' . intval($attrs['bpafbContainerMarginRight']) . 'px;';
				}
			}
		}

		// Margins
		if (isset($attrs['bpafbContainerMarginTop'])) {
			$styles[] = 'margin-top: ' . intval($attrs['bpafbContainerMarginTop']) . 'px;';
		}
		if (isset($attrs['bpafbContainerMarginRight'])) {
			$styles[] = 'margin-right: ' . intval($attrs['bpafbContainerMarginRight']) . 'px;';
		}
		if (isset($attrs['bpafbContainerMarginBottom'])) {
			$styles[] = 'margin-bottom: ' . intval($attrs['bpafbContainerMarginBottom']) . 'px;';
		}
		if (isset($attrs['bpafbContainerMarginLeft'])) {
			$styles[] = 'margin-left: ' . intval($attrs['bpafbContainerMarginLeft']) . 'px;';
		}

		// Background
		$bg_type = isset($attrs['bpafbContainerBgType']) ? $attrs['bpafbContainerBgType'] : 'color';
		if ($bg_type === 'gradient' && !empty($attrs['bpafbContainerBgGradient'])) {
			$styles[] = 'background-image: ' . esc_attr($attrs['bpafbContainerBgGradient']) . ';';
		} elseif ($bg_type === 'image' && !empty($attrs['bpafbContainerBgImageUrl'])) {
			$styles[] = 'background-image: url(' . esc_url($attrs['bpafbContainerBgImageUrl']) . ');';
			$size = isset($attrs['bpafbContainerBgImageSize']) ? $attrs['bpafbContainerBgImageSize'] : 'cover';
			$styles[] = 'background-size: ' . esc_attr($size) . ';';
			$styles[] = 'background-position: center center;';
			if (!empty($attrs['bpafbContainerOverlayColor'])) {
				$classes[] = 'bpafb-has-bg-overlay';
			}
		} elseif (!empty($attrs['bpafbContainerBgColor'])) {
			$styles[] = 'background-color: ' . esc_attr($attrs['bpafbContainerBgColor']) . ';';
		}

		// Padding
		if (isset($attrs['bpafbContainerPaddingTop'])) {
			$styles[] = 'padding-top: ' . intval($attrs['bpafbContainerPaddingTop']) . 'px;';
		}
		if (isset($attrs['bpafbContainerPaddingRight'])) {
			$styles[] = 'padding-right: ' . intval($attrs['bpafbContainerPaddingRight']) . 'px;';
		}
		if (isset($attrs['bpafbContainerPaddingBottom'])) {
			$styles[] = 'padding-bottom: ' . intval($attrs['bpafbContainerPaddingBottom']) . 'px;';
		}
		if (isset($attrs['bpafbContainerPaddingLeft'])) {
			$styles[] = 'padding-left: ' . intval($attrs['bpafbContainerPaddingLeft']) . 'px;';
		}

		// Border
		if (!empty($attrs['bpafbContainerBorderStyle']) && $attrs['bpafbContainerBorderStyle'] !== 'none') {
			$styles[] = 'border-style: ' . esc_attr($attrs['bpafbContainerBorderStyle']) . ';';
			if (!empty($attrs['bpafbContainerBorderColor'])) {
				$styles[] = 'border-color: ' . esc_attr($attrs['bpafbContainerBorderColor']) . ';';
			}
			if (isset($attrs['bpafbContainerBorderWidth'])) {
				$styles[] = 'border-width: ' . intval($attrs['bpafbContainerBorderWidth']) . 'px;';
			}
		}
		if (isset($attrs['bpafbContainerBorderRadius'])) {
			$styles[] = 'border-radius: ' . intval($attrs['bpafbContainerBorderRadius']) . 'px;';
		}

		// Shadow (normal + hover, hover applied via CSS class since PHP can't do :hover)
		if (!empty($attrs['bpafbContainerBoxShadow'])) {
			$color = !empty($attrs['bpafbContainerShadowColor']) ? $attrs['bpafbContainerShadowColor'] : 'rgba(0,0,0,0.1)';
			$blur = isset($attrs['bpafbContainerShadowBlur']) ? intval($attrs['bpafbContainerShadowBlur']) : 10;
			$spread = isset($attrs['bpafbContainerShadowSpread']) ? intval($attrs['bpafbContainerShadowSpread']) : 0;
			$styles[] = 'box-shadow: 0 4px ' . $blur . 'px ' . $spread . 'px ' . esc_attr($color) . ';';
		}
		if (!empty($attrs['bpafbContainerHoverBoxShadow'])) {
			$hcolor = !empty($attrs['bpafbContainerHoverShadowColor']) ? $attrs['bpafbContainerHoverShadowColor'] : 'rgba(0,0,0,0.15)';
			$hblur = isset($attrs['bpafbContainerHoverShadowBlur']) ? intval($attrs['bpafbContainerHoverShadowBlur']) : 15;
			$hspread = isset($attrs['bpafbContainerHoverShadowSpread']) ? intval($attrs['bpafbContainerHoverShadowSpread']) : 0;
			$styles[] = '--bpafb-hover-shadow: 0 4px ' . $hblur . 'px ' . $hspread . 'px ' . esc_attr($hcolor) . ';';
			$classes[] = 'bpafb-has-hover-shadow';
		}

		// Layout
		$uid = !empty($attrs['bpafbUid']) ? sanitize_html_class($attrs['bpafbUid']) : '';

		if (!empty($attrs['bpafbDisplay'])) {
			$styles[] = 'display: ' . esc_attr($attrs['bpafbDisplay']) . ';';
		}
		if (!empty($attrs['bpafbOverflow'])) {
			$styles[] = 'overflow: ' . esc_attr($attrs['bpafbOverflow']) . ';';
		}
		if (!empty($attrs['bpafbPosition'])) {
			$styles[] = 'position: ' . esc_attr($attrs['bpafbPosition']) . ';';
		}
		if (isset($attrs['bpafbContainerMinHeight'])) {
			$styles[] = 'min-height: ' . intval($attrs['bpafbContainerMinHeight']) . 'px;';
		}
		if (isset($attrs['bpafbContainerMaxHeight'])) {
			$styles[] = 'max-height: ' . intval($attrs['bpafbContainerMaxHeight']) . 'px;';
		}
		if (isset($attrs['bpafbZIndex'])) {
			$styles[] = 'z-index: ' . intval($attrs['bpafbZIndex']) . ';';
			if (empty($attrs['bpafbPosition'])) {
				$styles[] = 'position: relative;';
			}
		}

		// Transform
		$has_transform = false;
		if (!empty($attrs['bpafbTransformRotate'])) {
			$styles[] = 'rotate: ' . floatval($attrs['bpafbTransformRotate']) . 'deg;';
			$has_transform = true;
		}
		if (isset($attrs['bpafbTransformScale']) && floatval($attrs['bpafbTransformScale']) !== 100.0) {
			$styles[] = 'scale: ' . (floatval($attrs['bpafbTransformScale']) / 100) . ';';
			$has_transform = true;
		}
		if (!empty($attrs['bpafbTransformTranslateX']) || !empty($attrs['bpafbTransformTranslateY'])) {
			$tx = !empty($attrs['bpafbTransformTranslateX']) ? intval($attrs['bpafbTransformTranslateX']) : 0;
			$ty = !empty($attrs['bpafbTransformTranslateY']) ? intval($attrs['bpafbTransformTranslateY']) : 0;
			$styles[] = 'translate: ' . $tx . 'px ' . $ty . 'px;';
			$has_transform = true;
		}

		if ($has_transform && empty($attrs['bpafbDisplay'])) {
			// Transforms require a non-inline display type to work on the frontend
			$styles[] = 'display: block;';
		}

		// Visibility
		if (!empty($attrs['bpafbHideDesktop'])) {
			$classes[] = 'bpafb-hide-desktop';
		}
		if (!empty($attrs['bpafbHideTablet'])) {
			$classes[] = 'bpafb-hide-tablet';
		}
		if (!empty($attrs['bpafbHideMobile'])) {
			$classes[] = 'bpafb-hide-mobile';
		}

		// Motion effects
		if (!empty($attrs['bpafbHoverAnimation']) && $attrs['bpafbHoverAnimation'] !== 'none') {
			$classes[] = 'bpafb-hover-' . sanitize_html_class($attrs['bpafbHoverAnimation']);
		}
		if (!empty($attrs['bpafbFloatingEffect'])) {
			$classes[] = 'bpafb-floating';
		}

		// Scroll-triggered entrance animation
		$data_attrs = [];
		if (!empty($attrs['bpafbAnimationType']) && $attrs['bpafbAnimationType'] !== 'none') {
			$duration = isset($attrs['bpafbAnimationDuration']) ? intval($attrs['bpafbAnimationDuration']) : 800;
			$delay = isset($attrs['bpafbAnimationDelay']) ? intval($attrs['bpafbAnimationDelay']) : 0;
			$easing = !empty($attrs['bpafbAnimationEasing']) ? $attrs['bpafbAnimationEasing'] : 'ease';
			$classes[] = 'bpafb-animate';
			$data_attrs['data-bpafb-animation'] = sanitize_html_class($attrs['bpafbAnimationType']);
			$styles[] = '--bpafb-anim-duration: ' . $duration . 'ms;';
			$styles[] = '--bpafb-anim-delay: ' . $delay . 'ms;';
			$styles[] = '--bpafb-anim-easing: ' . esc_attr($easing) . ';';
		}

		// Unique id used to scope custom CSS / responsive overrides to this block instance.
		$extra_style_tag = '';
		if ($uid) {
			$classes[] = 'bpafb-uid-' . $uid;
			$extra_style_tag .= $this->bpafb_build_responsive_css($attrs, $uid);
			$extra_style_tag .= $this->bpafb_build_custom_css($attrs, $uid);
		}

		// HTML attributes
		$html_id = !empty($attrs['bpafbHtmlId']) ? $attrs['bpafbHtmlId'] : '';
		if (!empty($attrs['bpafbHtmlClasses'])) {
			$classes[] = $attrs['bpafbHtmlClasses'];
		}
		if (!empty($attrs['bpafbContainerOverlayColor']) && $bg_type === 'image') {
			$styles[] = '--bpafb-overlay-color: ' . esc_attr($attrs['bpafbContainerOverlayColor']) . ';';
		}

		if (empty($styles) && count($classes) === 1 && empty($extra_style_tag) && empty($html_id)) {
			return $block_content;
		}

		$style_attr_value = implode(' ', $styles);

		$output = $this->bpafb_inject_styles($block_content, $style_attr_value, implode(' ', $classes), $html_id, $data_attrs);

		return $extra_style_tag . $output;
	}

	/**
	 * Injects FAQPage JSON-LD schema for the Blockive FAQ block at render time.
	 *
	 * The FAQ block is static (its visible markup is generated client-side in
	 * save.js), but the schema is generated here instead, so it is never part
	 * of the saved post_content and is therefore never subject to the
	 * save-time wp_kses_post() filter, which strips <script> tags for any
	 * user without the unfiltered_html capability.
	 *
	 * @param string   $block_content The block content.
	 * @param array    $block         The block record.
	 * @param WP_Block $instance      The block instance (provides fully-resolved
	 *                                attributes, including registered defaults
	 *                                that are omitted from $block['attrs'] when
	 *                                a block instance hasn't changed them).
	 * @return string
	 */
	public function bpafb_inject_faq_schema($block_content, $block, $instance = null)
	{
		if (empty($block['blockName']) || $block['blockName'] !== 'blockive-premium-addon-for-block/faq') {
			return $block_content;
		}

		// Note: WP_Block only defines __get() (not __isset()), so isset($instance->attributes)
		// would always evaluate false regardless of the real value. Access it directly instead.
		$attrs = $instance instanceof WP_Block ? $instance->attributes : (isset($block['attrs']) ? $block['attrs'] : []);
		$items = isset($attrs['items']) && is_array($attrs['items']) ? $attrs['items'] : [];

		if (empty($items)) {
			return $block_content;
		}

		$main_entity = [];
		foreach ($items as $item) {
			$title = isset($item['title']) ? wp_strip_all_tags($item['title']) : '';
			$content = isset($item['content']) ? $item['content'] : '';

			$main_entity[] = [
				'@type' => 'Question',
				'name' => $title,
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text' => $content,
				],
			];
		}

		$schema = [
			'@context' => 'https://schema.org',
			'@type' => 'FAQPage',
			'mainEntity' => $main_entity,
		];

		$schema_json = wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		$schema_json = str_replace('<', '\\u003c', $schema_json);

		return $block_content . '<script type="application/ld+json">' . $schema_json . '</script>';
	}

	/**
	 * Builds a <style> block for tablet/mobile responsive padding & margin overrides.
	 *
	 * @param array  $attrs Block attributes.
	 * @param string $uid   Unique id used to scope the selector.
	 * @return string
	 */
	private function bpafb_build_responsive_css($attrs, $uid)
	{
		$selector = '.bpafb-uid-' . $uid;
		$breakpoints = [
			'Tablet' => '(max-width: 1024px)',
			'Mobile' => '(max-width: 767px)',
		];
		$sides = ['Top', 'Right', 'Bottom', 'Left'];
		$css = '';

		foreach ($breakpoints as $suffix => $media) {
			$rules = '';
			foreach (['Padding', 'Margin'] as $box) {
				foreach ($sides as $side) {
					$key = 'bpafbContainer' . $box . $side . $suffix;
					if (isset($attrs[$key])) {
						$rules .= strtolower($box) . '-' . strtolower($side) . ': ' . intval($attrs[$key]) . 'px !important;';
					}
				}
			}
			if ($rules) {
				$css .= '@media ' . $media . ' { ' . $selector . ' { ' . $rules . ' } }';
			}
		}

		return $css ? '<style>' . $css . '</style>' : '';
	}

	/**
	 * Strips Blockive's per-block Custom CSS attribute (bpafbCustomCss) from
	 * post content on save for users who lack the capability WordPress uses
	 * to gate unfiltered/raw content in post bodies.
	 *
	 * This runs at save time, not render time: the capability that matters
	 * is the *saving* author's, not the frontend visitor's. render_block
	 * runs for every visitor on every page view, and anonymous visitors
	 * never have unfiltered_html, so gating there would silently break
	 * Custom CSS for every authorized author's content on the frontend.
	 *
	 * Block attributes stored in the `<!-- wp:... {...} -->` comment
	 * delimiter are not passed through wp_kses_post() the way visible post
	 * content is (WordPress core allows block comments through kses so
	 * blocks keep working for users without unfiltered_html), so
	 * bpafbCustomCss needs its own gate here -- otherwise a user with only
	 * edit_posts could set it directly via the REST API content field,
	 * bypassing the editor UI entirely.
	 *
	 * @param string $content Raw post content about to be saved.
	 * @return string
	 */
	public function bpafb_strip_unauthorized_custom_css($content)
	{
		if (current_user_can('unfiltered_html')) {
			return $content;
		}

		// Cheap guard so this only does block-parsing work on content that
		// could actually contain the attribute (serialize_block omits
		// attributes matching their block.json default, and the default is
		// an empty string, so a non-empty value is the only way this
		// substring appears).
		if (strpos($content, 'bpafbCustomCss') === false) {
			return $content;
		}

		if (!function_exists('parse_blocks') || !function_exists('serialize_blocks')) {
			return $content;
		}

		$blocks = $this->bpafb_strip_custom_css_from_blocks(parse_blocks($content));

		return serialize_blocks($blocks);
	}

	/**
	 * Recursively clears bpafbCustomCss from every Blockive block in a
	 * parsed block tree, including nested innerBlocks.
	 *
	 * @param array $blocks Parsed block tree (as returned by parse_blocks()).
	 * @return array
	 */
	private function bpafb_strip_custom_css_from_blocks($blocks)
	{
		foreach ($blocks as $index => $block) {
			if (!empty($block['blockName']) && strpos($block['blockName'], 'blockive-premium-addon-for-block/') === 0) {
				if (!empty($block['attrs']['bpafbCustomCss'])) {
					$blocks[$index]['attrs']['bpafbCustomCss'] = '';
				}
			}
			if (!empty($block['innerBlocks'])) {
				$blocks[$index]['innerBlocks'] = $this->bpafb_strip_custom_css_from_blocks($block['innerBlocks']);
			}
		}

		return $blocks;
	}

	/**
	 * Builds the scoped Custom CSS <style> block for a block instance.
	 * Users write CSS using the literal word "selector" to target the block wrapper.
	 *
	 * @param array  $attrs Block attributes.
	 * @param string $uid   Unique id used to scope the selector.
	 * @return string
	 */
	private function bpafb_build_custom_css($attrs, $uid)
	{
		if (empty($attrs['bpafbCustomCss'])) {
			return '';
		}

		$css = wp_strip_all_tags($attrs['bpafbCustomCss']);
		$css = str_replace('</style', '', $css);
		$css = str_replace('selector', '.bpafb-uid-' . $uid, $css);

		return '<style>' . $css . '</style>';
	}

	/**
	 * Helper function to inject style, class, id and data-* attributes into the first tag of HTML content.
	 *
	 * Escaping boundary: $classes_to_add, $id, and every value in $data_attrs
	 * are expected RAW (not yet esc_attr()'d) - this function is what
	 * escapes them, via esc_attr() at each point they're written into the
	 * attribute string below. This is the opposite convention from
	 * $new_styles_str, whose individual values the caller
	 * (bpafb_render_block_container()) already esc_attr()'d before building
	 * the combined style string, to avoid double-encoding entities like `&`
	 * (see the note further down in this function). Callers passing a new
	 * Advanced-tab attribute through here must know which bucket it falls
	 * into - raw values only ever belong in $classes_to_add/$id/$data_attrs,
	 * never appended into $new_styles_str.
	 *
	 * @param string $html             The original HTML content.
	 * @param string $new_styles_str   The new inline styles to inject - pre-escaped by the caller.
	 * @param string $classes_to_add   The custom classes to add to the wrapper - raw, escaped in here.
	 * @param string $id               Optional HTML id to set on the wrapper (does not overwrite an existing id) - raw, escaped in here.
	 * @param array  $data_attrs       Optional map of data-* attribute name => value - raw, escaped in here.
	 * @return string
	 */
	private function bpafb_inject_styles($html, $new_styles_str, $classes_to_add = '', $id = '', $data_attrs = [])
	{
		// Some render.php templates emit a local <style> tag (e.g. hover-color
		// rules) before their actual wrapper element. Skip past any such
		// leading <style>...</style> blocks so the match below targets the
		// block's real root element instead of the style tag.
		$search_html = $html;
		$prefix_len = 0;
		while (preg_match('/^\s*<style\b[^>]*>.*?<\/style>/is', $search_html, $style_match)) {
			$prefix_len += strlen($style_match[0]);
			$search_html = substr($search_html, strlen($style_match[0]));
		}

		if (preg_match('/^\s*<([a-z0-9-]+)([^>]*)>/i', $search_html, $matches)) {
			$tag = $matches[1];
			$attributes_str = $matches[2];

			// Check if style attribute already exists.
			// Note: $existing_styles is extracted from already-rendered HTML (already
			// attribute-safe), and $new_styles_str's individual values were already
			// esc_attr()'d when built in bpafb_render_block_container(); re-escaping
			// the combined string here would double-encode entities like `&`.
			if ($new_styles_str && preg_match('/style=["\']([^"\']*)["\']/i', $attributes_str, $style_matches)) {
				$existing_styles = rtrim(trim($style_matches[1]), ';') . ';';
				$updated_styles = $existing_styles . ' ' . $new_styles_str;
				$new_attributes_str = preg_replace('/style=["\']([^"\']*)["\']/i', 'style="' . $updated_styles . '"', $attributes_str);
			} elseif ($new_styles_str) {
				$new_attributes_str = $attributes_str . ' style="' . $new_styles_str . '"';
			} else {
				$new_attributes_str = $attributes_str;
			}

			// Also add a custom container class
			if ($classes_to_add && preg_match('/class=["\']([^"\']*)["\']/i', $new_attributes_str, $class_matches)) {
				$updated_classes = trim($class_matches[1]) . ' ' . $classes_to_add;
				$new_attributes_str = preg_replace('/class=["\']([^"\']*)["\']/i', 'class="' . esc_attr($updated_classes) . '"', $new_attributes_str);
			} elseif ($classes_to_add) {
				$new_attributes_str = $new_attributes_str . ' class="' . esc_attr($classes_to_add) . '"';
			}

			// Add an id only if the wrapper doesn't already have one.
			if ($id && !preg_match('/\sid=["\']/i', $new_attributes_str)) {
				$new_attributes_str .= ' id="' . esc_attr($id) . '"';
			}

			foreach ($data_attrs as $attr_name => $attr_value) {
				$new_attributes_str .= ' ' . esc_attr($attr_name) . '="' . esc_attr($attr_value) . '"';
			}

			$pos = $prefix_len + strpos($search_html, $matches[0]);
			$replaced = '<' . $tag . $new_attributes_str . '>';
			return substr($html, 0, $pos) . $replaced . substr($html, $pos + strlen($matches[0]));
		}
		return $html;
	}
}
