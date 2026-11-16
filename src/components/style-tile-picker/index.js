/**
 * A grid of clickable preview tiles for choosing between a small set of
 * visual layout/style presets -- Events Loop Builder's style-tile picker,
 * generalized as a shared component. Each option supplies its own small
 * inline SVG preview (cheap, dependency-free, no screenshot assets) via
 * `preview()`; the active tile gets a highlighted ring.
 *
 * @param {Object}                                                   props
 * @param {string}                                                   [props.label]
 * @param {string}                                                   props.value
 * @param {Array<{value: string, label: string, preview: Function}>} props.options
 * @param {Function}                                                 props.onChange
 */
export default function StyleTilePicker( { label, value, options, onChange } ) {
	return (
		<div className="bpafb-style-tile-picker">
			{ label && <p className="bpafb-style-tile-picker__label">{ label }</p> }
			<div className="bpafb-style-tile-picker__grid">
				{ options.map( ( option ) => (
					<button
						type="button"
						key={ option.value }
						className={ `bpafb-style-tile-picker__tile${ value === option.value ? ' is-active' : '' }` }
						onClick={ () => onChange( option.value ) }
						aria-pressed={ value === option.value }
					>
						<span className="bpafb-style-tile-picker__preview">{ option.preview() }</span>
						<span className="bpafb-style-tile-picker__title">{ option.label }</span>
					</button>
				) ) }
			</div>
		</div>
	);
}
