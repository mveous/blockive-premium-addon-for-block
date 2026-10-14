import { BaseControl, Button, ButtonGroup } from '@wordpress/components';

/**
 * A pill-style switcher for a small, fixed set of choices (2-4 options),
 * matching Events Loop Builder's segmented controls (Asc/Desc, Grid/List,
 * pagination type, and so on). Drop-in alternative to `SelectControl` for
 * the same small-enum use case -- same `value`/`options`/`onChange` shape.
 *
 * @param {Object}                               props
 * @param {string}                               [props.label]
 * @param {string|number}                        props.value
 * @param {Array<{label: string, value: string}>} props.options
 * @param {Function}                              props.onChange
 */
export default function SegmentedControl( { label, value, options, onChange } ) {
	const control = (
		<ButtonGroup className="bpafb-segmented-control">
			{ options.map( ( option ) => (
				<Button
					key={ option.value }
					isPressed={ value === option.value }
					onClick={ () => onChange( option.value ) }
					className="bpafb-segmented-control__option"
				>
					{ option.label }
				</Button>
			) ) }
		</ButtonGroup>
	);

	if ( ! label ) {
		return control;
	}

	return <BaseControl label={ label }>{ control }</BaseControl>;
}
