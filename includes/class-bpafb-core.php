<?php
/**
 * Main class for Blockive Premium Addon For Block. Handles block
 * registration, shared container styling, and save-time security.
 *
 * This is kept in its own file, apart from the plugin's main file, so
 * Blockive Pro can use this exact same class too. Pro copies this file
 * as-is.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Blockive_Premium_Addon_For_Block
{

	/**
	 * The one and only instance of this class.
	 *
	 * @var Blockive_Premium_Addon_For_Block|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
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
	 * Stops this class from being copied.
	 */
	private function __clone()
	{
	}

	/**
	 * Stops this class from being restored from stored data.
	 */
	public function __wakeup()
	{
		throw new \Exception('Cannot unserialize a singleton.');
	}

	/**
	 * Sets up the WordPress hooks this plugin needs.
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
	 * Adds our own block category to the list.
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
	 * Registers the blocks listed in the build manifest.
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

		// The manifest only looks one folder deep under the build folder.
		// Template Builder blocks live two folders deep
		// (build/template-blocks/<category>/<block>/), so the manifest
		// misses them and their `render` function never gets used. We
		// register those blocks again here, from their real block.json
		// file, so render.php actually runs for them.
		foreach (glob(BPAFB_PATH . 'build/template-blocks/*/*/block.json') as $bpafb_tb_json) {
			$bpafb_tb_data = json_decode(file_get_contents($bpafb_tb_json), true);
			if (empty($bpafb_tb_data['name'])) {
				continue;
			}
			if ($registry->is_registered($bpafb_tb_data['name'])) {
				unregister_block_type($bpafb_tb_data['name']);
			}
			// The same problem also breaks any script or style the block
			// needs: the first pass above already registered it, but with
			// a wrong or empty URL, and WordPress will not register the
			// same handle twice. So we remove it here first, to let the
			// correct version below take its place.
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
					// If it does not start with "file:", it is already a
					// handle name, not a file path, so this plugin never
					// registered it and we should leave it alone.
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

		// Remove blocks that need another plugin, if that plugin is not active.
		// Contact Form 7
		if (!function_exists('wpcf7') && !defined('WPCF7_PLUGIN')) {
			if ($registry->is_registered('blockive-premium-addon-for-block/contact-form-7')) {
				unregister_block_type('blockive-premium-addon-for-block/contact-form-7');
			}
		}

	}

	/**
	 * Loads shared scripts and styles used by all blocks.
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
	 * Adds a 24px gap above each Blockive block on the live site, to match
	 * the gap already shown in the editor. None of this plugin's blocks
	 * use tags like `<p>` or `<h2>`, which get a gap from the browser on
	 * their own. Without this fix, blocks would sit right next to each
	 * other with no space, on themes that are not block themes.
	 *
	 * The gap is added above each block (not below the one before it), so
	 * it still shows up even if a block sets its own top margin to 0 (like
	 * Post Title or Featured Image do). `:where()` gives this rule the
	 * lowest possible weight, so a block's own margin setting always wins
	 * over it.
	 *
	 * This runs on `wp_enqueue_scripts`, not `enqueue_block_assets`, so it
	 * never loads in the editor. The editor already shows this gap on its own.
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
	 * Loads the script for the block editor's "Advanced" tab settings.
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

		// Tells the Advanced tab, in the editor, whether the current user
		// is allowed to use the Custom CSS field. This only changes what
		// the editor shows. The real check happens on the server when the
		// post is saved - see bpafb_strip_unauthorized_custom_css().
		wp_localize_script(
			'bpafb-editor-container-settings',
			'bpafbEditorSettings',
			[
				'canUseCustomCss' => current_user_can('unfiltered_html'),
			]
		);
	}

	/**
	 * Adds container styles (like padding, background, border) to a
	 * block's HTML when it is shown on the live site.
	 *
	 * @param string $block_content The block content.
	 * @param array  $block         The block record.
	 * @return string
	 */
	public function bpafb_render_block_container($block_content, $block)
	{
		// Only change blocks from this plugin.
		if (empty($block['blockName']) || strpos($block['blockName'], 'blockive-premium-addon-for-block/') !== 0) {
			return $block_content;
		}

		$attrs = isset($block['attrs']) ? $block['attrs'] : [];

		// Check if any Advanced tab settings are turned on at all (see src/components/advanced-tab).
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
			// Still use the alignment setting even if no custom width is set.
			if (isset($attrs['bpafbContainerAlign'])) {
				$align = $attrs['bpafbContainerAlign'];
				if ($align === 'left' || $align === 'center' || $align === 'right') {
					$classes[] = 'bpafb-align-' . $align;
				}
			} else {
				// If neither is set, fall back to left/right margins.
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

		// Shadow (normal and hover; hover is done with a CSS class, since PHP can't check for a mouse hover)
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
			// Rotate/scale/move only work on the live site if display is
			// not "inline", so we set it to "block" here.
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

		// Unique ID used to keep custom CSS and responsive settings tied to just this block.
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
	 * Adds FAQPage schema markup (for search engines) to the Blockive FAQ
	 * block, when the page is shown. The FAQ block's own HTML is built in
	 * save.js and stored with the post. We build the schema here instead
	 * of storing it, so it never gets stripped by the save-time
	 * wp_kses_post() filter, which removes <script> tags for users who
	 * don't have the unfiltered_html permission.
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

		// Note: WP_Block has a __get() method but no __isset() method, so
		// isset($instance->attributes) would always say false, even when
		// it has a value. We read it directly instead.
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
	 * Builds a <style> block for tablet and mobile padding and margin settings.
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
	 * Removes Blockive's Custom CSS setting (bpafbCustomCss) from post
	 * content when it is saved, if the user does not have the
	 * unfiltered_html permission.
	 *
	 * This check runs when the post is saved, not when it is shown. What
	 * matters is the permission of the person *saving* the post. Visitors
	 * to the live site never have unfiltered_html, so checking at that
	 * point would break Custom CSS for every author who is allowed to use
	 * it. Also, the block settings stored in the `<!-- wp:... -->` comment
	 * are not cleaned by wp_kses_post() the way normal post content is. So
	 * without this check, a user with only the edit_posts permission could
	 * set Custom CSS directly through the REST API, skipping the editor.
	 *
	 * @param string $content Raw post content about to be saved.
	 * @return string
	 */
	public function bpafb_strip_unauthorized_custom_css($content)
	{
		if (current_user_can('unfiltered_html')) {
			return $content;
		}

		// A quick check so we only do the slower block-parsing work when
		// the content might actually have this setting. WordPress leaves
		// out an attribute when it matches its default value (an empty
		// string here), so this text only appears when there is a real value.
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
	 * Clears bpafbCustomCss from every Blockive block in a parsed block
	 * tree, including blocks nested inside other blocks.
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
	 * Builds the Custom CSS <style> block for one block. Users type the
	 * word "selector" in their CSS to mean "this block's own wrapper".
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
	 * Adds style, class, id, and data-* attributes onto the first tag of
	 * a block's HTML.
	 *
	 * A note on escaping: $classes_to_add, $id, and $data_attrs must be
	 * passed in as raw, un-escaped text - this function runs esc_attr() on
	 * them itself. $new_styles_str works the other way round: the caller
	 * already ran esc_attr() on each value before joining them together,
	 * to avoid escaping something like `&` twice. So if you add a new
	 * Advanced-tab attribute here, make sure raw values only ever go into
	 * $classes_to_add, $id, or $data_attrs, never into $new_styles_str.
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
		// Some render.php files print their own <style> tag (like hover
		// color rules) before the block's real wrapper. We skip past any
		// of these <style> blocks first, so the match below finds the
		// real wrapper element, not the style tag.
		$search_html = $html;
		$prefix_len = 0;
		while (preg_match('/^\s*<style\b[^>]*>.*?<\/style>/is', $search_html, $style_match)) {
			$prefix_len += strlen($style_match[0]);
			$search_html = substr($search_html, strlen($style_match[0]));
		}

		if (preg_match('/^\s*<([a-z0-9-]+)([^>]*)>/i', $search_html, $matches)) {
			$tag = $matches[1];
			$attributes_str = $matches[2];

			// Check if a style attribute already exists.
			// Note: $existing_styles comes from HTML that was already
			// rendered, so it is already safe. $new_styles_str was also
			// already run through esc_attr() when it was built, in
			// bpafb_render_block_container(). Escaping either one again
			// here would turn something like `&` into `&amp;amp;`.
			if ($new_styles_str && preg_match('/style=["\']([^"\']*)["\']/i', $attributes_str, $style_matches)) {
				$existing_styles = rtrim(trim($style_matches[1]), ';') . ';';
				$updated_styles = $existing_styles . ' ' . $new_styles_str;
				$new_attributes_str = preg_replace('/style=["\']([^"\']*)["\']/i', 'style="' . $updated_styles . '"', $attributes_str);
			} elseif ($new_styles_str) {
				$new_attributes_str = $attributes_str . ' style="' . $new_styles_str . '"';
			} else {
				$new_attributes_str = $attributes_str;
			}

			// Also add our own container class.
			if ($classes_to_add && preg_match('/class=["\']([^"\']*)["\']/i', $new_attributes_str, $class_matches)) {
				$updated_classes = trim($class_matches[1]) . ' ' . $classes_to_add;
				$new_attributes_str = preg_replace('/class=["\']([^"\']*)["\']/i', 'class="' . esc_attr($updated_classes) . '"', $new_attributes_str);
			} elseif ($classes_to_add) {
				$new_attributes_str = $new_attributes_str . ' class="' . esc_attr($classes_to_add) . '"';
			}

			// Only add an id if the wrapper does not already have one.
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
