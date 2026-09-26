/**
 * Not named style.css: wp-scripts puts a style.css imported by several
 * entries into only one of them, and both the Template Blocks and the
 * Locked Blocks scripts need this.
 */
import './icon.css';

/**
 * Overlays a small lock badge on a Dashicon, marking a block as Pro-only
 * in the inserter grid.
 *
 * @param {string} dashicon Dashicon slug (without the "dashicons-" prefix).
 * @return {Element} Icon element for the block's `icon` setting.
 */
export function withProBadge( dashicon ) {
	return (
		<span className="bpafb-pro-teaser-icon">
			<span className={ `dashicons dashicons-${ dashicon }` } />
			<span
				className="dashicons dashicons-lock bpafb-pro-teaser-icon__badge"
				aria-hidden="true"
			/>
		</span>
	);
}
