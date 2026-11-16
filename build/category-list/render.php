<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render category-list block.
 *
 * @param array    $attributes The block attributes.
 * @param string   $content    The block content.
 * @param WP_Block $block      The block instance.
 */

$bpafb_showCount = isset($attributes['showCount']) ? $attributes['showCount'] : true;
$bpafb_showDescription = isset($attributes['showDescription']) ? $attributes['showDescription'] : false;
$bpafb_hideEmpty = isset($attributes['hideEmpty']) ? $attributes['hideEmpty'] : true;
$bpafb_limit = isset($attributes['limit']) ? $attributes['limit'] : 10;
$bpafb_orderBy = isset($attributes['orderBy']) ? $attributes['orderBy'] : 'name';
$bpafb_order = isset($attributes['order']) ? $attributes['order'] : 'asc';
$bpafb_excludeTerms = isset($attributes['excludeTerms']) ? $attributes['excludeTerms'] : '';
$bpafb_layoutType = isset($attributes['layoutType']) ? $attributes['layoutType'] : 'vertical';
$bpafb_showHierarchy = isset($attributes['showHierarchy']) ? $attributes['showHierarchy'] : false;
$bpafb_gap = isset($attributes['gap']) ? $attributes['gap'] : 20;
$bpafb_enableLink = isset($attributes['enableLink']) ? $attributes['enableLink'] : true;
$bpafb_itemBgColor = isset($attributes['itemBgColor']) ? $attributes['itemBgColor'] : '';
$bpafb_itemBorderColor = isset($attributes['itemBorderColor']) ? $attributes['itemBorderColor'] : '';
$bpafb_itemBorderWidth = isset($attributes['itemBorderWidth']) ? $attributes['itemBorderWidth'] : 0;
$bpafb_itemBorderRadius = isset($attributes['itemBorderRadius']) ? $attributes['itemBorderRadius'] : 0;
$bpafb_columns = isset($attributes['columns']) ? $attributes['columns'] : 3;
$bpafb_itemPadding = isset($attributes['itemPadding']) ? $attributes['itemPadding'] : 10;
$bpafb_textAlign = isset($attributes['textAlign']) ? $attributes['textAlign'] : 'left';
$bpafb_enableBoxShadow = isset($attributes['enableBoxShadow']) ? $attributes['enableBoxShadow'] : false;
$bpafb_removeChildBorder = isset($attributes['removeChildBorder']) ? $attributes['removeChildBorder'] : false;
$bpafb_taxonomy = isset($attributes['taxonomy']) ? $attributes['taxonomy'] : 'category';

$bpafb_item_style = '';
if ($bpafb_itemBgColor) {
	$bpafb_item_style .= 'background-color: ' . esc_attr($bpafb_itemBgColor) . '; ';
}
if ($bpafb_itemBorderColor) {
	$bpafb_item_style .= 'border-color: ' . esc_attr($bpafb_itemBorderColor) . '; ';
}
if ($bpafb_itemBorderWidth > 0) {
	$bpafb_item_style .= 'border-width: ' . esc_attr($bpafb_itemBorderWidth) . 'px; border-style: solid; ';
}
if ($bpafb_itemBorderRadius > 0) {
	$bpafb_item_style .= 'border-radius: ' . esc_attr($bpafb_itemBorderRadius) . 'px; ';
}
$bpafb_item_style .= 'padding: ' . esc_attr($bpafb_itemPadding) . 'px; ';
$bpafb_item_style .= 'text-align: ' . esc_attr($bpafb_textAlign) . '; ';
if ($bpafb_enableBoxShadow) {
	$bpafb_item_style .= 'box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); ';
}

$bpafb_grid_style = 'gap: ' . esc_attr($bpafb_gap) . 'px;';
if ($bpafb_layoutType === 'horizontal' && $bpafb_columns) {
	$bpafb_grid_style .= ' grid-template-columns: repeat(' . esc_attr($bpafb_columns) . ', 1fr);';
}

$bpafb_exclude_ids = !empty($bpafb_excludeTerms) ? array_map('intval', array_filter(array_map('trim', explode(',', $bpafb_excludeTerms)))) : array();

// Allowlisted against exactly what the block's own Order By/Order
// Direction SelectControls offer - defense in depth alongside
// get_terms()'s own orderby/order validation, so an unexpected value
// here can't reach the term query args at all.
$bpafb_args = array(
	'taxonomy' => $bpafb_taxonomy,
	'hide_empty' => $bpafb_hideEmpty,
	'number' => 0, // Fetch all to filter in PHP
	'orderby' => in_array($bpafb_orderBy, ['id', 'count'], true) ? $bpafb_orderBy : 'name',
	'order' => strtoupper($bpafb_order) === 'DESC' ? 'DESC' : 'ASC',
);

