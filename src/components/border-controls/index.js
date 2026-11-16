import { __ } from '@wordpress/i18n';
import { SelectControl, RangeControl, BaseControl, ColorPalette } from '@wordpress/components';

const TYPE_OPTIONS = [
	{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
	{ label: __( 'Solid', 'blockive-premium-addon-for-block' ), value: 'solid' },
	{ label: __( 'Dashed', 'blockive-premium-addon-for-block' ), value: 'dashed' },
	{ label: __( 'Dotted', 'blockive-premium-addon-for-block' ), value: 'dotted' },
	{ label: __( 'Double', 'blockive-premium-addon-for-block' ), value: 'double' },
];

const WIDTH_UNITS = [
	{ label: 'px', value: 'px' },
	{ label: 'em', value: 'em' },
	{ label: 'rem', value: 'rem' },
];

const RADIUS_UNITS = [
	{ label: 'px', value: 'px' },
	{ label: '%', value: '%' },
	{ label: 'em', value: 'em' },
	{ label: 'rem', value: 'rem' },
];

const WIDTH_UNIT_MAX = { em: 5, rem: 5 };
const RADIUS_UNIT_MAX = { '%': 50, em: 20, rem: 20 };

/**
 * values: { borderType, borderWidth, borderRadius, borderColor }
 * onChange( key, value )
 *
 * Pass `widthUnit`/`onWidthUnitChange` and/or `radiusUnit`/`onRadiusUnitChange`
 * to also show a px/em/rem (width) or px/%/em/rem (radius) unit picker next
 * to that field, same idea as SpacingControls' optional unit prop. Callers
 * that omit them keep today's plain, px-only control.
 */
export default function BorderControls( { values = {}, onChange, showRadius = true, widthUnit, onWidthUnitChange, radiusUnit, onRadiusUnitChange } ) {
	const { borderType = 'none', borderWidth, borderRadius, borderColor = '' } = values;

	const widthMax = widthUnit && WIDTH_UNIT_MAX[ widthUnit ] ? WIDTH_UNIT_MAX[ widthUnit ] : 20;
	const radiusMax = radiusUnit && RADIUS_UNIT_MAX[ radiusUnit ] ? RADIUS_UNIT_MAX[ radiusUnit ] : 150;

	return (
		<>
			<SelectControl
				label={ __( 'Border Type', 'blockive-premium-addon-for-block' ) }
				value={ borderType }
				options={ TYPE_OPTIONS }
				onChange={ ( val ) => onChange( 'borderType', val ) }
			/>
			{ borderType !== 'none' && (
				<>
					{ onWidthUnitChange ? (
						<div style={ { display: 'flex', gap: '10px', alignItems: 'flex-end' } }>
							<div style={ { flexGrow: 1 } }>
								<RangeControl
									label={ __( 'Border Width', 'blockive-premium-addon-for-block' ) }
									value={ borderWidth }
									onChange={ ( val ) => onChange( 'borderWidth', val ) }
									min={ 0 }
									max={ widthMax }
								/>
							</div>
							<div style={ { width: '80px', marginBottom: '16px' } }>
								<SelectControl
									label={ __( 'Unit', 'blockive-premium-addon-for-block' ) }
									value={ widthUnit || 'px' }
									options={ WIDTH_UNITS }
									onChange={ onWidthUnitChange }
								/>
							</div>
						</div>
					) : (
						<RangeControl
							label={ __( 'Border Width (px)', 'blockive-premium-addon-for-block' ) }
							value={ borderWidth }
							onChange={ ( val ) => onChange( 'borderWidth', val ) }
							min={ 0 }
							max={ 20 }
						/>
					) }
					<BaseControl label={ __( 'Border Color', 'blockive-premium-addon-for-block' ) }>
						<ColorPalette value={ borderColor } onChange={ ( val ) => onChange( 'borderColor', val ) } />
					</BaseControl>
				</>
			) }
			{ showRadius && ( onRadiusUnitChange ? (
				<div style={ { display: 'flex', gap: '10px', alignItems: 'flex-end' } }>
					<div style={ { flexGrow: 1 } }>
						<RangeControl
							label={ __( 'Border Radius', 'blockive-premium-addon-for-block' ) }
							value={ borderRadius }
							onChange={ ( val ) => onChange( 'borderRadius', val ) }
							min={ 0 }
							max={ radiusMax }
						/>
					</div>
					<div style={ { width: '80px', marginBottom: '16px' } }>
						<SelectControl
							label={ __( 'Unit', 'blockive-premium-addon-for-block' ) }
							value={ radiusUnit || 'px' }
							options={ RADIUS_UNITS }
							onChange={ onRadiusUnitChange }
						/>
					</div>
				</div>
			) : (
				<RangeControl
					label={ __( 'Border Radius (px)', 'blockive-premium-addon-for-block' ) }
					value={ borderRadius }
					onChange={ ( val ) => onChange( 'borderRadius', val ) }
					min={ 0 }
					max={ 150 }
				/>
			) ) }
		</>
	);
}

export function getBorderStyles( values = {}, prefix ) {
	const { borderType = 'none', borderWidth, borderRadius, borderColor, borderWidthUnit = 'px', borderRadiusUnit = 'px' } = values;
	const styles = {};
	if ( borderType && borderType !== 'none' ) {
		styles[ `${ prefix }-border-style` ] = borderType;
		if ( borderWidth !== undefined && borderWidth !== null ) styles[ `${ prefix }-border-width` ] = `${ borderWidth }${ borderWidthUnit }`;
		if ( borderColor ) styles[ `${ prefix }-border-color` ] = borderColor;
	} else {
		styles[ `${ prefix }-border-style` ] = 'none';
	}
	if ( borderRadius !== undefined && borderRadius !== null ) styles[ `${ prefix }-border-radius` ] = `${ borderRadius }${ borderRadiusUnit }`;
	return styles;
}
