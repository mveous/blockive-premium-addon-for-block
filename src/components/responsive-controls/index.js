import { __ } from '@wordpress/i18n';
import { useState, useCallback } from '@wordpress/element';
import { useSelect, useDispatch } from '@wordpress/data';

const BREAKPOINTS = [
	{ name: 'desktop', label: __( 'Desktop', 'blockive-premium-addon-for-block' ) },
	{ name: 'tablet', label: __( 'Tablet', 'blockive-premium-addon-for-block' ) },
	{ name: 'mobile', label: __( 'Mobile', 'blockive-premium-addon-for-block' ) },
];

/**
 * Reads and controls Gutenberg's editor canvas preview device type.
 *
 * Checks core/editor (modern WP), falling back to core/edit-post or
 * core/edit-site (__experimentalGetPreviewDeviceType).
 */
function useEditorPreviewDevice() {
	const currentDevice = useSelect( ( select ) => {
		const raw =
			select( 'core/editor' )?.getDeviceType?.()
			|| select( 'core/edit-post' )?.__experimentalGetPreviewDeviceType?.()
			|| select( 'core/edit-site' )?.__experimentalGetPreviewDeviceType?.()
			|| 'Desktop';
		const d = String( raw ).toLowerCase();
		return d === 'tablet' ? 'tablet' : d === 'mobile' ? 'mobile' : 'desktop';
	}, [] );

	const editorDispatch = useDispatch( 'core/editor' );
	const postDispatch = useDispatch( 'core/edit-post' );
	const siteDispatch = useDispatch( 'core/edit-site' );

	const setDevice = useCallback(
		( nextDevice ) => {
			const cap =
				nextDevice === 'tablet' ? 'Tablet' : nextDevice === 'mobile' ? 'Mobile' : 'Desktop';
			const fn =
				editorDispatch?.setDeviceType
				|| postDispatch?.__experimentalSetPreviewDeviceType
				|| siteDispatch?.__experimentalSetPreviewDeviceType;
			if ( typeof fn === 'function' ) {
				fn( cap );
			}
		},
		[ editorDispatch, postDispatch, siteDispatch ]
	);

	return [ currentDevice, setDevice ];
}

/**
 * Desktop / Tablet / Mobile switcher. Renders `children(device)` for the
 * currently active breakpoint.
 *
 * Synchronizes with Gutenberg's preview canvas in real time: switching to
 * Tablet or Mobile resizes the editor canvas, and changing Gutenberg's
 * preview toolbar switcher updates this control.
 */
export default function ResponsiveControls( { children } ) {
	const [ editorDevice, setEditorDevice ] = useEditorPreviewDevice();
	const [ localDevice, setLocalDevice ] = useState( 'desktop' );

	const activeDevice = editorDevice || localDevice;

	const handleDeviceChange = ( deviceName ) => {
		setLocalDevice( deviceName );
		setEditorDevice( deviceName );
	};

	return (
		<div className="bpafb-responsive-controls">
			<div
				className="bpafb-responsive-controls__switch"
				role="group"
				aria-label={ __( 'Preview device switcher', 'blockive-premium-addon-for-block' ) }
			>
				{ BREAKPOINTS.map( ( bp ) => (
					<button
						key={ bp.name }
						type="button"
						className={ `bpafb-responsive-controls__btn${ activeDevice === bp.name ? ' is-active' : '' }` }
						onClick={ () => handleDeviceChange( bp.name ) }
						aria-pressed={ activeDevice === bp.name }
					>
						{ bp.label }
					</button>
				) ) }
			</div>
			<div className="bpafb-responsive-controls__panel">{ children( activeDevice ) }</div>
		</div>
	);
}
