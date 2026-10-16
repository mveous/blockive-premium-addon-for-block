/**
 * Wraps a single control row, providing clean spacing and layout for inspector controls.
 *
 * @param {Object} props
 * @param {Object} props.children The control itself.
 */
export default function ControlRow( { children } ) {
	return (
		<div className="bpafb-control-row">
			<div className="bpafb-control-row__control">{ children }</div>
		</div>
	);
}
