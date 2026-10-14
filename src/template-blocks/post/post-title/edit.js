import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	BlockControls,
	AlignmentControl,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import ColorStateControls from '../../../components/color-state-controls';
import usePreviewContext from '../../shared/use-preview-context';

const TAG_OPTIONS = [
	{ label: 'H1', value: 'h1' },
	{ label: 'H2', value: 'h2' },
	{ label: 'H3', value: 'h3' },
	{ label: 'H4', value: 'h4' },
	{ label: 'H5', value: 'h5' },
	{ label: 'H6', value: 'h6' },
	{ label: 'Div', value: 'div' },
	{ label: 'Span', value: 'span' },
];

export default function Edit( { attributes, setAttributes } ) {
	const { tagName, textAlign, isLink, linkTarget, textColor, textHoverColor } = attributes;

	const { record, isResolving } = usePreviewContext();
	const previewTitle = record?.title?.rendered
		? record.title.rendered.replace( /<[^>]+>/g, '' )
		: null;

	const TagName = tagName || 'h2';

	const blockProps = useBlockProps( {
		className: 'bpafb-tb-post-title',
		style: {
			textAlign: textAlign || undefined,
			color: textColor || undefined,
		},
	} );

	return (
		<>
			<BlockControls>
				<AlignmentControl
					value={ textAlign }
					onChange={ ( value ) => setAttributes( { textAlign: value } ) }
				/>
			</BlockControls>

			<InspectorTabs
				general={
					<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<SelectControl
							label={ __( 'HTML Tag', 'blockive-premium-addon-for-block' ) }
							value={ TagName }
							options={ TAG_OPTIONS }
							onChange={ ( value ) => setAttributes( { tagName: value } ) }
						/>
						<ToggleControl
							label={ __( 'Link to Post', 'blockive-premium-addon-for-block' ) }
							checked={ !! isLink }
							onChange={ ( value ) => setAttributes( { isLink: value } ) }
						/>
						{ isLink && (
							<ToggleControl
								label={ __( 'Open in New Tab', 'blockive-premium-addon-for-block' ) }
								checked={ linkTarget === '_blank' }
								onChange={ ( value ) => setAttributes( { linkTarget: value ? '_blank' : '_self' } ) }
							/>
						) }
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<ColorStateControls
							normal={ [
								{
									label: __( 'Text Color', 'blockive-premium-addon-for-block' ),
									value: textColor,
									onChange: ( value ) => setAttributes( { textColor: value } ),
								},
							] }
							hover={ [
								{
									label: __( 'Text Color', 'blockive-premium-addon-for-block' ),
									value: textHoverColor,
									onChange: ( value ) => setAttributes( { textHoverColor: value } ),
								},
							] }
						/>
						<p className="bpafb-help-text">
							{ __( 'Font, size, weight and other typography options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<TagName { ...blockProps }>
				{ isResolving && ! previewTitle
					? __( 'Loading…', 'blockive-premium-addon-for-block' )
					: previewTitle || __( 'Sample Post Title', 'blockive-premium-addon-for-block' ) }
			</TagName>
		</>
	);
}
