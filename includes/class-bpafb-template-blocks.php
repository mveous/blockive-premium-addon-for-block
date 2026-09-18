<?php
/**
 * Adds the "Blockive Template" block category, and only lets Template
 * Blocks show up in the editor when editing a `blockive_template` post.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Keeps track of every Template Block (block names starting with
 * `blockive-premium-addon-for-block/tb-`, plus any other block a developer
 * adds through register_block_name()) and controls where they can be used.
 *
 * These blocks are registered on the server (block.json + render.php) on
 * every page load, since their render code must work wherever a template
 * ends up shown on the live site. None of them list an `editorScript`,
 * though. Instead, one combined file (build/template-blocks/index.js)
 * registers all of them for the editor, and that file is only loaded on
 * the Template Builder screen (see enqueue_editor_assets()). This is what
 * keeps them out of the block list in every other editor.
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
	 * The one and only instance of this class.
	 *
	 * @var Bpafb_Template_Blocks|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
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
	 * Loads the Template Blocks' combined CSS file. This runs on the live
	 * site, and also on the Template Builder screen, even though that is
	 * an admin screen.
	 *
	 * The block editor shows block content inside a separate iframe, kept
	 * apart for style reasons. WordPress only copies styles into that
	 * iframe when they are loaded with `enqueue_block_assets` (the hook
	 * this method uses), not with `enqueue_block_editor_assets`. So we
	 * cannot simply skip this on every admin screen, or the blocks would
	 * show up with no styling in the editor.
	 *
	 * This always loads on the live site, the same way this plugin's other
	 * shared stylesheets do. Loading it only on pages that use the block
	 * (with has_block()) is a possible improvement for later.
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
	 * Marks a block name as a Template Block, so it gets the same rules as
	 * Blockive's own Template Blocks (which category it can use, and the
	 * before/after render hooks). Meant to be called from a
	 * `blockive_register_template_block` callback.
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
	 * Fires a hook that lets other developers register their own Template
	 * Blocks (through register_block_type() and
	 * self::register_block_name()) and Dynamic Field providers.
	 */
	public function fire_registration_hook()
	{
		/**
		 * Fires once during init, so developers can register more Template
		 * Blocks. Inside the callback, call register_block_type() as usual,
		 * then call Bpafb_Template_Blocks::register_block_name( $name ) so
		 * the block is limited to the Template Builder editor and gets the
		 * render hooks below.
		 */
		do_action('blockive_register_template_block');
	}

	/**
	 * Adds the "Blockive Template" block category, but only while editing
	 * a `blockive_template` post. This keeps the category out of every
	 * other editor's block list.
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
	 * Loads the combined Template Blocks editor file, only on the Template
	 * Builder screen.
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

		// The block's look and CSS is handled by enqueue_frontend_style()
		// (hooked to enqueue_block_assets), not here. See that method's
		// notes above for why: only that hook copies its styles into the
		// block editor's iframe, where these blocks actually render.
	}

	/**
	 * Fires `blockive_before_template_block_render` right before a
	 * Template Block's render code runs.
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
			 * Fires right before a Template Block renders.
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
	 * Fires `blockive_after_template_block_render` right after a Template
	 * Block has rendered.
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
			 * Fires right after a Template Block has rendered.
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
