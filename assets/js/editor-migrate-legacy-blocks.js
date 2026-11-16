/**
 * Turns blocks saved under an old plugin prefix (e.g. "lc-block-widgets/
 * heading") back into the current Blockive block when the editor opens, so
 * they keep their content and settings instead of showing as "missing".
 * Gutenberg keeps the original block markup on the missing-block placeholder;
 * the old name in it is swapped for the current one and parsed again. A block
 * whose current version doesn't exist is left alone.
 */
( function ( data, blocks ) {
	const NAMESPACE = 'blockive-premium-addon-for-block/';
	const prefixes = ( window.bpafbLegacyBlocks && window.bpafbLegacyBlocks.prefixes ) || [];

	function currentName( legacyName ) {
		for ( const prefix of prefixes ) {
			if ( 0 === legacyName.indexOf( prefix ) ) {
				return NAMESPACE + legacyName.slice( prefix.length );
			}
		}
		return null;
	}

	function findLegacy( list, found ) {
		list.forEach( function ( block ) {
			const original = 'core/missing' === block.name && block.attributes && block.attributes.originalName;
			const target = 'string' === typeof original ? currentName( original ) : null;
			if ( target && blocks.getBlockType( target ) ) {
				found.push( { block, original, target } );
			} else if ( block.innerBlocks && block.innerBlocks.length ) {
				findLegacy( block.innerBlocks, found );
			}
		} );
		return found;
	}

	let lastBlocks = null;
	data.subscribe( function () {
		const editor = data.select( 'core/block-editor' );
		if ( ! editor || ! editor.getBlocks ) {
			return;
		}
		const all = editor.getBlocks();
		if ( all === lastBlocks ) {
			return;
		}
		lastBlocks = all;

		findLegacy( all, [] ).forEach( function ( item ) {
			const markup = item.block.attributes.originalContent.split( item.original ).join( item.target );
			const parsed = blocks.parse( markup );
			if ( parsed.length ) {
				data.dispatch( 'core/block-editor' ).replaceBlock( item.block.clientId, parsed );
			}
		} );
	} );
} )( window.wp.data, window.wp.blocks );
