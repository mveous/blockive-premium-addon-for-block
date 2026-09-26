<?php
/**
 * Shows a matched Blockive Template instead of the normal page content,
 * on single post, page, product, and event pages.
 *
 * The template is shown inside the theme's own page, not instead of it.
 * This way the theme's width, spacing, and fonts still work. The template's
 * content takes the place of `the_content`. The theme's own title and
 * featured image are hidden using core's `the_title` and
 * `post_thumbnail_html` filters (and, on block themes, by not showing
 * those blocks at all).
 *
 * WooCommerce products and Events Calendar events show a lot of extra
 * markup outside `the_content` on their own page. For these, a template
 * needs to take over the whole page instead of just the content area.
 * See setup_woocommerce_template() and maybe_swap_events_template().
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Shows the matched Blockive Template inside the active theme's own page,
 * keeping the theme's header, footer, fonts, and page width.
 */
class Bpafb_Template_Frontend_Render
{
	/**
	 * Template post ID matched for the current request.
	 *
	 * @var int
	 */
	private static $matched_template_id = 0;

	/**
	 * Whether resolve_template_for_current_request() has already run for
	 * this request. We also remember a "no match" result, since 0 could
	 * otherwise mean either "no match" or "not checked yet".
	 *
	 * @var bool
	 */
	private static $has_resolved_template = false;

	/**
	 * Stops the_content from running itself again while it is already running.
	 *
	 * @var bool
	 */
	private static $is_rendering = false;

	/**
	 * Template ID found by maybe_swap_events_template(). The wrapper
	 * template file (includes/templates/single-full-takeover-wrapper.php)
	 * reads this back.
	 *
	 * @var int
	 */
	private static $full_takeover_template_id = 0;

	/**
	 * Theme blocks that make up the post's title and byline. A Blockive
	 * Template's own Post Title block already shows this. We hide them
	 * together when "Hide title" is on, since a byline on its own with no
	 * heading above it looks wrong.
	 *
	 * @var string[]
	 */
	private static $title_block_names = [
		'core/post-title',
		'core/post-author',
		'core/post-author-name',
		'core/post-author-biography',
		'core/avatar',
		'core/post-date',
		'core/post-terms',
		'core/post-excerpt',
	];

	/**
	 * Theme blocks that show the post's featured image. Hidden when the
	 * "Hide featured image" setting is on.
	 *
	 * @var string[]
	 */
	private static $featured_image_block_names = [
		'core/post-featured-image',
	];

	/**
	 * Block names that loop over their own items (other posts, comments,
	 * and so on). We must not hide blocks found inside these, since they
	 * belong to the loop's own items, not the page's own title/image area.
	 *
	 * @var string[]
	 */
	private static $loop_boundary_block_names = [
		'core/query',
		'core/post-template',
		'core/comments',
		'core/comment-template',
	];

	/**
	 * How many of the loop blocks above are rendering right now, counting
	 * nested ones. While this is above 0, we are inside a loop item (like
	 * another post or a comment), so we must never hide a block there.
	 *
	 * We can't use block context (WP_Block::$context) for this instead:
	 * core/query and core/comment-template render their items with
	 * `new WP_Block(...)->render()`, which does not pass the parent
	 * context down. So a plain wrapper block inside the loop would look
	 * like it's outside the loop.
	 *
	 * @var int
	 */
	private static $active_loop_depth = 0;

