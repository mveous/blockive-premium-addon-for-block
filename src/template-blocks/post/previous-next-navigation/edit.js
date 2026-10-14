import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, ToggleControl, BaseControl, ColorPalette } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';

const HOVER_STYLE_OPTIONS = [
	{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
	{ label: __( 'Underline', 'blockive-premium-addon-for-block' ), value: 'underline' },
	{ label: __( 'Slide', 'blockive-premium-addon-for-block' ), value: 'slide' },
];

export default function Edit( { attributes, setAttributes } ) {
	const { prevLabel, nextLabel, prevIcon, nextIcon, hoverStyle, inSameTerm, linkHoverColor } = attributes;

	const blockProps = useBlockProps( {
		className: `bpafb-tb-prev-next-nav bpafb-hover-${ hoverStyle || 'none' }`,
	} );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<TextControl
							label={ __( 'Previous Label', 'blockive-premium-addon-for-block' ) }
							value={ prevLabel }
							onChange={ ( value ) => setAttributes( { prevLabel: value } ) }
						/>
						<TextControl
							label={ __( 'Previous Icon (Font Awesome class)', 'blockive-premium-addon-for-block' ) }
							value={ prevIcon }
							onChange={ ( value ) => setAttributes( { prevIcon: value } ) }
						/>
						<TextControl
							label={ __( 'Next Label', 'blockive-premium-addon-for-block' ) }
							value={ nextLabel }
							onChange={ ( value ) => setAttributes( { nextLabel: value } ) }
						/>
						<TextControl
							label={ __( 'Next Icon (Font Awesome class)', 'blockive-premium-addon-for-block' ) }
							value={ nextIcon }
							onChange={ ( value ) => setAttributes( { nextIcon: value } ) }
						/>
						<ToggleControl
							label={ __( 'Stay in Same Category', 'blockive-premium-addon-for-block' ) }
							checked={ !! inSameTerm }
							onChange={ ( value ) => setAttributes( { inSameTerm: value } ) }
							help={ __( 'Only link to adjacent posts sharing a category with the current post.', 'blockive-premium-addon-for-block' ) }
						/>
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Style', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<SelectControl
							label={ __( 'Hover Style', 'blockive-premium-addon-for-block' ) }
							value={ hoverStyle }
							options={ HOVER_STYLE_OPTIONS }
							onChange={ ( value ) => setAttributes( { hoverStyle: value } ) }
						/>
						<BaseControl label={ __( 'Link Hover Color', 'blockive-premium-addon-for-block' ) }>
							<ColorPalette
								value={ linkHoverColor }
								onChange={ ( value ) => setAttributes( { linkHoverColor: value } ) }
							/>
						</BaseControl>
						<p className="bpafb-help-text">
							{ __( 'Text and typography options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<div { ...blockProps }>
				<a href="#prev-preview" className="bpafb-tb-prev-next-link bpafb-tb-prev-link" onClick={ ( event ) => event.preventDefault() }>
					{ prevIcon && <i className={ prevIcon } /> }
					<span className="bpafb-tb-prev-next-text">
						<span className="bpafb-tb-prev-next-label">{ prevLabel }</span>
						<span className="bpafb-tb-prev-next-title">{ __( 'Sample Previous Post', 'blockive-premium-addon-for-block' ) }</span>
					</span>
				</a>
				<a href="#next-preview" className="bpafb-tb-prev-next-link bpafb-tb-next-link" onClick={ ( event ) => event.preventDefault() }>
					<span className="bpafb-tb-prev-next-text">
						<span className="bpafb-tb-prev-next-label">{ nextLabel }</span>
						<span className="bpafb-tb-prev-next-title">{ __( 'Sample Next Post', 'blockive-premium-addon-for-block' ) }</span>
					</span>
					{ nextIcon && <i className={ nextIcon } /> }
				</a>
			</div>
		</>
	);
}
