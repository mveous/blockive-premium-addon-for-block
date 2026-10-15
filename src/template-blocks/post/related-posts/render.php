<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Related Posts Template Block.
 *
 * Server-rendered via WP_Query, mirroring src/post-grid/render.php's
 * query-building pattern.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);
$bpafb_post_type = Bpafb_Template_Block_Render::get_post_type($block);

$bpafb_number_of_posts       = isset($attributes['numberOfPosts']) ? (int) $attributes['numberOfPosts'] : 3;
$bpafb_layout                = isset($attributes['layout']) && $attributes['layout'] === 'slider' ? 'slider' : 'grid';
$bpafb_columns               = isset($attributes['columns']) ? max(1, (int) $attributes['columns']) : 3;
$bpafb_grid_gap              = isset($attributes['gridGap']) ? (int) $attributes['gridGap'] : 24;
$bpafb_slider_columns        = isset($attributes['sliderColumns']) ? max(1, (int) $attributes['sliderColumns']) : 3;
$bpafb_slider_autoplay       = !empty($attributes['sliderAutoplay']);
$bpafb_slider_autoplay_speed = isset($attributes['sliderAutoplaySpeed']) ? (int) $attributes['sliderAutoplaySpeed'] : 3000;
$bpafb_slider_loop           = !empty($attributes['sliderLoop']);
$bpafb_slider_show_arrows    = !isset($attributes['sliderShowArrows']) || !empty($attributes['sliderShowArrows']);
$bpafb_slider_show_dots      = !isset($attributes['sliderShowDots']) || !empty($attributes['sliderShowDots']);
$bpafb_slider_space_between  = isset($attributes['sliderSpaceBetween']) ? (int) $attributes['sliderSpaceBetween'] : 20;
$bpafb_order_by              = isset($attributes['orderBy']) ? $attributes['orderBy'] : 'date';
$bpafb_order                 = isset($attributes['order']) && strtolower($attributes['order']) === 'asc' ? 'ASC' : 'DESC';
$bpafb_same_category         = !isset($attributes['sameCategory']) || !empty($attributes['sameCategory']);
$bpafb_show_image            = !isset($attributes['showImage']) || !empty($attributes['showImage']);
$bpafb_show_date             = !isset($attributes['showDate']) || !empty($attributes['showDate']);
$bpafb_content_type          = isset($attributes['contentType']) ? $attributes['contentType'] : 'limited';
if ($bpafb_content_type === 'excerpt') {
	$bpafb_content_type = 'limited';
}
$bpafb_excerpt_length        = isset($attributes['excerptLength']) ? max(1, (int) $attributes['excerptLength']) : 20;

// Modern Card Styling
$bpafb_card_style            = !empty($attributes['cardStyle']) ? sanitize_html_class($attributes['cardStyle']) : 'modern';
$bpafb_card_bg               = !empty($attributes['cardBgColor']) ? $attributes['cardBgColor'] : '';
$bpafb_card_radius           = isset($attributes['cardBorderRadius']) ? (int) $attributes['cardBorderRadius'] : 16;
$bpafb_card_padding          = isset($attributes['cardPadding']) ? (int) $attributes['cardPadding'] : 18;
$bpafb_card_hover_elev       = !isset($attributes['cardHoverElevation']) || !empty($attributes['cardHoverElevation']);
$bpafb_image_zoom            = !isset($attributes['imageZoom']) || !empty($attributes['imageZoom']);
$bpafb_image_radius          = isset($attributes['imageBorderRadius']) ? (int) $attributes['imageBorderRadius'] : 12;

