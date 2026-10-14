import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	RichText,
	BlockControls,
	AlignmentControl,
} from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	ColorPalette,
	BaseControl,
	TextControl,
	Button,
} from '@wordpress/components';
import { useState } from '@wordpress/element';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';
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
		borderType,
		borderRadius,
		titleColorHover,
		titleBgColorHover,
		questionFontFamily,
		questionFontSize,
		questionFontWeight,
		questionLineHeight,
		questionLetterSpacing,
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

	const [ activeIndex, setActiveIndex ] = useState( 0 );

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
				fontWeight: questionFontWeight,
				lineHeight: questionLineHeight,
				letterSpacing: questionLetterSpacing,
				textTransform: questionTextTransform,
				textDecoration: questionTextDecoration,
			},
			'--bpafb-faq-title'
		),
		...getBorderStyles( { borderType, borderWidth, borderRadius, borderColor }, '--bpafb-faq' ),
	};

	if ( animationType !== 'none' ) {
		customStyles.animationDuration = animationDuration;
		customStyles.animationDelay = animationDelay;
	}

	const blockProps = useBlockProps( {
		className: `bpafb-faq-wrapper ${ animationType !== 'none' ? `bpafb-animate-${ animationType }` : '' }`,
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
					title: `Frequently Asked Question #${ items.length + 1 }`,
					content: 'Enter answer here...',
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
			<PanelBody title={ __( 'FAQ Items', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				{ items.map( ( item, index ) => (
					<div key={ item.id } style={ { marginBottom: '15px', border: '1px solid #ddd', padding: '10px' } }>
						<TextControl
							label={ __( 'Question', 'blockive-premium-addon-for-block' ) }
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

			<PanelBody title={ __( 'Main Heading Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<SelectControl
					label={ __( 'Heading Tag', 'blockive-premium-addon-for-block' ) }
					value={ headingTag }
					options={ [
						{ label: 'H2', value: 'h2' },
						{ label: 'H3', value: 'h3' },
						{ label: 'H4', value: 'h4' },
						{ label: 'H5', value: 'h5' },
						{ label: 'H6', value: 'h6' },
						{ label: 'div', value: 'div' },
					] }
					onChange={ ( val ) => setAttributes( { headingTag: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<p style={ { marginBottom: '15px' } }>
					<em>{ __( 'Note: FAQ Schema payload is automatically generated and added to the page.', 'blockive-premium-addon-for-block' ) }</em>
				</p>
				<SelectControl
					label={ __( 'Title HTML Tag', 'blockive-premium-addon-for-block' ) }
					value={ titleTag }
					options={ [
						{ label: 'H2', value: 'h2' },
						{ label: 'H3', value: 'h3' },
						{ label: 'H4', value: 'h4' },
						{ label: 'H5', value: 'h5' },
						{ label: 'H6', value: 'h6' },
						{ label: 'div', value: 'div' },
						{ label: 'span', value: 'span' },
						{ label: 'p', value: 'p' },
					] }
					onChange={ ( val ) => setAttributes( { titleTag: val } ) }
				/>
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
			<PanelBody title={ __( 'Question Typography', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<TypographyControls
					values={ {
						fontFamily: questionFontFamily,
						fontSize: questionFontSize,
						fontWeight: questionFontWeight,
						lineHeight: questionLineHeight,
						letterSpacing: questionLetterSpacing,
						textTransform: questionTextTransform,
						textDecoration: questionTextDecoration,
					} }
					onChange={ ( key, val ) => setAttributes( { [ `question${ key.charAt( 0 ).toUpperCase() }${ key.slice( 1 ) }` ]: val } ) }
				/>
			</PanelBody>

			<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
				<ColorStateControls
					normal={ [
						{ label: __( 'Heading Color', 'blockive-premium-addon-for-block' ), value: headingColor, onChange: ( val ) => setAttributes( { headingColor: val } ) },
						{ label: __( 'Question Color', 'blockive-premium-addon-for-block' ), value: titleColor, onChange: ( val ) => setAttributes( { titleColor: val } ) },
						{ label: __( 'Question Background', 'blockive-premium-addon-for-block' ), value: titleBgColor, onChange: ( val ) => setAttributes( { titleBgColor: val } ) },
						{ label: __( 'Answer Color', 'blockive-premium-addon-for-block' ), value: contentColor, onChange: ( val ) => setAttributes( { contentColor: val } ) },
						{ label: __( 'Answer Background', 'blockive-premium-addon-for-block' ), value: contentBgColor, onChange: ( val ) => setAttributes( { contentBgColor: val } ) },
					] }
					hover={ [
						{ label: __( 'Question Hover Color', 'blockive-premium-addon-for-block' ), value: titleColorHover, onChange: ( val ) => setAttributes( { titleColorHover: val } ) },
						{ label: __( 'Question Hover Background', 'blockive-premium-addon-for-block' ), value: titleBgColorHover, onChange: ( val ) => setAttributes( { titleBgColorHover: val } ) },
					] }
				/>
				<BaseControl
					label={ __( 'Active (Open) Question Color', 'blockive-premium-addon-for-block' ) }
					help={ __( 'Color applied to the question while its answer is expanded.', 'blockive-premium-addon-for-block' ) }
				>
					<ColorPalette value={ titleActiveColor } onChange={ ( val ) => setAttributes( { titleActiveColor: val } ) } />
				</BaseControl>
			</PanelBody>

			<PanelBody title={ __( 'Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<BorderControls
					values={ { borderType, borderWidth, borderRadius, borderColor } }
					onChange={ ( key, val ) => setAttributes( { [ key ]: val } ) }
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

			<PanelBody title={ __( 'Animation', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
				<SelectControl
					label={ __( 'Animation Type', 'blockive-premium-addon-for-block' ) }
					value={ animationType }
					options={ [
						{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
						{ label: __( 'Fade In', 'blockive-premium-addon-for-block' ), value: 'fadeIn' },
						{ label: __( 'Fade In Up', 'blockive-premium-addon-for-block' ), value: 'fadeInUp' },
						{ label: __( 'Fade In Down', 'blockive-premium-addon-for-block' ), value: 'fadeInDown' },
						{ label: __( 'Zoom In', 'blockive-premium-addon-for-block' ), value: 'zoomIn' },
						{ label: __( 'Slide In Left', 'blockive-premium-addon-for-block' ), value: 'slideInLeft' },
						{ label: __( 'Slide In Right', 'blockive-premium-addon-for-block' ), value: 'slideInRight' },
					] }
					onChange={ ( val ) => setAttributes( { animationType: val } ) }
				/>
				{ animationType !== 'none' && (
					<>
						<TextControl
							label={ __( 'Animation Duration', 'blockive-premium-addon-for-block' ) }
							help={ __( 'e.g., 1s, 500ms', 'blockive-premium-addon-for-block' ) }
							value={ animationDuration }
							onChange={ ( val ) => setAttributes( { animationDuration: val } ) }
						/>
						<TextControl
							label={ __( 'Animation Delay', 'blockive-premium-addon-for-block' ) }
							help={ __( 'e.g., 0s, 200ms', 'blockive-premium-addon-for-block' ) }
							value={ animationDelay }
							onChange={ ( val ) => setAttributes( { animationDelay: val } ) }
						/>
					</>
				) }
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

			<BlockControls>
				<AlignmentControl
					value={ headingAlign }
					onChange={ ( newAlign ) => setAttributes( { headingAlign: newAlign } ) }
				/>
			</BlockControls>

			<div { ...blockProps }>
				<RichText
					tagName={ headingTag }
					className="bpafb-faq-main-heading"
					style={ { textAlign: headingAlign, color: headingColor, marginBottom: '20px' } }
					value={ headingText }
					onChange={ ( val ) => setAttributes( { headingText: val } ) }
					placeholder={ __( 'Enter FAQ Heading...', 'blockive-premium-addon-for-block' ) }
				/>
				{ items.map( ( item, index ) => {
					const isActive = activeIndex === index;

					let iconElement = null;
					if ( icon !== 'none' ) {
						if ( icon === 'plus-minus' ) {
							iconElement = <span className="bpafb-faq-icon"><i className={ isActive ? 'fas fa-minus' : 'fas fa-plus' }></i></span>;
						} else if ( icon === 'chevron' ) {
							iconElement = <span className="bpafb-faq-icon"><i className={ isActive ? 'fas fa-chevron-up' : 'fas fa-chevron-down' }></i></span>;
						} else if ( icon === 'angle' ) {
							iconElement = <span className="bpafb-faq-icon"><i className={ isActive ? 'fas fa-angle-up' : 'fas fa-angle-down' }></i></span>;
						}
					}

					return (
						<div key={ item.id } className={ `bpafb-faq-item ${ isActive ? 'active' : '' }` }>
							<div
								className={ `bpafb-faq-header flex-align-${ iconAlign }` }
								role="button"
								tabIndex={ 0 }
								aria-expanded={ isActive }
								aria-controls={ `bpafb-faq-content-${ item.id }` }
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
									tagName={ titleTag }
									className="bpafb-faq-title"
									value={ item.title }
									onChange={ ( val ) => updateItem( index, 'title', val ) }
									placeholder={ __( 'Question...', 'blockive-premium-addon-for-block' ) }
								/>
								{ iconAlign === 'right' && iconElement }
							</div>
							{ isActive && (
								<div className="bpafb-faq-content" id={ `bpafb-faq-content-${ item.id }` }>
									<RichText
										tagName="p"
										value={ item.content }
										onChange={ ( val ) => updateItem( index, 'content', val ) }
										placeholder={ __( 'Answer...', 'blockive-premium-addon-for-block' ) }
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
