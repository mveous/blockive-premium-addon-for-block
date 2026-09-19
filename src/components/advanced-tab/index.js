import { __ } from '@wordpress/i18n';
import { useEffect } from '@wordpress/element';
import { InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	RangeControl,
	ToggleControl,
	TextControl,
	TextareaControl,
} from '@wordpress/components';

import SpacingControls from '../spacing-controls';
import ResponsiveControls from '../responsive-controls';
import BorderControls from '../border-controls';
import ShadowControls from '../shadow-controls';
import BackgroundControls from '../background-controls';
import AnimationControls from '../animation-controls';

const DISPLAY_OPTIONS = [
	{ label: __( 'Default', 'blockive-premium-addon-for-block' ), value: '' },
	{ label: 'Block', value: 'block' },
	{ label: 'Inline Block', value: 'inline-block' },
	{ label: 'Flex', value: 'flex' },
	{ label: 'Inline Flex', value: 'inline-flex' },
	{ label: 'None', value: 'none' },
];

const OVERFLOW_OPTIONS = [
	{ label: __( 'Default', 'blockive-premium-addon-for-block' ), value: '' },
	{ label: 'Visible', value: 'visible' },
	{ label: 'Hidden', value: 'hidden' },
	{ label: 'Auto', value: 'auto' },
	{ label: 'Scroll', value: 'scroll' },
];

const POSITION_OPTIONS = [
	{ label: __( 'Default', 'blockive-premium-addon-for-block' ), value: '' },
	{ label: 'Static', value: 'static' },
	{ label: 'Relative', value: 'relative' },
	{ label: 'Absolute', value: 'absolute' },
	{ label: 'Fixed', value: 'fixed' },
	{ label: 'Sticky', value: 'sticky' },
];

