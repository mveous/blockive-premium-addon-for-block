<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Reading Time Template Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);

$bpafb_wpm = isset($attributes['wpm']) && (int) $attributes['wpm'] > 0 ? (int) $attributes['wpm'] : 200;
$bpafb_icon = isset($attributes['icon']) ? $attributes['icon'] : 'fa-regular fa-clock';
$bpafb_prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
$bpafb_suffix = isset($attributes['suffix']) ? $attributes['suffix'] : ' min read';

$bpafb_words = 0;
if ($bpafb_post_id) {
	$bpafb_content = get_post_field('post_content', $bpafb_post_id);
	$bpafb_words = str_word_count(wp_strip_all_tags(strip_shortcodes($bpafb_content)));
}
// Only floor to a minimum of 1 minute when a post actually resolved -
// otherwise (e.g. no post context available) this shows "0", matching the
// Comments Count block's "0 Comments" convention for the same situation,
// rather than a misleadingly non-zero "1 min read".
$bpafb_minutes = $bpafb_post_id ? max(1, (int) ceil($bpafb_words / $bpafb_wpm)) : 0;

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'bpafb-tb-reading-time',
]);

$bpafb_inner = Bpafb_Template_Block_Render::icon_html($bpafb_icon)
	. esc_html($bpafb_prefix)
	. esc_html((string) $bpafb_minutes)
	. esc_html($bpafb_suffix);

printf(
	'<span %1$s>%2$s</span>',
	$bpafb_wrapper_attributes, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	$bpafb_inner // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
);
