<?php
/**
 * A simple template, used in place of the theme's normal one when
 * Bpafb_Template_Frontend_Render::maybe_swap_events_template() finds a
 * matching single-kind Blockive Template for the current Events Calendar
 * event. It still calls get_header()/get_footer() like a normal theme
 * template does, so the theme's styles, scripts, and menu still show, and
 * any Pro Header/Footer/Popup templates still work. Only the main body of
 * the single event page is replaced.
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
			// This should never run - maybe_swap_events_template() only
			// uses this file after it has already found a match. But we
			// still add this, so the page is never completely blank if
			// something changes elsewhere later.
			the_title('<h1>', '</h1>');
			the_content();
		}
	}
}

get_footer();
