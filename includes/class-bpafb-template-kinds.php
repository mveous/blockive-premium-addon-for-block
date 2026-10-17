<?php
/**
 * The free plugin's "Template Location" setting: besides the existing
 * single post/page override (Bpafb_Template_Display_Conditions), a
 * Blockive Template can also be marked as a Header or Footer, shown
 * everywhere on the site (see Bpafb_Template_Theme_Locations).
 *
 * This is its own file, separate from class-bpafb-template-post-type.php
 * and class-bpafb-template-display-conditions.php, the same way the Pro
 * plugin's richer Template Kind system (Bpafb_Pro_Template_Kinds, with
 * Archive/Search/404/Popup/etc. on top of Header/Footer) lives in its own
 * file rather than editing those two.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the Template Location (Kind) meta field, and resolves the
 * published Header/Footer template (if any) for the current site.
 */
class Bpafb_Template_Kinds
{
	const META_KIND = '_bpafb_template_kind';

	/**
	 * Kinds besides "single" (the free plugin's original, implicit kind -
	 * a single post/page content override). Both always apply site-wide:
	 * the free version has no per-page Display Conditions for them.
	 *
	 * @var string[]
	 */
	const KINDS = ['header', 'footer'];

	/**
	 * Text labels for KINDS, used in the admin list columns.
	 *
	 * @var array<string,string>
	 */
	const KIND_LABELS = [
		'header' => 'Header',
		'footer' => 'Footer',
	];

	/**
	 * The one and only instance of this class.
	 *
	 * @var Bpafb_Template_Kinds|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
	 *
	 * @return Bpafb_Template_Kinds
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
		add_action('init', [$this, 'register_meta']);
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
	 * Registers the Template Location (Kind) meta field on the
	 * `blockive_template` post type (which Bpafb_Template_Post_Type
	 * already registers).
	 */
	public function register_meta()
	{
		register_post_meta(Bpafb_Template_Post_Type::POST_TYPE, self::META_KIND, [
			'type'          => 'string',
			'single'        => true,
			'default'       => 'single',
			'show_in_rest'  => true,
			'auth_callback' => function ($allowed, $meta_key, $post_id) {
				return current_user_can('edit_post', $post_id);
			},
		]);
	}

	/**
	 * Gets the Template Location (Kind) of a Blockive Template post. A
	 * blank, missing, or unrecognized value means "single", the free
	 * plugin's original kind.
	 *
	 * @param int $template_id Blockive Template post ID.
	 * @return string 'single', 'header', or 'footer'.
	 */
	public static function get_kind($template_id)
	{
		$kind = get_post_meta($template_id, self::META_KIND, true);
		return in_array($kind, self::KINDS, true) ? $kind : 'single';
	}

	/**
	 * Remembers the result of get_matching_template_id() for this page
	 * load, by kind, since Bpafb_Template_Theme_Locations looks each one
	 * up more than once per page (once per theme-location hook it checks).
	 *
	 * @var array<string,int>
	 */
	private static $resolved = [];

	/**
	 * Finds the best matching published Header or Footer template. Both
	 * kinds apply site-wide in the free version, so the only tiebreaker
	 * between more than one published template of the same kind is
	 * Bpafb_Template_Display_Conditions::META_PRIORITY (lower wins), the
	 * same setting the single-post override already uses.
	 *
	 * @param string $kind 'header' or 'footer'.
	 * @return int Matched template post ID, or 0 if none matched.
	 */
	public static function get_matching_template_id($kind)
	{
		if (!in_array($kind, self::KINDS, true)) {
			return 0;
		}

		if (array_key_exists($kind, self::$resolved)) {
			return self::$resolved[$kind];
		}

		$templates = get_posts([
			'post_type'      => Bpafb_Template_Post_Type::POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'no_found_rows'  => true,
			'meta_query'     => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				[
					'key'   => self::META_KIND,
					'value' => $kind,
				],
			],
		]);

		if (empty($templates)) {
			return self::$resolved[$kind] = 0;
		}

		$best = null;

		foreach ($templates as $template) {
			$priority = get_post_meta($template->ID, Bpafb_Template_Display_Conditions::META_PRIORITY, true);
			$priority = ($priority === '' || $priority === false) ? 10 : (int) $priority;

			if (null === $best || $priority < $best['priority']) {
				$best = ['id' => $template->ID, 'priority' => $priority];
			}
		}

		return self::$resolved[$kind] = $best['id'];
	}
}
