/**
 * Registers "(Pro)" teaser blocks for the Template Blocks that only Blockive
 * Pro has (WooCommerce, Events, Dynamic Field, and the header, footer, and
 * archive blocks), so they're visible (and clearly marked as Pro) in the
 * Blockive Template inserter.
 *
 * Each teaser is a purely client-side, static block: no block.json, no
 * render.php, no PHP registration. Inserting one just drops in a locked
 * placeholder (see ./teaser-edit); `save` returns null so nothing is ever
 * output on the frontend. See ./register for when teasers are skipped.
 */
import { __ } from '@wordpress/i18n';
import { PRO_TEASER_BLOCKS } from './block-list';
import { registerTeasers } from './register';

registerTeasers( PRO_TEASER_BLOCKS, {
	prefix: 'blockive-premium-addon-for-block/tb-',
	category: 'blockive-template',
	instructions: __(
		'This Template Block is part of Blockive Pro and is not available in the free version yet.',
		'blockive-premium-addon-for-block'
	),
} );
