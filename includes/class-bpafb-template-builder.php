<?php
/**
 * Loads the Template Builder editor files, but only when they are needed.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Loads the Template Builder's JS and CSS files, only when editing a
 * `blockive_template` post.
 */
class Bpafb_Template_Builder
{
	/**
	 * The one and only instance of this class.
	 *
	 * @var Bpafb_Template_Builder|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
	 *
	 * @return Bpafb_Template_Builder
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
		add_action('enqueue_block_editor_assets', [$this, 'enqueue_assets']);
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
	 * Loads the Template Builder files, only on the template editor screen.
	 */
	public function enqueue_assets()
	{
		if (!Bpafb_Screen_Helper::is_template_editor()) {
			return;
		}

		$script_path = BPAFB_PATH . 'build/template-builder/index.js';
		if (!file_exists($script_path)) {
			return;
		}

		$asset_file = BPAFB_PATH . 'build/template-builder/index.asset.php';
		$asset      = file_exists($asset_file) ? require $asset_file : [
			'dependencies' => [],
			'version'      => BPAFB_VERSION,
		];

		wp_enqueue_script(
			'bpafb-template-builder',
			BPAFB_URL . 'build/template-builder/index.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);

		if (file_exists(BPAFB_PATH . 'build/template-builder/style-index.css')) {
			wp_enqueue_style(
				'bpafb-template-builder',
				BPAFB_URL . 'build/template-builder/style-index.css',
				['wp-components'],
				$asset['version']
			);
		}

		wp_localize_script('bpafb-template-builder', 'bpafbTemplateBuilder', [
			'postType'              => Bpafb_Template_Post_Type::POST_TYPE,
			'freePostTypes'         => Bpafb_Template_Post_Type::get_free_template_types(),
			'specificScopeEnabled'  => Bpafb_Template_Display_Conditions::is_specific_scope_enabled(),
			'postTypeSingularNames' => self::get_post_type_singular_names(),
		]);
	}

	/**
	 * Gives the singular name for every viewable post type (like 'product'
	 * => 'Product'), used for wording like "All Products" or "Specific
	 * Product" in the Display Conditions settings. We need this because
	 * the `/wp/v2/types` REST response only has the plural name, not the
	 * singular one. This includes every viewable post type, even locked
	 * ones - only picking a locked one is blocked, not seeing its name.
	 *
	 * @return array<string,string>
	 */
	private static function get_post_type_singular_names()
	{
		$names = [];
		foreach (array_filter(get_post_types(), 'is_post_type_viewable') as $slug) {
			$post_type_object = get_post_type_object($slug);
			$names[$slug]     = $post_type_object ? $post_type_object->labels->singular_name : $slug;
		}
		return $names;
	}
}