$bpafb_title_color           = isset($attributes['titleColor']) ? $attributes['titleColor'] : '';
$bpafb_title_hover_color     = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['titleHoverColor']) ? $attributes['titleHoverColor'] : ''
);
$bpafb_title_font_family     = isset($attributes['titleFontFamily']) ? $attributes['titleFontFamily'] : '';
$bpafb_title_font_size       = isset($attributes['titleFontSize']) ? $attributes['titleFontSize'] : null;
$bpafb_allowed_font_size_units = ['px', 'em', 'rem', '%'];
$bpafb_title_font_size_unit  = isset($attributes['titleFontSizeUnit']) && in_array($attributes['titleFontSizeUnit'], $bpafb_allowed_font_size_units, true) ? $attributes['titleFontSizeUnit'] : 'px';
$bpafb_title_font_weight     = isset($attributes['titleFontWeight']) ? $attributes['titleFontWeight'] : '';
$bpafb_title_line_height     = isset($attributes['titleLineHeight']) ? $attributes['titleLineHeight'] : null;
$bpafb_title_letter_spacing  = isset($attributes['titleLetterSpacing']) ? $attributes['titleLetterSpacing'] : null;
$bpafb_allowed_letter_spacing_units = ['px', 'em', 'rem'];
$bpafb_title_letter_spacing_unit = isset($attributes['titleLetterSpacingUnit']) && in_array($attributes['titleLetterSpacingUnit'], $bpafb_allowed_letter_spacing_units, true) ? $attributes['titleLetterSpacingUnit'] : 'px';
$bpafb_title_text_transform  = isset($attributes['titleTextTransform']) ? $attributes['titleTextTransform'] : '';
$bpafb_title_text_decoration = isset($attributes['titleTextDecoration']) ? $attributes['titleTextDecoration'] : '';
$bpafb_date_color            = isset($attributes['dateColor']) ? $attributes['dateColor'] : '';
$bpafb_excerpt_color         = isset($attributes['excerptColor']) ? $attributes['excerptColor'] : '';
$bpafb_uid                   = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

// Resolve relation taxonomy & terms
$bpafb_related_taxonomy = '';
$bpafb_related_term_ids = [];
if ($bpafb_same_category) {
	if ($bpafb_post_id) {
		if (is_object_in_taxonomy($bpafb_post_type, 'category')) {
			$bpafb_related_taxonomy = 'category';
		} else {
			foreach (get_object_taxonomies($bpafb_post_type, 'objects') as $bpafb_tax_obj) {
				if (!empty($bpafb_tax_obj->public)) {
					$bpafb_related_taxonomy = $bpafb_tax_obj->name;
					break;
				}
			}
		}

		if ($bpafb_related_taxonomy) {
			$bpafb_terms = wp_get_post_terms($bpafb_post_id, $bpafb_related_taxonomy, ['fields' => 'ids']);
			if (!is_wp_error($bpafb_terms) && !empty($bpafb_terms)) {
				$bpafb_related_term_ids = $bpafb_terms;
			}
		}
	} elseif (is_category() || is_tax() || is_tag()) {
		$bpafb_queried_obj = get_queried_object();
		if ($bpafb_queried_obj && isset($bpafb_queried_obj->taxonomy, $bpafb_queried_obj->term_id)) {
			$bpafb_related_taxonomy = $bpafb_queried_obj->taxonomy;
			$bpafb_related_term_ids = [(int) $bpafb_queried_obj->term_id];
		}
	}
}

$bpafb_query_args = [
	'post_type'           => $bpafb_post_type,
	'posts_per_page'      => $bpafb_number_of_posts,
	'post_status'         => 'publish',
	'ignore_sticky_posts'  => true,
	'orderby'             => $bpafb_order_by === 'title' ? 'title' : ($bpafb_order_by === 'rand' ? 'rand' : 'date'),
	'order'               => $bpafb_order,
	'no_found_rows'       => true,
];
if ($bpafb_post_id) {
	$bpafb_query_args['post__not_in'] = [$bpafb_post_id]; // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
}
if ($bpafb_related_taxonomy && !empty($bpafb_related_term_ids)) {
	$bpafb_query_args['tax_query'] = [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		[
			'taxonomy' => $bpafb_related_taxonomy,
			'field'    => 'term_id',
			'terms'    => $bpafb_related_term_ids,
		],
	];
}

$bpafb_related_query = new WP_Query($bpafb_query_args);

