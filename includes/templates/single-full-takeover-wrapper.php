<?php
/**
 * Thin template_include replacement used when
 * Bpafb_Template_Frontend_Render::maybe_swap_events_template() resolves a
 * matching single-kind Blockive Template for the current Events Calendar
 * event - see that method's docblock for why a template swap is used here
 * instead of the hook-removal approach setup_woocommerce_template() uses
 * for WooCommerce products.
 *
 * Still calls get_header()/get_footer() like any normal theme template
 * would, so the theme's <head> assets, nav markup, and (if separately
 * matched) any Pro Header/Footer/Popup templates hooked to wp_body_open/
 * wp_footer all render exactly as they would on any other page - only the
 * plugin-owned single-event body markup is replaced.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();

		$bpafb_rendered = Bpafb_Template_Frontend_Render::render_full_takeover_template();

		if ($bpafb_rendered !== '') {
			echo $bpafb_rendered; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			// Should be unreachable - maybe_swap_events_template() only
			// swaps in this file once it has already confirmed a match -
			// but never render a completely blank body if something
			// upstream changes.
			the_title('<h1>', '</h1>');
			the_content();
		}
	}
}

get_footer();
