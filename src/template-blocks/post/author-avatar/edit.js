import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import BorderControls, { getBorderStyles } from '../../../components/border-controls';
import ShadowControls, { getShadowStyle } from '../../../components/shadow-controls';
import usePreviewContext from '../../shared/use-preview-context';

export default function Edit( { attributes, setAttributes } ) {
	const {
		size,
		borderRadius,
		borderType,
		borderWidth,
		borderWidthUnit = 'px',
		borderColor,
		shadowEnabled,
		shadowColor,
		shadowBlur,
		shadowSpread,
	} = attributes;

	const { record, isResolving } = usePreviewContext();
	const avatarUrls = record?._embedded?.author?.[ 0 ]?.avatar_urls;
	const previewAvatarUrl = avatarUrls
		? avatarUrls[ '96' ] || avatarUrls[ '48' ] || avatarUrls[ '24' ] || Object.values( avatarUrls )[ 0 ]
		: null;

	const customStyles = {
		'--bpafb-aa-size': `${ size || 96 }px`,
		'--bpafb-aa-radius': `${ borderRadius !== undefined ? borderRadius : 9999 }px`,
		'--bpafb-aa-shadow': getShadowStyle( { enabled: shadowEnabled, color: shadowColor, blur: shadowBlur, spread: shadowSpread } ),
		...getBorderStyles( { borderType, borderWidth, borderWidthUnit, borderColor }, '--bpafb-aa' ),
	};

	const blockProps = useBlockProps( {
		className: 'bpafb-tb-author-avatar',
		style: customStyles,
	} );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Avatar', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<RangeControl
							label={ __( 'Avatar Size (px)', 'blockive-premium-addon-for-block' ) }
							value={ size }
							onChange={ ( value ) => setAttributes( { size: value } ) }
							min={ 16 }
							max={ 400 }
						/>
						<RangeControl
							label={ __( 'Border Radius (px)', 'blockive-premium-addon-for-block' ) }
							value={ borderRadius }
							onChange={ ( value ) => setAttributes( { borderRadius: value } ) }
							min={ 0 }
							max={ 9999 }
						/>
					</PanelBody>
				}
				style={
					<>
						<PanelBody title={ __( 'Border', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
							<BorderControls
								values={ { borderType, borderWidth, borderColor } }
								onChange={ ( key, value ) => setAttributes( { [ key ]: value } ) }
								showRadius={ false }
								widthUnit={ borderWidthUnit }
								onWidthUnitChange={ ( value ) => setAttributes( { borderWidthUnit: value } ) }
							/>
						</PanelBody>
						<PanelBody title={ __( 'Shadow', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
							<ShadowControls
								hasHover={ false }
								normalValues={ { enabled: shadowEnabled, color: shadowColor, blur: shadowBlur, spread: shadowSpread } }
								onNormalChange={ ( key, value ) => {
									const map = {
										enabled: 'shadowEnabled',
										color: 'shadowColor',
										blur: 'shadowBlur',
										spread: 'shadowSpread',
									};
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
				{ previewAvatarUrl ? (
					<img src={ previewAvatarUrl } alt="" width={ size } height={ size } />
				) : (
					<div className="bpafb-tb-author-avatar-placeholder">
						{ isResolving ? (
							__( 'Loading…', 'blockive-premium-addon-for-block' )
						) : (
							<i className="fa-regular fa-circle-user" aria-hidden="true" />
						) }
					</div>
				) }
			</div>
		</>
	);
}