const HOVER_ANIMATION_OPTIONS = [
	{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
	{ label: __( 'Grow', 'blockive-premium-addon-for-block' ), value: 'grow' },
	{ label: __( 'Shrink', 'blockive-premium-addon-for-block' ), value: 'shrink' },
	{ label: __( 'Float Up', 'blockive-premium-addon-for-block' ), value: 'float-up' },
	{ label: __( 'Sink Down', 'blockive-premium-addon-for-block' ), value: 'sink-down' },
];

const PADDING_ATTR = {
	desktop: [ 'bpafbContainerPaddingTop', 'bpafbContainerPaddingRight', 'bpafbContainerPaddingBottom', 'bpafbContainerPaddingLeft' ],
	tablet: [ 'bpafbContainerPaddingTopTablet', 'bpafbContainerPaddingRightTablet', 'bpafbContainerPaddingBottomTablet', 'bpafbContainerPaddingLeftTablet' ],
	mobile: [ 'bpafbContainerPaddingTopMobile', 'bpafbContainerPaddingRightMobile', 'bpafbContainerPaddingBottomMobile', 'bpafbContainerPaddingLeftMobile' ],
};

const MARGIN_ATTR = {
	desktop: [ 'bpafbContainerMarginTop', 'bpafbContainerMarginRight', 'bpafbContainerMarginBottom', 'bpafbContainerMarginLeft' ],
	tablet: [ 'bpafbContainerMarginTopTablet', 'bpafbContainerMarginRightTablet', 'bpafbContainerMarginBottomTablet', 'bpafbContainerMarginLeftTablet' ],
	mobile: [ 'bpafbContainerMarginTopMobile', 'bpafbContainerMarginRightMobile', 'bpafbContainerMarginBottomMobile', 'bpafbContainerMarginLeftMobile' ],
};

function boxValueFromAttrs( attributes, attrNames ) {
	const [ top, right, bottom, left ] = attrNames;
	return {
		top: attributes[ top ],
		right: attributes[ right ],
		bottom: attributes[ bottom ],
		left: attributes[ left ],
	};
}

function generateUid() {
	return Math.random().toString( 36 ).slice( 2, 10 );
}

// Tracks which bpafbUid values are already claimed by a mounted block
// instance in this editor session, so a duplicated block (which starts out
// with a copy of the original's uid) can detect the collision and get a
// fresh one instead of silently sharing CSS scope with the original.
const claimedUids = new Set();

/**
 * The single shared "Advanced" control set rendered identically by every
 * Blockive block. Its panels are split across the block's two native
 * inspector tabs (no custom tab navigation of its own): layout/visibility/
 * z-index are functional settings and land in the native Settings tab,
 * while spacing/background/border/shadow/animation/transform/motion are
 * visual and land in the native Styles tab, next to the rest of the
 * block's style controls.
 */
export default function AdvancedTab( { attributes, setAttributes } ) {
	const {
		bpafbUid,
		bpafbDisplay = '',
		bpafbOverflow = '',
		bpafbPosition = '',
		bpafbContainerWidth,
		bpafbContainerWidthUnit = 'px',
		bpafbContainerMinHeight,
		bpafbContainerMaxHeight,
		bpafbContainerBgType = 'color',
		bpafbContainerBgColor = '',
		bpafbContainerBgGradient = '',
		bpafbContainerBgImageUrl = '',
		bpafbContainerBgImageId = 0,
		bpafbContainerBgImageSize = 'cover',
		bpafbContainerOverlayColor = '',
		bpafbContainerBorderStyle = 'none',
		bpafbContainerBorderWidth,
		bpafbContainerBorderRadius,
		bpafbContainerBorderColor = '',
		bpafbContainerBoxShadow = false,
		bpafbContainerShadowColor,
		bpafbContainerShadowBlur,
		bpafbContainerShadowSpread,
		bpafbContainerHoverBoxShadow = false,
		bpafbContainerHoverShadowColor,
		bpafbContainerHoverShadowBlur,
		bpafbContainerHoverShadowSpread,
		bpafbHideDesktop = false,
		bpafbHideTablet = false,
		bpafbHideMobile = false,
		bpafbAnimationType = 'none',
		bpafbAnimationDuration = 800,
		bpafbAnimationDelay = 0,
		bpafbAnimationEasing = 'ease',
		bpafbTransformRotate = 0,
		bpafbTransformScale = 100,
		bpafbTransformTranslateX = 0,
		bpafbTransformTranslateY = 0,
		bpafbHoverAnimation = 'none',
		bpafbFloatingEffect = false,
		bpafbZIndex,
		bpafbHtmlId = '',
		bpafbHtmlClasses = '',
		bpafbCustomCss = '',
	} = attributes;

	// Custom CSS output requires the same capability WordPress uses to gate
	// unfiltered/raw markup in post content (see bpafb_strip_unauthorized_custom_css()
	// in the main plugin file, which enforces this server-side at save time --
	// this flag only controls whether the field is shown, it is not the
	// security boundary itself).
	const canUseCustomCss = typeof window !== 'undefined' && window.bpafbEditorSettings
		? !! window.bpafbEditorSettings.canUseCustomCss
		: false;

	useEffect( () => {
		if ( ! bpafbUid || claimedUids.has( bpafbUid ) ) {
			const newUid = generateUid();
			claimedUids.add( newUid );
			setAttributes( { bpafbUid: newUid } );
		} else {
			claimedUids.add( bpafbUid );
		}
		// Intentionally run only on mount: this is a one-time claim check per
		// block instance, not a reaction to bpafbUid changes.
		// eslint-disable-next-line react-hooks/exhaustive-deps
	}, [] );

	return (
		<>
			<InspectorControls group="settings">
				<PanelBody title={ __( 'Layout', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
					<SelectControl
						label={ __( 'Display', 'blockive-premium-addon-for-block' ) }
						value={ bpafbDisplay }
						options={ DISPLAY_OPTIONS }
						onChange={ ( val ) => setAttributes( { bpafbDisplay: val } ) }
					/>
					<div style={ { display: 'flex', gap: '10px', alignItems: 'flex-end' } }>
						<div style={ { flexGrow: 1 } }>
							<RangeControl
								label={ __( 'Max Width', 'blockive-premium-addon-for-block' ) }
								value={ bpafbContainerWidth }
								onChange={ ( val ) => setAttributes( { bpafbContainerWidth: val } ) }
								min={ 10 }
								max={ 2000 }
							/>
						</div>
						<div style={ { width: '80px', marginBottom: '16px' } }>
							<SelectControl
								label={ __( 'Unit', 'blockive-premium-addon-for-block' ) }
								value={ bpafbContainerWidthUnit }
								options={ [
									{ label: 'px', value: 'px' },
									{ label: '%', value: '%' },
									{ label: 'rem', value: 'rem' },
								] }
								onChange={ ( val ) => setAttributes( { bpafbContainerWidthUnit: val } ) }
							/>
						</div>
					</div>
					<RangeControl
						label={ __( 'Min Height (px)', 'blockive-premium-addon-for-block' ) }
						value={ bpafbContainerMinHeight }
						onChange={ ( val ) => setAttributes( { bpafbContainerMinHeight: val } ) }
						min={ 0 }
						max={ 1200 }
					/>
					<RangeControl
						label={ __( 'Max Height (px)', 'blockive-premium-addon-for-block' ) }
						value={ bpafbContainerMaxHeight }
						onChange={ ( val ) => setAttributes( { bpafbContainerMaxHeight: val } ) }
						min={ 0 }
						max={ 2000 }
					/>
					<SelectControl
						label={ __( 'Overflow', 'blockive-premium-addon-for-block' ) }
						value={ bpafbOverflow }
						options={ OVERFLOW_OPTIONS }
						onChange={ ( val ) => setAttributes( { bpafbOverflow: val } ) }
					/>
					<SelectControl
						label={ __( 'Position', 'blockive-premium-addon-for-block' ) }
						value={ bpafbPosition }
						options={ POSITION_OPTIONS }
						onChange={ ( val ) => setAttributes( { bpafbPosition: val } ) }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Visibility', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<ToggleControl
						label={ __( 'Hide On Desktop', 'blockive-premium-addon-for-block' ) }
						checked={ !! bpafbHideDesktop }
						onChange={ ( val ) => setAttributes( { bpafbHideDesktop: val } ) }
					/>
					<ToggleControl
						label={ __( 'Hide On Tablet', 'blockive-premium-addon-for-block' ) }
						checked={ !! bpafbHideTablet }
						onChange={ ( val ) => setAttributes( { bpafbHideTablet: val } ) }
					/>
					<ToggleControl
						label={ __( 'Hide On Mobile', 'blockive-premium-addon-for-block' ) }
						checked={ !! bpafbHideMobile }
						onChange={ ( val ) => setAttributes( { bpafbHideMobile: val } ) }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Z-Index', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<RangeControl
						label={ __( 'Z-Index', 'blockive-premium-addon-for-block' ) }
						value={ bpafbZIndex }
						onChange={ ( val ) => setAttributes( { bpafbZIndex: val } ) }
						min={ -10 }
						max={ 999 }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Custom Attributes', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<TextControl
						label={ __( 'HTML ID', 'blockive-premium-addon-for-block' ) }
						value={ bpafbHtmlId }
						onChange={ ( val ) => setAttributes( { bpafbHtmlId: val } ) }
						help={ __( 'Sets a custom id on this block’s wrapper element. Ignored if the block already has an id (e.g. from the native HTML Anchor field below).', 'blockive-premium-addon-for-block' ) }
					/>
					<TextControl
						label={ __( 'HTML Classes', 'blockive-premium-addon-for-block' ) }
						value={ bpafbHtmlClasses }
						onChange={ ( val ) => setAttributes( { bpafbHtmlClasses: val } ) }
						help={ __( 'Space-separated custom classes added to this block’s wrapper element, alongside any native Additional CSS Class(es).', 'blockive-premium-addon-for-block' ) }
					/>
					{ canUseCustomCss ? (
						<TextareaControl
							label={ __( 'Custom CSS (Blockive)', 'blockive-premium-addon-for-block' ) }
							value={ bpafbCustomCss }
							onChange={ ( val ) => setAttributes( { bpafbCustomCss: val } ) }
							help={ __( 'Scoped to this block instance only -- use the word "selector" to target its wrapper, e.g. "selector { color: red; }". This is separate from the native Gutenberg Additional CSS field: that one applies as inline styles on this block only and isn’t scoped the same way.', 'blockive-premium-addon-for-block' ) }
						/>
					) : (
						<p className="bpafb-custom-css-restricted">
							{ __( 'Custom CSS requires the "unfiltered_html" capability on your account. Ask an administrator if you need this enabled.', 'blockive-premium-addon-for-block' ) }
						</p>
					) }
				</PanelBody>
			</InspectorControls>

			<InspectorControls group="styles">
				<PanelBody title={ __( 'Spacing', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<ResponsiveControls>
						{ ( device ) => (
							<>
								<SpacingControls
									label={ __( 'Padding (px)', 'blockive-premium-addon-for-block' ) }
									value={ boxValueFromAttrs( attributes, PADDING_ATTR[ device ] ) }
									onChange={ ( box ) => {
										const [ top, right, bottom, left ] = PADDING_ATTR[ device ];
										setAttributes( {
											[ top ]: box.top,
											[ right ]: box.right,
											[ bottom ]: box.bottom,
											[ left ]: box.left,
										} );
									} }
									min={ 0 }
								/>
								<SpacingControls
									label={ __( 'Margin (px)', 'blockive-premium-addon-for-block' ) }
									value={ boxValueFromAttrs( attributes, MARGIN_ATTR[ device ] ) }
									onChange={ ( box ) => {
										const [ top, right, bottom, left ] = MARGIN_ATTR[ device ];
										setAttributes( {
											[ top ]: box.top,
											[ right ]: box.right,
											[ bottom ]: box.bottom,
											[ left ]: box.left,
										} );
									} }
								/>
							</>
						) }
					</ResponsiveControls>
				</PanelBody>

				<PanelBody title={ __( 'Background', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<BackgroundControls
						values={ {
							bgType: bpafbContainerBgType,
							bgColor: bpafbContainerBgColor,
							bgGradient: bpafbContainerBgGradient,
							bgImageUrl: bpafbContainerBgImageUrl,
							bgImageId: bpafbContainerBgImageId,
							bgImageSize: bpafbContainerBgImageSize,
							overlayColor: bpafbContainerOverlayColor,
						} }
						onChange={ ( key, val ) => {
							const map = {
								bgType: 'bpafbContainerBgType',
								bgColor: 'bpafbContainerBgColor',
								bgGradient: 'bpafbContainerBgGradient',
								bgImageUrl: 'bpafbContainerBgImageUrl',
								bgImageId: 'bpafbContainerBgImageId',
								bgImageSize: 'bpafbContainerBgImageSize',
								overlayColor: 'bpafbContainerOverlayColor',
							};
							setAttributes( { [ map[ key ] ]: val } );
						} }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Border', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<BorderControls
						values={ {
							borderType: bpafbContainerBorderStyle,
							borderWidth: bpafbContainerBorderWidth,
							borderRadius: bpafbContainerBorderRadius,
							borderColor: bpafbContainerBorderColor,
						} }
						onChange={ ( key, val ) => {
							const map = {
								borderType: 'bpafbContainerBorderStyle',
								borderWidth: 'bpafbContainerBorderWidth',
								borderRadius: 'bpafbContainerBorderRadius',
								borderColor: 'bpafbContainerBorderColor',
							};
							setAttributes( { [ map[ key ] ]: val } );
						} }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Shadow', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<ShadowControls
						normalValues={ {
							enabled: bpafbContainerBoxShadow,
							color: bpafbContainerShadowColor,
							blur: bpafbContainerShadowBlur,
							spread: bpafbContainerShadowSpread,
						} }
						onNormalChange={ ( key, val ) => {
							const map = { enabled: 'bpafbContainerBoxShadow', color: 'bpafbContainerShadowColor', blur: 'bpafbContainerShadowBlur', spread: 'bpafbContainerShadowSpread' };
							setAttributes( { [ map[ key ] ]: val } );
						} }
						hoverValues={ {
							enabled: bpafbContainerHoverBoxShadow,
							color: bpafbContainerHoverShadowColor,
							blur: bpafbContainerHoverShadowBlur,
							spread: bpafbContainerHoverShadowSpread,
						} }
						onHoverChange={ ( key, val ) => {
							const map = { enabled: 'bpafbContainerHoverBoxShadow', color: 'bpafbContainerHoverShadowColor', blur: 'bpafbContainerHoverShadowBlur', spread: 'bpafbContainerHoverShadowSpread' };
							setAttributes( { [ map[ key ] ]: val } );
						} }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Animation', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<AnimationControls
						values={ { animationType: bpafbAnimationType, animationDuration: bpafbAnimationDuration, animationDelay: bpafbAnimationDelay, animationEasing: bpafbAnimationEasing } }
						onChange={ ( key, val ) => {
							const map = { animationType: 'bpafbAnimationType', animationDuration: 'bpafbAnimationDuration', animationDelay: 'bpafbAnimationDelay', animationEasing: 'bpafbAnimationEasing' };
							setAttributes( { [ map[ key ] ]: val } );
						} }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Transform', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<RangeControl
						label={ __( 'Rotate (deg)', 'blockive-premium-addon-for-block' ) }
						value={ bpafbTransformRotate }
						onChange={ ( val ) => setAttributes( { bpafbTransformRotate: val } ) }
						min={ -360 }
						max={ 360 }
					/>
					<RangeControl
						label={ __( 'Scale (%)', 'blockive-premium-addon-for-block' ) }
						value={ bpafbTransformScale }
						onChange={ ( val ) => setAttributes( { bpafbTransformScale: val } ) }
						min={ 10 }
						max={ 300 }
					/>
					<RangeControl
						label={ __( 'Translate X (px)', 'blockive-premium-addon-for-block' ) }
						value={ bpafbTransformTranslateX }
						onChange={ ( val ) => setAttributes( { bpafbTransformTranslateX: val } ) }
						min={ -300 }
						max={ 300 }
					/>
					<RangeControl
						label={ __( 'Translate Y (px)', 'blockive-premium-addon-for-block' ) }
						value={ bpafbTransformTranslateY }
						onChange={ ( val ) => setAttributes( { bpafbTransformTranslateY: val } ) }
						min={ -300 }
						max={ 300 }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Motion Effects', 'blockive-premium-addon-for-block' ) } initialOpen={ false }>
					<SelectControl
						label={ __( 'Hover Animation', 'blockive-premium-addon-for-block' ) }
						value={ bpafbHoverAnimation }
						options={ HOVER_ANIMATION_OPTIONS }
						onChange={ ( val ) => setAttributes( { bpafbHoverAnimation: val } ) }
					/>
					<ToggleControl
						label={ __( 'Floating Effect', 'blockive-premium-addon-for-block' ) }
						checked={ !! bpafbFloatingEffect }
						onChange={ ( val ) => setAttributes( { bpafbFloatingEffect: val } ) }
					/>
				</PanelBody>
			</InspectorControls>
		</>
	);
}
