import { useBlockProps, RichText } from '@wordpress/block-editor';
import { getTypographyStyles } from '../components/typography-controls';
import { getShadowStyle } from '../components/shadow-controls';

export default function save( { attributes } ) {
	const {
		content,
		view,
		shape,
		primaryColor,
		secondaryColor,
		size,
		sizeUnit = 'px',
		space,
		borderWidth,
		borderType,
		borderRadius,
		dropCapPadding,
		alignment,
		fontFamily,
		fontWeight,
		lineHeight,
		letterSpacing,
		letterSpacingUnit = 'px',
		textTransform,
		textDecoration,
		boxShadow,
		shadowColor,
		shadowBlur,
		shadowSpread,
		hoverBoxShadow,
		hoverShadowColor,
		hoverShadowBlur,
		hoverShadowSpread,
	} = attributes;

	const isFramed = view === 'framed';

	const customStyles = {
		textAlign: alignment,
		'--bpafb-dc-space': `${ space }px`,
		'--bpafb-dc-pd': `${ dropCapPadding }px`,
		'--bpafb-dc-color': secondaryColor || 'inherit',
		'--bpafb-dc-bg': view === 'stacked' ? ( primaryColor || '#000' ) : 'transparent',
		'--bpafb-dc-border-width': isFramed ? `${ borderWidth }px` : '0px',
		'--bpafb-dc-border-style': borderType || 'solid',
		'--bpafb-dc-border-color': primaryColor || '#000',
		'--bpafb-dc-radius': borderRadius > 0 ? `${ borderRadius }px` : ( shape === 'circle' ? '50%' : ( shape === 'rounded' ? '5px' : '0' ) ),
		'--bpafb-dc-shadow': getShadowStyle( { enabled: boxShadow, color: shadowColor, blur: shadowBlur, spread: shadowSpread } ),
		'--bpafb-dc-shadow-hover': getShadowStyle( { enabled: hoverBoxShadow, color: hoverShadowColor, blur: hoverShadowBlur, spread: hoverShadowSpread } ),
		...getTypographyStyles( { fontFamily, fontSize: size, fontSizeUnit: sizeUnit, fontWeight, lineHeight, letterSpacing, letterSpacingUnit, textTransform, textDecoration }, '--bpafb-dc-letter' ),
	};

	const blockProps = useBlockProps.save( {
		className: `has-drop-cap is-view-${ view } is-shape-${ shape }`,
		style: customStyles,
	} );

	return (
		<RichText.Content
			{ ...blockProps }
			tagName="p"
			value={ content }
		/>
	);
}
