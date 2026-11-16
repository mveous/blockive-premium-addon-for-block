import { __ } from '@wordpress/i18n';
import { BaseControl, Button } from '@wordpress/components';

/**
 * A compact "[-] value [+]" control for small bounded integers (columns,
 * items per page), matching Events Loop Builder's stepper fields. Lighter
 * weight than a `RangeControl` slider for this kind of value.
 *
 * @param {Object}        props
 * @param {string}        [props.label]
 * @param {number}        props.value
 * @param {Function}      props.onChange
 * @param {number}        [props.min]
 * @param {number}        [props.max]
 * @param {number}        [props.step]
 */
export default function StepperControl( { label, value, onChange, min = 0, max = 100, step = 1 } ) {
	const clamp = ( next ) => Math.min( max, Math.max( min, next ) );

	const control = (
		<div className="bpafb-stepper-control">
			<Button
				className="bpafb-stepper-control__btn"
				icon="minus"
				label={ __( 'Decrease', 'blockive-premium-addon-for-block' ) }
				onClick={ () => onChange( clamp( ( value ?? 0 ) - step ) ) }
				disabled={ value <= min }
				size="small"
			/>
			<span className="bpafb-stepper-control__value">{ value }</span>
			<Button
				className="bpafb-stepper-control__btn"
				icon="plus"
				label={ __( 'Increase', 'blockive-premium-addon-for-block' ) }
				onClick={ () => onChange( clamp( ( value ?? 0 ) + step ) ) }
				disabled={ value >= max }
				size="small"
			/>
		</div>
	);

	if ( ! label ) {
		return control;
	}

	return <BaseControl label={ label }>{ control }</BaseControl>;
}
