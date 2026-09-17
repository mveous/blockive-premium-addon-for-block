<?php
/**
 * Conditionally loads Template Builder editor assets.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueues the Template Builder JS/CSS bundle only when editing a `blockive_template`.
 */
class Bpafb_Template_Builder
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		add_action('enqueue_block_editor_assets', [$this, 'enqueue_assets']);
	}

	/**
	 * Enqueues the Template Builder bundle, gated to the template editor only.
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
	 * Every public, viewable post type's singular label (e.g. 'product' =>
	 * 'Product'), for building "All Products" / "Specific Product"-style
	 * Display Conditions wording - WordPress core's own `/wp/v2/types` REST
	 * response doesn't include `labels.singular_name`, only the plural
	 * `name`, so this has to be localized separately rather than read from
	 * the block editor's own `core` data store. Includes every viewable
	 * type regardless of Free/Pro lock state - the label text itself isn't
	 * privileged information, only the ability to pick a locked one is.
	 *
	 * @return array<string,string>
	 */
	private static function get_post_type_singular_names()
	{
		$names = [];
		foreach (array_filter(get_post_types(['public' => true]), 'is_post_type_viewable') as $slug) {
			$post_type_object = get_post_type_object($slug);
			$names[$slug]     = $post_type_object ? $post_type_object->labels->singular_name : $slug;
		}
		return $names;
	}
}
