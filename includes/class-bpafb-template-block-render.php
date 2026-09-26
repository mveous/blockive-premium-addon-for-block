<?php
/**
 * Small helper functions shared by every Template Block's render.php file.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Keeps common jobs, like "which post should this show", "format a date
 * the same way everywhere", and "print an icon", in one place, instead of
 * copying the same code into around 40 render.php files.
 */
class Bpafb_Template_Block_Render
{
	/**
	 * Finds the post ID a Template Block should show. Uses the postId
	 * given through the block's context first (like inside a Query Loop),
	 * and falls back to the current post in The Loop. That fallback is
	 * what's in use once a `blockive_template`'s content is shown in place
	 * of a real post, product, or event.
	 *
	 * @param WP_Block $block Block instance (available as $block in render.php).
	 * @return int
	 */
	public static function get_post_id($block)
	{
		if (!empty($block->context['postId'])) {
			$context_id = (int) $block->context['postId'];
			return self::is_real_post($context_id) ? $context_id : 0;
		}

		$fallback_id = get_the_ID() ?: 0;
		return self::is_real_post($fallback_id) ? $fallback_id : 0;
	}

	/**
	 * Whether a post id points to real, viewable content, and not to
	 * something internal like a revision, an autosave, or a
	 * `blockive_template` post. A Template Block must never use one of
	 * those by mistake. For example, a template's own revision (fetched
	 * for autosave) holds the same content as the template. Treating that
	 * revision as "the post" would show the same Post Content block again,
	 * over and over, without stopping.
	 *
	 * @param int $post_id Post ID.
	 * @return bool
	 */
	private static function is_real_post($post_id)
	{
		if (!$post_id) {
			return false;
		}
		$post_type = get_post_type($post_id);
		return $post_type && is_post_type_viewable($post_type);
	}

	/**
	 * Finds the post type, using the same order of checks as get_post_id().
	 *
	 * @param WP_Block $block Block instance.
	 * @return string
	 */
	public static function get_post_type($block)
	{
		if (!empty($block->context['postType'])) {
			return $block->context['postType'];
		}
		$post_id = self::get_post_id($block);
		return $post_id ? (string) get_post_type($post_id) : 'post';
	}

	/**
	 * Formats a date the same way in every date-related Template Block.
	 *
	 * @param string $mysql_date Date in MySQL/WP format (e.g. get_the_date('c', $post) or a post field).
	 * @param string $format     PHP date format string, empty for the site default.
	 * @param bool   $relative   Whether to return a "2 days ago" style relative string instead.
	 * @return string
	 */
	public static function format_date($mysql_date, $format = '', $relative = false)
	{
		if (empty($mysql_date)) {
			return '';
		}
		$timestamp = is_numeric($mysql_date) ? (int) $mysql_date : strtotime($mysql_date);
		if (!$timestamp) {
			return '';
		}
		if ($relative) {
			/* translators: %s: human-readable time difference. */
			return sprintf(__('%s ago', 'blockive-premium-addon-for-block'), human_time_diff($timestamp, current_time('timestamp')));
		}
		return date_i18n($format ? $format : get_option('date_format'), $timestamp);
	}

	/**
	 * Prints an icon `<i>` tag from a Font Awesome class string, the same
	 * way the Icon Box and Social Icons blocks do.
	 *
	 * @param string $icon_class Font Awesome class(es), e.g. "fa-regular fa-calendar".
	 * @return string
	 */
	public static function icon_html($icon_class)
	{
		if (empty($icon_class)) {
			return '';
		}
		return '<i class="' . esc_attr($icon_class) . '" aria-hidden="true"></i> ';
	}

