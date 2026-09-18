<?php
/**
 * Registers the Blockive Template custom post type.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the `blockive_template` CPT used by the Template Builder.
 */
class Bpafb_Template_Post_Type
{
	const POST_TYPE = 'blockive_template';

	/**
	 * Post types a template can target in the free version. Every other
	 * viewable post type is a Pro feature: the Template Type control shows
	 * them with a "(Pro)" label but keeps them disabled.
	 *
	 * @var string[]
	 */
	const FREE_TEMPLATE_TYPES = ['post', 'page'];

	/**
	 * Returns the post types a template can target in this build. A Pro
	 * build unlocks the rest through the `bpafb_free_template_types`
	 * filter. This is the one place the editor UI, the list table, and the
	 * live-site code all check.
	 *
	 * @return string[] Post type slugs.
	 */
	public static function get_free_template_types()
	{
		$types = apply_filters('bpafb_free_template_types', self::FREE_TEMPLATE_TYPES);

		if (!is_array($types)) {
			return self::FREE_TEMPLATE_TYPES;
		}

		return array_values(array_filter(array_map('strval', $types)));
	}

	/**
	 * Whether a template for the given post type works without Pro.
	 *
	 * @param string $post_type Post type slug.
	 * @return bool
	 */
	public static function is_free_template_type($post_type)
	{
		return in_array((string) $post_type, self::get_free_template_types(), true);
	}

	/**
	 * The one and only instance of this class.
	 *
	 * @var Bpafb_Template_Post_Type|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
	 *
	 * @return Bpafb_Template_Post_Type
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
		add_action('init', [$this, 'register_post_type']);
		add_action('init', [$this, 'register_meta']);
		add_action('save_post_' . self::POST_TYPE, [$this, 'ensure_default_meta'], 10, 2);
		add_filter('manage_' . self::POST_TYPE . '_posts_columns', [$this, 'add_admin_columns']);
		add_action('manage_' . self::POST_TYPE . '_posts_custom_column', [$this, 'render_admin_column'], 10, 2);
		add_filter('rest_pre_dispatch', [$this, 'restrict_rest_access'], 10, 3);
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
	 * Blockive Templates are set to `public => false`, but `show_in_rest
	 * => true` (needed for the block editor) means WordPress's normal REST
	 * API would still let anyone, even logged-out visitors, read any
	 * published one. That is because WordPress only checks permissions
	 * for `context=edit` requests, not the plain `context=view` a normal
	 * GET request uses. This function closes that gap by requiring the
	 * `edit_posts` permission for any REST request about this post type.
	 *
	 * @param mixed           $result  Response to replace the request with, or null to proceed normally.
	 * @param WP_REST_Server  $server  REST server instance.
	 * @param WP_REST_Request $request Current REST request.
	 * @return mixed
	 */
	public function restrict_rest_access($result, $server, $request)
	{
		if (null !== $result) {
			return $result;
		}

		$route = $request->get_route();
		if (!preg_match('#^/wp/v2/' . preg_quote(self::POST_TYPE, '#') . '(/|$)#', $route)) {
			return $result;
		}

		$post_type_object = get_post_type_object(self::POST_TYPE);
		if ($post_type_object && current_user_can($post_type_object->cap->edit_posts)) {
			return $result;
		}

		return new WP_Error(
			'bpafb_rest_forbidden',
			__('Sorry, you are not allowed to access Blockive Templates.', 'blockive-premium-addon-for-block'),
			['status' => rest_authorization_required_code()]
		);
	}

	/**
	 * Fills in the needed template meta fields with default values on save.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post object.
	 */
	public function ensure_default_meta($post_id, $post)
	{
		if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
			return;
		}

		$template_type = get_post_meta($post_id, '_bpafb_template_type', true);
		if (empty($template_type)) {
			update_post_meta($post_id, '_bpafb_template_type', 'post');
		}

