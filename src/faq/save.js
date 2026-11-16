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
		titleColorHover,
		titleBgColorHover,
		questionFontFamily,
		questionFontSize,
		questionFontSizeUnit = 'px',
		questionFontWeight,
		questionLineHeight,
		questionLetterSpacing,
		questionLetterSpacingUnit = 'px',
		questionTextTransform,
		questionTextDecoration,
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
		titleTag,
		headingText,
		headingTag,
		headingAlign,
		headingColor,
	} = attributes;

	const customStyles = {
		'--bpafb-faq-title-color': titleColor,
		'--bpafb-faq-title-active-color': titleActiveColor,
		'--bpafb-faq-title-bg': titleBgColor,
		'--bpafb-faq-content-color': contentColor,
		'--bpafb-faq-content-bg': contentBgColor,
		...( titleColorHover ? { '--bpafb-faq-title-color-hover': titleColorHover } : {} ),
		...( titleBgColorHover ? { '--bpafb-faq-title-bg-hover': titleBgColorHover } : {} ),
		'--bpafb-faq-shadow': getShadowStyle( { enabled: boxShadow, color: shadowColor, blur: shadowBlur, spread: shadowSpread } ),
		'--bpafb-faq-shadow-hover': getShadowStyle( { enabled: hoverBoxShadow, color: hoverShadowColor, blur: hoverShadowBlur, spread: hoverShadowSpread } ),
		...getTypographyStyles(
			{
				fontFamily: questionFontFamily,
				fontSize: questionFontSize,
				fontSizeUnit: questionFontSizeUnit,
				fontWeight: questionFontWeight,
				lineHeight: questionLineHeight,
				letterSpacing: questionLetterSpacing,
				letterSpacingUnit: questionLetterSpacingUnit,
				textTransform: questionTextTransform,
				textDecoration: questionTextDecoration,
			},
			'--bpafb-faq-title'
		),
		...getBorderStyles( { borderType, borderWidth, borderWidthUnit, borderRadius, borderRadiusUnit, borderColor }, '--bpafb-faq' ),
	};

	if ( animationType !== 'none' ) {
		customStyles.animationDuration = animationDuration;
		customStyles.animationDelay = animationDelay;
	}

	const blockProps = useBlockProps.save( {
		className: `bpafb-faq-wrapper ${ animationType !== 'none' ? `bpafb-animate-${ animationType }` : '' }`,
		style: customStyles,
	} );

	// FAQPage JSON-LD schema is generated and injected server-side (see
	// bpafb_inject_faq_schema() in the main plugin file) so it is never
	// subject to the save-time wp_kses_post() filter, which strips <script>
	// tags for any user without the unfiltered_html capability.

	return (
		<div { ...blockProps }>
			{ headingText && (
				<RichText.Content
					tagName={ headingTag }
					className="bpafb-faq-main-heading"
					style={ { textAlign: headingAlign, color: headingColor, marginBottom: '20px' } }
					value={ headingText }
				/>
			) }
			{ items.map( ( item, index ) => {
				const isFirst = index === 0;
				let iconElement = null;

				if ( icon !== 'none' ) {
					if ( icon === 'plus-minus' ) {
						iconElement = (
							<>
								<span className="bpafb-faq-icon bpafb-icon-open"><i className="fas fa-plus"></i></span>
								<span className="bpafb-faq-icon bpafb-icon-close" style={ { display: 'none' } }><i className="fas fa-minus"></i></span>
							</>
						);
					} else if ( icon === 'chevron' ) {
						iconElement = (
							<>
								<span className="bpafb-faq-icon bpafb-icon-open"><i className="fas fa-chevron-down"></i></span>
								<span className="bpafb-faq-icon bpafb-icon-close" style={ { display: 'none' } }><i className="fas fa-chevron-up"></i></span>
							</>
						);
					} else if ( icon === 'angle' ) {
						iconElement = (
							<>
								<span className="bpafb-faq-icon bpafb-icon-open"><i className="fas fa-angle-down"></i></span>
								<span className="bpafb-faq-icon bpafb-icon-close" style={ { display: 'none' } }><i className="fas fa-angle-up"></i></span>
							</>
						);
					}
				}

				return (
					<div key={ item.id || index } className={ `bpafb-faq-item ${ isFirst ? 'active' : '' }` }>
						<div
							className={ `bpafb-faq-header flex-align-${ iconAlign }` }
							role="button"
							tabIndex="0"
							aria-expanded={ isFirst }
							aria-controls={ `bpafb-faq-content-${ item.id || index }` }
						>
							{ iconAlign === 'left' && iconElement }
							<RichText.Content
								tagName={ titleTag }
								className="bpafb-faq-title"
								value={ item.title }
							/>
							{ iconAlign === 'right' && iconElement }
						</div>
						<div className="bpafb-faq-content" id={ `bpafb-faq-content-${ item.id || index }` } style={ { display: isFirst ? 'block' : 'none' } }>
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
