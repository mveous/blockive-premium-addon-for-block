import { registerBlockType, getBlockType } from '@wordpress/blocks';
import { __, sprintf } from '@wordpress/i18n';
import { createTeaserEdit } from './teaser-edit';
import { withProBadge } from './icon';

/**
 * Registers a locked "(Pro)" teaser block for each entry, under the same
 * name as the real Pro block, so content made with a teaser keeps working
 * once Pro is turned on.
 *
 * Only runs when the free plugin asks for it (window.bpafbLockedBlocks,
 * printed by Bpafb_Locked_Blocks). This file is also copied into Pro by
 * bin/sync-shared-source.js, where the real blocks exist and no teaser may
 * take their names. Names already registered, on the server or in the
 * editor, are skipped for the same reason.
 *
 * @param {Array<{slug: string, title: string, icon: string}>} blocks               Teasers to register.
 * @param {Object}                                             options
 * @param {string}                                             options.prefix       Block name prefix.
 * @param {string}                                             options.category     Inserter category.
 * @param {string}                                             options.instructions Placeholder text.
 */
export function registerTeasers( blocks, { prefix, category, instructions } ) {
	const settings = window.bpafbLockedBlocks;
	if ( ! settings ) {
		return;
	}
	const registered = settings.registered || [];

	blocks.forEach( ( { slug, title, icon } ) => {
		const name = prefix + slug;
		if ( registered.includes( name ) || getBlockType( name ) ) {
			return;
		}
		registerBlockType( name, {
			apiVersion: 3,
			title,
			category,
			icon: withProBadge( icon ),
			description: sprintf(
				/* translators: %s: block title, e.g. "Product Price". */
				__(
					'%s - available in Blockive Pro.',
					'blockive-premium-addon-for-block'
				),
				title
			),
			keywords: [ __( 'pro', 'blockive-premium-addon-for-block' ) ],
			supports: {
				html: false,
				className: false,
				customClassName: false,
				reusable: false,
			},
			edit: createTeaserEdit( title, instructions ),
			save: () => null,
		} );
	} );
}
