import { createSlotFill } from '@wordpress/components';

/**
 * Lets other bundles (e.g. Pro's editor extensions) add panels inside
 * Blockive's own Advanced tab, instead of WordPress listing them loose below
 * the tab bar. Matched by name, so a separate bundle can call
 * `createSlotFill( 'BpafbInspectorAdvancedExtra' ).Fill` itself.
 */
export const { Slot: AdvancedExtraSlot, Fill: AdvancedExtraFill } = createSlotFill( 'BpafbInspectorAdvancedExtra' );
