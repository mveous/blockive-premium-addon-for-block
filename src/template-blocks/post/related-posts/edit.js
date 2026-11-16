import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { PanelBody, RangeControl, SelectControl, ToggleControl } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import SegmentedControl from '../../../components/segmented-control';
import StepperControl from '../../../components/stepper-control';
import ColorStateControls from '../../../components/color-state-controls';
import TypographyControls, { getTypographyStyles } from '../../../components/typography-controls';

const LAYOUT_OPTIONS = [
	{ label: __( 'Grid', 'blockive-premium-addon-for-block' ), value: 'grid' },
	{ label: __( 'Slider', 'blockive-premium-addon-for-block' ), value: 'slider' },
];

const CARD_STYLE_OPTIONS = [
	{ label: __( 'Modern Card (Elevated)', 'blockive-premium-addon-for-block' ), value: 'modern' },
	{ label: __( 'Bordered Clean', 'blockive-premium-addon-for-block' ), value: 'bordered' },
	{ label: __( 'Flat Soft', 'blockive-premium-addon-for-block' ), value: 'flat' },
	{ label: __( 'Minimal Editorial', 'blockive-premium-addon-for-block' ), value: 'minimal' },
];

const CONTENT_TYPE_OPTIONS = [
	{ label: __( 'Limited Words', 'blockive-premium-addon-for-block' ), value: 'limited' },
	{ label: __( 'Full Content', 'blockive-premium-addon-for-block' ), value: 'full' },
	{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
];

const ORDER_BY_OPTIONS = [
	{ label: __( 'Date', 'blockive-premium-addon-for-block' ), value: 'date' },
	{ label: __( 'Title', 'blockive-premium-addon-for-block' ), value: 'title' },
	{ label: __( 'Random', 'blockive-premium-addon-for-block' ), value: 'rand' },
];

const ORDER_OPTIONS = [
	{ label: __( 'Descending', 'blockive-premium-addon-for-block' ), value: 'desc' },
	{ label: __( 'Ascending', 'blockive-premium-addon-for-block' ), value: 'asc' },
];

export default function Edit( { attributes, setAttributes } ) {
	const {
		numberOfPosts = 3,
		layout = 'grid',
		columns = 3,
		gridGap = 24,
		sliderColumns = 3,
		sliderAutoplay = false,
		sliderAutoplaySpeed = 3000,
		sliderLoop = false,
		sliderShowArrows = true,
		sliderShowDots = true,
		sliderSpaceBetween = 20,
		orderBy = 'date',
		order = 'desc',
		sameCategory = true,
		showImage = true,
		showDate = true,
		contentType = 'limited',
		excerptLength = 20,
		cardStyle = 'modern',
		cardBgColor,
		cardBorderRadius = 16,
		cardPadding = 18,
		cardHoverElevation = true,
		imageZoom = true,
		imageBorderRadius = 12,
		titleColor,
		titleHoverColor,
		titleFontFamily,
		titleFontSize,
		titleFontSizeUnit = 'px',
		titleFontWeight,
		titleLineHeight,
		titleLetterSpacing,
		titleLetterSpacingUnit = 'px',
		titleTextTransform,
		titleTextDecoration,
		dateColor,
		excerptColor,
	} = attributes;

	const blockClasses = [
		'bpafb-tb-related-posts',
		`bpafb-tb-related-posts-${ layout }`,
		`bpafb-tb-related-posts--style-${ cardStyle }`,
		cardHoverElevation ? 'bpafb-tb-related-posts--hover-elevation' : '',
		imageZoom ? 'bpafb-tb-related-posts--image-zoom' : '',
	].filter( Boolean ).join( ' ' );

	const blockStyles = {
		width: '100%',
		maxWidth: '100%',
		boxSizing: 'border-box',
		'--bpafb-rp-columns': columns || 3,
		'--bpafb-rp-gap': `${ gridGap ?? 24 }px`,
		'--bpafb-rp-card-bg': cardBgColor || undefined,
		'--bpafb-rp-card-radius': `${ cardBorderRadius ?? 16 }px`,
		'--bpafb-rp-card-padding': `${ cardPadding ?? 18 }px`,
		'--bpafb-rp-image-radius': `${ imageBorderRadius ?? 12 }px`,
		'--bpafb-rp-title-color': titleColor || undefined,
		'--bpafb-rp-title-hover-color': titleHoverColor || undefined,
		'--bpafb-rp-date-color': dateColor || undefined,
		'--bpafb-rp-excerpt-color': excerptColor || undefined,
		...getTypographyStyles(
			{
				fontFamily: titleFontFamily,
				fontSize: titleFontSize,
				fontSizeUnit: titleFontSizeUnit,
				fontWeight: titleFontWeight,
				lineHeight: titleLineHeight,
				letterSpacing: titleLetterSpacing,
				letterSpacingUnit: titleLetterSpacingUnit,
				textTransform: titleTextTransform,
				textDecoration: titleTextDecoration,
			},
			'--bpafb-rp-title'
		),
	};

	const blockProps = useBlockProps( {
		className: blockClasses,
		style: blockStyles,
	} );

	const placeholderCards = Array.from( { length: Math.min( numberOfPosts || 3, 12 ) } );

	const renderCard = ( _, index ) => (
		<article className="bpafb-tb-related-post-card" key={ index }>
			{ showImage && (
				<div className="bpafb-tb-related-post-image bpafb-tb-related-post-image-placeholder">
					<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" opacity="0.4">
						<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
						<circle cx="9" cy="9" r="2"/>
						<path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
					</svg>
				</div>
			) }
			<div className="bpafb-tb-related-post-content">
				{ showDate && (
					<span className="bpafb-tb-related-post-date">
						<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
							<rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
							<line x1="16" x2="16" y1="2" y2="6"/>
							<line x1="8" x2="8" y1="2" y2="6"/>
							<line x1="3" x2="21" y1="10" y2="10"/>
						</svg>
						{ __( 'January 1, 2026', 'blockive-premium-addon-for-block' ) }
					</span>
				) }
				<h3 className="bpafb-tb-related-post-title">
					<a href="#related-post-preview" onClick={ ( event ) => event.preventDefault() }>
						{ __( 'Sample Related Article', 'blockive-premium-addon-for-block' ) } #{ index + 1 }
					</a>
				</h3>
				{ contentType !== 'none' && (
					<div className="bpafb-tb-related-post-excerpt">
						{ contentType === 'full'
							? __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'blockive-premium-addon-for-block' )
							: __( 'Discover insights, modern strategies, and top trends designed to elevate your website and engage your audience.', 'blockive-premium-addon-for-block' )
						}
					</div>
				) }
			</div>
		</article>
	);

	return (
		<>
			<InspectorTabs
				general={
					<>
						<PanelBody title={ __( 'Layout & Style', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
							<SegmentedControl
								label={ __( 'Card Style Preset', 'blockive-premium-addon-for-block' ) }
								value={ cardStyle }
								options={ CARD_STYLE_OPTIONS }
								onChange={ ( value ) => setAttributes( { cardStyle: value } ) }
							/>
							<SegmentedControl
								label={ __( 'Layout Mode', 'blockive-premium-addon-for-block' ) }
								value={ layout }
								options={ LAYOUT_OPTIONS }
								onChange={ ( value ) => setAttributes( { layout: value } ) }
							/>
							<StepperControl
								label={ __( 'Total Posts to Fetch', 'blockive-premium-addon-for-block' ) }
								value={ numberOfPosts }
								onChange={ ( value ) => setAttributes( { numberOfPosts: value } ) }
								min={ 1 }
								max={ 12 }
							/>
							{ layout === 'grid' && (
								<>
									<StepperControl
										label={ __( 'Grid Columns (Desktop)', 'blockive-premium-addon-for-block' ) }
										value={ columns }
										onChange={ ( value ) => setAttributes( { columns: value } ) }
										min={ 1 }
										max={ 6 }
									/>
									<RangeControl
										label={ __( 'Grid Gap (px)', 'blockive-premium-addon-for-block' ) }
										value={ gridGap }
										onChange={ ( value ) => setAttributes( { gridGap: value } ) }
										min={ 0 }
										max={ 60 }
									/>
								</>
							) }
							{ layout === 'slider' && (
								<>
									<StepperControl
										label={ __( 'Slides to Show (Desktop)', 'blockive-premium-addon-for-block' ) }
										value={ sliderColumns }
										onChange={ ( value ) => setAttributes( { sliderColumns: value } ) }
										min={ 1 }
										max={ 4 }
									/>
									<RangeControl
										label={ __( 'Space Between Slides (px)', 'blockive-premium-addon-for-block' ) }
										value={ sliderSpaceBetween }
										onChange={ ( value ) => setAttributes( { sliderSpaceBetween: value } ) }
										min={ 0 }
										max={ 50 }
									/>
									<ToggleControl
										label={ __( 'Autoplay', 'blockive-premium-addon-for-block' ) }
										checked={ !! sliderAutoplay }
										onChange={ ( value ) => setAttributes( { sliderAutoplay: value } ) }
									/>
									{ sliderAutoplay && (
										<RangeControl
											label={ __( 'Autoplay Speed (ms)', 'blockive-premium-addon-for-block' ) }
											value={ sliderAutoplaySpeed }
											onChange={ ( value ) => setAttributes( { sliderAutoplaySpeed: value } ) }
											min={ 1000 }
											max={ 10000 }
											step={ 500 }
										/>
									) }
									<ToggleControl
										label={ __( 'Infinite Loop', 'blockive-premium-addon-for-block' ) }
										checked={ !! sliderLoop }
										onChange={ ( value ) => setAttributes( { sliderLoop: value } ) }
									/>
									<ToggleControl
										label={ __( 'Show Navigation Arrows', 'blockive-premium-addon-for-block' ) }
										checked={ !! sliderShowArrows }
										onChange={ ( value ) => setAttributes( { sliderShowArrows: value } ) }
									/>
									<ToggleControl
										label={ __( 'Show Pagination Dots', 'blockive-premium-addon-for-block' ) }
										checked={ !! sliderShowDots }
										onChange={ ( value ) => setAttributes( { sliderShowDots: value } ) }
									/>
								</>
							) }
						</PanelBody>

						<PanelBody title={ __( 'Query & Relations', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
							<ToggleControl
								label={ __( 'Match Same Category', 'blockive-premium-addon-for-block' ) }
								checked={ !! sameCategory }
								onChange={ ( value ) => setAttributes( { sameCategory: value } ) }
								help={ __( 'Only show posts sharing a category (or primary taxonomy) with current context.', 'blockive-premium-addon-for-block' ) }
							/>
							<SegmentedControl
								label={ __( 'Order By', 'blockive-premium-addon-for-block' ) }
								value={ orderBy }
								options={ ORDER_BY_OPTIONS }
								onChange={ ( value ) => setAttributes( { orderBy: value } ) }
							/>
							<SegmentedControl
								label={ __( 'Order', 'blockive-premium-addon-for-block' ) }
								value={ order }
								options={ ORDER_OPTIONS }
								onChange={ ( value ) => setAttributes( { order: value } ) }
							/>
						</PanelBody>

						<PanelBody title={ __( 'Card Elements', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
							<ToggleControl
								label={ __( 'Show Featured Image', 'blockive-premium-addon-for-block' ) }
								checked={ !! showImage }
								onChange={ ( value ) => setAttributes( { showImage: value } ) }
							/>
							<ToggleControl
								label={ __( 'Show Date', 'blockive-premium-addon-for-block' ) }
								checked={ !! showDate }
								onChange={ ( value ) => setAttributes( { showDate: value } ) }
							/>
							<SegmentedControl
								label={ __( 'Post Content', 'blockive-premium-addon-for-block' ) }
								value={ contentType }
								options={ CONTENT_TYPE_OPTIONS }
								onChange={ ( value ) => setAttributes( { contentType: value } ) }
							/>
							{ contentType === 'limited' && (
								<RangeControl
									label={ __( 'Number of Words', 'blockive-premium-addon-for-block' ) }
									value={ excerptLength }
									onChange={ ( value ) => setAttributes( { excerptLength: value } ) }
									min={ 5 }
									max={ 200 }
								/>
							) }
							<ToggleControl
								label={ __( 'Card Hover Elevation', 'blockive-premium-addon-for-block' ) }
								checked={ !! cardHoverElevation }
								onChange={ ( value ) => setAttributes( { cardHoverElevation: value } ) }
							/>
							<ToggleControl
								label={ __( 'Image Hover Zoom Effect', 'blockive-premium-addon-for-block' ) }
								checked={ !! imageZoom }
								onChange={ ( value ) => setAttributes( { imageZoom: value } ) }
							/>
						</PanelBody>
					</>
				}
				style={
					<>
						<PanelBody title={ __( 'Card & Spacing', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
							<RangeControl
								label={ __( 'Card Border Radius (px)', 'blockive-premium-addon-for-block' ) }
								value={ cardBorderRadius }
								onChange={ ( value ) => setAttributes( { cardBorderRadius: value } ) }
								min={ 0 }
								max={ 40 }
							/>
							<RangeControl
								label={ __( 'Card Padding (px)', 'blockive-premium-addon-for-block' ) }
								value={ cardPadding }
								onChange={ ( value ) => setAttributes( { cardPadding: value } ) }
								min={ 0 }
								max={ 40 }
							/>
							<RangeControl
								label={ __( 'Image Border Radius (px)', 'blockive-premium-addon-for-block' ) }
								value={ imageBorderRadius }
								onChange={ ( value ) => setAttributes( { imageBorderRadius: value } ) }
								min={ 0 }
								max={ 30 }
							/>
						</PanelBody>
						<PanelBody title={ __( 'Typography & Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
							<TypographyControls
								values={ {
									fontFamily: titleFontFamily,
									fontSize: titleFontSize,
									fontWeight: titleFontWeight,
									lineHeight: titleLineHeight,
									letterSpacing: titleLetterSpacing,
									textTransform: titleTextTransform,
									textDecoration: titleTextDecoration,
								} }
								onChange={ ( key, value ) => setAttributes( { [ `title${ key.charAt( 0 ).toUpperCase() }${ key.slice( 1 ) }` ]: value } ) }
								fontSizeUnit={ titleFontSizeUnit }
								onFontSizeUnitChange={ ( value ) => setAttributes( { titleFontSizeUnit: value } ) }
								letterSpacingUnit={ titleLetterSpacingUnit }
								onLetterSpacingUnitChange={ ( value ) => setAttributes( { titleLetterSpacingUnit: value } ) }
							/>
							<ColorStateControls
								normal={ [
									{
										label: __( 'Title Color', 'blockive-premium-addon-for-block' ),
										value: titleColor,
										onChange: ( value ) => setAttributes( { titleColor: value } ),
									},
									{
										label: __( 'Date Color', 'blockive-premium-addon-for-block' ),
										value: dateColor,
										onChange: ( value ) => setAttributes( { dateColor: value } ),
									},
									{
										label: __( 'Excerpt / Content Color', 'blockive-premium-addon-for-block' ),
										value: excerptColor,
										onChange: ( value ) => setAttributes( { excerptColor: value } ),
									},
									{
										label: __( 'Card Background', 'blockive-premium-addon-for-block' ),
										value: cardBgColor,
										onChange: ( value ) => setAttributes( { cardBgColor: value } ),
									},
								] }
								hover={ [
									{
										label: __( 'Title Hover Color', 'blockive-premium-addon-for-block' ),
										value: titleHoverColor,
										onChange: ( value ) => setAttributes( { titleHoverColor: value } ),
									},
								] }
							/>
						</PanelBody>
					</>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<div { ...blockProps }>
				{ layout === 'slider' ? (
					<div className="bpafb-tb-related-posts-slider-editor-wrap" style={ { width: '100%' } }>
						<div
							className="bpafb-tb-related-posts-slider-preview"
							style={ {
								display: 'grid',
								width: '100%',
								gridTemplateColumns: `repeat(${ Math.min( sliderColumns || 3, placeholderCards.length ) }, minmax(0, 1fr))`,
								gap: `${ sliderSpaceBetween ?? 20 }px`,
							} }
						>
							{ placeholderCards.slice( 0, sliderColumns || 3 ).map( renderCard ) }
						</div>
						{ sliderShowArrows && (
							<div className="bpafb-tb-slider-preview-arrows" style={ { display: 'flex', justifyContent: 'space-between', marginTop: '14px', padding: '0 4px' } }>
								<span className="bpafb-preview-btn bpafb-preview-btn-prev">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
								</span>
								<span className="bpafb-preview-btn bpafb-preview-btn-next">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
								</span>
							</div>
						) }
						{ sliderShowDots && (
							<div className="bpafb-tb-slider-preview-dots" style={ { display: 'flex', justifyContent: 'center', gap: '8px', marginTop: '14px' } }>
								{ placeholderCards.map( ( _, idx ) => (
									<span
										key={ idx }
										style={ {
											width: idx === 0 ? '24px' : '8px',
											height: '8px',
											borderRadius: '999px',
											backgroundColor: idx === 0 ? '#0f172a' : 'rgba(15, 23, 42, 0.25)',
											display: 'inline-block',
											transition: 'all 0.3s ease',
										} }
									/>
								) ) }
							</div>
						) }
					</div>
				) : (
					<div
						className="bpafb-tb-related-posts-grid"
						style={ {
							display: 'grid',
							width: '100%',
							gridTemplateColumns: `repeat(${ columns || 3 }, minmax(0, 1fr))`,
							gap: `${ gridGap ?? 24 }px`,
						} }
					>
						{ placeholderCards.map( renderCard ) }
					</div>
				) }
			</div>
		</>
	);
}
