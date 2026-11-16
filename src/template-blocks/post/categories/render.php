<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Categories Template Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);

$bpafb_categories = $bpafb_post_id ? get_the_category($bpafb_post_id) : [];
if (is_wp_error($bpafb_categories)) {
	$bpafb_categories = [];
}

if (empty($bpafb_categories)) {
	return;
}

$bpafb_separator = isset($attributes['separator']) ? $attributes['separator'] : ', ';
$bpafb_badge_style = !empty($attributes['badgeStyle']);
$bpafb_is_link = !isset($attributes['isLink']) || !empty($attributes['isLink']);
$bpafb_text_color = isset($attributes['textColor']) ? $attributes['textColor'] : '';
$bpafb_text_hover_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['textHoverColor']) ? $attributes['textHoverColor'] : ''
);
$bpafb_uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

$bpafb_style = '';
if ($bpafb_text_color) {
	$bpafb_style .= 'color:' . esc_attr($bpafb_text_color) . ';';
}

$bpafb_classes = ['bpafb-tb-categories'];
if ($bpafb_badge_style) {
	$bpafb_classes[] = 'bpafb-tb-categories--badges';
}
if ($bpafb_uid) {
	$bpafb_classes[] = 'bpafb-uid-' . $bpafb_uid;
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_classes),
	'style' => $bpafb_style,
]);

if ($bpafb_text_hover_color && $bpafb_uid) {
	$bpafb_hover_selector = '.bpafb-uid-' . esc_attr($bpafb_uid) . ' .bpafb-tb-category-item';
	echo '<style>' . esc_attr($bpafb_hover_selector) . ':hover, ' . esc_attr($bpafb_hover_selector) . ':hover a { color:' . esc_attr($bpafb_text_hover_color) . ' !important; }</style>';
}

printf('<div %s>', $bpafb_wrapper_attributes); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

foreach ($bpafb_categories as $bpafb_index => $bpafb_cat) {
	if ($bpafb_index > 0 && !$bpafb_badge_style && $bpafb_separator) {
		echo '<span class="bpafb-tb-category-sep">' . esc_html($bpafb_separator) . '</span>';
	}

	$bpafb_name = esc_html($bpafb_cat->name);
	$bpafb_url = get_category_link($bpafb_cat->term_id);

	echo '<span class="bpafb-tb-category-item">';
	if ($bpafb_is_link && !is_wp_error($bpafb_url)) {
		printf('<a href="%s">%s</a>', esc_url($bpafb_url), $bpafb_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		echo $bpafb_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	echo '</span>';
}

echo '</div>';
