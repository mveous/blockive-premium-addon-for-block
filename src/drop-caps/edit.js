import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	BlockControls,
	AlignmentControl,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl, RangeControl } from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';
import ColorStateControls from '../components/color-state-controls';
import TypographyControls, { getTypographyStyles } from '../components/typography-controls';
import BorderControls from '../components/border-controls';
import ShadowControls, { getShadowStyle } from '../components/shadow-controls';

export default function Edit( { attributes, setAttributes } ) {
	const {
		content,
		view,
		shape,
		primaryColor,
		secondaryColor,
		size,
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
		...getTypographyStyles( { fontFamily, fontSize: size, fontWeight, lineHeight, letterSpacing, textTransform, textDecoration }, '--bpafb-dc-letter' ),
	};

	const blockProps = useBlockProps( {
		className: `has-drop-cap is-view-${ view } is-shape-${ shape }`,
		style: customStyles,
	} );

	const generalTab = (
		<PanelBody title={ __( 'Drop Cap Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
			<SegmentedControl
				label={ __( 'View', 'blockive-premium-addon-for-block' ) }
				value={ view }
				options={ [
					{ label: 'Default', value: 'default' },
					{ label: 'Stacked', value: 'stacked' },
					{ label: 'Framed', value: 'framed' },
				] }
				onChange={ ( val ) => setAttributes( { view: val } ) }
			/>

			{ view !== 'default' && (
				<SegmentedControl
					label={ __( 'Shape', 'blockive-premium-addon-for-block' ) }
					value={ shape }
					options={ [
						{ label: 'Square', value: 'square' },
						{ label: 'Rounded', value: 'rounded' },
						{ label: 'Circle', value: 'circle' },
					] }
					onChange={ ( val ) => setAttributes( { shape: val } ) }
				/>
			) }
		</PanelBody>
	);

	const styleTab = (
		<>
			<PanelBody title={ __( 'Typography', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<TypographyControls
					values={ { fontFamily, fontSize: size, fontWeight, lineHeight, letterSpacing, textTransform, textDecoration } }
					onChange={ ( key, val ) => setAttributes( key === 'fontSize' ? { size: val } : { [ key ]: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<ColorStateControls
					normal={ [
						{ label: __( 'Letter Color', 'blockive-premium-addon-for-block' ), value: secondaryColor, onChange: ( val ) => setAttributes( { secondaryColor: val } ) },
						...( view === 'stacked'
							? [ { label: __( 'Background Color', 'blockive-premium-addon-for-block' ), value: primaryColor, onChange: ( val ) => setAttributes( { primaryColor: val } ) } ]
							: [] ),
					] }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Spacing', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<RangeControl
					label={ __( 'Space', 'blockive-premium-addon-for-block' ) }
					value={ space }
					onChange={ ( val ) => setAttributes( { space: val } ) }
					min={ 0 }
					max={ 100 }
				/>

				{ view !== 'default' && (
					<>
						<RangeControl
							label={ __( 'Padding', 'blockive-premium-addon-for-block' ) }
							value={ dropCapPadding }
							onChange={ ( val ) => setAttributes( { dropCapPadding: val } ) }
							min={ 0 }
							max={ 100 }
						/>
						<RangeControl
							label={ __( 'Corner Radius', 'blockive-premium-addon-for-block' ) }
							value={ borderRadius }
							onChange={ ( val ) => setAttributes( { borderRadius: val } ) }
							min={ 0 }
							max={ 100 }
							help={ __( 'Leave at 0 to use the Shape setting.', 'blockive-premium-addon-for-block' ) }
						/>
					</>
				) }
			</PanelBody>

			{ view === 'framed' && (
				<PanelBody title={ __( 'Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<BorderControls
						values={ { borderType, borderWidth, borderColor: primaryColor } }
						showRadius={ false }
						onChange={ ( key, val ) => setAttributes( key === 'borderColor' ? { primaryColor: val } : { [ key ]: val } ) }
					/>
				</PanelBody>
			) }

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
			<BlockControls>
				<AlignmentControl
					value={ alignment }
					onChange={ ( newAlign ) => setAttributes( { alignment: newAlign } ) }
				/>
			</BlockControls>

			<InspectorTabs
				general={ generalTab }
				style={ styleTab }
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<RichText
				{ ...blockProps }
				tagName="p"
				value={ content }
				onChange={ ( val ) => setAttributes( { content: val } ) }
				placeholder={ __( 'Enter text here...', 'blockive-premium-addon-for-block' ) }
			/>
		</>
	);
}
