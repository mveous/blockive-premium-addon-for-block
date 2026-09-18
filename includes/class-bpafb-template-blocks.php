<?php
/**
 * Registers the "Blockive Template" block category and gates every Template
 * Block's editor availability to the `blockive_template` editor screen.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Central registry + gating for Template Blocks (block names prefixed with
 * `blockive-premium-addon-for-block/tb-`, plus any third-party block a
 * developer opts in via register_block_name()).
 *
 * These blocks are registered server-side (block.json + render.php) on every
 * request, because their render callback must work wherever a template's
 * markup ends up output on the frontend. None of them declare an
 * `editorScript` in block.json though, so WordPress never auto-enqueues an
 * editor script for them. Instead a single consolidated bundle
 * (build/template-blocks/index.js) calls registerBlockType() for all of
 * them, and that bundle is only enqueued on the Template Builder screen
 * (see enqueue_editor_assets()). Since it's the client-side registerBlockType
 * call that makes a block insertable, this keeps them out of the inserter on
 * every other post type's editor while still rendering correctly on the
 * frontend.
 */
class Bpafb_Template_Blocks
{
	const CATEGORY_SLUG = 'blockive-template';
	const NAME_PREFIX   = 'blockive-premium-addon-for-block/tb-';

	/**
	 * Block names registered by third parties via register_block_name().
	 *
	 * @var array<string,bool>
	 */
	private static $extra_block_names = [];

	/**
	 * The single instance of this class.
	 *
	 * @var Bpafb_Template_Blocks|null
	 */
	private static $instance = null;

	/**
	 * Retrieves (creating if necessary) the single instance of this class.
	 *
	 * @return Bpafb_Template_Blocks
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
		add_filter('block_categories_all', [$this, 'register_category'], 10, 2);
		add_action('enqueue_block_editor_assets', [$this, 'enqueue_editor_assets'], 20);
		add_action('enqueue_block_assets', [$this, 'enqueue_frontend_style']);
		add_action('init', [$this, 'fire_registration_hook'], 20);
		add_filter('pre_render_block', [$this, 'before_render'], 10, 2);
		add_filter('render_block', [$this, 'after_render'], 10, 2);
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
	 * Enqueues the Template Blocks' combined stylesheet - on the frontend,
	 * and also on the Template Builder screen despite it being an admin
	 * screen.
	 *
	 * That second part matters: the block editor renders block content
	 * inside a separate iframe (`editor-canvas`) for style isolation, and
	 * WordPress only mirrors styles into that iframe when they're enqueued
	 * via `enqueue_block_assets` (this method's hook) - NOT via
	 * `enqueue_block_editor_assets` (see enqueue_editor_assets() below,
	 * which is correct for the JS bundle but was previously also loading
	 * these same stylesheets there, where they only ever reached the outer
	 * admin document and never the iframe actually rendering block preview
	 * markup). So this method has to run on the Template Builder screen
	 * too, not skip it via a blanket is_admin() check, or every block's
	 * appearance in the editor silently falls back to unstyled HTML while
	 * the frontend renders correctly.
	 *
	 * Every Template Block shares one JS bundle (see enqueue_editor_assets())
	 * so its styles are bundled together too, rather than one CSS file per
	 * block. Loaded unconditionally on the frontend, matching how this
	 * plugin already loads its other global stylesheets - there is no
	 * "render this template on the frontend" pipeline yet to key a
	 * has_block() style check off of, so that's a follow-up optimization
	 * once that pipeline exists.
	 */
	public function enqueue_frontend_style()
	{
		if (is_admin() && !Bpafb_Screen_Helper::is_template_editor()) {
			return;
		}

		if (file_exists(BPAFB_PATH . 'build/template-blocks/index.css')) {
			wp_enqueue_style(
				'bpafb-template-blocks-frontend',
				BPAFB_URL . 'build/template-blocks/index.css',
				[],
				BPAFB_VERSION
			);
		}

		if (file_exists(BPAFB_PATH . 'build/template-blocks/style-index.css')) {
			wp_enqueue_style(
				'bpafb-template-blocks-frontend-style',
				BPAFB_URL . 'build/template-blocks/style-index.css',
				[],
				BPAFB_VERSION
			);
		}
	}

	/**
	 * Registers a block name as a Template Block so it's gated the same way
	 * as Blockive's own (category eligibility, before/after render hooks).
	 * Intended to be called from a `blockive_register_template_block` callback.
	 *
	 * @param string $block_name Fully qualified block name, e.g. "my-plugin/my-block".
	 */
	public static function register_block_name($block_name)
	{
		self::$extra_block_names[$block_name] = true;
	}

