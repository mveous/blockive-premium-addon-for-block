<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Featured Image Template Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);
$bpafb_has_thumbnail = $bpafb_post_id && has_post_thumbnail($bpafb_post_id);

if (!$bpafb_has_thumbnail) {
	return;
}

$bpafb_size = isset($attributes['imageSize']) ? $attributes['imageSize'] : 'large';
$bpafb_aspect_ratio = isset($attributes['aspectRatio']) ? $attributes['aspectRatio'] : '';
$bpafb_border_radius = isset($attributes['borderRadius']) ? (int) $attributes['borderRadius'] : 0;
$bpafb_object_fit = isset($attributes['objectFit']) ? $attributes['objectFit'] : 'cover';
$bpafb_lazy_load = !isset($attributes['lazyLoad']) || !empty($attributes['lazyLoad']);
$bpafb_is_link = !isset($attributes['isLink']) || !empty($attributes['isLink']);
$bpafb_overlay_color = Bpafb_Template_Block_Render::sanitize_css_color(isset($attributes['overlayColor']) ? $attributes['overlayColor'] : '');
$bpafb_hover_effect = isset($attributes['hoverEffect']) ? $attributes['hoverEffect'] : 'none';
$bpafb_border_type = isset($attributes['borderType']) && in_array($attributes['borderType'], ['solid', 'dashed', 'dotted', 'double', 'groove', 'ridge', 'inset', 'outset'], true) ? $attributes['borderType'] : 'none';
$bpafb_border_width = isset($attributes['borderWidth']) ? (int) $attributes['borderWidth'] : 0;
$bpafb_border_color = Bpafb_Template_Block_Render::sanitize_css_color(isset($attributes['borderColor']) ? $attributes['borderColor'] : '');
$bpafb_shadow_enabled = !empty($attributes['shadowEnabled']);
$bpafb_shadow_color = Bpafb_Template_Block_Render::sanitize_css_color(isset($attributes['shadowColor']) ? $attributes['shadowColor'] : '');
$bpafb_shadow_color = $bpafb_shadow_color !== '' ? $bpafb_shadow_color : 'rgba(0,0,0,0.15)';
$bpafb_shadow_blur = isset($attributes['shadowBlur']) ? (int) $attributes['shadowBlur'] : 15;
$bpafb_shadow_spread = isset($attributes['shadowSpread']) ? (int) $attributes['shadowSpread'] : 0;

$bpafb_figure_style = '';
if ($bpafb_aspect_ratio) {
	$bpafb_figure_style .= 'aspect-ratio:' . esc_attr($bpafb_aspect_ratio) . ';';
}
if ($bpafb_border_radius) {
	$bpafb_figure_style .= 'border-radius:' . $bpafb_border_radius . 'px;overflow:hidden;';
}
if ($bpafb_overlay_color) {
	$bpafb_figure_style .= '--bpafb-fi-overlay-color:' . esc_attr($bpafb_overlay_color) . ';';
}
if ($bpafb_border_type && $bpafb_border_type !== 'none') {
	$bpafb_figure_style .= '--bpafb-fi-border-style:' . esc_attr($bpafb_border_type) . ';';
	$bpafb_figure_style .= '--bpafb-fi-border-width:' . $bpafb_border_width . 'px;';
	if ($bpafb_border_color) {
		$bpafb_figure_style .= '--bpafb-fi-border-color:' . esc_attr($bpafb_border_color) . ';';
	}
} else {
	$bpafb_figure_style .= '--bpafb-fi-border-style:none;';
}
$bpafb_figure_style .= '--bpafb-fi-shadow:' . ($bpafb_shadow_enabled
	? sprintf('0 4px %dpx %dpx %s', $bpafb_shadow_blur, $bpafb_shadow_spread, esc_attr($bpafb_shadow_color))
	: 'none') . ';';

$bpafb_figure_classes = ['bpafb-tb-featured-image'];
if ($bpafb_overlay_color) {
	$bpafb_figure_classes[] = 'bpafb-has-overlay';
}
if ($bpafb_hover_effect && $bpafb_hover_effect !== 'none') {
	$bpafb_figure_classes[] = 'bpafb-fi-hover-' . sanitize_html_class($bpafb_hover_effect);
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_figure_classes),
	'style' => $bpafb_figure_style,
]);

printf('<figure %s>', $bpafb_wrapper_attributes); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

$bpafb_img_atts = [
	'style' => 'object-fit:' . esc_attr($bpafb_object_fit) . ';width:100%;height:100%;',
	'loading' => $bpafb_lazy_load ? 'lazy' : 'eager',
];
$bpafb_img_html = get_the_post_thumbnail($bpafb_post_id, $bpafb_size, $bpafb_img_atts);

if ($bpafb_is_link) {
	printf(
		'<a href="%s">%s</a>',
		esc_url(get_permalink($bpafb_post_id)),
		$bpafb_img_html // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
} else {
	echo $bpafb_img_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

if ($bpafb_overlay_color) {
	echo '<span class="bpafb-tb-fi-overlay"></span>';
}

echo '</figure>';
