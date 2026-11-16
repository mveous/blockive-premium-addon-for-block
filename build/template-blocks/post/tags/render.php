<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Tags Template Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);

$bpafb_tags = $bpafb_post_id ? get_the_tags($bpafb_post_id) : [];
if (!is_array($bpafb_tags)) {
	$bpafb_tags = [];
}

if (empty($bpafb_tags)) {
	return;
}

$bpafb_separator = isset($attributes['separator']) ? $attributes['separator'] : ', ';
$bpafb_badge_style = !empty($attributes['badgeStyle']);
$bpafb_link_hover_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['linkHoverColor']) ? $attributes['linkHoverColor'] : ''
);
$bpafb_uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

$bpafb_classes = ['bpafb-tb-tags'];
if ($bpafb_badge_style) {
	$bpafb_classes[] = 'bpafb-tags-badge';
}
if ($bpafb_uid) {
	$bpafb_classes[] = 'bpafb-uid-' . $bpafb_uid;
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_classes),
]);

if ($bpafb_link_hover_color && $bpafb_uid) {
	echo '<style>.bpafb-uid-' . esc_attr($bpafb_uid) . ' a:hover { color:' . esc_attr($bpafb_link_hover_color) . ' !important; }</style>';
}

echo '<div ' . $bpafb_wrapper_attributes . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

if ($bpafb_badge_style) {
	foreach ($bpafb_tags as $bpafb_tag) {
		printf(
			'<a href="%s" class="bpafb-tb-tag-badge">%s</a>',
			esc_url(get_tag_link($bpafb_tag)),
			esc_html($bpafb_tag->name)
		);
	}
} else {
	$bpafb_list = get_the_tag_list('', esc_html($bpafb_separator), '', $bpafb_post_id);
	if ($bpafb_list && !is_wp_error($bpafb_list)) {
		echo $bpafb_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

echo '</div>';
