import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, BaseControl, ColorPalette } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import usePreviewContext from '../../shared/use-preview-context';

const SAMPLE_TAGS = [
	{ id: 'sample-1', name: __( 'News', 'blockive-premium-addon-for-block' ) },
	{ id: 'sample-2', name: __( 'Design', 'blockive-premium-addon-for-block' ) },
	{ id: 'sample-3', name: __( 'Tips', 'blockive-premium-addon-for-block' ) },
];

export default function Edit( { attributes, setAttributes } ) {
	const { separator, badgeStyle, linkHoverColor } = attributes;

	const { record, isResolving } = usePreviewContext();

	const embeddedTerms = record?._embedded?.[ 'wp:term' ] || [];
	const previewTags = embeddedTerms
		.flat()
		.filter( ( term ) => term && term.taxonomy === 'post_tag' );

	const tags = previewTags.length ? previewTags : ( record ? [] : SAMPLE_TAGS );

	const blockProps = useBlockProps( {
		className: `bpafb-tb-tags${ badgeStyle ? ' bpafb-tags-badge' : '' }`,
	} );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<TextControl
							label={ __( 'Separator', 'blockive-premium-addon-for-block' ) }
							value={ separator }
							onChange={ ( value ) => setAttributes( { separator: value } ) }
							disabled={ !! badgeStyle }
							help={ badgeStyle ? __( 'Not used in Badge Style.', 'blockive-premium-addon-for-block' ) : undefined }
						/>
						<ToggleControl
							label={ __( 'Badge Style', 'blockive-premium-addon-for-block' ) }
							checked={ !! badgeStyle }
							onChange={ ( value ) => setAttributes( { badgeStyle: value } ) }
						/>
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<BaseControl label={ __( 'Link Hover Color', 'blockive-premium-addon-for-block' ) }>
							<ColorPalette
								value={ linkHoverColor }
								onChange={ ( value ) => setAttributes( { linkHoverColor: value } ) }
							/>
						</BaseControl>
						<p className="bpafb-help-text">
							{ __( 'Text, background and typography options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<div { ...blockProps }>
				{ isResolving && ! record ? (
					__( 'Loading…', 'blockive-premium-addon-for-block' )
				) : tags.length ? (
					tags.map( ( tag, index ) => (
						<span className="bpafb-tb-tag-item" key={ tag.id }>
							{ ! badgeStyle && index > 0 && separator && (
								<span className="bpafb-tb-tag-sep">{ separator }</span>
							) }
							<a
								href="#tags-preview"
								className={ badgeStyle ? 'bpafb-tb-tag-badge' : 'bpafb-tb-tag-link' }
								onClick={ ( event ) => event.preventDefault() }
							>
								{ tag.name }
							</a>
						</span>
					) )
				) : (
					<span className="bpafb-tb-tags-placeholder">
						{ __( 'No tags', 'blockive-premium-addon-for-block' ) }
					</span>
				) }
			</div>
		</>
	);
}
