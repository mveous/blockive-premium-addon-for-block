import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';

/**
 * Wraps a single control (typically one breakpoint's value inside
 * `ResponsiveControls`) with a small reset button that only appears once
 * the value has actually been overridden away from what it would otherwise
 * inherit -- Events Loop Builder's "ghosted inherited value" pattern.
 *
 * The caller owns the actual attribute reads/writes; this is just the
 * reset-affordance chrome around it.
 *
 * @param {Object}   props
 * @param {boolean}  props.isOverridden Whether this breakpoint has its own value set.
 * @param {Function} props.onReset      Clears the override so it inherits again.
 * @param {Object}   props.children     The control itself.
 */
export default function ControlRow( { isOverridden, onReset, children } ) {
	return (
		<div className="bpafb-control-row">
			<div className="bpafb-control-row__control">{ children }</div>
			{ isOverridden && (
				<Button
					className="bpafb-control-row__reset"
					icon="undo"
					label={ __( 'Reset to inherited value', 'blockive-premium-addon-for-block' ) }
					onClick={ onReset }
					size="small"
				/>
			) }
		</div>
	);
}