	/**
	 * Per-theme settings for the "Full width (no sidebar)" option. Each
	 * entry names the filter a theme already has for changing its own
	 * sidebar layout, plus either the value that means "no sidebar", or
	 * (for a theme like Kadence, whose filter carries a whole settings
	 * array) a `transform` function. A theme with no entry here just
	 * ignores the setting.
	 *
	 * Other code can add more themes through the
	 * `bpafb_sidebar_layout_adapters` filter (see
	 * register_sidebar_layout_adapter()), without editing this plugin.
	 *
	 * @var array<string, array{filter: string, value?: string, transform?: string}>
	 */
	private static $default_sidebar_layout_adapters = [
		'astra' => [
			'filter' => 'astra_page_layout',
			'value'  => 'no-sidebar',
			// Astra's "Content Width" setting uses its own `.ast-container`
			// wrapper above the post content, separate from the sidebar.
			// See print_full_width_container_css().
			'container_selector' => '.ast-container',
			// Astra adds `ast-no-title` to `.entry-header` when the title
			// is empty, but still shows the byline anyway.
			// See print_hide_title_meta_css().
			'classic_meta_selector' => '.entry-header.ast-no-title .entry-meta',
			// The filter Astra's own page-builder add-ons use to hide post
			// navigation. See register_post_nav_adapter().
			'post_nav_filter' => 'astra_single_post_navigation_enabled',
		],
		'generatepress' => [
			'filter' => 'generate_sidebar_layout',
			'value'  => 'no-sidebar',
		],
		'oceanwp' => [
			// Read before the theme's own sidebar setting, so this still
			// wins even when a post has no layout chosen.
			'filter' => 'ocean_post_layout_meta_value',
			'value'  => 'full-width',
		],
		'neve' => [
			'filter' => 'neve_sidebar_position',
			'value'  => 'full-width',
		],
		'blocksy' => [
			'filter' => 'blocksy:global:page_structure',
			'value'  => 'none',
		],
		'kadence' => [
			// Kadence's filter carries a whole settings array, not one value.
			'filter'    => 'kadence_post_layout',
			'transform' => 'disable_kadence_sidebar',
		],
	];

	/**
	 * The one and only instance of this class.
	 *
	 * @var Bpafb_Template_Frontend_Render|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
	 *
	 * @return Bpafb_Template_Frontend_Render
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
		add_action('template_redirect', [$this, 'resolve_matched_template']);
		// Priority PHP_INT_MAX: page builders and themes set their own
		// content on `the_content` and don't check what ran before them.
		// Running last means a matched template always wins.
		add_filter('the_content', [$this, 'filter_the_content'], PHP_INT_MAX);
		add_filter('the_title', [$this, 'suppress_duplicate_title'], 10, 2);
		add_filter('post_thumbnail_id', [$this, 'suppress_duplicate_featured_image_id'], 10, 2);
		add_filter('post_thumbnail_html', [$this, 'suppress_duplicate_featured_image'], 10, 2);
		add_filter('comments_template', [$this, 'suppress_duplicate_comments_template']);
		add_filter('pre_render_block', [$this, 'track_loop_boundary_enter'], 1, 2);
		add_filter('pre_render_block', [$this, 'suppress_duplicate_theme_blocks'], 10, 2);
		add_filter('render_block', [$this, 'track_loop_boundary_exit'], 999, 2);
		// No need to check if WooCommerce is active: this action only ever
		// fires when it is.
		add_action('woocommerce_before_single_product', [$this, 'setup_woocommerce_template']);
		// Priority PHP_INT_MAX so this always wins over whatever Events
		// Calendar (or a theme) already set template_include to.
		add_filter('template_include', [$this, 'maybe_swap_events_template'], PHP_INT_MAX);
		add_action('wp_head', [$this, 'print_full_width_container_css']);
		add_action('wp_head', [$this, 'print_hide_title_meta_css']);
		$this->register_sidebar_layout_adapter();
		$this->register_post_nav_adapter();
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
	 * If the current theme has a known "no sidebar" filter, this hooks
	 * into it so the "Full width (no sidebar)" template setting can ask
	 * the theme to drop its sidebar, the same way the theme's own
	 * page-builder add-ons do.
	 */
	private function register_sidebar_layout_adapter()
	{
		$theme = get_template();

		/**
		 * Filters the per-theme "no sidebar" settings used by the
		 * "Full width (no sidebar)" template setting.
		 *
		 * @param array<string, array{filter: string, value?: string, transform?: string}> $adapters
		 *     A list mapping a theme's slug to its settings: `filter` (the
		 *     filter name to hook into), and either `value` (the "no
		 *     sidebar" value) or `transform` (a function to call, for a
		 *     theme whose filter carries a whole settings array instead of
		 *     one value).
		 */
		$adapters = apply_filters('bpafb_sidebar_layout_adapters', self::$default_sidebar_layout_adapters);

		if (!isset($adapters[$theme])) {
			return;
		}

		$adapter = $adapters[$theme];

		add_filter($adapter['filter'], function ($layout) use ($adapter) {
			if (!$this->matched_template_wants_full_width()) {
				return $layout;
			}

			if (!empty($adapter['transform'])) {
				$transform = $adapter['transform'];
				// A plain string names one of this class's own methods. A
				// theme added through the filter can pass any callable instead.
				if (is_string($transform) && method_exists($this, $transform)) {
					$transform = [$this, $transform];
				}
				if (is_callable($transform)) {
					return call_user_func($transform, $layout);
				}
			}

			return isset($adapter['value']) ? $adapter['value'] : $layout;
		});
	}

