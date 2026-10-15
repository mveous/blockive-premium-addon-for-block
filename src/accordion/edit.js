import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
} from '@wordpress/components';
import { useState } from '@wordpress/element';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import ColorStateControls from '../components/color-state-controls';
import TypographyControls, { getTypographyStyles } from '../components/typography-controls';
import BorderControls, { getBorderStyles } from '../components/border-controls';
import ShadowControls, { getShadowStyle } from '../components/shadow-controls';

export default function Edit( { attributes, setAttributes } ) {
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

	const [ activeIndex, setActiveIndex ] = useState( 0 );

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

	const blockProps = useBlockProps( {
		className: `bpafb-accordion-wrapper ${ animationType !== 'none' ? `bpafb-animate-${ animationType }` : '' }`,
		style: customStyles,
	} );

	const updateItem = ( index, key, value ) => {
		const newItems = [ ...items ];
		newItems[ index ] = { ...newItems[ index ], [ key ]: value };
		setAttributes( { items: newItems } );
	};

	const addItem = () => {
		setAttributes( {
			items: [
				...items,
				{
					id: Date.now().toString(),
					title: `Accordion Item #${ items.length + 1 }`,
					content: 'Enter content here...',
				},
			],
		} );
		setActiveIndex( items.length );
	};

	const removeItem = ( index ) => {
		const newItems = items.filter( ( _, i ) => i !== index );
		setAttributes( { items: newItems } );
		setActiveIndex( 0 );
	};

	const generalTab = (
		<>
			<PanelBody title={ __( 'Accordion Items', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				{ items.map( ( item, index ) => (
					<div key={ item.id } style={ { marginBottom: '15px', border: '1px solid #ddd', padding: '10px' } }>
						<TextControl
							label={ __( 'Title', 'blockive-premium-addon-for-block' ) }
							value={ item.title }
							onChange={ ( val ) => updateItem( index, 'title', val ) }
						/>
						<Button isDestructive onClick={ () => removeItem( index ) }>
							{ __( 'Remove Item', 'blockive-premium-addon-for-block' ) }
						</Button>
					</div>
				) ) }
				<Button isPrimary onClick={ addItem }>
					{ __( 'Add Item', 'blockive-premium-addon-for-block' ) }
				</Button>
			</PanelBody>

			<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<SegmentedControl
					label={ __( 'Icon', 'blockive-premium-addon-for-block' ) }
					value={ icon }
					options={ [
						{ label: 'Plus / Minus', value: 'plus-minus' },
						{ label: 'Chevron', value: 'chevron' },
						{ label: 'Angle', value: 'angle' },
						{ label: 'None', value: 'none' },
					] }
					onChange={ ( val ) => setAttributes( { icon: val } ) }
				/>
				<SegmentedControl
					label={ __( 'Icon Alignment', 'blockive-premium-addon-for-block' ) }
					value={ iconAlign }
					options={ [
						{ label: 'Left', value: 'left' },
						{ label: 'Right', value: 'right' },
					] }
					onChange={ ( val ) => setAttributes( { iconAlign: val } ) }
				/>
			</PanelBody>
		</>
	);

	const styleTab = (
		<>
			<PanelBody title={ __( 'Title Typography', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<TypographyControls
					values={ { fontFamily: titleFontFamily, fontSize: titleFontSize, fontWeight: titleFontWeight, lineHeight: titleLineHeight, letterSpacing: titleLetterSpacing, textTransform: titleTextTransform, textDecoration: titleTextDecoration } }
					onChange={ ( key, val ) => setAttributes( { [ `title${ key.charAt( 0 ).toUpperCase() }${ key.slice( 1 ) }` ]: val } ) }
					fontSizeUnit={ titleFontSizeUnit }
					onFontSizeUnitChange={ ( val ) => setAttributes( { titleFontSizeUnit: val } ) }
					letterSpacingUnit={ titleLetterSpacingUnit }
					onLetterSpacingUnitChange={ ( val ) => setAttributes( { titleLetterSpacingUnit: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<ColorStateControls
					normal={ [
						{ label: __( 'Title Color', 'blockive-premium-addon-for-block' ), value: titleColor, onChange: ( val ) => setAttributes( { titleColor: val } ) },
						{ label: __( 'Title Background', 'blockive-premium-addon-for-block' ), value: titleBgColor, onChange: ( val ) => setAttributes( { titleBgColor: val } ) },
						{ label: __( 'Content Color', 'blockive-premium-addon-for-block' ), value: contentColor, onChange: ( val ) => setAttributes( { contentColor: val } ) },
						{ label: __( 'Content Background', 'blockive-premium-addon-for-block' ), value: contentBgColor, onChange: ( val ) => setAttributes( { contentBgColor: val } ) },
					] }
					hover={ [
						{ label: __( 'Title Color (Active/Open)', 'blockive-premium-addon-for-block' ), value: titleActiveColor, onChange: ( val ) => setAttributes( { titleActiveColor: val } ) },
					] }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<BorderControls
					values={ { borderType, borderWidth, borderRadius, borderColor } }
					onChange={ ( key, val ) => setAttributes( { [ key ]: val } ) }
					widthUnit={ borderWidthUnit }
					onWidthUnitChange={ ( val ) => setAttributes( { borderWidthUnit: val } ) }
					radiusUnit={ borderRadiusUnit }
					onRadiusUnitChange={ ( val ) => setAttributes( { borderRadiusUnit: val } ) }
				/>
			</PanelBody>

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
			<InspectorTabs
				general={ generalTab }
				style={ styleTab }
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<div { ...blockProps }>
				{ items.map( ( item, index ) => {
					const isActive = activeIndex === index;

					let iconElement = null;
					if ( icon !== 'none' ) {
						if ( icon === 'plus-minus' ) {
							iconElement = <span className="bpafb-accordion-icon"><i className={ isActive ? 'fas fa-minus' : 'fas fa-plus' }></i></span>;
						} else if ( icon === 'chevron' ) {
							iconElement = <span className="bpafb-accordion-icon"><i className={ isActive ? 'fas fa-chevron-up' : 'fas fa-chevron-down' }></i></span>;
						} else if ( icon === 'angle' ) {
							iconElement = <span className="bpafb-accordion-icon"><i className={ isActive ? 'fas fa-angle-up' : 'fas fa-angle-down' }></i></span>;
						}
					}

					return (
						<div key={ item.id } className={ `bpafb-accordion-item ${ isActive ? 'active' : '' }` }>
							<div
								className={ `bpafb-accordion-header flex-align-${ iconAlign }` }
								role="button"
								tabIndex={ 0 }
								aria-expanded={ isActive }
								aria-controls={ `bpafb-accordion-content-${ item.id }` }
								onClick={ () => setActiveIndex( isActive ? -1 : index ) }
								onKeyDown={ ( event ) => {
									if ( event.key === 'Enter' || event.key === ' ' ) {
										event.preventDefault();
										setActiveIndex( isActive ? -1 : index );
									}
								} }
							>
								{ iconAlign === 'left' && iconElement }
								<RichText
									tagName="span"
									className="bpafb-accordion-title"
									value={ item.title }
									onChange={ ( val ) => updateItem( index, 'title', val ) }
									placeholder={ __( 'Title...', 'blockive-premium-addon-for-block' ) }
								/>
								{ iconAlign === 'right' && iconElement }
							</div>
							{ isActive && (
								<div className="bpafb-accordion-content" id={ `bpafb-accordion-content-${ item.id }` }>
									<RichText
										tagName="p"
										value={ item.content }
										onChange={ ( val ) => updateItem( index, 'content', val ) }
										placeholder={ __( 'Content...', 'blockive-premium-addon-for-block' ) }
									/>
								</div>
							) }
						</div>
					);
				} ) }
			</div>
		</>
	);
}