$bpafb_raw_categories = get_terms($bpafb_args);
$bpafb_categories = array();

if (!is_wp_error($bpafb_raw_categories)) {
	foreach ($bpafb_raw_categories as $bpafb_cat) {
		if (!empty($bpafb_exclude_ids) && in_array($bpafb_cat->term_id, $bpafb_exclude_ids, true)) {
			continue;
		}
		$bpafb_categories[] = $bpafb_cat;
	}
	if (!$bpafb_showHierarchy && $bpafb_limit > 0) {
		$bpafb_categories = array_slice($bpafb_categories, 0, $bpafb_limit);
	}
} else {
	$bpafb_categories = $bpafb_raw_categories;
}

if (!is_wp_error($bpafb_categories) && $bpafb_showHierarchy) {
	$bpafb_map = array();
	$bpafb_tree = array();
	foreach ($bpafb_categories as $bpafb_cat) {
		$bpafb_cat->children = array();
		$bpafb_map[$bpafb_cat->term_id] = $bpafb_cat;
	}
	foreach ($bpafb_categories as $bpafb_cat) {
		if ($bpafb_cat->parent && isset($bpafb_map[$bpafb_cat->parent])) {
			$bpafb_map[$bpafb_cat->parent]->children[] = $bpafb_map[$bpafb_cat->term_id];
		} else {
			$bpafb_tree[] = $bpafb_map[$bpafb_cat->term_id];
		}
	}
	// Limit applies to top-level nodes only, after the hierarchy is built, so a
	// retained top-level category always keeps its complete children intact.
	if ($bpafb_limit > 0) {
		$bpafb_tree = array_slice($bpafb_tree, 0, $bpafb_limit);
	}
	$bpafb_categories = $bpafb_tree;
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'bpafb-category-list-wrapper bpafb-layout-' . esc_attr($bpafb_layoutType),
	)
);

$bpafb_render_category_item = function ($bpafb_category, $bpafb_depth = 0) use (&$bpafb_render_category_item, $bpafb_showCount, $bpafb_showDescription, $bpafb_layoutType, $bpafb_enableLink, $bpafb_item_style, $bpafb_removeChildBorder) {
	$bpafb_current_item_style = $bpafb_item_style;
	if ($bpafb_depth > 0 && $bpafb_removeChildBorder) {
		$bpafb_current_item_style .= 'border-width: 0px; border-style: none; ';
	}
	ob_start();
	?>
	<div class="bpafb-category-item bpafb-depth-<?php echo esc_attr($bpafb_depth); ?>"
		style="<?php echo esc_attr($bpafb_current_item_style); ?>">
		<h3 class="bpafb-category-name">
			<?php if ($bpafb_enableLink): ?>
				<a href="<?php echo esc_url(get_term_link($bpafb_category)); ?>">
					<?php echo esc_html($bpafb_category->name); ?>
				</a>
			<?php else: ?>
				<span><?php echo esc_html($bpafb_category->name); ?></span>
			<?php endif; ?>
			<?php if ($bpafb_showCount): ?>
				<span class="bpafb-category-count"> (<?php echo esc_html($bpafb_category->count); ?>)</span>
			<?php endif; ?>
		</h3>
		<?php if ($bpafb_showDescription && !empty($bpafb_category->description) && $bpafb_layoutType !== 'horizontal'): ?>
			<p class="bpafb-category-description"><?php echo esc_html($bpafb_category->description); ?></p>
		<?php endif; ?>
		<?php if (!empty($bpafb_category->children)): ?>
			<div class="bpafb-category-children">
				<?php foreach ($bpafb_category->children as $bpafb_child) {
					echo $bpafb_render_category_item($bpafb_child, $bpafb_depth + 1); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} ?>
			</div>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
};
?>
<div <?php
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $bpafb_wrapper_attributes;
?>>
	<?php if (!empty($bpafb_categories) && !is_wp_error($bpafb_categories)): ?>
		<div class="bpafb-category-grid" style="<?php echo esc_attr($bpafb_grid_style); ?>">
			<?php foreach ($bpafb_categories as $bpafb_category): ?>
				<?php echo $bpafb_render_category_item($bpafb_category); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php endforeach; ?>
		</div>
	<?php else:
		$bpafb_tax_obj = get_taxonomy($bpafb_taxonomy);
		$bpafb_tax_label = $bpafb_tax_obj ? strtolower($bpafb_tax_obj->labels->singular_name) : 'category';
		?>
		<p>
			<?php
			/* translators: %s: Taxonomy label */
			printf(esc_html__('No %s found.', 'blockive-premium-addon-for-block'), esc_html($bpafb_tax_label));
			?>
		</p>
	<?php endif; ?>
</div>