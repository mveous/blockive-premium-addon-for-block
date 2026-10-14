import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, RichText } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl, ToggleControl, RangeControl, BaseControl, ColorPalette } from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';
import ColorStateControls from '../components/color-state-controls';
import TypographyControls, { getTypographyStyles } from '../components/typography-controls';
import BorderControls, { getBorderStyles } from '../components/border-controls';
import ShadowControls, { getShadowStyle } from '../components/shadow-controls';

export default function Edit( { attributes, setAttributes } ) {
	const {
		icon,
		title,
		titleTag,
		description,
		url,
		linkTarget,
		iconPosition,
		iconSize,
		iconColor,
		iconColorHover,
		iconBgColor,
		iconBgColorHover,
		titleColor,
		titleColorHover,
		descColor,
		boxBgColor,
		boxBgColorHover,
		iconPadding,
		iconBorderRadius,
		boxAlignment,
		iconBorderColor,
		iconBorderWidth,
		iconBorderStyle,
		titleFontFamily,
		titleFontSize,
		titleFontWeight,
		titleLineHeight,
		titleLetterSpacing,
		titleTextTransform,
		titleTextDecoration,
		descFontFamily,
		descFontSize,
		descFontWeight,
		descLineHeight,
		descLetterSpacing,
		descTextTransform,
		descTextDecoration,
		borderType,
		borderWidth,
		borderRadius,
		borderColor,
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
		'--bpafb-ib-icon-size': `${ iconSize }px`,
		'--bpafb-ib-icon-color': iconColor,
		'--bpafb-ib-icon-color-hover': iconColorHover,
		'--bpafb-ib-icon-bg': iconBgColor,
		'--bpafb-ib-icon-bg-hover': iconBgColorHover,
		'--bpafb-ib-icon-padding': `${ iconPadding }px`,
		'--bpafb-ib-icon-radius': `${ iconBorderRadius }px`,
		'--bpafb-ib-title-color': titleColor,
		'--bpafb-ib-title-color-hover': titleColorHover,
		'--bpafb-ib-desc-color': descColor,
		'--bpafb-ib-box-bg': boxBgColor,
		'--bpafb-ib-box-bg-hover': boxBgColorHover,
		'--bpafb-ib-alignment': boxAlignment,
		'--bpafb-ib-icon-border-color': iconBorderColor,
		'--bpafb-ib-icon-border-width': iconBorderWidth ? `${ iconBorderWidth }px` : undefined,
		'--bpafb-ib-icon-border-style': iconBorderStyle,
		'--bpafb-ib-shadow': getShadowStyle( { enabled: boxShadow, color: shadowColor, blur: shadowBlur, spread: shadowSpread } ),
		'--bpafb-ib-shadow-hover': getShadowStyle( { enabled: hoverBoxShadow, color: hoverShadowColor, blur: hoverShadowBlur, spread: hoverShadowSpread } ),
		...getTypographyStyles( { fontFamily: titleFontFamily, fontSize: titleFontSize, fontWeight: titleFontWeight, lineHeight: titleLineHeight, letterSpacing: titleLetterSpacing, textTransform: titleTextTransform, textDecoration: titleTextDecoration }, '--bpafb-ib-title' ),
		...getTypographyStyles( { fontFamily: descFontFamily, fontSize: descFontSize, fontWeight: descFontWeight, lineHeight: descLineHeight, letterSpacing: descLetterSpacing, textTransform: descTextTransform, textDecoration: descTextDecoration }, '--bpafb-ib-desc' ),
		...getBorderStyles( { borderType, borderWidth, borderRadius, borderColor }, '--bpafb-ib-box' ),
	};

	const blockProps = useBlockProps( {
		className: `bpafb-icon-box-wrapper bpafb-icon-box--${ iconPosition }`,
		style: customStyles,
	} );

	const generalTab = (
		<PanelBody title={ __( 'Content', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
			<TextControl
				label={ __( 'FontAwesome Icon Class', 'blockive-premium-addon-for-block' ) }
				value={ icon }
				onChange={ ( val ) => setAttributes( { icon: val } ) }
				help="e.g., 'fas fa-star', 'fab fa-facebook'"
			/>

			<SelectControl
				label={ __( 'Title HTML Tag', 'blockive-premium-addon-for-block' ) }
				value={ titleTag }
				options={ [
					{ label: 'H2', value: 'h2' },
					{ label: 'H3', value: 'h3' },
					{ label: 'H4', value: 'h4' },
					{ label: 'H5', value: 'h5' },
					{ label: 'H6', value: 'h6' },
					{ label: 'P', value: 'p' },
					{ label: 'DIV', value: 'div' },
				] }
				onChange={ ( val ) => setAttributes( { titleTag: val } ) }
			/>

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

			<SegmentedControl
				label={ __( 'Icon Position', 'blockive-premium-addon-for-block' ) }
				value={ iconPosition }
				options={ [
					{ label: 'Top', value: 'top' },
					{ label: 'Left', value: 'left' },
					{ label: 'Right', value: 'right' },
				] }
				onChange={ ( val ) => setAttributes( { iconPosition: val } ) }
			/>

			<SegmentedControl
				label={ __( 'Text Alignment', 'blockive-premium-addon-for-block' ) }
				value={ boxAlignment }
				options={ [
					{ label: 'Left', value: 'left' },
					{ label: 'Center', value: 'center' },
					{ label: 'Right', value: 'right' },
				] }
				onChange={ ( val ) => setAttributes( { boxAlignment: val } ) }
			/>
		</PanelBody>
	);

	const styleTab = (
		<>
			<PanelBody title={ __( 'Icon Styling', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<RangeControl
					label={ __( 'Icon Size', 'blockive-premium-addon-for-block' ) }
					value={ iconSize }
					onChange={ ( val ) => setAttributes( { iconSize: val } ) }
					min={ 10 }
					max={ 200 }
				/>
				<RangeControl
					label={ __( 'Icon Padding', 'blockive-premium-addon-for-block' ) }
					value={ iconPadding }
					onChange={ ( val ) => setAttributes( { iconPadding: val } ) }
					min={ 0 }
					max={ 100 }
				/>
				<RangeControl
					label={ __( 'Icon Border Radius', 'blockive-premium-addon-for-block' ) }
					value={ iconBorderRadius }
					onChange={ ( val ) => setAttributes( { iconBorderRadius: val } ) }
					min={ 0 }
					max={ 100 }
				/>
				<RangeControl
					label={ __( 'Icon Border Width (px)', 'blockive-premium-addon-for-block' ) }
					value={ iconBorderWidth }
					onChange={ ( val ) => setAttributes( { iconBorderWidth: val } ) }
					min={ 0 }
					max={ 20 }
				/>
				<SelectControl
					label={ __( 'Icon Border Style', 'blockive-premium-addon-for-block' ) }
					value={ iconBorderStyle }
					options={ [
						{ label: 'Solid', value: 'solid' },
						{ label: 'Dashed', value: 'dashed' },
						{ label: 'Dotted', value: 'dotted' },
						{ label: 'Double', value: 'double' },
						{ label: 'None', value: 'none' },
					] }
					onChange={ ( val ) => setAttributes( { iconBorderStyle: val } ) }
				/>
				<BaseControl label={ __( 'Icon Border Color', 'blockive-premium-addon-for-block' ) }>
					<ColorPalette value={ iconBorderColor } onChange={ ( val ) => setAttributes( { iconBorderColor: val } ) } />
				</BaseControl>
				<ColorStateControls
					normal={ [
						{ label: __( 'Icon Color', 'blockive-premium-addon-for-block' ), value: iconColor, onChange: ( val ) => setAttributes( { iconColor: val } ) },
						{ label: __( 'Icon Background', 'blockive-premium-addon-for-block' ), value: iconBgColor, onChange: ( val ) => setAttributes( { iconBgColor: val } ) },
					] }
					hover={ [
						{ label: __( 'Icon Color (Hover)', 'blockive-premium-addon-for-block' ), value: iconColorHover, onChange: ( val ) => setAttributes( { iconColorHover: val } ) },
						{ label: __( 'Icon Background (Hover)', 'blockive-premium-addon-for-block' ), value: iconBgColorHover, onChange: ( val ) => setAttributes( { iconBgColorHover: val } ) },
					] }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Title Typography', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<TypographyControls
					values={ { fontFamily: titleFontFamily, fontSize: titleFontSize, fontWeight: titleFontWeight, lineHeight: titleLineHeight, letterSpacing: titleLetterSpacing, textTransform: titleTextTransform, textDecoration: titleTextDecoration } }
					onChange={ ( key, val ) => setAttributes( { [ `title${ key.charAt( 0 ).toUpperCase() }${ key.slice( 1 ) }` ]: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Description Typography', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<TypographyControls
					values={ { fontFamily: descFontFamily, fontSize: descFontSize, fontWeight: descFontWeight, lineHeight: descLineHeight, letterSpacing: descLetterSpacing, textTransform: descTextTransform, textDecoration: descTextDecoration } }
					onChange={ ( key, val ) => setAttributes( { [ `desc${ key.charAt( 0 ).toUpperCase() }${ key.slice( 1 ) }` ]: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<ColorStateControls
					normal={ [
						{ label: __( 'Title Color', 'blockive-premium-addon-for-block' ), value: titleColor, onChange: ( val ) => setAttributes( { titleColor: val } ) },
						{ label: __( 'Description Color', 'blockive-premium-addon-for-block' ), value: descColor, onChange: ( val ) => setAttributes( { descColor: val } ) },
						{ label: __( 'Box Background', 'blockive-premium-addon-for-block' ), value: boxBgColor, onChange: ( val ) => setAttributes( { boxBgColor: val } ) },
					] }
					hover={ [
						{ label: __( 'Title Color (Hover)', 'blockive-premium-addon-for-block' ), value: titleColorHover, onChange: ( val ) => setAttributes( { titleColorHover: val } ) },
						{ label: __( 'Box Background (Hover)', 'blockive-premium-addon-for-block' ), value: boxBgColorHover, onChange: ( val ) => setAttributes( { boxBgColorHover: val } ) },
					] }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Box Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<BorderControls values={ { borderType, borderWidth, borderRadius, borderColor } } onChange={ ( key, val ) => setAttributes( { [ key ]: val } ) } />
			</PanelBody>

			<PanelBody title={ __( 'Box Shadow', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
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

	const ContentElement = () => (
		<>
			{ icon && (
				<div className="bpafb-icon-box-icon-wrapper">
					<i className={ `${ icon } bpafb-icon-box-icon` }></i>
				</div>
			) }

			<div className="bpafb-icon-box-content">
				<RichText
					tagName={ titleTag }
					className="bpafb-icon-box-title"
					value={ title }
					onChange={ ( val ) => setAttributes( { title: val } ) }
					placeholder={ __( 'Enter title...', 'blockive-premium-addon-for-block' ) }
				/>

				<RichText
					tagName="div"
					className="bpafb-icon-box-description"
					value={ description }
					onChange={ ( val ) => setAttributes( { description: val } ) }
					placeholder={ __( 'Enter description...', 'blockive-premium-addon-for-block' ) }
				/>
			</div>
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
				{ url ? (
					<div className="bpafb-icon-box-link">
						<ContentElement />
					</div>
				) : (
					<ContentElement />
				) }
			</div>
		</>
	);
}
