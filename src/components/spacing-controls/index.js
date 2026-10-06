import { __ } from '@wordpress/i18n';
import { RangeControl, SelectControl } from '@wordpress/components';

const SIDES = [ 'top', 'right', 'bottom', 'left' ];
const SIDE_LABELS = {
	top: __( 'Top', 'blockive-premium-addon-for-block' ),
	right: __( 'Right', 'blockive-premium-addon-for-block' ),
	bottom: __( 'Bottom', 'blockive-premium-addon-for-block' ),
	left: __( 'Left', 'blockive-premium-addon-for-block' ),
};

const UNITS = [
	{ label: 'px', value: 'px' },
	{ label: '%', value: '%' },
	{ label: 'em', value: 'em' },
	{ label: 'rem', value: 'rem' },
];

// Sensible slider ceilings per unit - the px max a caller passes in (via
// `max`) rarely makes sense once the same value means "%" or "em".
const UNIT_MAX = { '%': 100, em: 20, rem: 20 };

/**
 * Reusable box-model (Top/Right/Bottom/Left) control for Padding, Margin,
 * Gap, Icon Spacing, etc.
 *
 * value: { top, right, bottom, left }
 * onChange( { top, right, bottom, left } )
 *
 * Pass `unit` + `onUnitChange` to also show a px/%/em/rem unit picker next
 * to the label (one unit for the whole group, same as Max Width). Callers
 * that omit them keep the plain, unit-less control.
 */
export default function SpacingControls( { label, value = {}, onChange, min = -100, max = 200, unit, onUnitChange } ) {
	const effectiveMax = unit && UNIT_MAX[ unit ] ? UNIT_MAX[ unit ] : max;

	return (
		<div className="bpafb-spacing-controls">
			{ ( label || onUnitChange ) && (
				<div className="bpafb-spacing-controls__header">
					{ label && <p className="bpafb-spacing-controls__label">{ label }</p> }
					{ onUnitChange && (
						<SelectControl
							className="bpafb-spacing-controls__unit"
							label={ __( 'Unit', 'blockive-premium-addon-for-block' ) }
							hideLabelFromVision
							value={ unit || 'px' }
							options={ UNITS }
							onChange={ onUnitChange }
						/>
					) }
				</div>
			) }
			<div className="bpafb-spacing-controls__grid">
				{ SIDES.map( ( side ) => (
					<RangeControl
						key={ side }
						label={ SIDE_LABELS[ side ] }
						value={ value[ side ] }
						onChange={ ( val ) => onChange( { ...value, [ side ]: val } ) }
						min={ min }
						max={ effectiveMax }
					/>
				) ) }
			</div>
		</div>
	);
}