		$scope = get_post_meta($post_id, Bpafb_Template_Display_Conditions::META_SCOPE, true);
		if (empty($scope)) {
			update_post_meta($post_id, Bpafb_Template_Display_Conditions::META_SCOPE, 'all');
		}
	}

	/**
	 * Inserts "Template Type" and "Display Condition" columns into the
	 * Blockive Templates list table, between Title and Date.
	 *
	 * @param array $columns Existing column list.
	 * @return array Modified column list.
	 */
	public function add_admin_columns($columns)
	{
		$date = $columns['date'] ?? null;
		unset($columns['date']);

		$columns['bpafb_template_type']     = __('Template Type', 'blockive-premium-addon-for-block');
		$columns['bpafb_display_condition'] = __('Display Condition', 'blockive-premium-addon-for-block');

		if (null !== $date) {
			$columns['date'] = $date;
		}

		return $columns;
	}

	/**
	 * Renders the "Template Type" and "Display Condition" column content.
	 *
	 * @param string $column  Column key.
	 * @param int    $post_id Post ID.
	 */
	public function render_admin_column($column, $post_id)
	{
		if ('bpafb_template_type' !== $column && 'bpafb_display_condition' !== $column) {
			return;
		}

		$post_type_slug = get_post_meta($post_id, '_bpafb_template_type', true) ?: 'post';
		$post_type_obj  = get_post_type_object($post_type_slug);

		if ('bpafb_template_type' === $column) {
			$type_label = $post_type_obj ? $post_type_obj->labels->singular_name : $post_type_slug;

			if (!self::is_free_template_type($post_type_slug)) {
				$type_label = sprintf(
					/* translators: %s: post type name, e.g. "Product". */
					__('%s (Pro)', 'blockive-premium-addon-for-block'),
					$type_label
				);
			}

			echo esc_html($type_label);
			return;
		}

		$post_type_name = $post_type_obj ? $post_type_obj->labels->name : $post_type_slug;
		$scope          = get_post_meta($post_id, Bpafb_Template_Display_Conditions::META_SCOPE, true);

		if ('all' === $scope) {
			echo esc_html(
				sprintf(
					/* translators: %s: post type name, e.g. "Posts". */
					__('All %s', 'blockive-premium-addon-for-block'),
					$post_type_name
				)
			);
		} else {
			echo esc_html(
				sprintf(
					/* translators: %s: post type name, e.g. "Posts". */
					__('Specific %s (Pro)', 'blockive-premium-addon-for-block'),
					$post_type_name
				)
			);
		}
	}

	/**
	 * Registers the post type.
	 */
	public function register_post_type()
	{
		register_post_type(self::POST_TYPE, [
			'labels' => [
				'name'               => __('Blockive Templates', 'blockive-premium-addon-for-block'),
				'singular_name'      => __('Blockive Template', 'blockive-premium-addon-for-block'),
				'add_new'            => __('Add New', 'blockive-premium-addon-for-block'),
				'add_new_item'       => __('Add New Template', 'blockive-premium-addon-for-block'),
				'edit_item'          => __('Edit Template', 'blockive-premium-addon-for-block'),
				'new_item'           => __('New Template', 'blockive-premium-addon-for-block'),
				'view_item'          => __('View Template', 'blockive-premium-addon-for-block'),
				'search_items'       => __('Search Templates', 'blockive-premium-addon-for-block'),
				'not_found'          => __('No templates found', 'blockive-premium-addon-for-block'),
				'not_found_in_trash' => __('No templates found in Trash', 'blockive-premium-addon-for-block'),
				'all_items'          => __('Blockive Templates', 'blockive-premium-addon-for-block'),
				'menu_name'          => __('Blockive Templates', 'blockive-premium-addon-for-block'),
			],
			'public'              => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-layout',
			'supports'            => ['title', 'editor', 'custom-fields', 'revisions'],
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'has_archive'         => false,
			'rewrite'             => false,
		]);
	}

	/**
	 * Registers the "Template Type" meta field, which stores the real post
	 * type (post, page, product, event, and so on) this template is meant
	 * for. Template Blocks use this to know which post to show live
	 * preview data from while editing.
	 */
	public function register_meta()
	{
		register_post_meta(self::POST_TYPE, '_bpafb_template_type', [
			'type'          => 'string',
			'single'        => true,
			'default'       => 'post',
			'show_in_rest'  => true,
			'auth_callback' => function ($allowed, $meta_key, $post_id) {
				return current_user_can('edit_post', $post_id);
			},
		]);
	}
}