	/**
	 * Checks a color value before it is placed inside a `<style>` tag.
	 * `esc_attr()` on its own does not stop CSS characters like `{`, `}`,
	 * or `;` from breaking out of the rule, so this only allows values
	 * that look like a real CSS color: a hex code, a named color, or an
	 * rgb()/rgba()/hsl()/hsla()/var() call.
	 *
	 * @param string $color Color value from a block attribute.
	 * @return string The color unchanged, or '' if it does not look like a safe CSS color.
	 */
	public static function sanitize_css_color($color)
	{
		$color = trim((string) $color);
		if ($color === '') {
			return '';
		}
		if (preg_match('/^(#[0-9a-fA-F]{3,8}|[a-zA-Z]+|(?:rgba?|hsla?|var)\([^{};]*\))$/', $color)) {
			return $color;
		}
		return '';
	}

	/**
	 * Checks a CSS gradient value before it is placed in an inline style
	 * or <style> tag.
	 *
	 * @param string $gradient Gradient value from a block attribute.
	 * @return string The gradient unchanged, or '' if not safe.
	 */
	public static function sanitize_css_gradient($gradient)
	{
		$gradient = trim((string) $gradient);
		if ($gradient === '') {
			return '';
		}
		if (preg_match('/^(?:repeating-)?(?:linear|radial|conic)-gradient\([^{};<>]*\)$/i', $gradient)) {
			return $gradient;
		}
		return '';
	}

	/**
	 * Renders a post, product, or event "title" Template Block. Titles
	 * work the same way for all three - products and events are both
	 * normal WordPress post types - so the Post Title, Product Title, and
	 * Event Title blocks all share this same code. Only the wrapper CSS
	 * class is different between them.
	 *
	 * @param WP_Block $block         Block instance (available as $block in render.php).
	 * @param array    $attributes    Block attributes.
	 * @param string   $wrapper_class Block-specific wrapper class, e.g. 'bpafb-tb-post-title'.
	 */
	public static function render_title_block($block, $attributes, $wrapper_class)
	{
		$post_id = self::get_post_id($block);

		$allowed_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span'];
		$tag = isset($attributes['tagName']) && in_array($attributes['tagName'], $allowed_tags, true)
			? $attributes['tagName']
			: 'h2';

		$is_link = !empty($attributes['isLink']);
		$link_target = isset($attributes['linkTarget']) ? $attributes['linkTarget'] : '_self';
		$text_align = isset($attributes['textAlign']) ? $attributes['textAlign'] : '';
		$text_color = isset($attributes['textColor']) ? $attributes['textColor'] : '';
		$text_hover_color = self::sanitize_css_color(
			isset($attributes['textHoverColor']) ? $attributes['textHoverColor'] : ''
		);
		$uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

		$title = $post_id ? get_the_title($post_id) : '';
		if ($title === '') {
			$title = __('(no title)', 'blockive-premium-addon-for-block');
		}

		$style = '';
		if ($text_align) {
			$style .= 'text-align:' . esc_attr($text_align) . ';';
		}
		if ($text_color) {
			$style .= 'color:' . esc_attr($text_color) . ';';
		}

		$classes = [$wrapper_class];
		if ($uid) {
			$classes[] = 'bpafb-uid-' . $uid;
		}

		$wrapper_attributes = get_block_wrapper_attributes([
			'class' => implode(' ', $classes),
			'style' => $style,
		]);

		$inner = esc_html($title);
		if ($is_link && $post_id) {
			$rel = $link_target === '_blank' ? ' rel="noopener noreferrer"' : '';
			$inner = '<a href="' . esc_url(get_permalink($post_id)) . '" target="' . esc_attr($link_target) . '"' . $rel . '>' . $inner . '</a>';
		}

		if ($text_hover_color && $uid) {
			echo '<style>.bpafb-uid-' . esc_attr($uid) . ':hover, .bpafb-uid-' . esc_attr($uid) . ':hover a { color:' . esc_attr($text_hover_color) . ' !important; }</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		printf(
			'<%1$s %2$s>%3$s</%1$s>',
			tag_escape($tag),
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$wrapper_attributes,
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$inner
		);
	}
}
