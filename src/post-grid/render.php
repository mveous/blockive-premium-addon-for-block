<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Post Grid block.
 */

$bpafb_columns = isset($attributes['columns']) ? absint($attributes['columns']) : 3;
$bpafb_posts_per_page = isset($attributes['postsPerPage']) ? absint($attributes['postsPerPage']) : 9;
$bpafb_posts_per_page = max(1, min(50, $bpafb_posts_per_page));
// Allowlisted against exactly what the block's own Order By/Order
// SelectControls offer (plus 'id', an older value still handled a few
// lines below for posts saved before this attribute's options changed) -
// defense in depth alongside WP_Query's own orderby/order validation,
// so an unexpected value here can't reach the query args at all.
$bpafb_allowed_orderby = ['date', 'title', 'rand', 'id'];
$bpafb_orderby = isset($attributes['orderBy']) && in_array($attributes['orderBy'], $bpafb_allowed_orderby, true)
	? $attributes['orderBy']
	: 'date';
$bpafb_order = isset($attributes['order']) && in_array($attributes['order'], ['asc', 'desc'], true)
	? $attributes['order']
	: 'desc';
$bpafb_show_image = isset($attributes['showImage']) ? $attributes['showImage'] : true;
$bpafb_show_excerpt = isset($attributes['showExcerpt']) ? $attributes['showExcerpt'] : true;
$bpafb_show_date = isset($attributes['showDate']) ? $attributes['showDate'] : true;
$bpafb_show_author = isset($attributes['showAuthor']) ? $attributes['showAuthor'] : true;
$bpafb_post_type = isset($attributes['postType']) && is_post_type_viewable($attributes['postType']) ? $attributes['postType'] : 'post';
$bpafb_date_format = isset($attributes['dateFormat']) && !empty($attributes['dateFormat']) ? $attributes['dateFormat'] : get_option('date_format');
$bpafb_title_color = isset($attributes['titleColor']) ? $attributes['titleColor'] : '';
$bpafb_date_color = isset($attributes['dateColor']) ? $attributes['dateColor'] : '';
$bpafb_author_color = isset($attributes['authorColor']) ? $attributes['authorColor'] : '';
$bpafb_excerpt_color = isset($attributes['excerptColor']) ? $attributes['excerptColor'] : '';
$bpafb_card_bg_color = isset($attributes['cardBgColor']) ? $attributes['cardBgColor'] : '';
$bpafb_card_br_radius = isset($attributes['cardBorderRadius']) ? absint($attributes['cardBorderRadius']) : 8;
$bpafb_card_bd_color = isset($attributes['cardBorderColor']) ? $attributes['cardBorderColor'] : '';
$bpafb_card_bd_width = isset($attributes['cardBorderWidth']) ? absint($attributes['cardBorderWidth']) : 0;
$bpafb_card_bd_style = isset($attributes['cardBorderStyle']) ? $attributes['cardBorderStyle'] : 'solid';

$bpafb_card_style = '';
if ($bpafb_card_bg_color) {
	$bpafb_card_style .= 'background-color: ' . esc_attr($bpafb_card_bg_color) . ';';
}
if ($bpafb_card_br_radius !== '') {
	$bpafb_card_style .= 'border-radius: ' . esc_attr($bpafb_card_br_radius) . 'px;';
}
if ($bpafb_card_bd_width > 0) {
	$bpafb_card_style .= 'border-width: ' . esc_attr($bpafb_card_bd_width) . 'px;';
	$bpafb_card_style .= 'border-style: ' . esc_attr($bpafb_card_bd_style) . ';';
	if ($bpafb_card_bd_color) {
		$bpafb_card_style .= 'border-color: ' . esc_attr($bpafb_card_bd_color) . ';';
	}
}

$bpafb_title_style = $bpafb_title_color ? 'color: ' . esc_attr($bpafb_title_color) . ';' : '';
$bpafb_date_style = $bpafb_date_color ? 'color: ' . esc_attr($bpafb_date_color) . ';' : '';
$bpafb_author_style = $bpafb_author_color ? 'color: ' . esc_attr($bpafb_author_color) . ';' : '';
$bpafb_excerpt_style = $bpafb_excerpt_color ? 'color: ' . esc_attr($bpafb_excerpt_color) . ';' : '';

$bpafb_wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'bpafb-post-grid-wrapper',
	)
);

$bpafb_query_args = array(
	'post_type' => $bpafb_post_type,
	'posts_per_page' => $bpafb_posts_per_page,
	'orderby' => $bpafb_orderby === 'id' ? 'ID' : $bpafb_orderby,
	'order' => $bpafb_order,
	'post_status' => 'publish',
);

$bpafb_post_query = new WP_Query($bpafb_query_args);

?>
<div <?php
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $bpafb_wrapper_attributes;
?>>
	<?php if ($bpafb_post_query->have_posts()): ?>
		<div class="bpafb-post-grid" style="grid-template-columns: repeat(<?php echo esc_attr($bpafb_columns); ?>, 1fr);">
			<?php while ($bpafb_post_query->have_posts()):
				$bpafb_post_query->the_post(); ?>
				<article class="bpafb-post-card" style="<?php echo esc_attr($bpafb_card_style); ?>">
					<?php if ($bpafb_show_image && has_post_thumbnail()): ?>
						<div class="bpafb-post-image">
							<a href="<?php echo esc_url(get_permalink()); ?>">
								<?php the_post_thumbnail('medium'); ?>
							</a>
						</div>
					<?php elseif ($bpafb_show_image): ?>
						<div class="bpafb-post-image">
							<div style="background-color: #f0f0f0; width: 100%; padding-bottom: 75%;"></div>
						</div>
					<?php endif; ?>

					<div class="bpafb-post-content">
						<?php if ($bpafb_show_date): ?>
							<span class="bpafb-post-date"
								style="<?php echo esc_attr($bpafb_date_style); ?>"><?php echo esc_html(get_the_date($bpafb_date_format)); ?></span>
						<?php endif; ?>

						<h3 class="bpafb-post-title">
							<a href="<?php echo esc_url(get_permalink()); ?>"
								style="<?php echo esc_attr($bpafb_title_style); ?>"><?php the_title(); ?></a>
						</h3>

						<?php if ($bpafb_show_author): ?>
							<span class="bpafb-post-author"
								style="<?php echo esc_attr($bpafb_author_style); ?>"><?php echo esc_html__('By', 'blockive-premium-addon-for-block') . ' ' . esc_html(get_the_author()); ?></span>
						<?php endif; ?>

						<?php if ($bpafb_show_excerpt): ?>
							<div class="bpafb-post-excerpt" style="<?php echo esc_attr($bpafb_excerpt_style); ?>">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	<?php else: ?>
		<?php
		$bpafb_tax_obj = get_post_type_object($bpafb_post_type);
		$bpafb_tax_label = $bpafb_tax_obj ? strtolower($bpafb_tax_obj->labels->singular_name) : 'post';
		?>
		<p>
			<?php
			/* translators: %s: Taxonomy label */
			printf(esc_html__('No %s found.', 'blockive-premium-addon-for-block'), esc_html($bpafb_tax_label));
			?>
		</p>
	<?php endif; ?>
</div>