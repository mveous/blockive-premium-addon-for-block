import { __ } from '@wordpress/i18n';
import { SelectControl, RangeControl, TextControl } from '@wordpress/components';

const WEIGHT_OPTIONS = [
	{ label: __( 'Default', 'blockive-premium-addon-for-block' ), value: '' },
	{ label: '100', value: '100' },
	{ label: '200', value: '200' },
	{ label: '300', value: '300' },
	{ label: '400 (Normal)', value: '400' },
	{ label: '500', value: '500' },
	{ label: '600', value: '600' },
	{ label: '700 (Bold)', value: '700' },
	{ label: '800', value: '800' },
	{ label: '900', value: '900' },
];

const TRANSFORM_OPTIONS = [
	{ label: __( 'Default', 'blockive-premium-addon-for-block' ), value: '' },
	{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
	{ label: __( 'Uppercase', 'blockive-premium-addon-for-block' ), value: 'uppercase' },
	{ label: __( 'Lowercase', 'blockive-premium-addon-for-block' ), value: 'lowercase' },
	{ label: __( 'Capitalize', 'blockive-premium-addon-for-block' ), value: 'capitalize' },
];

const DECORATION_OPTIONS = [
	{ label: __( 'Default', 'blockive-premium-addon-for-block' ), value: '' },
	{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
	{ label: __( 'Underline', 'blockive-premium-addon-for-block' ), value: 'underline' },
	{ label: __( 'Line Through', 'blockive-premium-addon-for-block' ), value: 'line-through' },
	{ label: __( 'Overline', 'blockive-premium-addon-for-block' ), value: 'overline' },
];

const FONT_SIZE_UNITS = [
	{ label: 'px', value: 'px' },
	{ label: 'em', value: 'em' },
	{ label: 'rem', value: 'rem' },
	{ label: '%', value: '%' },
];
const FONT_SIZE_UNIT_MAX = { em: 8, rem: 8, '%': 400 };

const LETTER_SPACING_UNITS = [
	{ label: 'px', value: 'px' },
	{ label: 'em', value: 'em' },
	{ label: 'rem', value: 'rem' },
];
const LETTER_SPACING_UNIT_MAX = { em: 1, rem: 1 };
const LETTER_SPACING_UNIT_MIN = { em: -0.5, rem: -0.5 };

/**
 * values: { fontFamily, fontSize, fontWeight, lineHeight, letterSpacing, textTransform, textDecoration }
 * onChange( key, value )
 *
 * Pass `fontSizeUnit`/`onFontSizeUnitChange` and/or `letterSpacingUnit`/
 * `onLetterSpacingUnitChange` to also show a unit picker next to that field,
 * same optional-prop idea as BorderControls' widthUnit/radiusUnit. Callers
 * that omit them keep today's plain, px-only control.
 */
export default function TypographyControls( { values = {}, onChange, fontSizeUnit, onFontSizeUnitChange, letterSpacingUnit, onLetterSpacingUnitChange } ) {
	const {
		fontFamily = '',
		fontSize,
		fontWeight = '',
		lineHeight,
		letterSpacing,
		textTransform = '',
		textDecoration = '',
	} = values;

	const fontSizeMax = fontSizeUnit && FONT_SIZE_UNIT_MAX[ fontSizeUnit ] ? FONT_SIZE_UNIT_MAX[ fontSizeUnit ] : 120;
	const letterSpacingMax = letterSpacingUnit && LETTER_SPACING_UNIT_MAX[ letterSpacingUnit ] ? LETTER_SPACING_UNIT_MAX[ letterSpacingUnit ] : 20;
	const letterSpacingMin = letterSpacingUnit && LETTER_SPACING_UNIT_MIN[ letterSpacingUnit ] !== undefined ? LETTER_SPACING_UNIT_MIN[ letterSpacingUnit ] : -5;

	return (
		<>
			<TextControl
				label={ __( 'Font Family', 'blockive-premium-addon-for-block' ) }
				value={ fontFamily }
				onChange={ ( val ) => onChange( 'fontFamily', val ) }
				help={ __( "e.g. 'Poppins', sans-serif", 'blockive-premium-addon-for-block' ) }
			/>
			{ onFontSizeUnitChange ? (
				<div style={ { display: 'flex', gap: '10px', alignItems: 'flex-end' } }>
					<div style={ { flexGrow: 1 } }>
						<RangeControl
							label={ __( 'Font Size', 'blockive-premium-addon-for-block' ) }
							value={ fontSize }
							onChange={ ( val ) => onChange( 'fontSize', val ) }
							min={ 8 }
							max={ fontSizeMax }
						/>
					</div>
					<div style={ { width: '80px', marginBottom: '16px' } }>
						<SelectControl
							label={ __( 'Unit', 'blockive-premium-addon-for-block' ) }
							value={ fontSizeUnit || 'px' }
							options={ FONT_SIZE_UNITS }
							onChange={ onFontSizeUnitChange }
						/>
					</div>
				</div>
			) : (
				<RangeControl
					label={ __( 'Font Size (px)', 'blockive-premium-addon-for-block' ) }
					value={ fontSize }
					onChange={ ( val ) => onChange( 'fontSize', val ) }
					min={ 8 }
					max={ 120 }
				/>
			) }
			<SelectControl
				label={ __( 'Font Weight', 'blockive-premium-addon-for-block' ) }
				value={ fontWeight }
				options={ WEIGHT_OPTIONS }
				onChange={ ( val ) => onChange( 'fontWeight', val ) }
			/>
			<RangeControl
				label={ __( 'Line Height', 'blockive-premium-addon-for-block' ) }
				value={ lineHeight }
				onChange={ ( val ) => onChange( 'lineHeight', val ) }
				min={ 0.5 }
				max={ 3 }
				step={ 0.1 }
			/>
			{ onLetterSpacingUnitChange ? (
				<div style={ { display: 'flex', gap: '10px', alignItems: 'flex-end' } }>
					<div style={ { flexGrow: 1 } }>
						<RangeControl
							label={ __( 'Letter Spacing', 'blockive-premium-addon-for-block' ) }
							value={ letterSpacing }
							onChange={ ( val ) => onChange( 'letterSpacing', val ) }
							min={ letterSpacingMin }
							max={ letterSpacingMax }
							step={ letterSpacingUnit === 'em' || letterSpacingUnit === 'rem' ? 0.01 : 0.5 }
						/>
					</div>
					<div style={ { width: '80px', marginBottom: '16px' } }>
						<SelectControl
							label={ __( 'Unit', 'blockive-premium-addon-for-block' ) }
							value={ letterSpacingUnit || 'px' }
							options={ LETTER_SPACING_UNITS }
							onChange={ onLetterSpacingUnitChange }
						/>
					</div>
				</div>
			) : (
				<RangeControl
					label={ __( 'Letter Spacing (px)', 'blockive-premium-addon-for-block' ) }
					value={ letterSpacing }
					onChange={ ( val ) => onChange( 'letterSpacing', val ) }
					min={ -5 }
					max={ 20 }
					step={ 0.5 }
				/>
			) }
			<SelectControl
				label={ __( 'Text Transform', 'blockive-premium-addon-for-block' ) }
				value={ textTransform }
				options={ TRANSFORM_OPTIONS }
				onChange={ ( val ) => onChange( 'textTransform', val ) }
			/>
			<SelectControl
				label={ __( 'Text Decoration', 'blockive-premium-addon-for-block' ) }
				value={ textDecoration }
				options={ DECORATION_OPTIONS }
				onChange={ ( val ) => onChange( 'textDecoration', val ) }
			/>
		</>
	);
}

/**
 * Turns a typography values object into a CSS custom-property-friendly style object.
 * `prefix` is the CSS variable prefix, e.g. '--bpafb-btn-text'.
 */
export function getTypographyStyles( values = {}, prefix ) {
	const {
		fontFamily,
		fontSize,
		fontSizeUnit = 'px',
		fontWeight,
		lineHeight,
		letterSpacing,
		letterSpacingUnit = 'px',
		textTransform,
		textDecoration,
	} = values;

	const styles = {};
	if ( fontFamily ) styles[ `${ prefix }-font-family` ] = fontFamily;
	if ( fontSize !== undefined && fontSize !== null ) styles[ `${ prefix }-font-size` ] = `${ fontSize }${ fontSizeUnit }`;
	if ( fontWeight ) styles[ `${ prefix }-font-weight` ] = fontWeight;
	if ( lineHeight !== undefined && lineHeight !== null ) styles[ `${ prefix }-line-height` ] = lineHeight;
	if ( letterSpacing !== undefined && letterSpacing !== null ) styles[ `${ prefix }-letter-spacing` ] = `${ letterSpacing }${ letterSpacingUnit }`;
	if ( textTransform ) styles[ `${ prefix }-text-transform` ] = textTransform;
	if ( textDecoration ) styles[ `${ prefix }-text-decoration` ] = textDecoration;
	return styles;
}
