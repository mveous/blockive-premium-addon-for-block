import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import { Dashicon } from '@wordpress/components';

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

/**
 * Compact box-model (Top / Right / Bottom / Left) control inspired by
 * Events Loop Builder (.elb-box).
 *
 * Renders all 4 sides in a single compact horizontal grid with an
 * interactive Link / Unlink toggle and unit selector, saving over 70% of
 * the vertical space of 4 stacked sliders.
 *
 * @param {Object}   props
 * @param {string}   [props.label]        Section title, e.g. "Padding".
 * @param {Object}   [props.value]        { top, right, bottom, left }
 * @param {Function} props.onChange       Receives updated { top, right, bottom, left }
 * @param {string}   [props.unit]         Current unit, e.g. "px".
 * @param {Function} [props.onUnitChange] Receives new unit string.
 */
export default function SpacingControls( { label, value = {}, onChange, unit, onUnitChange } ) {
	const topVal = value?.top;
	const rightVal = value?.right;
	const bottomVal = value?.bottom;
	const leftVal = value?.left;

	// Automatically start linked if all defined sides are identical.
	const [ isLinked, setIsLinked ] = useState( () => {
		const defined = [ topVal, rightVal, bottomVal, leftVal ].filter( ( v ) => v !== undefined && v !== '' );
		if ( defined.length <= 1 ) {
			return true;
		}
		return defined.every( ( v ) => v === defined[ 0 ] );
	} );

	const handleSideChange = ( side, rawVal ) => {
		const parsed = rawVal === '' ? undefined : parseFloat( rawVal );
		const nextVal = Number.isNaN( parsed ) ? undefined : parsed;

		if ( isLinked ) {
			onChange( {
				top: nextVal,
				right: nextVal,
				bottom: nextVal,
				left: nextVal,
			} );
		} else {
			onChange( {
				...value,
				[ side ]: nextVal,
			} );
		}
	};

	const linkLabel = isLinked
		? __( 'Unlink sides', 'blockive-premium-addon-for-block' )
		: __( 'Link sides', 'blockive-premium-addon-for-block' );

	return (
		<div className="bpafb-spacing-controls">
			{ ( label || onUnitChange ) && (
				<div className="bpafb-spacing-controls__header">
					{ label && <span className="bpafb-spacing-controls__label">{ label }</span> }
					<div className="bpafb-spacing-controls__actions">
						<button
							type="button"
							className={ `bpafb-spacing-controls__link-btn${ isLinked ? ' is-linked' : '' }` }
							onClick={ () => setIsLinked( ! isLinked ) }
							title={ linkLabel }
							aria-label={ linkLabel }
							aria-pressed={ isLinked }
						>
							<Dashicon icon={ isLinked ? 'admin-links' : 'editor-unlink' } />
						</button>
						{ onUnitChange && (
							<select
								className="bpafb-spacing-controls__unit-select"
								value={ unit || 'px' }
								onChange={ ( e ) => onUnitChange( e.target.value ) }
								aria-label={ __( 'Unit', 'blockive-premium-addon-for-block' ) }
							>
								{ UNITS.map( ( u ) => (
									<option key={ u.value } value={ u.value }>
										{ u.label }
									</option>
								) ) }
							</select>
						) }
					</div>
				</div>
			) }

			<div className="bpafb-spacing-controls__inputs">
				{ SIDES.map( ( side ) => {
					const sideVal = value?.[ side ];
					const displayVal = sideVal !== undefined && sideVal !== null ? sideVal : '';

					return (
						<label key={ side } className="bpafb-spacing-controls__field" title={ SIDE_LABELS[ side ] }>
							<input
								type="number"
								className="bpafb-spacing-controls__input"
								value={ displayVal }
								placeholder="0"
								onChange={ ( e ) => handleSideChange( side, e.target.value ) }
							/>
							<span className="bpafb-spacing-controls__side">{ SIDE_LABELS[ side ] }</span>
						</label>
					);
				} ) }
			</div>
		</div>
	);
}
