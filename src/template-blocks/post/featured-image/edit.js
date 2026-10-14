import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, RangeControl, ToggleControl, BaseControl, ColorPalette } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import BorderControls, { getBorderStyles } from '../../../components/border-controls';
import ShadowControls, { getShadowStyle } from '../../../components/shadow-controls';
import usePreviewContext, { getEmbeddedFeaturedImageUrl } from '../../shared/use-preview-context';

const SIZE_OPTIONS = [
	{ label: __( 'Thumbnail', 'blockive-premium-addon-for-block' ), value: 'thumbnail' },
	{ label: __( 'Medium', 'blockive-premium-addon-for-block' ), value: 'medium' },
	{ label: __( 'Large', 'blockive-premium-addon-for-block' ), value: 'large' },
	{ label: __( 'Full Size', 'blockive-premium-addon-for-block' ), value: 'full' },
];

const ASPECT_OPTIONS = [
	{ label: __( 'Original', 'blockive-premium-addon-for-block' ), value: '' },
	{ label: '1:1', value: '1/1' },
	{ label: '4:3', value: '4/3' },
	{ label: '3:2', value: '3/2' },
	{ label: '16:9', value: '16/9' },
	{ label: '21:9', value: '21/9' },
];

const OBJECT_FIT_OPTIONS = [
	{ label: __( 'Cover', 'blockive-premium-addon-for-block' ), value: 'cover' },
	{ label: __( 'Contain', 'blockive-premium-addon-for-block' ), value: 'contain' },
	{ label: __( 'Fill', 'blockive-premium-addon-for-block' ), value: 'fill' },
];

const HOVER_EFFECT_OPTIONS = [
	{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
	{ label: __( 'Zoom In', 'blockive-premium-addon-for-block' ), value: 'zoom' },
	{ label: __( 'Grayscale to Color', 'blockive-premium-addon-for-block' ), value: 'grayscale' },
	{ label: __( 'Darken', 'blockive-premium-addon-for-block' ), value: 'darken' },
];

export default function Edit( { attributes, setAttributes } ) {
	const {
		imageSize,
		aspectRatio,
		borderRadius,
		objectFit,
		lazyLoad,
		isLink,
		overlayColor,
		hoverEffect,
		borderType,
		borderWidth,
		borderColor,
		shadowEnabled,
		shadowColor,
		shadowBlur,
		shadowSpread,
	} = attributes;

	const { record, isResolving } = usePreviewContext();
	const previewImageUrl = getEmbeddedFeaturedImageUrl( record, imageSize );

	const blockProps = useBlockProps( {
		className: `bpafb-tb-featured-image bpafb-fi-hover-${ hoverEffect || 'none' }${ overlayColor ? ' bpafb-has-overlay' : '' }`,
		style: {
			aspectRatio: aspectRatio || undefined,
			borderRadius: borderRadius ? `${ borderRadius }px` : undefined,
			overflow: borderRadius ? 'hidden' : undefined,
			'--bpafb-fi-overlay-color': overlayColor || undefined,
			'--bpafb-fi-shadow': getShadowStyle( { enabled: shadowEnabled, color: shadowColor, blur: shadowBlur, spread: shadowSpread } ),
			...getBorderStyles( { borderType, borderWidth, borderColor }, '--bpafb-fi' ),
		},
	} );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Image', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<SelectControl
							label={ __( 'Image Size', 'blockive-premium-addon-for-block' ) }
							value={ imageSize }
							options={ SIZE_OPTIONS }
							onChange={ ( value ) => setAttributes( { imageSize: value } ) }
						/>
						<SelectControl
							label={ __( 'Aspect Ratio', 'blockive-premium-addon-for-block' ) }
							value={ aspectRatio }
							options={ ASPECT_OPTIONS }
							onChange={ ( value ) => setAttributes( { aspectRatio: value } ) }
						/>
						<SelectControl
							label={ __( 'Object Fit', 'blockive-premium-addon-for-block' ) }
							value={ objectFit }
							options={ OBJECT_FIT_OPTIONS }
							onChange={ ( value ) => setAttributes( { objectFit: value } ) }
						/>
						<ToggleControl
							label={ __( 'Lazy Load', 'blockive-premium-addon-for-block' ) }
							checked={ !! lazyLoad }
							onChange={ ( value ) => setAttributes( { lazyLoad: value } ) }
						/>
						<ToggleControl
							label={ __( 'Link to Post', 'blockive-premium-addon-for-block' ) }
							checked={ !! isLink }
							onChange={ ( value ) => setAttributes( { isLink: value } ) }
						/>
					</PanelBody>
				}
				style={
					<>
						<PanelBody title={ __( 'Style', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
							<RangeControl
								label={ __( 'Border Radius (px)', 'blockive-premium-addon-for-block' ) }
								value={ borderRadius }
								onChange={ ( value ) => setAttributes( { borderRadius: value } ) }
								min={ 0 }
								max={ 100 }
							/>
							<SelectControl
								label={ __( 'Hover Effect', 'blockive-premium-addon-for-block' ) }
								value={ hoverEffect }
								options={ HOVER_EFFECT_OPTIONS }
								onChange={ ( value ) => setAttributes( { hoverEffect: value } ) }
							/>
							<BaseControl label={ __( 'Overlay Color', 'blockive-premium-addon-for-block' ) }>
								<ColorPalette value={ overlayColor } onChange={ ( value ) => setAttributes( { overlayColor: value } ) } />
							</BaseControl>
						</PanelBody>
						<PanelBody title={ __( 'Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
							<BorderControls
								values={ { borderType, borderWidth, borderColor } }
								onChange={ ( key, value ) => setAttributes( { [ key ]: value } ) }
								showRadius={ false }
							/>
						</PanelBody>
						<PanelBody title={ __( 'Shadow', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
							<ShadowControls
								hasHover={ false }
								normalValues={ { enabled: shadowEnabled, color: shadowColor, blur: shadowBlur, spread: shadowSpread } }
								onNormalChange={ ( key, value ) => {
									const map = { enabled: 'shadowEnabled', color: 'shadowColor', blur: 'shadowBlur', spread: 'shadowSpread' };
									setAttributes( { [ map[ key ] ]: value } );
								} }
							/>
						</PanelBody>
					</>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<figure { ...blockProps }>
				{ previewImageUrl ? (
					<img src={ previewImageUrl } alt="" style={ { objectFit, width: '100%', height: '100%' } } />
				) : (
					<div className="bpafb-tb-featured-image-placeholder">
						{ isResolving
							? __( 'Loading…', 'blockive-premium-addon-for-block' )
							: __( 'Featured Image Placeholder', 'blockive-premium-addon-for-block' ) }
					</div>
				) }
				{ overlayColor && <span className="bpafb-tb-fi-overlay" /> }
			</figure>
		</>
	);
}
