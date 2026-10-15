import { useBlockProps, RichText } from '@wordpress/block-editor';
import { getTypographyStyles } from '../components/typography-controls';
import { getBorderStyles } from '../components/border-controls';
import { getShadowStyle } from '../components/shadow-controls';
import { getSafeIconBoxUrl } from './utils';

export default function save( { attributes } ) {
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
		titleFontSizeUnit = 'px',
		titleFontWeight,
		titleLineHeight,
		titleLetterSpacing,
		titleLetterSpacingUnit = 'px',
		titleTextTransform,
		titleTextDecoration,
		descFontFamily,
		descFontSize,
		descFontSizeUnit = 'px',
		descFontWeight,
		descLineHeight,
		descLetterSpacing,
		descLetterSpacingUnit = 'px',
		descTextTransform,
		descTextDecoration,
		borderType,
		borderWidth,
		borderWidthUnit = 'px',
		borderRadius,
		borderRadiusUnit = 'px',
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
		...getTypographyStyles( { fontFamily: titleFontFamily, fontSize: titleFontSize, fontSizeUnit: titleFontSizeUnit, fontWeight: titleFontWeight, lineHeight: titleLineHeight, letterSpacing: titleLetterSpacing, letterSpacingUnit: titleLetterSpacingUnit, textTransform: titleTextTransform, textDecoration: titleTextDecoration }, '--bpafb-ib-title' ),
		...getTypographyStyles( { fontFamily: descFontFamily, fontSize: descFontSize, fontSizeUnit: descFontSizeUnit, fontWeight: descFontWeight, lineHeight: descLineHeight, letterSpacing: descLetterSpacing, letterSpacingUnit: descLetterSpacingUnit, textTransform: descTextTransform, textDecoration: descTextDecoration }, '--bpafb-ib-desc' ),
		...getBorderStyles( { borderType, borderWidth, borderWidthUnit, borderRadius, borderRadiusUnit, borderColor }, '--bpafb-ib-box' ),
	};

	const blockProps = useBlockProps.save( {
		className: `bpafb-icon-box-wrapper bpafb-icon-box--${ iconPosition }`,
		style: customStyles,
	} );

	const TitleTag = titleTag;

	const ContentElement = () => (
		<>
			{ icon && (
				<div className="bpafb-icon-box-icon-wrapper">
					<i className={ `${ icon } bpafb-icon-box-icon` }></i>
				</div>
			) }

			<div className="bpafb-icon-box-content">
				{ title && <RichText.Content tagName={ TitleTag } className="bpafb-icon-box-title" value={ title } /> }
				{ description && <RichText.Content tagName="div" className="bpafb-icon-box-description" value={ description } /> }
			</div>
		</>
	);

	const safeUrl = getSafeIconBoxUrl( url );

	return (
		<div { ...blockProps }>
			{ safeUrl ? (
				<a
					href={ safeUrl }
					className="bpafb-icon-box-link"
					target={ linkTarget ? '_blank' : undefined }
					rel={ linkTarget ? 'noopener noreferrer' : undefined }
				>
					<ContentElement />
				</a>
			) : (
				<ContentElement />
			) }
		</div>
	);
}
