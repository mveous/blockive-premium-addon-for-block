import { Children, cloneElement, isValidElement, Fragment, useState } from '@wordpress/element';
import { PanelBody } from '@wordpress/components';

/**
 * Flattens nested `<>...</>` Fragments down to their actual leaf elements.
 * Blocks commonly build their `general`/`style` content (and the shared
 * Advanced sections build theirs) as a single top-level Fragment wrapping
 * several `PanelBody`s -- `Children.toArray` alone does NOT unwrap an
 * explicit Fragment element into its own children, so without this the
 * accordion below would only ever see one opaque Fragment per block/section
 * instead of each individual panel.
 */
function flattenChildren( children ) {
	const result = [];
	Children.forEach( children, ( child ) => {
		if ( ! isValidElement( child ) ) {
			return;
		}
		if ( child.type === Fragment ) {
			result.push( ...flattenChildren( child.props.children ) );
			return;
		}
		result.push( child );
	} );
	return result;
}

/**
 * Coordinates its `PanelBody` descendants (including ones nested inside
 * Fragments) so only one is open at a time, matching Events Loop Builder's
 * single-open accordion feel. Non-`PanelBody` elements (help text, notices,
 * etc.) pass through untouched.
 *
 * Blocks don't need to change how they build their panel list -- this just
 * wraps whatever `PanelBody` elements are already there and injects the
 * `opened`/`onToggle` controlled props `PanelBody` already supports. Panel
 * identity is tracked by position (not React `key`, which most callers
 * don't set) since the panel list itself is static per block.
 */
export default function Accordion( { children } ) {
	const items = flattenChildren( children );

	const defaultIndex = ( () => {
		const explicitIndex = items.findIndex( ( item ) => item.type === PanelBody && item.props.initialOpen );
		if ( explicitIndex !== -1 ) {
			return explicitIndex;
		}
		return items.findIndex( ( item ) => item.type === PanelBody );
	} )();

	const [ openIndex, setOpenIndex ] = useState( defaultIndex );

	return items.map( ( item, index ) => {
		if ( item.type !== PanelBody ) {
			return cloneElement( item, { key: item.key ?? index } );
		}
		return cloneElement( item, {
			key: item.key ?? index,
			opened: openIndex === index,
			onToggle: ( isOpen ) => setOpenIndex( isOpen ? index : -1 ),
		} );
	} );
}
