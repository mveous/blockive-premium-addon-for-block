<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Author Template Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);

$bpafb_allowed_formats = ['display_name', 'first_name', 'last_name', 'nickname'];
$bpafb_display_format = isset($attributes['displayFormat']) && in_array($attributes['displayFormat'], $bpafb_allowed_formats, true)
	? $attributes['displayFormat']
	: 'display_name';
$bpafb_is_link = !empty($attributes['isLink']);
$bpafb_link_target = isset($attributes['linkTarget']) ? $attributes['linkTarget'] : '_self';
$bpafb_text_align = isset($attributes['textAlign']) ? $attributes['textAlign'] : '';
$bpafb_text_hover_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['textHoverColor']) ? $attributes['textHoverColor'] : ''
);
$bpafb_uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

$bpafb_author_id = $bpafb_post_id ? (int) get_post_field('post_author', $bpafb_post_id) : 0;
$bpafb_author_name = $bpafb_author_id ? get_the_author_meta($bpafb_display_format, $bpafb_author_id) : '';
if ($bpafb_author_name === '') {
	$bpafb_author_name = __('Anonymous', 'blockive-premium-addon-for-block');
}

$bpafb_style = '';
if ($bpafb_text_align) {
	$bpafb_style .= 'text-align:' . esc_attr($bpafb_text_align) . ';';
}

$bpafb_classes = ['bpafb-tb-author'];
if ($bpafb_uid) {
	$bpafb_classes[] = 'bpafb-uid-' . $bpafb_uid;
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_classes),
	'style' => $bpafb_style,
]);

$bpafb_inner = esc_html($bpafb_author_name);
if ($bpafb_is_link && $bpafb_author_id) {
	$bpafb_url = get_author_posts_url($bpafb_author_id);
	$bpafb_rel = $bpafb_link_target === '_blank' ? ' rel="noopener noreferrer"' : '';
	$bpafb_inner = '<a href="' . esc_url($bpafb_url) . '" target="' . esc_attr($bpafb_link_target) . '"' . $bpafb_rel . '>' . $bpafb_inner . '</a>';
}

if ($bpafb_text_hover_color && $bpafb_uid) {
	echo '<style>.bpafb-uid-' . esc_attr($bpafb_uid) . ':hover, .bpafb-uid-' . esc_attr($bpafb_uid) . ':hover a { color:' . esc_attr($bpafb_text_hover_color) . ' !important; }</style>';
}

printf(
	'<span %1$s>%2$s</span>',
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	$bpafb_wrapper_attributes,
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	$bpafb_inner
);
