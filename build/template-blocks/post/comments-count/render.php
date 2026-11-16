<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Comments Count Template Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);

$bpafb_icon = isset($attributes['icon']) ? $attributes['icon'] : 'fa-regular fa-comment';
$bpafb_format = isset($attributes['format']) && $attributes['format'] !== '' ? $attributes['format'] : '{count} Comments';
$bpafb_is_link = !isset($attributes['isLink']) || !empty($attributes['isLink']);
$bpafb_text_hover_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['textHoverColor']) ? $attributes['textHoverColor'] : ''
);
$bpafb_uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

$bpafb_count = $bpafb_post_id ? (int) get_comments_number($bpafb_post_id) : 0;

// Grammar-aware default label: when the format contains the literal word
// "Comments" (the default shape), swap it for the singular "Comment" once
// the count is 1, using _n() to keep it translatable.
$bpafb_word = _n('Comment', 'Comments', $bpafb_count, 'blockive-premium-addon-for-block');
if ($bpafb_count === 1) {
	$bpafb_format = preg_replace('/\bComments\b/i', $bpafb_word, $bpafb_format);
}

$bpafb_label = str_replace('{count}', number_format_i18n($bpafb_count), $bpafb_format);

$bpafb_classes = ['bpafb-tb-comments-count'];
if ($bpafb_uid) {
	$bpafb_classes[] = 'bpafb-uid-' . $bpafb_uid;
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_classes),
]);

$bpafb_inner = Bpafb_Template_Block_Render::icon_html($bpafb_icon) . esc_html($bpafb_label);

if ($bpafb_is_link && $bpafb_post_id) {
	$bpafb_inner = '<a href="' . esc_url(get_comments_link($bpafb_post_id)) . '">' . $bpafb_inner . '</a>';
}

if ($bpafb_text_hover_color && $bpafb_uid) {
	echo '<style>.bpafb-uid-' . esc_attr($bpafb_uid) . ':hover, .bpafb-uid-' . esc_attr($bpafb_uid) . ':hover a { color:' . esc_attr($bpafb_text_hover_color) . ' !important; }</style>';
}

printf(
	'<span %1$s>%2$s</span>',
	$bpafb_wrapper_attributes, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	$bpafb_inner // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
);
