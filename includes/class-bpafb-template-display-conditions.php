<?php
/**
 * Stores and matches the "where should this template apply" rules for the
 * `blockive_template` post type.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the display-condition meta fields and resolves, for a given
 * real-world post, which published Blockive Template (if any) should
 * replace its frontend output.
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
	 * Whether the "specific posts/pages" display condition scope is
	 * available in this build. Free version templates can only apply to
	 * "All" of their target post type; a Pro build flips this on via the
	 * `bpafb_specific_display_condition_enabled` filter - the single source
	 * of truth shared by the editor UI and the frontend matcher.
	 *
	 * @return bool
	 */
	public static function is_specific_scope_enabled()
	{
		return (bool) apply_filters('bpafb_specific_display_condition_enabled', false);
	}

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		add_action('init', [$this, 'register_meta']);
	}

	/**
	 * Registers the display-condition meta. Defaults to a scope of
	 * "specific" with an empty id list, so a newly created template applies
	 * nowhere until a site owner deliberately assigns it - never silently
	 * overrides real pages.
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

		// Title/featured-image suppression defaults to true (hidden) so
		// existing templates keep behaving exactly as before this setting
		// existed - it's opt-out, not opt-in.
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
	 * Finds the best-matching published Blockive Template for a given real
	 * post, if any. A "specific" assignment always outranks an "all" one for
	 * the same post type; ties are broken by the lowest priority number
	 * (same convention as WordPress hook priorities).
	 *
	 * @param string $post_type Real post's post type (e.g. 'post', 'product').
	 * @param int    $post_id   Real post's ID.
	 * @return int Matched template post ID, or 0 if none matched.
	 */
	public static function get_matching_template_id($post_type, $post_id)
	{
		// Templates for anything beyond the free post types are a Pro
		// feature. Existing templates keep their saved Template Type (the
		// data is never rewritten) - they simply don't take over the
		// frontend until Pro unlocks the type.
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

		// A Pro build's Template Kind meta (_bpafb_template_kind) marks
		// templates meant for a header/footer/archive/etc. location rather
		// than this singular-content override. Those are matched by Pro's
		// own resolver against a different set of conditions entirely, so
		// they must never also compete here for "which template overrides
		// this post's content" - the exclusion below applies regardless of
		// whether Pro is even installed, since it only reads meta by key.
		// Absent/empty (no Pro, or a template saved before this meta
		// existed) counts as "single" so nothing already-working changes.
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

			// A saved "specific" scope (e.g. from a prior Pro install) never
			// takes effect in the free version - falls through to "all"
			// matching instead of being skipped outright, same as any other
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
