<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Previous / Next Navigation Template Block.
 *
 * get_previous_post()/get_next_post() read the current post from the global
 * $post, so this temporarily sets up post data for the resolved post id
 * (never assuming global $post is already the right post) and restores it
 * immediately after, matching the safe usage pattern for these core
 * functions outside The Loop.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);

$bpafb_prev_label = isset($attributes['prevLabel']) ? $attributes['prevLabel'] : __('Previous', 'blockive-premium-addon-for-block');
$bpafb_next_label = isset($attributes['nextLabel']) ? $attributes['nextLabel'] : __('Next', 'blockive-premium-addon-for-block');
$bpafb_prev_icon = isset($attributes['prevIcon']) ? $attributes['prevIcon'] : 'fa-solid fa-arrow-left';
$bpafb_next_icon = isset($attributes['nextIcon']) ? $attributes['nextIcon'] : 'fa-solid fa-arrow-right';
$bpafb_hover_style = isset($attributes['hoverStyle']) ? $attributes['hoverStyle'] : 'none';
$bpafb_in_same_term = !empty($attributes['inSameTerm']);
$bpafb_link_hover_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['linkHoverColor']) ? $attributes['linkHoverColor'] : ''
);
$bpafb_uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

$bpafb_prev_post = null;
$bpafb_next_post = null;

if ($bpafb_post_id) {
	global $post;
	$bpafb_original_post = $post;

	$post = get_post($bpafb_post_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	if ($post) {
		setup_postdata($post);
		$bpafb_prev_candidate = get_previous_post($bpafb_in_same_term);
		$bpafb_next_candidate = get_next_post($bpafb_in_same_term);
		$bpafb_prev_post = ($bpafb_prev_candidate && !is_wp_error($bpafb_prev_candidate)) ? $bpafb_prev_candidate : null;
		$bpafb_next_post = ($bpafb_next_candidate && !is_wp_error($bpafb_next_candidate)) ? $bpafb_next_candidate : null;
	}

	wp_reset_postdata();
	$post = $bpafb_original_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
}

if (!$bpafb_prev_post && !$bpafb_next_post) {
	return;
}

$bpafb_classes = ['bpafb-tb-prev-next-nav', 'bpafb-hover-' . sanitize_html_class($bpafb_hover_style)];
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

if ($bpafb_prev_post) {
	printf(
		'<a href="%1$s" class="bpafb-tb-prev-next-link bpafb-tb-prev-link">%2$s<span class="bpafb-tb-prev-next-text"><span class="bpafb-tb-prev-next-label">%3$s</span><span class="bpafb-tb-prev-next-title">%4$s</span></span></a>',
		esc_url(get_permalink($bpafb_prev_post)),
		Bpafb_Template_Block_Render::icon_html($bpafb_prev_icon), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		esc_html($bpafb_prev_label),
		esc_html(get_the_title($bpafb_prev_post))
	);
} else {
	echo '<span class="bpafb-tb-prev-next-link bpafb-tb-prev-next-disabled"></span>';
}

if ($bpafb_next_post) {
	printf(
		'<a href="%1$s" class="bpafb-tb-prev-next-link bpafb-tb-next-link"><span class="bpafb-tb-prev-next-text"><span class="bpafb-tb-prev-next-label">%2$s</span><span class="bpafb-tb-prev-next-title">%3$s</span></span>%4$s</a>',
		esc_url(get_permalink($bpafb_next_post)),
		esc_html($bpafb_next_label),
		esc_html(get_the_title($bpafb_next_post)),
		Bpafb_Template_Block_Render::icon_html($bpafb_next_icon) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
} else {
	echo '<span class="bpafb-tb-prev-next-link bpafb-tb-prev-next-disabled"></span>';
}

echo '</div>';
