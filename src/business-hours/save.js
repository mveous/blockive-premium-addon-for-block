import { useBlockProps, RichText } from '@wordpress/block-editor';
import { getTypographyStyles } from '../components/typography-controls';
import { getBorderStyles } from '../components/border-controls';
import { getShadowStyle } from '../components/shadow-controls';

export default function save( { attributes } ) {
	const {
		title,
		hours,
		highlightToday,
		timeFormat,
		titleColor,
		containerBgColor,
		itemBgColor,
		itemTextColor,
		todayBgColor,
		todayTextColor,
		closedColor,
		itemBgColorHover,
		itemTextColorHover,
		dayFontFamily,
		dayFontSize,
		dayFontSizeUnit = 'px',
		dayFontWeight,
		dayLineHeight,
		dayLetterSpacing,
		dayLetterSpacingUnit = 'px',
		dayTextTransform,
		dayTextDecoration,
		timeFontFamily,
		timeFontSize,
		timeFontSizeUnit = 'px',
		timeFontWeight,
		timeLineHeight,
		timeLetterSpacing,
		timeLetterSpacingUnit = 'px',
		timeTextTransform,
		timeTextDecoration,
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
		'--bpafb-bh-title-color': titleColor,
		'--bpafb-bh-container-bg': containerBgColor,
		'--bpafb-bh-item-bg': itemBgColor,
		'--bpafb-bh-item-text-color': itemTextColor,
		'--bpafb-bh-today-bg': todayBgColor,
		'--bpafb-bh-today-text-color': todayTextColor,
		'--bpafb-bh-closed-color': closedColor,
		'--bpafb-bh-item-bg-hover': itemBgColorHover,
		'--bpafb-bh-item-text-color-hover': itemTextColorHover,
		'--bpafb-bh-shadow': getShadowStyle( { enabled: boxShadow, color: shadowColor, blur: shadowBlur, spread: shadowSpread } ),
		'--bpafb-bh-shadow-hover': getShadowStyle( { enabled: hoverBoxShadow, color: hoverShadowColor, blur: hoverShadowBlur, spread: hoverShadowSpread } ),
		...getTypographyStyles( { fontFamily: dayFontFamily, fontSize: dayFontSize, fontSizeUnit: dayFontSizeUnit, fontWeight: dayFontWeight, lineHeight: dayLineHeight, letterSpacing: dayLetterSpacing, letterSpacingUnit: dayLetterSpacingUnit, textTransform: dayTextTransform, textDecoration: dayTextDecoration }, '--bpafb-bh-day' ),
		...getTypographyStyles( { fontFamily: timeFontFamily, fontSize: timeFontSize, fontSizeUnit: timeFontSizeUnit, fontWeight: timeFontWeight, lineHeight: timeLineHeight, letterSpacing: timeLetterSpacing, letterSpacingUnit: timeLetterSpacingUnit, textTransform: timeTextTransform, textDecoration: timeTextDecoration }, '--bpafb-bh-time' ),
		...getBorderStyles( { borderType, borderWidth, borderWidthUnit, borderRadius, borderRadiusUnit, borderColor }, '--bpafb-bh-container' ),
	};

	const blockProps = useBlockProps.save( {
		className: 'bpafb-business-hours-wrapper',
		style: customStyles,
		'data-highlight-today': highlightToday ? 'true' : 'false',
	} );

	const formatTime = ( time ) => {
		if ( ! time ) return '';

		if ( timeFormat === '12' ) {
			let [ hrs, minutes ] = time.split( ':' );
			if ( ! hrs || ! minutes ) return time;

			let suffix = 'AM';
			let h = parseInt( hrs, 10 );
			if ( h >= 12 ) {
				suffix = 'PM';
				if ( h > 12 ) h -= 12;
			}
			if ( h === 0 ) h = 12;

			return `${ h.toString().padStart( 2, '0' ) }:${ minutes } ${ suffix }`;
		}

		return time;
	};

	const getDayLabel = ( day ) => {
		const labels = {
			monday: 'Monday',
			tuesday: 'Tuesday',
			wednesday: 'Wednesday',
			thursday: 'Thursday',
			friday: 'Friday',
			saturday: 'Saturday',
			sunday: 'Sunday',
		};
		return labels[ day ] || day;
	};

	return (
		<div { ...blockProps }>
			<div className="bpafb-business-hours-container">
				{ title && (
					<RichText.Content
						tagName="h3"
						className="bpafb-business-hours-title"
						value={ title }
					/>
				) }

				<div className="bpafb-business-hours-list">
					{ hours.map( ( hour, index ) => {
						return (
							<div key={ index } className="bpafb-business-hours-item" data-day={ hour.day }>
								<span className="bpafb-business-hours-day">{ getDayLabel( hour.day ) }</span>

								{ hour.isClosed ? (
									<span className="bpafb-business-hours-time closed">{ hour.closedText }</span>
								) : (
									<span className="bpafb-business-hours-time">
										{ formatTime( hour.openTime ) } - { formatTime( hour.closeTime ) }
									</span>
								) }
							</div>
						);
					} ) }
				</div>
			</div>
		</div>
	);
}
