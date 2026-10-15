import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	ToggleControl,
	TextControl,
	Button,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import ColorStateControls from '../components/color-state-controls';
import TypographyControls, { getTypographyStyles } from '../components/typography-controls';
import BorderControls, { getBorderStyles } from '../components/border-controls';
import ShadowControls, { getShadowStyle } from '../components/shadow-controls';

export default function Edit( { attributes, setAttributes } ) {
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

	const blockProps = useBlockProps( {
		className: 'bpafb-business-hours-wrapper',
		style: customStyles,
	} );

	const updateHour = ( index, key, value ) => {
		const newHours = [ ...hours ];
		newHours[ index ] = { ...newHours[ index ], [ key ]: value };
		setAttributes( { hours: newHours } );
	};

	const addHour = () => {
		setAttributes( {
			hours: [
				...hours,
				{ day: 'monday', openTime: '09:00', closeTime: '18:00', isClosed: false, closedText: 'Closed' },
			],
		} );
	};

	const removeHour = ( index ) => {
		const newHours = hours.filter( ( _, i ) => i !== index );
		setAttributes( { hours: newHours } );
	};

	const dayOptions = [
		{ label: __( 'Monday', 'blockive-premium-addon-for-block' ), value: 'monday' },
		{ label: __( 'Tuesday', 'blockive-premium-addon-for-block' ), value: 'tuesday' },
		{ label: __( 'Wednesday', 'blockive-premium-addon-for-block' ), value: 'wednesday' },
		{ label: __( 'Thursday', 'blockive-premium-addon-for-block' ), value: 'thursday' },
		{ label: __( 'Friday', 'blockive-premium-addon-for-block' ), value: 'friday' },
		{ label: __( 'Saturday', 'blockive-premium-addon-for-block' ), value: 'saturday' },
		{ label: __( 'Sunday', 'blockive-premium-addon-for-block' ), value: 'sunday' },
	];

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

	const currentDayIndex = new Date().getDay();
	// JS getDay(): 0 = Sunday, 1 = Monday...
	const dayMap = [ 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' ];
	const todayString = dayMap[ currentDayIndex ];

	const generalTab = (
		<>
			<PanelBody title={ __( 'Business Hours List', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				{ hours.map( ( hour, index ) => (
					<div key={ index } style={ { marginBottom: '15px', border: '1px solid #ddd', padding: '10px' } }>
						<SelectControl
							label={ __( 'Day', 'blockive-premium-addon-for-block' ) }
							value={ hour.day }
							options={ dayOptions }
							onChange={ ( val ) => updateHour( index, 'day', val ) }
						/>
						<ToggleControl
							label={ __( 'Closed', 'blockive-premium-addon-for-block' ) }
							checked={ hour.isClosed }
							onChange={ ( val ) => updateHour( index, 'isClosed', val ) }
						/>
						{ hour.isClosed ? (
							<TextControl
								label={ __( 'Closed Text', 'blockive-premium-addon-for-block' ) }
								value={ hour.closedText }
								onChange={ ( val ) => updateHour( index, 'closedText', val ) }
							/>
						) : (
							<>
								<TextControl
									label={ __( 'Open Time', 'blockive-premium-addon-for-block' ) }
									type="time"
									value={ hour.openTime }
									onChange={ ( val ) => updateHour( index, 'openTime', val ) }
								/>
								<TextControl
									label={ __( 'Close Time', 'blockive-premium-addon-for-block' ) }
									type="time"
									value={ hour.closeTime }
									onChange={ ( val ) => updateHour( index, 'closeTime', val ) }
								/>
							</>
						) }
						<Button isDestructive onClick={ () => removeHour( index ) }>
							{ __( 'Remove Item', 'blockive-premium-addon-for-block' ) }
						</Button>
					</div>
				) ) }
				<Button isPrimary onClick={ addHour }>
					{ __( 'Add Item', 'blockive-premium-addon-for-block' ) }
				</Button>
			</PanelBody>

			<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<TextControl
					label={ __( 'Title', 'blockive-premium-addon-for-block' ) }
					value={ title }
					onChange={ ( val ) => setAttributes( { title: val } ) }
				/>
				<ToggleControl
					label={ __( 'Highlight Today', 'blockive-premium-addon-for-block' ) }
					checked={ highlightToday }
					onChange={ ( val ) => setAttributes( { highlightToday: val } ) }
				/>
				<SegmentedControl
					label={ __( 'Time Format', 'blockive-premium-addon-for-block' ) }
					value={ timeFormat }
					options={ [
						{ label: '12 Hour', value: '12' },
						{ label: '24 Hour', value: '24' },
					] }
					onChange={ ( val ) => setAttributes( { timeFormat: val } ) }
				/>
			</PanelBody>
		</>
	);

	const colorNormalFields = [
		{ label: __( 'Title Color', 'blockive-premium-addon-for-block' ), value: titleColor, onChange: ( val ) => setAttributes( { titleColor: val } ) },
		{ label: __( 'Container Background', 'blockive-premium-addon-for-block' ), value: containerBgColor, onChange: ( val ) => setAttributes( { containerBgColor: val } ) },
		{ label: __( 'Item Background', 'blockive-premium-addon-for-block' ), value: itemBgColor, onChange: ( val ) => setAttributes( { itemBgColor: val } ) },
		{ label: __( 'Item Text Color', 'blockive-premium-addon-for-block' ), value: itemTextColor, onChange: ( val ) => setAttributes( { itemTextColor: val } ) },
		{ label: __( 'Closed Tag Color', 'blockive-premium-addon-for-block' ), value: closedColor, onChange: ( val ) => setAttributes( { closedColor: val } ) },
	];

	if ( highlightToday ) {
		colorNormalFields.push(
			{ label: __( 'Today Background', 'blockive-premium-addon-for-block' ), value: todayBgColor, onChange: ( val ) => setAttributes( { todayBgColor: val } ) },
			{ label: __( 'Today Text Color', 'blockive-premium-addon-for-block' ), value: todayTextColor, onChange: ( val ) => setAttributes( { todayTextColor: val } ) }
		);
	}

	const styleTab = (
		<>
			<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<ColorStateControls
					normal={ colorNormalFields }
					hover={ [
						{ label: __( 'Item Background (Hover)', 'blockive-premium-addon-for-block' ), value: itemBgColorHover, onChange: ( val ) => setAttributes( { itemBgColorHover: val } ) },
						{ label: __( 'Item Text Color (Hover)', 'blockive-premium-addon-for-block' ), value: itemTextColorHover, onChange: ( val ) => setAttributes( { itemTextColorHover: val } ) },
					] }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Day Typography', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<TypographyControls
					values={ { fontFamily: dayFontFamily, fontSize: dayFontSize, fontWeight: dayFontWeight, lineHeight: dayLineHeight, letterSpacing: dayLetterSpacing, textTransform: dayTextTransform, textDecoration: dayTextDecoration } }
					onChange={ ( key, val ) => setAttributes( { [ `day${ key.charAt( 0 ).toUpperCase() }${ key.slice( 1 ) }` ]: val } ) }
					fontSizeUnit={ dayFontSizeUnit }
					onFontSizeUnitChange={ ( val ) => setAttributes( { dayFontSizeUnit: val } ) }
					letterSpacingUnit={ dayLetterSpacingUnit }
					onLetterSpacingUnitChange={ ( val ) => setAttributes( { dayLetterSpacingUnit: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Time Typography', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<TypographyControls
					values={ { fontFamily: timeFontFamily, fontSize: timeFontSize, fontWeight: timeFontWeight, lineHeight: timeLineHeight, letterSpacing: timeLetterSpacing, textTransform: timeTextTransform, textDecoration: timeTextDecoration } }
					onChange={ ( key, val ) => setAttributes( { [ `time${ key.charAt( 0 ).toUpperCase() }${ key.slice( 1 ) }` ]: val } ) }
					fontSizeUnit={ timeFontSizeUnit }
					onFontSizeUnitChange={ ( val ) => setAttributes( { timeFontSizeUnit: val } ) }
					letterSpacingUnit={ timeLetterSpacingUnit }
					onLetterSpacingUnitChange={ ( val ) => setAttributes( { timeLetterSpacingUnit: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Container Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<BorderControls
					values={ { borderType, borderWidth, borderRadius, borderColor } }
					onChange={ ( key, val ) => setAttributes( { [ key ]: val } ) }
					widthUnit={ borderWidthUnit }
					onWidthUnitChange={ ( val ) => setAttributes( { borderWidthUnit: val } ) }
					radiusUnit={ borderRadiusUnit }
					onRadiusUnitChange={ ( val ) => setAttributes( { borderRadiusUnit: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Container Shadow', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
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
				<div className="bpafb-business-hours-container">
					<RichText
						tagName="h3"
						className="bpafb-business-hours-title"
						value={ title }
						onChange={ ( val ) => setAttributes( { title: val } ) }
						placeholder={ __( 'Business Hours', 'blockive-premium-addon-for-block' ) }
					/>

					<div className="bpafb-business-hours-list">
						{ hours.map( ( hour, index ) => {
							const isToday = highlightToday && hour.day === todayString;
							const itemClass = `bpafb-business-hours-item ${ isToday ? 'today' : '' }`;

							const dayLabel = dayOptions.find( ( d ) => d.value === hour.day )?.label || hour.day;

							return (
								<div key={ index } className={ itemClass } data-day={ hour.day }>
									<span className="bpafb-business-hours-day">{ dayLabel }</span>

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
		</>
	);
}
