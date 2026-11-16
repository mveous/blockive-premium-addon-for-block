<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Breadcrumbs Template Block.
 *
 * Builds a reasonable default trail (Home > primary taxonomy term, if any >
 * current title, unlinked). This intentionally does not try to replicate a
 * full breadcrumbs plugin (parent pages, nested taxonomy ancestors, etc.).
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

$bpafb_post_id = Bpafb_Template_Block_Render::get_post_id($block);
$bpafb_post_type = Bpafb_Template_Block_Render::get_post_type($block);

$bpafb_separator = isset($attributes['separator']) ? $attributes['separator'] : '/';
$bpafb_show_home_icon = !isset($attributes['showHomeIcon']) || !empty($attributes['showHomeIcon']);
$bpafb_home_icon = isset($attributes['homeIcon']) ? $attributes['homeIcon'] : 'fa-solid fa-house';
$bpafb_text_color = isset($attributes['textColor']) ? $attributes['textColor'] : '';
$bpafb_text_hover_color = Bpafb_Template_Block_Render::sanitize_css_color(
	isset($attributes['textHoverColor']) ? $attributes['textHoverColor'] : ''
);
$bpafb_uid = !empty($attributes['bpafbUid']) ? sanitize_html_class($attributes['bpafbUid']) : '';

// Build the trail: Home > (primary taxonomy term, if any) > current title.
$bpafb_trail = [];

$bpafb_trail[] = [
	'label' => __('Home', 'blockive-premium-addon-for-block'),
	'url'   => home_url('/'),
	'icon'  => $bpafb_show_home_icon ? $bpafb_home_icon : '',
];

if ($bpafb_post_id) {
	$bpafb_term_crumb = null;

	if (is_object_in_taxonomy($bpafb_post_type, 'category')) {
		$bpafb_categories = get_the_category($bpafb_post_id);
		if (!empty($bpafb_categories)) {
			$bpafb_term_crumb = [
				'label' => $bpafb_categories[0]->name,
				'url'   => get_category_link($bpafb_categories[0]),
				'icon'  => '',
			];
		}
	} else {
		$bpafb_taxonomies = get_object_taxonomies($bpafb_post_type, 'objects');
		foreach ($bpafb_taxonomies as $bpafb_taxonomy) {
			if (empty($bpafb_taxonomy->public)) {
				continue;
			}
			$bpafb_terms = get_the_terms($bpafb_post_id, $bpafb_taxonomy->name);
			if (!empty($bpafb_terms) && !is_wp_error($bpafb_terms)) {
				$bpafb_term_link = get_term_link($bpafb_terms[0]);
				$bpafb_term_crumb = [
					'label' => $bpafb_terms[0]->name,
					'url'   => is_wp_error($bpafb_term_link) ? '' : $bpafb_term_link,
					'icon'  => '',
				];
				break;
			}
		}
	}

	if (!$bpafb_term_crumb) {
		$bpafb_post_type_obj = get_post_type_object($bpafb_post_type);
		if ($bpafb_post_type_obj && !empty($bpafb_post_type_obj->has_archive) && $bpafb_post_type !== 'post') {
			$bpafb_archive_link = get_post_type_archive_link($bpafb_post_type);
			if ($bpafb_archive_link) {
				$bpafb_term_crumb = [
					'label' => $bpafb_post_type_obj->labels->name,
					'url'   => $bpafb_archive_link,
					'icon'  => '',
				];
			}
		}
	}

	if ($bpafb_term_crumb) {
		$bpafb_trail[] = $bpafb_term_crumb;
	}

	$bpafb_title = get_the_title($bpafb_post_id);
	$bpafb_trail[] = [
		'label' => $bpafb_title !== '' ? $bpafb_title : __('(no title)', 'blockive-premium-addon-for-block'),
		'url'   => '',
		'icon'  => '',
	];
}

$bpafb_style = $bpafb_text_color ? 'color:' . esc_attr($bpafb_text_color) . ';' : '';

$bpafb_classes = ['bpafb-tb-breadcrumbs'];
if ($bpafb_uid) {
	$bpafb_classes[] = 'bpafb-uid-' . $bpafb_uid;
}

$bpafb_wrapper_attributes = get_block_wrapper_attributes([
	'class' => implode(' ', $bpafb_classes),
	'style' => $bpafb_style,
]);

if ($bpafb_text_hover_color && $bpafb_uid) {
	echo '<style>.bpafb-uid-' . esc_attr($bpafb_uid) . ' a:hover { color:' . esc_attr($bpafb_text_hover_color) . ' !important; }</style>';
}

printf('<nav %s aria-label="%s">', $bpafb_wrapper_attributes, esc_attr__('Breadcrumb', 'blockive-premium-addon-for-block')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

$bpafb_last_index = count($bpafb_trail) - 1;
foreach ($bpafb_trail as $bpafb_index => $bpafb_item) {
	echo '<span class="bpafb-tb-breadcrumb-item">';
	if ($bpafb_index > 0 && $bpafb_separator) {
		echo '<span class="bpafb-tb-breadcrumb-sep">' . esc_html($bpafb_separator) . '</span>';
	}

	$bpafb_icon_html = !empty($bpafb_item['icon']) ? Bpafb_Template_Block_Render::icon_html($bpafb_item['icon']) : '';

	if ($bpafb_index === $bpafb_last_index || empty($bpafb_item['url'])) {
		echo '<span class="bpafb-tb-breadcrumb-current">' . $bpafb_icon_html . esc_html($bpafb_item['label']) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		printf(
			'<a href="%s">%s%s</a>',
			esc_url($bpafb_item['url']),
			$bpafb_icon_html, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			esc_html($bpafb_item['label'])
		);
	}
	echo '</span>';
}

echo '</nav>';
