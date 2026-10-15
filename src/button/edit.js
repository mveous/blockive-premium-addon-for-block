import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, RichText } from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	TextControl,
	ToggleControl,
	RangeControl,
	BaseControl,
	ColorPalette,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import ColorStateControls from '../components/color-state-controls';
import TypographyControls, { getTypographyStyles } from '../components/typography-controls';
import BorderControls, { getBorderStyles } from '../components/border-controls';
import ShadowControls, { getShadowStyle } from '../components/shadow-controls';

export default function Edit( { attributes, setAttributes } ) {
	const {
		text,
		url,
		linkTarget,
		showIcon,
		icon,
		iconPosition,
		badgeText,
		alignment,
		buttonWidth,
		textColor,
		bgColor,
		textColorHover,
		bgColorHover,
		badgeTextColor,
		badgeBgColor,
		iconSpacing,
		fontFamily,
		fontSize,
		fontSizeUnit = 'px',
		fontWeight,
		lineHeight,
		letterSpacing,
		letterSpacingUnit = 'px',
		textTransform,
		textDecoration,
		borderType,
		borderWidth,
		borderWidthUnit = 'px',
		borderRadius,
		borderRadiusUnit = 'px',
		borderColor,
		borderColorHover,
		boxShadow,
		shadowColor,
		shadowBlur,
		shadowSpread,
		hoverBoxShadow,
		hoverShadowColor,
		hoverShadowBlur,
		hoverShadowSpread,
	} = attributes;

	const customStyles = {
		'--bpafb-btn-text-color': textColor,
		'--bpafb-btn-bg-color': bgColor,
		'--bpafb-btn-text-color-hover': textColorHover,
		'--bpafb-btn-bg-color-hover': bgColorHover,
		'--bpafb-btn-badge-text-color': badgeTextColor,
		'--bpafb-btn-badge-bg-color': badgeBgColor,
		'--bpafb-btn-icon-spacing': `${ iconSpacing }px`,
		'--bpafb-btn-width': buttonWidth === 'full' ? '100%' : 'auto',
		'--bpafb-btn-justify':
			alignment === 'left' ? 'flex-start' : alignment === 'right' ? 'flex-end' : alignment === 'justify' ? 'stretch' : 'center',
		'--bpafb-btn-border-color-hover': borderColorHover,
		'--bpafb-btn-shadow': getShadowStyle( { enabled: boxShadow, color: shadowColor, blur: shadowBlur, spread: shadowSpread } ),
		'--bpafb-btn-shadow-hover': getShadowStyle( { enabled: hoverBoxShadow, color: hoverShadowColor, blur: hoverShadowBlur, spread: hoverShadowSpread } ),
		...getTypographyStyles( { fontFamily, fontSize, fontSizeUnit, fontWeight, lineHeight, letterSpacing, letterSpacingUnit, textTransform, textDecoration }, '--bpafb-btn-text' ),
		...getBorderStyles( { borderType, borderWidth, borderWidthUnit, borderRadius, borderRadiusUnit, borderColor }, '--bpafb-btn' ),
	};

	const blockProps = useBlockProps( {
		className: `bpafb-button-wrapper bpafb-button-align-${ alignment }`,
		style: customStyles,
	} );

	const generalTab = (
		<PanelBody title={ __( 'Content', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
			<TextControl
				label={ __( 'Link URL', 'blockive-premium-addon-for-block' ) }
				value={ url }
				onChange={ ( val ) => setAttributes( { url: val } ) }
				type="url"
			/>

			{ url && (
				<ToggleControl
					label={ __( 'Open in new tab', 'blockive-premium-addon-for-block' ) }
					checked={ linkTarget }
					onChange={ ( val ) => setAttributes( { linkTarget: val } ) }
				/>
			) }

			<TextControl
				label={ __( 'Badge Text (Optional)', 'blockive-premium-addon-for-block' ) }
				value={ badgeText }
				onChange={ ( val ) => setAttributes( { badgeText: val } ) }
				help={ __( 'Leave empty to hide badge', 'blockive-premium-addon-for-block' ) }
			/>

			<ToggleControl
				label={ __( 'Show Icon', 'blockive-premium-addon-for-block' ) }
				checked={ showIcon }
				onChange={ ( val ) => setAttributes( { showIcon: val } ) }
			/>

			{ showIcon && (
				<>
					<TextControl
						label={ __( 'FontAwesome Icon Class', 'blockive-premium-addon-for-block' ) }
						value={ icon }
						onChange={ ( val ) => setAttributes( { icon: val } ) }
						help="e.g., 'fas fa-arrow-right'"
					/>
					<SegmentedControl
						label={ __( 'Icon Position', 'blockive-premium-addon-for-block' ) }
						value={ iconPosition }
						options={ [
							{ label: 'Left (Before Text)', value: 'left' },
							{ label: 'Right (After Text)', value: 'right' },
						] }
						onChange={ ( val ) => setAttributes( { iconPosition: val } ) }
					/>
				</>
			) }

			<SegmentedControl
				label={ __( 'Alignment', 'blockive-premium-addon-for-block' ) }
				value={ alignment }
				options={ [
					{ label: 'Left', value: 'left' },
					{ label: 'Center', value: 'center' },
					{ label: 'Right', value: 'right' },
					{ label: 'Justified (Full Width)', value: 'justify' },
				] }
				onChange={ ( val ) => {
					setAttributes( { alignment: val, buttonWidth: val === 'justify' ? 'full' : 'auto' } );
				} }
			/>
		</PanelBody>
	);

	const styleTab = (
		<>
			<PanelBody title={ __( 'Typography', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<TypographyControls
					values={ { fontFamily, fontSize, fontWeight, lineHeight, letterSpacing, textTransform, textDecoration } }
					onChange={ ( key, val ) => setAttributes( { [ key ]: val } ) }
					fontSizeUnit={ fontSizeUnit }
					onFontSizeUnitChange={ ( val ) => setAttributes( { fontSizeUnit: val } ) }
					letterSpacingUnit={ letterSpacingUnit }
					onLetterSpacingUnitChange={ ( val ) => setAttributes( { letterSpacingUnit: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<ColorStateControls
					normal={ [
						{ label: __( 'Text Color', 'blockive-premium-addon-for-block' ), value: textColor, onChange: ( val ) => setAttributes( { textColor: val } ) },
						{ label: __( 'Background Color', 'blockive-premium-addon-for-block' ), value: bgColor, onChange: ( val ) => setAttributes( { bgColor: val } ) },
					] }
					hover={ [
						{ label: __( 'Hover Text Color', 'blockive-premium-addon-for-block' ), value: textColorHover, onChange: ( val ) => setAttributes( { textColorHover: val } ) },
						{ label: __( 'Hover Background Color', 'blockive-premium-addon-for-block' ), value: bgColorHover, onChange: ( val ) => setAttributes( { bgColorHover: val } ) },
					] }
				/>
			</PanelBody>

			{ badgeText && (
				<PanelBody title={ __( 'Badge Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<BaseControl label={ __( 'Badge Text Color', 'blockive-premium-addon-for-block' ) }>
						<ColorPalette value={ badgeTextColor } onChange={ ( val ) => setAttributes( { badgeTextColor: val } ) } />
					</BaseControl>
					<BaseControl label={ __( 'Badge Background', 'blockive-premium-addon-for-block' ) }>
						<ColorPalette value={ badgeBgColor } onChange={ ( val ) => setAttributes( { badgeBgColor: val } ) } />
					</BaseControl>
				</PanelBody>
			) }

			<PanelBody title={ __( 'Spacing', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<RangeControl
					label={ __( 'Icon Spacing', 'blockive-premium-addon-for-block' ) }
					value={ iconSpacing }
					onChange={ ( val ) => setAttributes( { iconSpacing: val } ) }
					min={ 0 }
					max={ 50 }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<BorderControls
					values={ { borderType, borderWidth, borderRadius, borderColor } }
					onChange={ ( key, val ) => setAttributes( { [ key ]: val } ) }
					widthUnit={ borderWidthUnit }
					onWidthUnitChange={ ( val ) => setAttributes( { borderWidthUnit: val } ) }
					radiusUnit={ borderRadiusUnit }
					onRadiusUnitChange={ ( val ) => setAttributes( { borderRadiusUnit: val } ) }
				/>
				<BaseControl label={ __( 'Border Color (Hover)', 'blockive-premium-addon-for-block' ) }>
					<ColorPalette value={ borderColorHover } onChange={ ( val ) => setAttributes( { borderColorHover: val } ) } />
				</BaseControl>
			</PanelBody>

			<PanelBody title={ __( 'Shadow', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<ShadowControls
					normalValues={ { enabled: boxShadow, color: shadowColor, blur: shadowBlur, spread: shadowSpread } }
					onNormalChange={ ( key, val ) => {
						const map = { enabled: 'boxShadow', color: 'shadowColor', blur: 'shadowBlur', spread: 'shadowSpread' };
						setAttributes( { [ map[ key ] ]: val } );
					} }
					hoverValues={ { enabled: hoverBoxShadow, color: hoverShadowColor, blur: hoverShadowBlur, spread: hoverShadowSpread } }
					onHoverChange={ ( key, val ) => {
						const map = { enabled: 'hoverBoxShadow', color: 'hoverShadowColor', blur: 'hoverShadowBlur', spread: 'hoverShadowSpread' };
						setAttributes( { [ map[ key ] ]: val } );
					} }
				/>
			</PanelBody>
		</>
	);

	return (
		<>
			<InspectorTabs
				general={ generalTab }
				style={ styleTab }
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<div { ...blockProps }>
				<div className="bpafb-button-link">
					<div className="bpafb-button-inner">
						{ badgeText && <span className="bpafb-button-badge">{ badgeText }</span> }

						{ showIcon && iconPosition === 'left' && icon && (
							<i className={ `${ icon } bpafb-button-icon bpafb-button-icon--left` }></i>
						) }

						<RichText
							tagName="span"
							className="bpafb-button-text"
							value={ text }
							onChange={ ( val ) => setAttributes( { text: val } ) }
							placeholder={ __( 'Button Text...', 'blockive-premium-addon-for-block' ) }
							allowedFormats={ [ 'core/bold', 'core/italic' ] }
						/>

						{ showIcon && iconPosition === 'right' && icon && (
							<i className={ `${ icon } bpafb-button-icon bpafb-button-icon--right` }></i>
						) }
					</div>
				</div>
			</div>
		</>
	);
}
