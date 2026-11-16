import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import ColorStateControls from '../../../components/color-state-controls';
import usePreviewContext from '../../shared/use-preview-context';

const SAMPLE_CATEGORIES = [ __( 'News', 'blockive-premium-addon-for-block' ), __( 'Updates', 'blockive-premium-addon-for-block' ) ];

export default function Edit( { attributes, setAttributes } ) {
	const { separator, badgeStyle, isLink, textColor, textHoverColor } = attributes;

	const { record } = usePreviewContext();
	const embeddedTerms = record?._embedded?.[ 'wp:term' ] || [];
	const categoryTerms = embeddedTerms.flat().filter( ( term ) => term.taxonomy === 'category' );
	const previewCategories = categoryTerms.length ? categoryTerms.map( ( term ) => term.name ) : SAMPLE_CATEGORIES;

	const blockProps = useBlockProps( {
		className: `bpafb-tb-categories${ badgeStyle ? ' bpafb-tb-categories--badges' : '' }`,
		style: { color: textColor || undefined },
	} );

	const renderLabel = ( name ) =>
		isLink ? <span className="bpafb-tb-category-link">{ name }</span> : name;

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<ToggleControl
							label={ __( 'Badge Style', 'blockive-premium-addon-for-block' ) }
							checked={ !! badgeStyle }
							onChange={ ( value ) => setAttributes( { badgeStyle: value } ) }
						/>
						<ToggleControl
							label={ __( 'Link to Category Archive', 'blockive-premium-addon-for-block' ) }
							checked={ !! isLink }
							onChange={ ( value ) => setAttributes( { isLink: value } ) }
						/>
						{ ! badgeStyle && (
							<TextControl
								label={ __( 'Separator', 'blockive-premium-addon-for-block' ) }
								value={ separator }
								onChange={ ( value ) => setAttributes( { separator: value } ) }
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
							{ __( 'Font size, weight and other typography options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<div { ...blockProps }>
				{ previewCategories.map( ( name, index ) => (
					<span className="bpafb-tb-category-item" key={ index }>
						{ index > 0 && ! badgeStyle && separator && (
							<span className="bpafb-tb-category-sep">{ separator }</span>
						) }
						{ renderLabel( name ) }
					</span>
				) ) }
			</div>
		</>
	);
}
