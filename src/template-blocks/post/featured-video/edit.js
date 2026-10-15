import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, SelectControl } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import BorderControls, { getBorderStyles } from '../../../components/border-controls';
import ShadowControls, { getShadowStyle } from '../../../components/shadow-controls';
import usePreviewContext from '../../shared/use-preview-context';

const ASPECT_OPTIONS = [
	{ label: '16:9', value: '16/9' },
	{ label: '4:3', value: '4/3' },
	{ label: '1:1', value: '1/1' },
	{ label: '21:9', value: '21/9' },
];

export default function Edit( { attributes, setAttributes } ) {
	const {
		videoUrl,
		metaKey,
		autoDetect,
		aspectRatio,
		borderRadius,
		borderRadiusUnit = 'px',
		borderType,
		borderWidth,
		borderWidthUnit = 'px',
		borderColor,
		shadowEnabled,
		shadowColor,
		shadowBlur,
		shadowSpread,
	} = attributes;

	const { isResolving } = usePreviewContext();

	const blockProps = useBlockProps( {
		className: 'bpafb-tb-featured-video',
		style: {
			aspectRatio: aspectRatio || undefined,
			'--bpafb-fv-shadow': getShadowStyle( { enabled: shadowEnabled, color: shadowColor, blur: shadowBlur, spread: shadowSpread } ),
			...getBorderStyles( { borderType, borderWidth, borderWidthUnit, borderRadius, borderRadiusUnit, borderColor }, '--bpafb-fv' ),
		},
	} );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Video', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<TextControl
							label={ __( 'Featured Video Meta Key', 'blockive-premium-addon-for-block' ) }
							value={ metaKey }
							onChange={ ( value ) => setAttributes( { metaKey: value } ) }
							help={ __( 'Reads this post meta key first, if it holds a URL.', 'blockive-premium-addon-for-block' ) }
						/>
						<ToggleControl
							label={ __( 'Auto Detect', 'blockive-premium-addon-for-block' ) }
							checked={ !! autoDetect }
							onChange={ ( value ) => setAttributes( { autoDetect: value } ) }
							help={ __( 'Use a video found in the post content or the featured media, if it is a video.', 'blockive-premium-addon-for-block' ) }
						/>
						<TextControl
							label={ __( 'Video URL (fallback)', 'blockive-premium-addon-for-block' ) }
							value={ videoUrl }
							onChange={ ( value ) => setAttributes( { videoUrl: value } ) }
							help={ __( 'YouTube, Vimeo, or a direct .mp4/.webm/.ogg URL. Used when no meta value or auto-detected video is found.', 'blockive-premium-addon-for-block' ) }
						/>
					</PanelBody>
				}
				style={
					<>
						<PanelBody title={ __( 'Style', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
							<SelectControl
								label={ __( 'Aspect Ratio', 'blockive-premium-addon-for-block' ) }
								value={ aspectRatio }
								options={ ASPECT_OPTIONS }
								onChange={ ( value ) => setAttributes( { aspectRatio: value } ) }
							/>
						</PanelBody>
						<PanelBody title={ __( 'Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
							<BorderControls
								values={ { borderType, borderWidth, borderRadius, borderColor } }
								onChange={ ( key, value ) => setAttributes( { [ key ]: value } ) }
								widthUnit={ borderWidthUnit }
								onWidthUnitChange={ ( value ) => setAttributes( { borderWidthUnit: value } ) }
								radiusUnit={ borderRadiusUnit }
								onRadiusUnitChange={ ( value ) => setAttributes( { borderRadiusUnit: value } ) }
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

			<div { ...blockProps }>
				<div className="bpafb-tb-featured-video-placeholder">
					<i className="fa-solid fa-circle-play" />
					<span>
						{ isResolving
							? __( 'Loading…', 'blockive-premium-addon-for-block' )
							: videoUrl
								? videoUrl
								: __( 'Featured Video Placeholder', 'blockive-premium-addon-for-block' ) }
					</span>
				</div>
			</div>
		</>
	);
}
