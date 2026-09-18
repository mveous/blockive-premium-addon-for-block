<?php
/**
 * Stores and checks the "where should this template apply" rules for the
 * `blockive_template` post type.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the display-condition meta fields, and, for a given real post,
 * works out which published Blockive Template (if any) should replace it
 * on the live site.
 */
class Bpafb_Template_Display_Conditions
{
	const META_SCOPE          = '_bpafb_display_condition_scope';
	const META_IDS            = '_bpafb_display_condition_ids';
	const META_PRIORITY       = '_bpafb_template_priority';
	const META_FULL_WIDTH     = '_bpafb_full_width';
	const META_HIDE_TITLE     = '_bpafb_hide_title';
	const META_HIDE_FEATURED  = '_bpafb_hide_featured_image';
	const META_HIDE_COMMENTS  = '_bpafb_hide_comments';
	const META_HIDE_POST_NAV  = '_bpafb_hide_post_nav';

	/**
	 * Whether the "specific posts/pages" display condition is turned on in
	 * this build. Free templates can only apply to "All" of their target
	 * post type. Pro turns this on through the
	 * `bpafb_specific_display_condition_enabled` filter.
	 *
	 * @return bool
	 */
	public static function is_specific_scope_enabled()
	{
		return (bool) apply_filters('bpafb_specific_display_condition_enabled', false);
	}

	/**
	 * The one and only instance of this class.
	 *
	 * @var Bpafb_Template_Display_Conditions|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
	 *
	 * @return Bpafb_Template_Display_Conditions
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
	 * Registers the display-condition meta fields. Starts with a scope of
	 * "specific" and an empty list of IDs, so a new template applies
	 * nowhere until a site owner picks where it should show. It should
	 * never take over real pages on its own.
	 */
	public function register_meta()
	{
		$post_type = Bpafb_Template_Post_Type::POST_TYPE;

		$auth_callback = function ($allowed, $meta_key, $post_id) {
			return current_user_can('edit_post', $post_id);
		};

		register_post_meta($post_type, self::META_SCOPE, [
			'type'          => 'string',
			'single'        => true,
			'default'       => 'all',
			'show_in_rest'  => true,
			'auth_callback' => $auth_callback,
		]);

		register_post_meta($post_type, self::META_IDS, [
			'type'          => 'array',
			'single'        => true,
			'default'       => [],
			'show_in_rest'  => [
				'schema' => [
					'type'  => 'array',
					'items' => ['type' => 'integer'],
				],
			],
			'auth_callback' => $auth_callback,
		]);

		register_post_meta($post_type, self::META_PRIORITY, [
			'type'          => 'integer',
			'single'        => true,
			'default'       => 10,
			'show_in_rest'  => true,
			'auth_callback' => $auth_callback,
		]);

		register_post_meta($post_type, self::META_FULL_WIDTH, [
			'type'          => 'boolean',
			'single'        => true,
			'default'       => false,
			'show_in_rest'  => true,
			'auth_callback' => $auth_callback,
		]);

		// Hiding the title and featured image defaults to true (on), so
		// templates made before this setting existed keep working exactly
		// as before. Site owners can turn it off, but it starts on.
		register_post_meta($post_type, self::META_HIDE_TITLE, [
			'type'          => 'boolean',
			'single'        => true,
			'default'       => true,
			'show_in_rest'  => true,
			'auth_callback' => $auth_callback,
		]);

		register_post_meta($post_type, self::META_HIDE_FEATURED, [
			'type'          => 'boolean',
			'single'        => true,
			'default'       => true,
			'show_in_rest'  => true,
			'auth_callback' => $auth_callback,
		]);

		register_post_meta($post_type, self::META_HIDE_COMMENTS, [
			'type'          => 'boolean',
			'single'        => true,
			'default'       => false,
			'show_in_rest'  => true,
			'auth_callback' => $auth_callback,
		]);

		register_post_meta($post_type, self::META_HIDE_POST_NAV, [
			'type'          => 'boolean',
			'single'        => true,
			'default'       => false,
			'show_in_rest'  => true,
			'auth_callback' => $auth_callback,
		]);
	}

	/**
	 * Finds the best matching published Blockive Template for a real post,
	 * if any exist. A "specific" template always wins over an "all"
	 * template for the same post type. If more than one still matches, the
	 * one with the lowest priority number wins (same rule WordPress uses
	 * for hook priority).
	 *
	 * @param string $post_type Real post's post type (e.g. 'post', 'product').
	 * @param int    $post_id   Real post's ID.
	 * @return int Matched template post ID, or 0 if none matched.
	 */
	public static function get_matching_template_id($post_type, $post_id)
	{
		// Templates for any post type beyond the free ones are a Pro
		// feature. An existing template keeps its saved Template Type -
		// we never change that data - it just does not take over the live
		// site until Pro unlocks that post type.
		if (!Bpafb_Template_Post_Type::is_free_template_type($post_type)) {
			return 0;
		}

		$type_clause = ('post' === $post_type)
			? [
				'relation' => 'OR',
				[
					'key'   => '_bpafb_template_type',
					'value' => 'post',
				],
				[
					'key'     => '_bpafb_template_type',
					'compare' => 'NOT EXISTS',
				],
				[
					'key'   => '_bpafb_template_type',
					'value' => '',
				],
			]
			: [
				[
					'key'   => '_bpafb_template_type',
					'value' => $post_type,
				],
			];

		// Pro's Template Kind meta (_bpafb_template_kind) marks templates
		// meant for a header, footer, archive, or similar spot, rather
		// than this single-post override. Those must never be picked here.
		// A blank or missing value counts as "single", so nothing that
		// already works changes.
		$kind_clause = [
			'relation' => 'OR',
			[
				'key'   => '_bpafb_template_kind',
				'value' => 'single',
			],
			[
				'key'     => '_bpafb_template_kind',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'   => '_bpafb_template_kind',
				'value' => '',
			],
		];

		$templates = get_posts([
			'post_type'      => Bpafb_Template_Post_Type::POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'no_found_rows'  => true,
			'meta_query'     => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				'relation' => 'AND',
				$type_clause,
				$kind_clause,
			],
		]);

		if (empty($templates)) {
			return 0;
		}

		$best_specific = null;
		$best_all      = null;

		foreach ($templates as $template) {
			$scope    = get_post_meta($template->ID, self::META_SCOPE, true);
			$scope    = empty($scope) ? 'all' : $scope;
			$priority = get_post_meta($template->ID, self::META_PRIORITY, true);
			$priority = ($priority === '' || $priority === false) ? 10 : (int) $priority;

			// A saved "specific" scope (for example, from a past Pro
			// install) never works in the free version. It is treated as
			// "all" here instead of being skipped, the same as any other
			// template with scope "all".
			if ($scope === 'specific' && !self::is_specific_scope_enabled()) {
				$scope = 'all';
			}

			if ($scope === 'all') {
				if (!$best_all || $priority < $best_all['priority']) {
					$best_all = ['id' => $template->ID, 'priority' => $priority];
				}
				continue;
			}

			$ids = get_post_meta($template->ID, self::META_IDS, true);
			if (!is_array($ids) || !in_array((int) $post_id, array_map('intval', $ids), true)) {
				continue;
			}

			if (!$best_specific || $priority < $best_specific['priority']) {
				$best_specific = ['id' => $template->ID, 'priority' => $priority];
			}
		}

		if ($best_specific) {
			return $best_specific['id'];
		}

		return $best_all ? $best_all['id'] : 0;
	}
}