if (!$bpafb_related_query->have_posts()) {
	return;
}

// Builds one post card's markup
$bpafb_render_card = function ($bpafb_card_post) use (
	$bpafb_show_image,
	$bpafb_show_date,
	$bpafb_content_type,
	$bpafb_excerpt_length
) {
	$bpafb_card_id = $bpafb_card_post->ID;
	$bpafb_permalink = get_permalink($bpafb_card_id);
	ob_start();
	?>
	<article class="bpafb-tb-related-post-card">
		<?php if ($bpafb_show_image && has_post_thumbnail($bpafb_card_id)) : ?>
			<a class="bpafb-tb-related-post-image" href="<?php echo esc_url($bpafb_permalink); ?>">
				<?php echo get_the_post_thumbnail($bpafb_card_id, 'medium_large'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		<?php endif; ?>
		<div class="bpafb-tb-related-post-content">
			<?php if ($bpafb_show_date) : ?>
				<span class="bpafb-tb-related-post-date">
					<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
					<?php echo esc_html(get_the_date('', $bpafb_card_id)); ?>
				</span>
			<?php endif; ?>
			<h3 class="bpafb-tb-related-post-title">
				<a href="<?php echo esc_url($bpafb_permalink); ?>"><?php echo esc_html(get_the_title($bpafb_card_id)); ?></a>
			</h3>
			<?php if ($bpafb_content_type !== 'none') : ?>
				<div class="bpafb-tb-related-post-excerpt">
					<?php
					if ($bpafb_content_type === 'full') {
						$bpafb_full_content = get_the_content(null, false, $bpafb_card_post);
						$bpafb_full_content = apply_filters('the_content', $bpafb_full_content);
						echo wp_kses_post($bpafb_full_content);
					} else {
						$bpafb_excerpt = get_the_excerpt($bpafb_card_id);
						echo esc_html(wp_trim_words($bpafb_excerpt, $bpafb_excerpt_length));
					}
					?>
				</div>
			<?php endif; ?>
		</div>
	</article>
	<?php
	return ob_get_clean();
};

$bpafb_classes = [
	'bpafb-tb-related-posts',
	'bpafb-tb-related-posts-' . $bpafb_layout,
	'bpafb-tb-related-posts--style-' . $bpafb_card_style,
];
if ($bpafb_card_hover_elev) {
	$bpafb_classes[] = 'bpafb-tb-related-posts--hover-elevation';
}
if ($bpafb_image_zoom) {
	$bpafb_classes[] = 'bpafb-tb-related-posts--image-zoom';
}
if ($bpafb_uid) {
	$bpafb_classes[] = 'bpafb-uid-' . $bpafb_uid;
}

$bpafb_styles = [
	'--bpafb-rp-columns:' . esc_attr($bpafb_columns) . ';',
	'--bpafb-rp-gap:' . esc_attr($bpafb_grid_gap) . 'px;',
	'--bpafb-rp-card-radius:' . esc_attr($bpafb_card_radius) . 'px;',
	'--bpafb-rp-card-padding:' . esc_attr($bpafb_card_padding) . 'px;',
	'--bpafb-rp-image-radius:' . esc_attr($bpafb_image_radius) . 'px;',
];
if ($bpafb_card_bg) {
	$bpafb_styles[] = '--bpafb-rp-card-bg:' . esc_attr($bpafb_card_bg) . ';';
}
if ($bpafb_title_color) {
	$bpafb_styles[] = '--bpafb-rp-title-color:' . esc_attr($bpafb_title_color) . ';';
}
if ($bpafb_title_hover_color) {
	$bpafb_styles[] = '--bpafb-rp-title-hover-color:' . esc_attr($bpafb_title_hover_color) . ';';
}
if ($bpafb_title_font_family) {
	$bpafb_styles[] = '--bpafb-rp-title-font-family:' . esc_attr($bpafb_title_font_family) . ';';
}
if ($bpafb_title_font_size !== null) {
	$bpafb_styles[] = '--bpafb-rp-title-font-size:' . (float) $bpafb_title_font_size . esc_attr($bpafb_title_font_size_unit) . ';';
}
if ($bpafb_title_font_weight) {
	$bpafb_styles[] = '--bpafb-rp-title-font-weight:' . esc_attr($bpafb_title_font_weight) . ';';
}
if ($bpafb_title_line_height !== null) {
	$bpafb_styles[] = '--bpafb-rp-title-line-height:' . (float) $bpafb_title_line_height . ';';
}
if ($bpafb_title_letter_spacing !== null) {
	$bpafb_styles[] = '--bpafb-rp-title-letter-spacing:' . (float) $bpafb_title_letter_spacing . esc_attr($bpafb_title_letter_spacing_unit) . ';';
}
if ($bpafb_title_text_transform) {
	$bpafb_styles[] = '--bpafb-rp-title-text-transform:' . esc_attr($bpafb_title_text_transform) . ';';
}
if ($bpafb_title_text_decoration) {
	$bpafb_styles[] = '--bpafb-rp-title-text-decoration:' . esc_attr($bpafb_title_text_decoration) . ';';
}
if ($bpafb_date_color) {
	$bpafb_styles[] = '--bpafb-rp-date-color:' . esc_attr($bpafb_date_color) . ';';
}
if ($bpafb_excerpt_color) {
	$bpafb_styles[] = '--bpafb-rp-excerpt-color:' . esc_attr($bpafb_excerpt_color) . ';';
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_classes),
	'style' => implode(' ', $bpafb_styles),
]);