	/**
	 * If the current theme has a known "show post navigation" filter, this
	 * hooks into it so "Hide post navigation" can ask the theme not to
	 * print its links at all, instead of hiding them with CSS.
	 *
	 * Uses the same list of themes as register_sidebar_layout_adapter().
	 */
	private function register_post_nav_adapter()
	{
		$theme = get_template();

		/** This filter is documented in register_sidebar_layout_adapter(). */
		$adapters = apply_filters('bpafb_sidebar_layout_adapters', self::$default_sidebar_layout_adapters);

		if (empty($adapters[$theme]['post_nav_filter'])) {
			return;
		}

		add_filter($adapters[$theme]['post_nav_filter'], function ($enabled) {
			if (is_admin() || !is_singular()) {
				return $enabled;
			}

			$template_id = self::get_matched_template_id();
			if (!$template_id) {
				return $enabled;
			}

			if (get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_POST_NAV, true)) {
				return false;
			}

			return $enabled;
		});
	}

	/**
	 * Kadence's `kadence_post_layout` filter carries the theme's whole
	 * layout settings. We only need to change the 'sidebar' key.
	 *
	 * @param mixed $layout Value passed through the `kadence_post_layout` filter.
	 * @return mixed
	 */
	private function disable_kadence_sidebar($layout)
	{
		if (is_array($layout)) {
			$layout['sidebar'] = 'disable';
		}
		return $layout;
	}

	/**
	 * Whether the matched template has "Full width (no sidebar)" turned on
	 * for this page.
	 *
	 * @return bool
	 */
	private function matched_template_wants_full_width()
	{
		if (is_admin() || !is_singular()) {
			return false;
		}

		$template_id = self::get_matched_template_id();
		if (!$template_id) {
			return false;
		}

		return (bool) get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_FULL_WIDTH, true);
	}

	/**
	 * Removes the theme's own page-wide "boxed container" width (for
	 * example Astra's "Content Width" setting) when the matched template
	 * has "Full width (no sidebar)" turned on.
	 *
	 * This is separate from the sidebar itself: dropping the sidebar makes
	 * the content wider up to the theme's boxed container, but does not
	 * change that container's own width. `:has()` limits this change to
	 * only the container that actually wraps the matched template.
	 *
	 * Only works for themes whose settings above have a
	 * `container_selector` (right now, just Astra).
	 */
	public function print_full_width_container_css()
	{
		if (!$this->matched_template_wants_full_width()) {
			return;
		}

		$theme = get_template();

		/** This filter is documented in register_sidebar_layout_adapter(). */
		$adapters = apply_filters('bpafb_sidebar_layout_adapters', self::$default_sidebar_layout_adapters);

		if (empty($adapters[$theme]['container_selector'])) {
			return;
		}

		$selector = $this->sanitize_css_selector($adapters[$theme]['container_selector']);
		if ($selector === '') {
			return;
		}

		printf(
			'<style>%1$s:has(.bpafb-template-render){max-width:none!important;margin-left:auto!important;margin-right:auto!important;}</style>',
			esc_html($selector)
		);
	}

	/**
	 * Hides the theme's own classic (non-block) author/date/category line
	 * when the matched template's "Hide title" setting is on.
	 * suppress_duplicate_title() already clears the theme's title text,
	 * but some themes (Astra included) still show this line on their own,
	 * so it needs its own fix here. Block themes are already handled by
	 * suppress_duplicate_theme_blocks().
	 *
	 * Only works for themes whose settings above have a
	 * `classic_meta_selector` (right now, just Astra).
	 */
	public function print_hide_title_meta_css()
	{
		if (is_admin() || !is_singular()) {
			return;
		}

		$template_id = self::get_matched_template_id();
		if (!$template_id) {
			return;
		}

		if (!get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_TITLE, true)) {
			return;
		}

		$theme = get_template();

		/** This filter is documented in register_sidebar_layout_adapter(). */
		$adapters = apply_filters('bpafb_sidebar_layout_adapters', self::$default_sidebar_layout_adapters);

		if (empty($adapters[$theme]['classic_meta_selector'])) {
			return;
		}

		$selector = $this->sanitize_css_selector($adapters[$theme]['classic_meta_selector']);
		if ($selector === '') {
			return;
		}

		printf(
			'<style>%1$s{display:none!important;}</style>',
			esc_html($selector)
		);
	}

	/**
	 * Checks a CSS selector from an adapter's `container_selector` before
	 * it is placed inside a `<style>` tag. `esc_html()` alone stops it
	 * from closing the tag early, but does nothing about CSS characters
	 * like `{`, `}`, or `;`. So we only accept a plain class/id/tag
	 * selector here.
	 *
	 * @param string $selector Selector from an adapter's `container_selector`.
	 * @return string The selector unchanged, or '' if it does not look safe.
	 */
	private function sanitize_css_selector($selector)
	{
		$selector = trim((string) $selector);
		if ($selector !== '' && preg_match('/^[a-zA-Z0-9_\-.#> ]+$/', $selector)) {
			return $selector;
		}
		return '';
	}

	/**
	 * The matched template ID, but only if the current request is showing
	 * that matched post's own entry inside the main Loop. This is not true
	 * for a document `<title>` tag, an RSS feed entry, or a post shown in
	 * a related-posts or comments loop somewhere on the page. Returns 0
	 * in every other case.
	 *
	 * Also returns 0 while the template's own content is being rendered
	 * (self::$is_rendering): a Template Block inside it, like Post Title
	 * or Featured Image, calls get_the_title()/get_the_post_thumbnail()
	 * for the same post through this same filter chain. We must not hide
	 * that, or the template would hide its own blocks.
	 *
	 * @param int $post_id Post ID passed by the filter being checked.
	 * @return int
	 */
	private function matched_template_id_for_post_in_loop($post_id)
	{
		if (self::$is_rendering) {
			return 0;
		}

		if (is_admin() || is_feed() || !is_singular() || !in_the_loop() || !is_main_query()) {
			return 0;
		}

		if ((int) $post_id !== (int) get_queried_object_id()) {
			return 0;
		}

		return self::get_matched_template_id();
	}

	/**
	 * Clears the theme's own title for the matched post, using the same
	 * `the_title` filter both classic and block themes use. Only runs
	 * when the template's "Hide title" setting is on (on by default).
	 *
	 * @param string $title   Post title.
	 * @param int    $post_id Post ID.
	 * @return string
	 */
	public function suppress_duplicate_title($title, $post_id)
	{
		$template_id = $this->matched_template_id_for_post_in_loop($post_id);
		if (!$template_id) {
			return $title;
		}

		$hide = get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_TITLE, true);
		return $hide ? '' : $title;
	}

	/**
	 * Clears the theme's own featured image for the matched post, using
	 * the `post_thumbnail_html` filter both classic and block themes use.
	 * Only runs when "Hide featured image" is on (on by default).
	 *
	 * @param string $html    Featured image HTML.
	 * @param int    $post_id Post ID.
	 * @return string
	 */
	public function suppress_duplicate_featured_image($html, $post_id)
	{
		$template_id = $this->matched_template_id_for_post_in_loop($post_id);
		if (!$template_id) {
			return $html;
		}

		$hide = get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_FEATURED, true);
		return $hide ? '' : $html;
	}

	/**
	 * Clears the matched post's thumbnail ID itself, not just the shown
	 * markup, so `has_post_thumbnail()` also reports false. Some themes,
	 * like Kadence, show their featured-image wrapper (with a reserved
	 * empty box) based on `has_post_thumbnail()`, not on whether any HTML
	 * was actually printed. So we need to clear this too.
	 *
	 * @param int|false $thumbnail_id Post thumbnail attachment ID.
	 * @param WP_Post   $post         Post object.
	 * @return int|false
	 */
	public function suppress_duplicate_featured_image_id($thumbnail_id, $post)
	{
		$template_id = $this->matched_template_id_for_post_in_loop($post->ID);
		if (!$template_id) {
			return $thumbnail_id;
		}

		$hide = get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_FEATURED, true);
		return $hide ? 0 : $thumbnail_id;
	}

	/**
	 * Points `comments_template()` at an empty file for the matched post
	 * when "Hide comments" is on, so classic themes show nothing in the
	 * comments area.
	 *
	 * @param string $template Path to the theme's own comments template file.
	 * @return string
	 */
	public function suppress_duplicate_comments_template($template)
	{
		if (is_admin() || !is_singular() || !is_main_query()) {
			return $template;
		}

		$template_id = self::get_matched_template_id();
		if (!$template_id) {
			return $template;
		}

		if (!get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_COMMENTS, true)) {
			return $template;
		}

		$blank = BPAFB_PATH . 'includes/templates/blank-comments.php';
		return file_exists($blank) ? $blank : $template;
	}

	/**
	 * Adds 1 to the loop-depth counter just before a loop block (Query
	 * Loop, Comment Template, and so on) starts rendering its items. Used
	 * together with track_loop_boundary_exit().
	 *
	 * @param string|null $pre_render   Left untouched.
	 * @param array       $parsed_block The block about to render.
	 * @return string|null
	 */
	public function track_loop_boundary_enter($pre_render, $parsed_block)
	{
		$block_name = isset($parsed_block['blockName']) ? $parsed_block['blockName'] : '';
		if (in_array($block_name, self::$loop_boundary_block_names, true)) {
			self::$active_loop_depth++;
		}
		return $pre_render;
	}

	/**
	 * Takes 1 off the loop-depth counter once a loop block has finished
	 * rendering all of its items. Used together with track_loop_boundary_enter().
	 *
	 * @param string $block_content Rendered block HTML.
	 * @param array  $parsed_block  The block that finished rendering.
	 * @return string
	 */
	public function track_loop_boundary_exit($block_content, $parsed_block)
	{
		$block_name = isset($parsed_block['blockName']) ? $parsed_block['blockName'] : '';
		if (in_array($block_name, self::$loop_boundary_block_names, true)) {
			self::$active_loop_depth = max(0, self::$active_loop_depth - 1);
		}
		return $block_content;
	}

	/**
	 * Hides the theme's own title, featured image, byline, date, terms,
	 * and/or Comments block when a Blockive Template has matched and the
	 * matching "Hide ..." setting is on, so nothing shows twice. Blocks
	 * inside a Query Loop or Comment Template are left alone, since those
	 * belong to other posts or comments, not this page's own title area.
	 *
	 * A block that only *wraps* a block we want to hide (for example a
	 * theme's byline made of a paragraph plus an author block) is hidden
	 * as a whole, as long as it does not also hold the real post content.
	 *
	 * @param string|null $pre_render   Short-circuit value; non-null skips this block entirely.
	 * @param array       $parsed_block The block about to render.
	 * @return string|null
	 */
	public function suppress_duplicate_theme_blocks($pre_render, $parsed_block)
	{
		if ($pre_render !== null) {
			return $pre_render;
		}

		$block_name = isset($parsed_block['blockName']) ? $parsed_block['blockName'] : '';
		if (empty($block_name)) {
			return $pre_render;
		}

		if (is_admin() || !is_singular() || !is_main_query()) {
			return $pre_render;
		}

		$template_id = self::get_matched_template_id();
		if (!$template_id) {
			return $pre_render;
		}

		if (self::$active_loop_depth > 0) {
			return $pre_render;
		}

		if ('core/comments' === $block_name) {
			$hide_comments = get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_COMMENTS, true);
			return $hide_comments ? '' : $pre_render;
		}

		$suppressed_names = [];
		if (get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_TITLE, true)) {
			$suppressed_names = array_merge($suppressed_names, self::$title_block_names);
		}
		if (get_post_meta($template_id, Bpafb_Template_Display_Conditions::META_HIDE_FEATURED, true)) {
			$suppressed_names = array_merge($suppressed_names, self::$featured_image_block_names);
		}

		if (empty($suppressed_names)) {
			return $pre_render;
		}

		if (in_array($block_name, $suppressed_names, true)) {
			return '';
		}

		if (in_array($block_name, self::$loop_boundary_block_names, true)) {
			// The blocks inside this are loop items - never hide a loop itself.
			return $pre_render;
		}

		if ('core/pattern' === $block_name && !empty($parsed_block['attrs']['slug'])) {
			$slug = $parsed_block['attrs']['slug'];
			if (
				$this->pattern_contains_block($slug, $suppressed_names)
				&& !$this->pattern_contains_block($slug, ['core/post-content'])
			) {
				return '';
			}
			return $pre_render;
		}

		if (
			!empty($parsed_block['innerBlocks'])
			&& $this->subtree_contains_block($parsed_block['innerBlocks'], $suppressed_names)
			&& !$this->subtree_contains_block($parsed_block['innerBlocks'], ['core/post-content'])
		) {
			return '';
		}

		return $pre_render;
	}

	/**
	 * Whether a parsed block tree has any block whose name is in $names.
	 * Also looks inside inner blocks and `core/pattern` blocks.
	 *
	 * @param array    $blocks Parsed blocks (as from parse_blocks()).
	 * @param string[] $names  Block names to look for.
	 * @return bool
	 */
	private function subtree_contains_block($blocks, array $names)
	{
		foreach ($blocks as $block) {
			$name = isset($block['blockName']) ? $block['blockName'] : '';
			if ('' === $name) {
				continue;
			}
			if (in_array($name, $names, true)) {
				return true;
			}
			if (in_array($name, self::$loop_boundary_block_names, true)) {
				// Its contents belong to whatever this block loops over,
				// not the current single post.
				continue;
			}
			if ('core/pattern' === $name && !empty($block['attrs']['slug'])) {
				if ($this->pattern_contains_block($block['attrs']['slug'], $names)) {
					return true;
				}
				continue;
			}
			if (!empty($block['innerBlocks']) && $this->subtree_contains_block($block['innerBlocks'], $names)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Whether a saved pattern's content has any block in $names.
	 *
	 * @param string   $slug  Pattern slug.
	 * @param string[] $names Block names to look for.
	 * @return bool
	 */
	private function pattern_contains_block($slug, array $names)
	{
		if (!class_exists('WP_Block_Patterns_Registry')) {
			return false;
		}
		$registry = WP_Block_Patterns_Registry::get_instance();
		if (!$registry->is_registered($slug)) {
			return false;
		}
		$pattern = $registry->get_registered($slug);
		if (empty($pattern['content'])) {
			return false;
		}
		return $this->subtree_contains_block(parse_blocks($pattern['content']), $names);
	}

	/**
	 * Checks if the current page matches a Blockive Template, and resets
	 * the loop-depth counter for the new page load, so it always starts
	 * fresh even if a past count got stuck.
	 */
	public function resolve_matched_template()
	{
		self::$active_loop_depth = 0;

		if (is_admin() || !is_singular()) {
			return;
		}

		self::resolve_template_for_current_request();
	}

	/**
	 * Finds and remembers the matched template ID for the current page,
	 * including a "no match" result. This way a page with no matching
	 * template does not run the get_posts() lookup again every time
	 * get_matched_template_id() is called (once per block).
	 */
	private static function resolve_template_for_current_request()
	{
		if (self::$has_resolved_template) {
			return;
		}
		self::$has_resolved_template = true;

		$queried_id   = get_queried_object_id();
		$queried_type = get_post_type($queried_id);

		if (!$queried_id || !$queried_type || $queried_type === Bpafb_Template_Post_Type::POST_TYPE) {
			return;
		}

		if (wp_count_posts(Bpafb_Template_Post_Type::POST_TYPE)->publish < 1) {
			return;
		}

		self::$matched_template_id = Bpafb_Template_Display_Conditions::get_matching_template_id($queried_type, $queried_id);
	}

	/**
	 * Changes the post content on single pages to show the matched
	 * Blockive Template's content instead of the post's own content.
	 *
	 * @param string $content Original post content.
	 * @return string
	 */
	public function filter_the_content($content)
	{
		if (is_admin() || !is_singular() || !in_the_loop() || !is_main_query()) {
			return $content;
		}

		if (self::$is_rendering) {
			return $content;
		}

		$template_id = self::get_matched_template_id();
		if (!$template_id) {
			return $content;
		}

		$queried_id = get_queried_object_id();
		if (get_the_ID() !== $queried_id) {
			return $content;
		}

		$template_post = get_post($template_id);
		if (!$template_post || empty($template_post->post_content)) {
			return $content;
		}

		self::$is_rendering = true;

		try {
			$rendered = do_blocks($template_post->post_content);
		} finally {
			self::$is_rendering = false;
		}

		return '<div class="bpafb-template-render">' . $rendered . '</div>';
	}

	/**
	 * Sets up the WooCommerce single-product page when a template matches.
	 */
	public function setup_woocommerce_template()
	{
		$template_id = self::get_matched_template_id();
		if (!$template_id) {
			return;
		}

		$queried_id = get_queried_object_id();
		if (get_post_type($queried_id) !== 'product') {
			return;
		}

		remove_all_actions('woocommerce_before_single_product_summary');
		remove_all_actions('woocommerce_single_product_summary');
		remove_all_actions('woocommerce_after_single_product_summary');

		add_action('woocommerce_single_product_summary', function () use ($template_id) {
			$template_post = get_post($template_id);
			if ($template_post && !empty($template_post->post_content)) {
				self::$is_rendering = true;
				try {
					$rendered = do_blocks($template_post->post_content);
				} finally {
					self::$is_rendering = false;
				}
				echo '<div class="bpafb-template-render">' . $rendered . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}, 1);
	}

	/**
	 * Swaps in a thin wrapper template for a single Events Calendar event
	 * when a matching Blockive Template exists, so the template takes
	 * over the whole event page (title, schedule, venue, organizer, and
	 * so on), not just the content area. This uses a template_include
	 * swap, since Events Calendar does not offer the small set of stable
	 * hooks WooCommerce does.
	 *
	 * Does not keep the theme's title/featured-image/comments settings
	 * for this case (same as setup_woocommerce_template()), since a full
	 * takeover replaces the whole page body anyway.
	 *
	 * @param string $template Absolute path to the template PHP core resolved.
	 * @return string
	 */
	public function maybe_swap_events_template($template)
	{
		if (is_admin() || !is_singular('tribe_events')) {
			return $template;
		}

		$template_id = self::get_matched_template_id();
		if (!$template_id) {
			return $template;
		}

		$wrapper = BPAFB_PATH . 'includes/templates/single-full-takeover-wrapper.php';
		if (!file_exists($wrapper)) {
			return $template;
		}

		self::$full_takeover_template_id = $template_id;

		return $wrapper;
	}

	/**
	 * Renders the template found by maybe_swap_events_template(), for the
	 * wrapper template file it points template_include at.
	 *
	 * @return string Rendered HTML, or '' if nothing is matched (this
	 *                should never happen outside that wrapper file).
	 */
	public static function render_full_takeover_template()
	{
		$template_id = self::$full_takeover_template_id;
		if (!$template_id) {
			return '';
		}

		$template_post = get_post($template_id);
		if (!$template_post || empty($template_post->post_content)) {
			return '';
		}

		self::$is_rendering = true;

		try {
			$rendered = do_blocks($template_post->post_content);
		} finally {
			self::$is_rendering = false;
		}

		return '<div class="bpafb-template-render">' . $rendered . '</div>';
	}

	/**
	 * Returns the Blockive Template post ID matched for the current page.
	 *
	 * @return int
	 */
	public static function get_matched_template_id()
	{
		if (!self::$has_resolved_template && !is_admin() && is_singular()) {
			self::resolve_template_for_current_request();
		}
		return self::$matched_template_id;
	}
}
