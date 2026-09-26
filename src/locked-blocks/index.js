/**
 * Registers a locked "(Pro)" teaser for each regular block that only
 * Blockive Pro has, in the Blockive Widgets inserter category, the same
 * way the Template Builder shows its Pro-only Template Blocks (see
 * ../template-blocks/pro-teasers). Loaded in every block editor by
 * Bpafb_Locked_Blocks.
 */
import { __ } from '@wordpress/i18n';
import { LOCKED_BLOCKS } from './block-list';
import { registerTeasers } from '../template-blocks/pro-teasers/register';

registerTeasers( LOCKED_BLOCKS, {
	prefix: 'blockive-premium-addon-for-block/',
	category: 'bpafb-widgets',
	instructions: __(
		'This block is part of Blockive Pro and is not available in the free version.',
		'blockive-premium-addon-for-block'
	),
} );
