<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Render function for the Post Title Template Block.
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content (unused, dynamic block).
 * @var WP_Block $block      Block instance.
 */

Bpafb_Template_Block_Render::render_title_block($block, $attributes, 'bpafb-tb-post-title');