	/**
	 * Whether a block name belongs to the Template Blocks set.
	 *
	 * @param string $block_name Block name.
	 * @return bool
	 */
	public static function is_template_block($block_name)
	{
		if (empty($block_name)) {
			return false;
		}
		if (strpos($block_name, self::NAME_PREFIX) === 0) {
			return true;
		}
		return isset(self::$extra_block_names[$block_name]);
	}

	/**
	 * Fires the extensibility hook that lets developers register their own
	 * Template Blocks (via register_block_type() + self::register_block_name())
	 * and Dynamic Field providers.
	 */
	public function fire_registration_hook()
	{
		/**
		 * Fires once during init so developers can register additional Template
		 * Blocks. Inside the callback, register_block_type() the block as usual
		 * and call Bpafb_Template_Blocks::register_block_name( $name ) so it's
		 * gated to the Template Builder editor and receives the render hooks
		 * below.
		 */
		do_action('blockive_register_template_block');
	}

	/**
	 * Adds the "Blockive Template" block category, but only while editing a
	 * `blockive_template` post - keeps the category out of every other
	 * editor's inserter.
	 *
	 * @param array                        $categories    Existing block categories.
	 * @param WP_Block_Editor_Context|null $editor_context Current block editor context.
	 * @return array
	 */
	public function register_category($categories, $editor_context)
	{
		if (empty($editor_context->post) || $editor_context->post->post_type !== Bpafb_Template_Post_Type::POST_TYPE) {
			return $categories;
		}

		return array_merge(
			[
				[
					'slug'  => self::CATEGORY_SLUG,
					'title' => esc_html__('Blockive Template', 'blockive-premium-addon-for-block'),
				],
			],
			$categories
		);
	}

	/**
	 * Enqueues the consolidated Template Blocks editor bundle, gated to the
	 * Template Builder screen only.
	 */
	public function enqueue_editor_assets()
	{
		if (!Bpafb_Screen_Helper::is_template_editor()) {
			return;
		}

		$script_path = BPAFB_PATH . 'build/template-blocks/index.js';
		if (!file_exists($script_path)) {
			return;
		}

		$asset_file = BPAFB_PATH . 'build/template-blocks/index.asset.php';
		$asset      = file_exists($asset_file) ? require $asset_file : [
			'dependencies' => [],
			'version'      => BPAFB_VERSION,
		];

		wp_enqueue_script(
			'bpafb-template-blocks',
			BPAFB_URL . 'build/template-blocks/index.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);

		// Block appearance CSS is handled by enqueue_frontend_style() (hooked
		// to enqueue_block_assets), not here - see that method's docblock for
		// why: only that hook gets its styles mirrored into the block
		// editor's iframed canvas, where these blocks actually render.
	}

	/**
	 * Fires `blockive_before_template_block_render` immediately before a
	 * Template Block's render callback runs.
	 *
	 * @param string|null $pre_render   Short-circuit value (left untouched).
	 * @param array       $parsed_block The block being rendered.
	 * @return string|null
	 */
	public function before_render($pre_render, $parsed_block)
	{
		$block_name = isset($parsed_block['blockName']) ? $parsed_block['blockName'] : '';
		if (self::is_template_block($block_name)) {
			/**
			 * Fires immediately before a Template Block renders.
			 *
			 * @param string $block_name Block name.
			 * @param array  $attrs      Block attributes.
			 * @param array  $parsed_block Full parsed block array.
			 */
			do_action(
				'blockive_before_template_block_render',
				$block_name,
				isset($parsed_block['attrs']) ? $parsed_block['attrs'] : [],
				$parsed_block
			);
		}
		return $pre_render;
	}

	/**
	 * Fires `blockive_after_template_block_render` immediately after a
	 * Template Block has rendered.
	 *
	 * @param string $content      Rendered block HTML.
	 * @param array  $parsed_block The block that was rendered.
	 * @return string
	 */
	public function after_render($content, $parsed_block)
	{
		$block_name = isset($parsed_block['blockName']) ? $parsed_block['blockName'] : '';
		if (self::is_template_block($block_name)) {
			/**
			 * Fires immediately after a Template Block has rendered.
			 *
			 * @param string $block_name Block name.
			 * @param string $content    Rendered block HTML.
			 * @param array  $attrs      Block attributes.
			 * @param array  $parsed_block Full parsed block array.
			 */
			do_action(
				'blockive_after_template_block_render',
				$block_name,
				$content,
				isset($parsed_block['attrs']) ? $parsed_block['attrs'] : [],
				$parsed_block
			);
		}
		return $content;
	}
}
