<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Post Content Template Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);

$bpafb_display_mode = isset($attributes['displayMode']) && $attributes['displayMode'] === 'excerpt' ? 'excerpt' : 'full';
$bpafb_max_width = isset($attributes['maxWidth']) ? (int) $attributes['maxWidth'] : 0;
$bpafb_drop_cap = !empty($attributes['dropCap']);
$bpafb_text_align = isset($attributes['textAlign']) ? $attributes['textAlign'] : '';
$bpafb_link_hover_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['linkHoverColor']) ? $attributes['linkHoverColor'] : ''
);
$bpafb_uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

$bpafb_is_empty = true;

if ($bpafb_display_mode === 'excerpt') {
	$bpafb_excerpt_text = $bpafb_post_id ? trim(wp_strip_all_tags(get_the_excerpt($bpafb_post_id))) : '';
	$bpafb_is_empty = $bpafb_excerpt_text === '';
	$bpafb_content_html = $bpafb_is_empty ? '' : '<p>' . esc_html($bpafb_excerpt_text) . '</p>';
} elseif ($bpafb_post_id && post_password_required($bpafb_post_id)) {
	$bpafb_content_html = get_the_password_form($bpafb_post_id);
	$bpafb_is_empty = false;
} else {
	$bpafb_raw_content = $bpafb_post_id ? get_post_field('post_content', $bpafb_post_id) : '';
	// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	$bpafb_content_html = $bpafb_post_id ? apply_filters('the_content', $bpafb_raw_content) : '';
	// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	$bpafb_is_empty = trim($bpafb_content_html) === '';
}

if ($bpafb_is_empty) {
	return;
}

$bpafb_style = '';
if ($bpafb_text_align) {
	$bpafb_style .= 'text-align:' . esc_attr($bpafb_text_align) . ';';
}
if ($bpafb_max_width) {
	$bpafb_style .= 'max-width:' . $bpafb_max_width . 'px;';
}

$bpafb_classes = ['bpafb-tb-post-content'];
if ($bpafb_drop_cap) {
	$bpafb_classes[] = 'bpafb-has-drop-cap';
}
if ($bpafb_uid) {
	$bpafb_classes[] = 'bpafb-uid-' . $bpafb_uid;
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_classes),
	'style' => $bpafb_style,
]);

if ($bpafb_link_hover_color && $bpafb_uid) {
	echo '<style>.bpafb-uid-' . esc_attr($bpafb_uid) . ' a:hover { color:' . esc_attr($bpafb_link_hover_color) . ' !important; }</style>';
}

printf('<div %s>', $bpafb_wrapper_attributes); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

echo $bpafb_content_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

echo '</div>';
