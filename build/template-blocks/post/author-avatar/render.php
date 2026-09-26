<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Author Avatar Template Block.
 *
 * Border/shadow inline styles mirror the getBorderStyles()/getShadowStyle()
 * JS helpers in components/border-controls and components/shadow-controls
 * (used by edit.js for the live preview) so the two stay visually in sync.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);
$bpafb_author_id = $bpafb_post_id ? (int) get_post_field('post_author', $bpafb_post_id) : 0;

if (!$bpafb_author_id) {
	return;
}

$bpafb_size = isset($attributes['size']) ? (int) $attributes['size'] : 96;
$bpafb_radius = isset($attributes['borderRadius']) ? (int) $attributes['borderRadius'] : 9999;
$bpafb_border_type = isset($attributes['borderType']) && in_array($attributes['borderType'], ['solid', 'dashed', 'dotted', 'double', 'groove', 'ridge', 'inset', 'outset'], true) ? $attributes['borderType'] : 'none';
$bpafb_border_width = isset($attributes['borderWidth']) ? (int) $attributes['borderWidth'] : 0;
$bpafb_border_color = Bpafb_Template_Block_Render::sanitize_css_color(isset($attributes['borderColor']) ? $attributes['borderColor'] : '');
$bpafb_shadow_enabled = !empty($attributes['shadowEnabled']);
$bpafb_shadow_color = Bpafb_Template_Block_Render::sanitize_css_color(isset($attributes['shadowColor']) ? $attributes['shadowColor'] : '');
$bpafb_shadow_color = $bpafb_shadow_color !== '' ? $bpafb_shadow_color : 'rgba(0,0,0,0.15)';
$bpafb_shadow_blur = isset($attributes['shadowBlur']) ? (int) $attributes['shadowBlur'] : 15;
$bpafb_shadow_spread = isset($attributes['shadowSpread']) ? (int) $attributes['shadowSpread'] : 0;

$bpafb_style_vars   = [];
$bpafb_style_vars[] = '--bpafb-aa-size:' . $bpafb_size . 'px';
$bpafb_style_vars[] = '--bpafb-aa-radius:' . $bpafb_radius . 'px';

if ($bpafb_border_type && $bpafb_border_type !== 'none') {
	$bpafb_style_vars[] = '--bpafb-aa-border-style:' . esc_attr($bpafb_border_type);
	$bpafb_style_vars[] = '--bpafb-aa-border-width:' . $bpafb_border_width . 'px';
	if ($bpafb_border_color) {
		$bpafb_style_vars[] = '--bpafb-aa-border-color:' . esc_attr($bpafb_border_color);
	}
} else {
	$bpafb_style_vars[] = '--bpafb-aa-border-style:none';
}

$bpafb_style_vars[] = '--bpafb-aa-shadow:' . ($bpafb_shadow_enabled
	? sprintf('0 4px %dpx %dpx %s', $bpafb_shadow_blur, $bpafb_shadow_spread, esc_attr($bpafb_shadow_color))
	: 'none');

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'bpafb-tb-author-avatar',
	'style' => implode(';', $bpafb_style_vars) . ';',
]);

printf('<div %s>', $bpafb_wrapper_attributes); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

echo get_avatar($bpafb_author_id, $bpafb_size, '', '', ['class' => 'bpafb-tb-author-avatar-img']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

echo '</div>';
