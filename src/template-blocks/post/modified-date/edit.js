import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import usePreviewContext from '../../shared/use-preview-context';
import { formatPreviewDate } from '../../shared/format';

// Static stand-in ISO date used whenever no real preview record is available
// yet, so the Format/Relative Time options still visibly update instead of
// leaving the editor preview blank.
const PLACEHOLDER_DATE = '2026-01-02T14:30:00';

export default function Edit( { attributes, setAttributes } ) {
	const { dateFormat, relative } = attributes;

	const { record } = usePreviewContext();
	const previewDateSource = record?.modified || record?.date || PLACEHOLDER_DATE;
	const previewDateText = formatPreviewDate( previewDateSource, { format: dateFormat, relative } );

	const blockProps = useBlockProps( { className: 'bpafb-tb-modified-date' } );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<TextControl
							label={ __( 'Date Format', 'blockive-premium-addon-for-block' ) }
							value={ dateFormat }
							onChange={ ( value ) => setAttributes( { dateFormat: value } ) }
							help={ __( 'PHP date format string, e.g. F j, Y. Leave empty for the site default.', 'blockive-premium-addon-for-block' ) }
						/>
						<ToggleControl
							label={ __( 'Relative Time', 'blockive-premium-addon-for-block' ) }
							checked={ !! relative }
							onChange={ ( value ) => setAttributes( { relative: value } ) }
							help={ __( 'Show "2 days ago" style relative time instead of a formatted date.', 'blockive-premium-addon-for-block' ) }
						/>
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Style', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<p className="bpafb-help-text">
							{ __( 'Font size and text color options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<span { ...blockProps }>
				<time>{ previewDateText }</time>
			</span>
		</>
	);
}
