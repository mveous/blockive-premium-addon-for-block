import { useBlockProps, RichText } from '@wordpress/block-editor';
import { getTypographyStyles } from '../components/typography-controls';
import { getBorderStyles } from '../components/border-controls';
import { getShadowStyle } from '../components/shadow-controls';

export default function save( { attributes } ) {
	const {
		items,
		icon,
		iconAlign,
		titleColor,
		titleActiveColor,
		titleBgColor,
		contentColor,
		contentBgColor,
		borderColor,
		borderWidth,
		borderWidthUnit = 'px',
		borderType,
		borderRadius,
		borderRadiusUnit = 'px',
		titleFontFamily,
		titleFontSize,
		titleFontSizeUnit = 'px',
		titleFontWeight,
		titleLineHeight,
		titleLetterSpacing,
		titleLetterSpacingUnit = 'px',
		titleTextTransform,
		titleTextDecoration,
		boxShadow,
		shadowColor,
		shadowBlur,
		shadowSpread,
		hoverBoxShadow,
		hoverShadowColor,
		hoverShadowBlur,
		hoverShadowSpread,
		animationType,
		animationDuration,
		animationDelay,
	} = attributes;

	const shadowNormal = getShadowStyle( { enabled: boxShadow, color: shadowColor, blur: shadowBlur, spread: shadowSpread } );
	const shadowHover = getShadowStyle( { enabled: hoverBoxShadow, color: hoverShadowColor, blur: hoverShadowBlur, spread: hoverShadowSpread } );

	const customStyles = {
		'--bpafb-accordion-title-color': titleColor,
		'--bpafb-accordion-title-active-color': titleActiveColor,
		'--bpafb-accordion-title-bg': titleBgColor,
		'--bpafb-accordion-content-color': contentColor,
		'--bpafb-accordion-content-bg': contentBgColor,
		...getTypographyStyles( { fontFamily: titleFontFamily, fontSize: titleFontSize, fontSizeUnit: titleFontSizeUnit, fontWeight: titleFontWeight, lineHeight: titleLineHeight, letterSpacing: titleLetterSpacing, letterSpacingUnit: titleLetterSpacingUnit, textTransform: titleTextTransform, textDecoration: titleTextDecoration }, '--bpafb-accordion-title' ),
		...getBorderStyles( { borderType, borderWidth, borderWidthUnit, borderRadius, borderRadiusUnit, borderColor }, '--bpafb-accordion' ),
	};

	// Only emit the shadow custom properties when a custom shadow is actually
	// enabled, so the block's original card shadow (defined in the stylesheet)
	// keeps rendering untouched until a user opts in.
	if ( shadowNormal !== 'none' ) {
		customStyles[ '--bpafb-accordion-shadow' ] = shadowNormal;
	}
	if ( shadowHover !== 'none' ) {
		customStyles[ '--bpafb-accordion-shadow-hover' ] = shadowHover;
	}

	if ( animationType !== 'none' ) {
		customStyles.animationDuration = animationDuration;
		customStyles.animationDelay = animationDelay;
	}

	const blockProps = useBlockProps.save( {
		className: `bpafb-accordion-wrapper ${ animationType !== 'none' ? `bpafb-animate-${ animationType }` : '' }`,
		style: customStyles,
	} );

	return (
		<div { ...blockProps }>
			{ items.map( ( item, index ) => {
				const isFirst = index === 0;
				let iconElement = null;

				if ( icon !== 'none' ) {
					if ( icon === 'plus-minus' ) {
						iconElement = (
							<>
								<span className="bpafb-accordion-icon bpafb-icon-open"><i className="fas fa-plus"></i></span>
								<span className="bpafb-accordion-icon bpafb-icon-close" style={ { display: 'none' } }><i className="fas fa-minus"></i></span>
							</>
						);
					} else if ( icon === 'chevron' ) {
						iconElement = (
							<>
								<span className="bpafb-accordion-icon bpafb-icon-open"><i className="fas fa-chevron-down"></i></span>
								<span className="bpafb-accordion-icon bpafb-icon-close" style={ { display: 'none' } }><i className="fas fa-chevron-up"></i></span>
							</>
						);
					} else if ( icon === 'angle' ) {
						iconElement = (
							<>
								<span className="bpafb-accordion-icon bpafb-icon-open"><i className="fas fa-angle-down"></i></span>
								<span className="bpafb-accordion-icon bpafb-icon-close" style={ { display: 'none' } }><i className="fas fa-angle-up"></i></span>
							</>
						);
					}
				}

				return (
					<div key={ item.id || index } className={ `bpafb-accordion-item ${ isFirst ? 'active' : '' }` }>
						<div
							className={ `bpafb-accordion-header flex-align-${ iconAlign }` }
							role="button"
							tabIndex="0"
							aria-expanded={ isFirst }
							aria-controls={ `bpafb-accordion-content-${ item.id || index }` }
						>
							{ iconAlign === 'left' && iconElement }
							<RichText.Content
								tagName="span"
								className="bpafb-accordion-title"
								value={ item.title }
							/>
							{ iconAlign === 'right' && iconElement }
						</div>
						<div className="bpafb-accordion-content" id={ `bpafb-accordion-content-${ item.id || index }` } style={ { display: isFirst ? 'block' : 'none' } }>
							<RichText.Content
								tagName="p"
								value={ item.content }
							/>
						</div>
					</div>
				);
			} ) }
		</div>
	);
}