if ($bpafb_title_hover_color && $bpafb_uid) {
	echo '<style>.bpafb-uid-' . esc_attr($bpafb_uid) . ' .bpafb-tb-related-post-title a:hover { color:' . esc_attr($bpafb_title_hover_color) . ' !important; }</style>';
}

echo '<div ' . $bpafb_wrapper_attributes . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

if ($bpafb_layout === 'slider') {
	?>
	<div
		class="bpafb-tb-related-posts-slider swiper"
		data-slides-per-view="<?php echo esc_attr($bpafb_slider_columns); ?>"
		data-autoplay="<?php echo $bpafb_slider_autoplay ? 'true' : 'false'; ?>"
		data-autoplay-speed="<?php echo esc_attr($bpafb_slider_autoplay_speed); ?>"
		data-loop="<?php echo $bpafb_slider_loop ? 'true' : 'false'; ?>"
		data-space-between="<?php echo esc_attr($bpafb_slider_space_between); ?>"
	>
		<div class="swiper-wrapper">
			<?php foreach ($bpafb_related_query->posts as $bpafb_related_post) : ?>
				<div class="swiper-slide"><?php echo $bpafb_render_card($bpafb_related_post); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<?php endforeach; ?>
		</div>
		<?php if ($bpafb_slider_show_dots) : ?>
			<div class="swiper-pagination"></div>
		<?php endif; ?>
		<?php if ($bpafb_slider_show_arrows) : ?>
			<div class="swiper-button-prev" aria-label="<?php esc_attr_e('Previous Slide', 'blockive-premium-addon-for-block'); ?>">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
			</div>
			<div class="swiper-button-next" aria-label="<?php esc_attr_e('Next Slide', 'blockive-premium-addon-for-block'); ?>">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
			</div>
		<?php endif; ?>
	</div>
	<?php
} else {
	$bpafb_grid_inline_style = sprintf(
		'display: grid; width: 100%%; grid-template-columns: repeat(%d, minmax(0, 1fr)); gap: %dpx;',
		$bpafb_columns,
		$bpafb_grid_gap
	);
	?>
	<div class="bpafb-tb-related-posts-grid" style="<?php echo esc_attr($bpafb_grid_inline_style); ?>">
		<?php foreach ($bpafb_related_query->posts as $bpafb_related_post) : ?>
			<?php echo $bpafb_render_card($bpafb_related_post); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endforeach; ?>
	</div>
	<?php
}

echo '</div>';
