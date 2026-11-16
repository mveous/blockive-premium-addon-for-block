<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Post Meta Template Block.
 *
 * Item resolution lives in Bpafb_Post_Meta_Items (includes/), not in this
 * file: render.php is `include`-d fresh every time the block renders, so
 * declaring a top-level function here would fatal ("cannot redeclare") the
 * moment this block renders more than once on the same request.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);
$bpafb_items = isset($attributes['items']) && is_array($attributes['items']) ? $attributes['items'] : [];
$bpafb_show_icons = !isset($attributes['showIcons']) || !empty($attributes['showIcons']);

$bpafb_rendered_items = [];
foreach ($bpafb_items as $bpafb_item) {
	if (empty($bpafb_item['enabled'])) {
		continue;
	}
	$bpafb_html = Bpafb_Post_Meta_Items::get_html($bpafb_item['key'], $bpafb_post_id, $bpafb_show_icons);
	if ($bpafb_html !== '') {
		$bpafb_rendered_items[] = $bpafb_html;
	}
}

if (empty($bpafb_rendered_items)) {
	return;
}

$bpafb_separator = isset($attributes['separator']) ? $attributes['separator'] : '•';
$bpafb_link_hover_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['linkHoverColor']) ? $attributes['linkHoverColor'] : ''
);
$bpafb_uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

$bpafb_badge_style = isset($attributes['badgeStyle']) && in_array($attributes['badgeStyle'], ['solid', 'soft', 'outline'], true)
	? $attributes['badgeStyle']
	: 'none';
$bpafb_badge_bg_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['badgeBgColor']) ? $attributes['badgeBgColor'] : ''
);
$bpafb_badge_text_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['badgeTextColor']) ? $attributes['badgeTextColor'] : ''
);

$bpafb_item_classes = 'bpafb-tb-post-meta-item';
$bpafb_item_style = '';
if ('none' !== $bpafb_badge_style) {
	$bpafb_item_classes .= ' bpafb-tb-post-meta-item--badge-' . $bpafb_badge_style;
	$bpafb_item_style_parts = [];
	if ($bpafb_badge_bg_color) {
		$bpafb_item_style_parts[] = '--bpafb-meta-badge-bg:' . $bpafb_badge_bg_color;
	}
	if ($bpafb_badge_text_color) {
		$bpafb_item_style_parts[] = '--bpafb-meta-badge-color:' . $bpafb_badge_text_color;
	}
	if (!empty($bpafb_item_style_parts)) {
		$bpafb_item_style = ' style="' . esc_attr(implode(';', $bpafb_item_style_parts)) . '"';
	}
}

$bpafb_classes = ['bpafb-tb-post-meta'];
if ($bpafb_uid) {
	$bpafb_classes[] = 'bpafb-uid-' . $bpafb_uid;
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_classes),
]);

if ($bpafb_link_hover_color && $bpafb_uid) {
	echo '<style>.bpafb-uid-' . esc_attr($bpafb_uid) . ' a:hover { color:' . esc_attr($bpafb_link_hover_color) . ' !important; }</style>';
}

?>
<div <?php echo $bpafb_wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php foreach ($bpafb_rendered_items as $bpafb_index => $bpafb_html) : ?>
		<?php if ($bpafb_index > 0 && $bpafb_separator) : ?>
			<span class="bpafb-tb-post-meta-sep"><?php echo esc_html($bpafb_separator); ?></span>
		<?php endif; ?>
		<span class="<?php echo esc_attr($bpafb_item_classes); ?>"<?php echo $bpafb_item_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built entirely from sanitize_css_color() above. ?>>
			<?php echo $bpafb_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</span>
	<?php endforeach; ?>
</div>
