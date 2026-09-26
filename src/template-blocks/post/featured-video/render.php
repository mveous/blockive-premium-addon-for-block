<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Featured Video Template Block.
 *
 * Resolution order: post meta ($metaKey) > auto-detected content/featured
 * media video (when $autoDetect) > manual $videoUrl fallback attribute.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);

$bpafb_video_url_attr = isset($attributes['videoUrl']) ? trim($attributes['videoUrl']) : '';
$bpafb_meta_key = isset($attributes['metaKey']) && $attributes['metaKey'] !== '' ? $attributes['metaKey'] : 'featured_video_url';
$bpafb_auto_detect = !isset($attributes['autoDetect']) || !empty($attributes['autoDetect']);
$bpafb_aspect_ratio = isset($attributes['aspectRatio']) ? $attributes['aspectRatio'] : '16/9';
$bpafb_border_radius = isset($attributes['borderRadius']) ? (int) $attributes['borderRadius'] : 0;
$bpafb_border_type = isset($attributes['borderType']) && in_array($attributes['borderType'], ['solid', 'dashed', 'dotted', 'double', 'groove', 'ridge', 'inset', 'outset'], true) ? $attributes['borderType'] : 'none';
$bpafb_border_width = isset($attributes['borderWidth']) ? (int) $attributes['borderWidth'] : 0;
$bpafb_border_color = Bpafb_Template_Block_Render::sanitize_css_color(isset($attributes['borderColor']) ? $attributes['borderColor'] : '');
$bpafb_shadow_enabled = !empty($attributes['shadowEnabled']);
$bpafb_shadow_color = Bpafb_Template_Block_Render::sanitize_css_color(isset($attributes['shadowColor']) ? $attributes['shadowColor'] : '');
$bpafb_shadow_color = $bpafb_shadow_color !== '' ? $bpafb_shadow_color : 'rgba(0,0,0,0.15)';
$bpafb_shadow_blur = isset($attributes['shadowBlur']) ? (int) $attributes['shadowBlur'] : 15;
$bpafb_shadow_spread = isset($attributes['shadowSpread']) ? (int) $attributes['shadowSpread'] : 0;

$bpafb_video_url = '';

// 1. Post meta.
if ($bpafb_post_id) {
	$bpafb_meta_value = get_post_meta($bpafb_post_id, $bpafb_meta_key, true);
	if (!empty($bpafb_meta_value) && is_string($bpafb_meta_value)) {
		$bpafb_video_url = trim($bpafb_meta_value);
	}
}

// 2. Auto-detect: first <video> tag / [video] shortcode in the content, or a
// featured image attachment that is actually a video mime type.
if ($bpafb_video_url === '' && $bpafb_auto_detect && $bpafb_post_id) {
	$bpafb_raw_content = get_post_field('post_content', $bpafb_post_id);

	if (preg_match('/<video[^>]*\ssrc=["\']([^"\']+)["\']/i', $bpafb_raw_content, $bpafb_matches)) {
		$bpafb_video_url = $bpafb_matches[1];
	} elseif (preg_match('/\[video[^\]]*\ssrc=["\']([^"\']+)["\']/i', $bpafb_raw_content, $bpafb_matches)) {
		$bpafb_video_url = $bpafb_matches[1];
	} elseif (has_post_thumbnail($bpafb_post_id)) {
		$bpafb_thumb_id = get_post_thumbnail_id($bpafb_post_id);
		if ($bpafb_thumb_id && strpos((string) get_post_mime_type($bpafb_thumb_id), 'video/') === 0) {
			$bpafb_attachment_url = wp_get_attachment_url($bpafb_thumb_id);
			if ($bpafb_attachment_url) {
				$bpafb_video_url = $bpafb_attachment_url;
			}
		}
	}
}

// 3. Manual fallback attribute.
if ($bpafb_video_url === '' && $bpafb_video_url_attr !== '') {
	$bpafb_video_url = $bpafb_video_url_attr;
}

if ($bpafb_video_url === '') {
	return;
}

$bpafb_style_vars = [];
if ($bpafb_aspect_ratio) {
	$bpafb_style_vars[] = 'aspect-ratio:' . esc_attr($bpafb_aspect_ratio);
}
if ($bpafb_border_radius) {
	$bpafb_style_vars[] = '--bpafb-fv-border-radius:' . $bpafb_border_radius . 'px';
}
if ($bpafb_border_type && $bpafb_border_type !== 'none') {
	$bpafb_style_vars[] = '--bpafb-fv-border-style:' . esc_attr($bpafb_border_type);
	$bpafb_style_vars[] = '--bpafb-fv-border-width:' . $bpafb_border_width . 'px';
	if ($bpafb_border_color) {
		$bpafb_style_vars[] = '--bpafb-fv-border-color:' . esc_attr($bpafb_border_color);
	}
} else {
	$bpafb_style_vars[] = '--bpafb-fv-border-style:none';
}
$bpafb_style_vars[] = '--bpafb-fv-shadow:' . ($bpafb_shadow_enabled
	? sprintf('0 4px %dpx %dpx %s', $bpafb_shadow_blur, $bpafb_shadow_spread, esc_attr($bpafb_shadow_color))
	: 'none');

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'bpafb-tb-featured-video',
	'style' => implode(';', $bpafb_style_vars) . ';',
]);

echo '<div ' . $bpafb_wrapper_attributes . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

if (preg_match('/\.(mp4|webm|ogg)(\?.*)?$/i', $bpafb_video_url)) {
	printf(
		'<video src="%s" controls preload="metadata" style="width:100%%;height:100%%;"></video>',
		esc_url($bpafb_video_url)
	);
} else {
	$bpafb_embed = wp_oembed_get($bpafb_video_url, ['width' => 1200]);
	if ($bpafb_embed) {
		echo '<div class="bpafb-tb-featured-video-embed">' . $bpafb_embed . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		printf(
			'<a class="bpafb-tb-featured-video-fallback-link" href="%1$s" target="_blank" rel="noopener noreferrer">%2$s %1$s</a>',
			esc_url($bpafb_video_url),
			Bpafb_Template_Block_Render::icon_html('fa-solid fa-circle-play') // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
}

echo '</div>';
