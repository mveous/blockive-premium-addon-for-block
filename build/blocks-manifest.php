<?php
// This file is generated. Do not modify it manually.
return array(
	'accordion' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/accordion',
		'version' => '0.1.0',
		'title' => 'Accordion',
		'category' => 'bpafb-widgets',
		'icon' => 'list-view',
		'description' => 'Accordion block with advanced layout and style settings.',
		'attributes' => array(
			'items' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'title' => 'Accordion Item 1',
						'content' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
					),
					array(
						'id' => '2',
						'title' => 'Accordion Item 2',
						'content' => 'Click edit button to change this text. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
					)
				)
			),
			'icon' => array(
				'type' => 'string',
				'default' => 'plus-minus'
			),
			'iconAlign' => array(
				'type' => 'string',
				'default' => 'right'
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => '#0f172a'
			),
			'titleActiveColor' => array(
				'type' => 'string',
				'default' => '#4f46e5'
			),
			'titleBgColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'contentColor' => array(
				'type' => 'string',
				'default' => '#334155'
			),
			'contentBgColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => '#e2e8f0'
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 12
			),
			'titleFontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleFontSize' => array(
				'type' => 'number',
				'default' => null
			),
			'titleFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleLineHeight' => array(
				'type' => 'number',
				'default' => null
			),
			'titleLetterSpacing' => array(
				'type' => 'number',
				'default' => null
			),
			'titleTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleTextDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'hoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'hoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'hoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'animationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'animationDuration' => array(
				'type' => 'string',
				'default' => '1s'
			),
			'animationDelay' => array(
				'type' => 'string',
				'default' => '0s'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js'
	),
	'business-hours' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/business-hours',
		'version' => '0.1.0',
		'title' => 'Business Hours',
		'category' => 'bpafb-widgets',
		'icon' => 'clock',
		'description' => 'Business Hours block to display opening and closing times.',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Business Hours'
			),
			'hours' => array(
				'type' => 'array',
				'default' => array(
					array(
						'day' => 'monday',
						'openTime' => '09:00',
						'closeTime' => '18:00',
						'isClosed' => false,
						'closedText' => 'Closed'
					),
					array(
						'day' => 'tuesday',
						'openTime' => '09:00',
						'closeTime' => '18:00',
						'isClosed' => false,
						'closedText' => 'Closed'
					),
					array(
						'day' => 'wednesday',
						'openTime' => '09:00',
						'closeTime' => '18:00',
						'isClosed' => false,
						'closedText' => 'Closed'
					),
					array(
						'day' => 'thursday',
						'openTime' => '09:00',
						'closeTime' => '18:00',
						'isClosed' => false,
						'closedText' => 'Closed'
					),
					array(
						'day' => 'friday',
						'openTime' => '09:00',
						'closeTime' => '18:00',
						'isClosed' => false,
						'closedText' => 'Closed'
					),
					array(
						'day' => 'saturday',
						'openTime' => '10:00',
						'closeTime' => '16:00',
						'isClosed' => false,
						'closedText' => 'Closed'
					),
					array(
						'day' => 'sunday',
						'openTime' => '',
						'closeTime' => '',
						'isClosed' => true,
						'closedText' => 'Closed'
					)
				)
			),
			'highlightToday' => array(
				'type' => 'boolean',
				'default' => true
			),
			'timeFormat' => array(
				'type' => 'string',
				'default' => '24'
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'containerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemTextColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'todayBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'todayTextColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'closedColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemBgColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemTextColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'dayFontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'dayFontSize' => array(
				'type' => 'number',
				'default' => null
			),
			'dayFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'dayLineHeight' => array(
				'type' => 'number',
				'default' => null
			),
			'dayLetterSpacing' => array(
				'type' => 'number',
				'default' => null
			),
			'dayTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'dayTextDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'timeFontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'timeFontSize' => array(
				'type' => 'number',
				'default' => null
			),
			'timeFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'timeLineHeight' => array(
				'type' => 'number',
				'default' => null
			),
			'timeLetterSpacing' => array(
				'type' => 'number',
				'default' => null
			),
			'timeTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'timeTextDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 8
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'hoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'hoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'hoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js'
	),
	'button' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/button',
		'version' => '0.1.0',
		'title' => 'Button',
		'category' => 'bpafb-widgets',
		'icon' => 'button',
		'description' => 'A highly customizable button with icon and badge support.',
		'attributes' => array(
			'text' => array(
				'type' => 'string',
				'default' => 'Click Here'
			),
			'url' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkTarget' => array(
				'type' => 'boolean',
				'default' => false
			),
			'showIcon' => array(
				'type' => 'boolean',
				'default' => false
			),
			'icon' => array(
				'type' => 'string',
				'default' => 'fas fa-arrow-right'
			),
			'iconPosition' => array(
				'type' => 'string',
				'default' => 'right'
			),
			'badgeText' => array(
				'type' => 'string',
				'default' => ''
			),
			'alignment' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'buttonWidth' => array(
				'type' => 'string',
				'default' => 'auto'
			),
			'textColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'bgColor' => array(
				'type' => 'string',
				'default' => '#3b82f6'
			),
			'textColorHover' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'bgColorHover' => array(
				'type' => 'string',
				'default' => '#2563eb'
			),
			'badgeTextColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'badgeBgColor' => array(
				'type' => 'string',
				'default' => '#ef4444'
			),
			'iconSpacing' => array(
				'type' => 'number',
				'default' => 8
			),
			'fontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'fontSize' => array(
				'type' => 'number',
				'default' => null
			),
			'fontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'lineHeight' => array(
				'type' => 'number',
				'default' => null
			),
			'letterSpacing' => array(
				'type' => 'number',
				'default' => null
			),
			'textTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'textDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 4
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'borderColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'hoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'hoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'hoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css'
	),
	'category-list' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/category-list',
		'version' => '0.1.0',
		'title' => 'Category List',
		'category' => 'bpafb-widgets',
		'icon' => 'list-view',
		'description' => 'WordPress category browser/list block.',
		'supports' => array(
			'color' => array(
				'text' => true,
				'background' => false,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true
			),
			'anchor' => true
		),
		'attributes' => array(
			'showCount' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showDescription' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hideEmpty' => array(
				'type' => 'boolean',
				'default' => true
			),
			'limit' => array(
				'type' => 'number',
				'default' => 10
			),
			'orderBy' => array(
				'type' => 'string',
				'default' => 'name'
			),
			'order' => array(
				'type' => 'string',
				'default' => 'asc'
			),
			'excludeTerms' => array(
				'type' => 'string',
				'default' => ''
			),
			'layoutType' => array(
				'type' => 'string',
				'default' => 'vertical'
			),
			'showHierarchy' => array(
				'type' => 'boolean',
				'default' => false
			),
			'gap' => array(
				'type' => 'number',
				'default' => 20
			),
			'enableLink' => array(
				'type' => 'boolean',
				'default' => true
			),
			'itemBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemBorderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'itemBorderRadius' => array(
				'type' => 'number',
				'default' => 0
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3
			),
			'itemPadding' => array(
				'type' => 'number',
				'default' => 10
			),
			'textAlign' => array(
				'type' => 'string',
				'default' => 'left'
			),
			'enableBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'removeChildBorder' => array(
				'type' => 'boolean',
				'default' => false
			),
			'taxonomy' => array(
				'type' => 'string',
				'default' => 'category'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'render' => 'file:./render.php',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./index.css'
	),
	'contact-form-7' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/contact-form-7',
		'version' => '0.1.0',
		'title' => 'Contact Form 7',
		'category' => 'bpafb-widgets',
		'icon' => 'email-alt',
		'description' => 'Contact Form 7 integration block.',
		'supports' => array(
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true
			),
			'anchor' => true
		),
		'attributes' => array(
			'formId' => array(
				'type' => 'string',
				'default' => ''
			),
			'showTitle' => array(
				'type' => 'boolean',
				'default' => true
			),
			'title' => array(
				'type' => 'string',
				'default' => 'Contact Us'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Send us a message'
			),
			'titleColor' => array(
				'type' => 'string'
			),
			'descriptionColor' => array(
				'type' => 'string'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css'
	),
	'countdown-timer' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/countdown-timer',
		'version' => '0.1.0',
		'title' => 'Countdown Timer',
		'category' => 'bpafb-widgets',
		'icon' => 'clock',
		'description' => 'A customizable countdown timer block with rich styling settings.',
		'attributes' => array(
			'targetDate' => array(
				'type' => 'string',
				'default' => ''
			),
			'timerType' => array(
				'type' => 'string',
				'default' => 'due'
			),
			'targetTimestamp' => array(
				'type' => 'number'
			),
			'evergreenHours' => array(
				'type' => 'number',
				'default' => 24
			),
			'evergreenMinutes' => array(
				'type' => 'number',
				'default' => 0
			),
			'evergreenId' => array(
				'type' => 'string',
				'default' => ''
			),
			'expireAction' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'expireMessage' => array(
				'type' => 'string',
				'default' => ''
			),
			'expireRedirect' => array(
				'type' => 'string',
				'default' => ''
			),
			'showDays' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showHours' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showMinutes' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showSeconds' => array(
				'type' => 'boolean',
				'default' => true
			),
			'labelDays' => array(
				'type' => 'string',
				'default' => 'Days'
			),
			'labelHours' => array(
				'type' => 'string',
				'default' => 'Hours'
			),
			'labelMinutes' => array(
				'type' => 'string',
				'default' => 'Minutes'
			),
			'labelSeconds' => array(
				'type' => 'string',
				'default' => 'Seconds'
			),
			'styleType' => array(
				'type' => 'string',
				'default' => 'block'
			),
			'boxBgColor' => array(
				'type' => 'string',
				'default' => '#f1f5f9'
			),
			'boxBorderColor' => array(
				'type' => 'string',
				'default' => '#e2e8f0'
			),
			'boxBorderWidth' => array(
				'type' => 'number',
				'default' => 1
			),
			'boxBorderRadius' => array(
				'type' => 'number',
				'default' => 8
			),
			'numberColor' => array(
				'type' => 'string',
				'default' => '#0f172a'
			),
			'labelColor' => array(
				'type' => 'string',
				'default' => '#64748b'
			),
			'gap' => array(
				'type' => 'number',
				'default' => 20
			),
			'alignment' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'animationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'animationDuration' => array(
				'type' => 'string',
				'default' => '1s'
			),
			'animationDelay' => array(
				'type' => 'string',
				'default' => '0s'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js'
	),
	'drop-caps' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/drop-caps',
		'version' => '0.1.0',
		'title' => 'Drop Caps',
		'category' => 'bpafb-widgets',
		'icon' => 'editor-textcolor',
		'description' => 'Advanced drop caps block with customizable view, shape, and styling.',
		'attributes' => array(
			'content' => array(
				'type' => 'string',
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
			),
			'view' => array(
				'type' => 'string',
				'default' => 'default'
			),
			'shape' => array(
				'type' => 'string',
				'default' => 'square'
			),
			'primaryColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'secondaryColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'size' => array(
				'type' => 'number',
				'default' => 50
			),
			'space' => array(
				'type' => 'number',
				'default' => 10
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 0
			),
			'dropCapPadding' => array(
				'type' => 'number',
				'default' => 10
			),
			'alignment' => array(
				'type' => 'string',
				'default' => 'left'
			),
			'fontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'fontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'lineHeight' => array(
				'type' => 'number',
				'default' => null
			),
			'letterSpacing' => array(
				'type' => 'number',
				'default' => null
			),
			'textTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'textDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'boxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'hoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'hoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'hoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css'
	),
	'faq' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/faq',
		'version' => '0.1.0',
		'title' => 'FAQ',
		'category' => 'bpafb-widgets',
		'icon' => 'editor-help',
		'description' => 'FAQ block with rich schema.org markup for SEO, based on accordion behavior.',
		'attributes' => array(
			'items' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'title' => 'Frequently Asked Question 1',
						'content' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
					),
					array(
						'id' => '2',
						'title' => 'Frequently Asked Question 2',
						'content' => 'Click edit button to change this text. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
					)
				)
			),
			'icon' => array(
				'type' => 'string',
				'default' => 'plus-minus'
			),
			'iconAlign' => array(
				'type' => 'string',
				'default' => 'right'
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => '#0f172a'
			),
			'titleActiveColor' => array(
				'type' => 'string',
				'default' => '#4f46e5'
			),
			'titleBgColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'contentColor' => array(
				'type' => 'string',
				'default' => '#334155'
			),
			'contentBgColor' => array(
				'type' => 'string',
				'default' => '#f8fafc'
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => '#e2e8f0'
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 0
			),
			'titleColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleBgColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'questionFontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'questionFontSize' => array(
				'type' => 'number',
				'default' => null
			),
			'questionFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'questionLineHeight' => array(
				'type' => 'number',
				'default' => null
			),
			'questionLetterSpacing' => array(
				'type' => 'number',
				'default' => null
			),
			'questionTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'questionTextDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'hoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'hoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'hoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'animationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'animationDuration' => array(
				'type' => 'string',
				'default' => '1s'
			),
			'animationDelay' => array(
				'type' => 'string',
				'default' => '0s'
			),
			'titleTag' => array(
				'type' => 'string',
				'default' => 'span'
			),
			'headingText' => array(
				'type' => 'string',
				'default' => 'Ask you question'
			),
			'headingTag' => array(
				'type' => 'string',
				'default' => 'h2'
			),
			'headingAlign' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'headingColor' => array(
				'type' => 'string',
				'default' => '#0f172a'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js'
	),
	'funfact' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/funfact',
		'version' => '0.1.0',
		'title' => 'Fun Fact',
		'category' => 'bpafb-widgets',
		'icon' => 'chart-bar',
		'description' => 'Animated statistics/counter block.',
		'attributes' => array(
			'items' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'number' => '1000',
						'prefix' => '',
						'suffix' => '+',
						'title' => 'Happy Clients'
					),
					array(
						'id' => '2',
						'number' => '120',
						'prefix' => '',
						'suffix' => '',
						'title' => 'Awards Won'
					),
					array(
						'id' => '3',
						'number' => '500',
						'prefix' => '',
						'suffix' => '+',
						'title' => 'Projects Completed'
					)
				)
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3
			),
			'numberColor' => array(
				'type' => 'string',
				'default' => '#4f46e5'
			),
			'textColor' => array(
				'type' => 'string',
				'default' => '#333333'
			),
			'duration' => array(
				'type' => 'number',
				'default' => 1000
			),
			'gap' => array(
				'type' => 'number',
				'default' => 20
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js',
		'supports' => array(
			'anchor' => true
		)
	),
	'heading' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/heading',
		'version' => '0.1.0',
		'title' => 'Heading',
		'category' => 'bpafb-widgets',
		'icon' => 'heading',
		'description' => 'Advanced heading block with rich customized settings.',
		'attributes' => array(
			'content' => array(
				'type' => 'string',
				'default' => 'Stunning Default Heading'
			),
			'alignment' => array(
				'type' => 'string',
				'default' => ''
			),
			'level' => array(
				'type' => 'number',
				'default' => 2
			),
			'link' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkTarget' => array(
				'type' => 'string',
				'default' => '_self'
			),
			'textShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.2)'
			),
			'textShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'textShadowX' => array(
				'type' => 'number',
				'default' => 0
			),
			'textShadowY' => array(
				'type' => 'number',
				'default' => 10
			),
			'blendMode' => array(
				'type' => 'string',
				'default' => 'normal'
			),
			'animationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'animationDuration' => array(
				'type' => 'string',
				'default' => '1s'
			),
			'animationDelay' => array(
				'type' => 'string',
				'default' => '0s'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => false,
				'gradients' => false,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalTextDecoration' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css'
	),
	'icon-box' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/icon-box',
		'version' => '0.1.0',
		'title' => 'Icon Box',
		'category' => 'bpafb-widgets',
		'icon' => 'info',
		'description' => 'An icon box that displays an icon, title, description, and link.',
		'attributes' => array(
			'icon' => array(
				'type' => 'string',
				'default' => 'fas fa-star'
			),
			'title' => array(
				'type' => 'string',
				'default' => 'Icon Box Title'
			),
			'titleTag' => array(
				'type' => 'string',
				'default' => 'h3'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
			),
			'url' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkTarget' => array(
				'type' => 'boolean',
				'default' => false
			),
			'iconPosition' => array(
				'type' => 'string',
				'default' => 'top'
			),
			'iconSize' => array(
				'type' => 'number',
				'default' => 40
			),
			'iconColor' => array(
				'type' => 'string',
				'default' => '#3b82f6'
			),
			'iconColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'iconBgColor' => array(
				'type' => 'string',
				'default' => 'rgba(59, 130, 246, 0.1)'
			),
			'iconBgColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'descColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxBgColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'iconPadding' => array(
				'type' => 'number',
				'default' => 20
			),
			'iconBorderRadius' => array(
				'type' => 'number',
				'default' => 20
			),
			'boxAlignment' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'iconBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'iconBorderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'iconBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'titleFontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleFontSize' => array(
				'type' => 'number',
				'default' => null
			),
			'titleFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleLineHeight' => array(
				'type' => 'number',
				'default' => null
			),
			'titleLetterSpacing' => array(
				'type' => 'number',
				'default' => null
			),
			'titleTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleTextDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'descFontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'descFontSize' => array(
				'type' => 'number',
				'default' => null
			),
			'descFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'descLineHeight' => array(
				'type' => 'number',
				'default' => null
			),
			'descLetterSpacing' => array(
				'type' => 'number',
				'default' => null
			),
			'descTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'descTextDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'hoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'hoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'hoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css'
	),
	'image-accordion' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/image-accordion',
		'version' => '0.1.0',
		'title' => 'Image Accordion',
		'category' => 'bpafb-widgets',
		'icon' => 'format-image',
		'description' => 'Image accordion block with advanced styling options.',
		'attributes' => array(
			'items' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'title' => 'Image Accordion Item 1',
						'imageUrl' => '',
						'content' => 'Content goes here...'
					),
					array(
						'id' => '2',
						'title' => 'Image Accordion Item 2',
						'imageUrl' => '',
						'content' => 'Content goes here...'
					)
				)
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'contentColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'overlayOpacity' => array(
				'type' => 'number',
				'default' => 0.7
			),
			'animationDuration' => array(
				'type' => 'string',
				'default' => '0.3s'
			),
			'height' => array(
				'type' => 'string',
				'default' => '400px'
			),
			'imageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'imagePosition' => array(
				'type' => 'string',
				'default' => 'center center'
			),
			'showTitle' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showContent' => array(
				'type' => 'boolean',
				'default' => true
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js',
		'supports' => array(
			'anchor' => true
		)
	),
	'image-box' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/image-box',
		'version' => '0.1.0',
		'title' => 'Image Box',
		'category' => 'bpafb-widgets',
		'icon' => 'format-image',
		'description' => 'An image box that displays an image, title, description, and link.',
		'attributes' => array(
			'imageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'imageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'imageAlt' => array(
				'type' => 'string',
				'default' => ''
			),
			'title' => array(
				'type' => 'string',
				'default' => 'Image Box Title'
			),
			'titleTag' => array(
				'type' => 'string',
				'default' => 'h3'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
			),
			'linkUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkText' => array(
				'type' => 'string',
				'default' => 'Read More'
			),
			'linkTarget' => array(
				'type' => 'boolean',
				'default' => false
			),
			'imagePosition' => array(
				'type' => 'string',
				'default' => 'top'
			),
			'contentAlign' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'verticalAlign' => array(
				'type' => 'string',
				'default' => 'top'
			),
			'imageSize' => array(
				'type' => 'string',
				'default' => '100px'
			),
			'imageRadius' => array(
				'type' => 'number',
				'default' => 0
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'descColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkColor' => array(
				'type' => 'string',
				'default' => '#3b82f6'
			),
			'linkColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'boxBgColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'imageSpacing' => array(
				'type' => 'number',
				'default' => 20
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css'
	),
	'image-comparison' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/image-comparison',
		'version' => '0.1.0',
		'title' => 'Image Comparison',
		'category' => 'bpafb-widgets',
		'icon' => 'format-image',
		'description' => 'Before/after image comparison slider block.',
		'attributes' => array(
			'beforeImage' => array(
				'type' => 'string',
				'default' => ''
			),
			'afterImage' => array(
				'type' => 'string',
				'default' => ''
			),
			'beforeLabel' => array(
				'type' => 'string',
				'default' => 'Before'
			),
			'afterLabel' => array(
				'type' => 'string',
				'default' => 'After'
			),
			'showLabels' => array(
				'type' => 'boolean',
				'default' => true
			),
			'labelColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'labelBackgroundColor' => array(
				'type' => 'string',
				'default' => 'rgba(0, 0, 0, 0.65)'
			),
			'labelPosition' => array(
				'type' => 'string',
				'default' => 'top'
			),
			'separatorColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'arrowColor' => array(
				'type' => 'string',
				'default' => '#555555'
			),
			'sliderPosition' => array(
				'type' => 'number',
				'default' => 50
			),
			'height' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js',
		'supports' => array(
			'anchor' => true
		)
	),
	'lottie' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/lottie',
		'version' => '0.1.0',
		'title' => 'Lottie',
		'category' => 'bpafb-widgets',
		'icon' => 'format-image',
		'description' => 'Lottie animation player block.',
		'attributes' => array(
			'animationUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'width' => array(
				'type' => 'string',
				'default' => '100px'
			),
			'height' => array(
				'type' => 'string',
				'default' => '100px'
			),
			'align' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'linkUrl' => array(
				'type' => 'string'
			),
			'linkTarget' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'supports' => array(
			'anchor' => true
		)
	),
	'mailchimp' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/mailchimp',
		'version' => '0.1.0',
		'title' => 'MailChimp',
		'category' => 'bpafb-widgets',
		'icon' => 'email',
		'description' => 'MailChimp newsletter subscription block.',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Subscribe to Our Newsletter'
			),
			'subtitle' => array(
				'type' => 'string',
				'default' => 'Get the latest updates delivered to your inbox'
			),
			'placeholderText' => array(
				'type' => 'string',
				'default' => 'Enter your email'
			),
			'buttonText' => array(
				'type' => 'string',
				'default' => 'Subscribe'
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'subtitleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'inputBgColor' => array(
				'type' => 'string',
				'default' => '#f8f9fa'
			),
			'buttonBgColor' => array(
				'type' => 'string',
				'default' => '#f0f0f0'
			),
			'buttonTextColor' => array(
				'type' => 'string',
				'default' => '#000000'
			),
			'inputBorderRadius' => array(
				'type' => 'number',
				'default' => 0
			),
			'buttonBorderRadius' => array(
				'type' => 'number',
				'default' => 2
			),
			'buttonHoverBgColor' => array(
				'type' => 'string',
				'default' => '#e0e0e0'
			),
			'buttonHoverTextColor' => array(
				'type' => 'string',
				'default' => '#000000'
			),
			'showInputIcon' => array(
				'type' => 'boolean',
				'default' => false
			),
			'inputIconBgColor' => array(
				'type' => 'string',
				'default' => '#e9ecef'
			),
			'inputIconColor' => array(
				'type' => 'string',
				'default' => '#000000'
			),
			'showButtonIcon' => array(
				'type' => 'boolean',
				'default' => false
			),
			'inputBorderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'inputBorderColor' => array(
				'type' => 'string',
				'default' => 'transparent'
			),
			'buttonBorderWidth' => array(
				'type' => 'number',
				'default' => 1
			),
			'buttonBorderColor' => array(
				'type' => 'string',
				'default' => '#767676'
			),
			'formAction' => array(
				'type' => 'string',
				'default' => ''
			),
			'formGap' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./index.css',
		'supports' => array(
			'anchor' => true
		)
	),
	'pie-chart' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/pie-chart',
		'version' => '0.1.0',
		'title' => 'Pie Chart',
		'category' => 'bpafb-widgets',
		'icon' => 'chart-pie',
		'description' => 'A dynamic pie and donut chart block using Chart.js.',
		'attributes' => array(
			'chartData' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'label' => 'Red',
						'value' => 300,
						'bg' => '#ff6384'
					),
					array(
						'id' => '2',
						'label' => 'Blue',
						'value' => 50,
						'bg' => '#36a2eb'
					),
					array(
						'id' => '3',
						'label' => 'Yellow',
						'value' => 100,
						'bg' => '#ffce56'
					)
				)
			),
			'legendPosition' => array(
				'type' => 'string',
				'default' => 'top'
			),
			'cutout' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 2
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'animationSpeed' => array(
				'type' => 'number',
				'default' => 1000
			),
			'alignment' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js'
	),
	'post-grid' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/post-grid',
		'version' => '0.1.0',
		'title' => 'Post Grid',
		'category' => 'bpafb-widgets',
		'icon' => 'grid-view',
		'description' => 'Dynamic post grid/listing block.',
		'supports' => array(
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true
			),
			'anchor' => true
		),
		'attributes' => array(
			'columns' => array(
				'type' => 'number',
				'default' => 3
			),
			'postsPerPage' => array(
				'type' => 'number',
				'default' => 9
			),
			'orderBy' => array(
				'type' => 'string',
				'default' => 'date'
			),
			'order' => array(
				'type' => 'string',
				'default' => 'desc'
			),
			'showImage' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showExcerpt' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showDate' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showAuthor' => array(
				'type' => 'boolean',
				'default' => true
			),
			'postType' => array(
				'type' => 'string',
				'default' => 'post'
			),
			'dateFormat' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'dateColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'authorColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'excerptColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'cardBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'cardBorderRadius' => array(
				'type' => 'number',
				'default' => 8
			),
			'cardBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'cardBorderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'cardBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'render' => 'file:./render.php',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./index.css'
	),
	'pricing-table' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/pricing-table',
		'version' => '0.1.0',
		'title' => 'Pricing Table',
		'category' => 'bpafb-widgets',
		'icon' => 'money-alt',
		'description' => 'A fully customizable pricing table block with features list and button.',
		'attributes' => array(
			'tables' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'title' => 'Pro Plan',
						'subtitle' => 'Best for growing businesses',
						'image' => '',
						'isFeatured' => false,
						'featuredBadge' => 'Most Popular',
						'currency' => '$',
						'price' => '99',
						'period' => '/ month',
						'buttonText' => 'Get Started',
						'buttonUrl' => '#',
						'features' => array(
							array(
								'id' => '1',
								'text' => '50 Users',
								'active' => true,
								'icon' => 'fas fa-check'
							),
							array(
								'id' => '2',
								'text' => '100GB Storage',
								'active' => true,
								'icon' => 'fas fa-check'
							),
							array(
								'id' => '3',
								'text' => '24/7 Support',
								'active' => true,
								'icon' => 'fas fa-check'
							),
							array(
								'id' => '4',
								'text' => 'Custom Domain',
								'active' => false,
								'icon' => 'fas fa-times'
							)
						)
					)
				)
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3
			),
			'columnGap' => array(
				'type' => 'number',
				'default' => 25
			),
			'layoutStyle' => array(
				'type' => 'string',
				'default' => 'style1'
			),
			'alignment' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'headerBgColor' => array(
				'type' => 'string',
				'default' => '#2563eb'
			),
			'headerTitleColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'headerSubtitleColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'priceColor' => array(
				'type' => 'string',
				'default' => '#1e293b'
			),
			'featureTextColor' => array(
				'type' => 'string',
				'default' => '#475569'
			),
			'buttonBgColor' => array(
				'type' => 'string',
				'default' => '#2563eb'
			),
			'buttonTextColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'badgeBgColor' => array(
				'type' => 'string'
			),
			'badgeTextColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'buttonBorderColor' => array(
				'type' => 'string'
			),
			'buttonBorderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'buttonBorderRadius' => array(
				'type' => 'number',
				'default' => 50
			),
			'boxBgColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => '#e2e8f0'
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 12
			),
			'boxShadow' => array(
				'type' => 'boolean',
				'default' => true
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css'
	),
	'progress-bar' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/progress-bar',
		'version' => '0.1.0',
		'title' => 'Progress Bar',
		'category' => 'bpafb-widgets',
		'icon' => 'performance',
		'description' => 'A premium animated progress bar widget.',
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Web Development'
			),
			'percentage' => array(
				'type' => 'number',
				'default' => 85
			),
			'displayPercentage' => array(
				'type' => 'boolean',
				'default' => true
			),
			'layoutStyle' => array(
				'type' => 'string',
				'default' => 'standard'
			),
			'barHeight' => array(
				'type' => 'number',
				'default' => 18
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 50
			),
			'isStriped' => array(
				'type' => 'boolean',
				'default' => false
			),
			'isAnimated' => array(
				'type' => 'boolean',
				'default' => true
			),
			'animationDuration' => array(
				'type' => 'number',
				'default' => 1500
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => '#1e293b'
			),
			'percentageColor' => array(
				'type' => 'string',
				'default' => '#1e293b'
			),
			'barColor' => array(
				'type' => 'string',
				'default' => '#4f46e5'
			),
			'trackColor' => array(
				'type' => 'string',
				'default' => '#f1f5f9'
			),
			'innerTextColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'alignment' => array(
				'type' => 'string',
				'default' => 'left'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'typography' => array(
				'fontSize' => true,
				'__experimentalFontWeight' => true
			),
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'viewScript' => 'file:./view.js',
		'style' => 'file:./index.css'
	),
	'social-icons' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/social-icons',
		'version' => '0.1.0',
		'title' => 'Social Icons',
		'category' => 'bpafb-widgets',
		'icon' => 'share',
		'description' => 'A premium social icons block with customizable controls.',
		'attributes' => array(
			'items' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'network' => 'facebook',
						'icon' => 'fab fa-facebook-f',
						'link' => '#',
						'color' => '#1877F2'
					),
					array(
						'id' => '2',
						'network' => 'twitter',
						'icon' => 'fa-brands fa-x-twitter',
						'link' => '#',
						'color' => '#000000'
					),
					array(
						'id' => '3',
						'network' => 'youtube',
						'icon' => 'fab fa-youtube',
						'link' => '#',
						'color' => '#FF0000'
					)
				)
			),
			'shape' => array(
				'type' => 'string',
				'default' => 'rounded'
			),
			'alignment' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'iconSize' => array(
				'type' => 'number',
				'default' => 18
			),
			'iconPadding' => array(
				'type' => 'number',
				'default' => 10
			),
			'iconSpacing' => array(
				'type' => 'number',
				'default' => 10
			),
			'colorType' => array(
				'type' => 'string',
				'default' => 'official'
			),
			'customPrimaryColor' => array(
				'type' => 'string',
				'default' => '#000000'
			),
			'customSecondaryColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'hoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css'
	),
	'tabs' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tabs',
		'version' => '0.1.0',
		'title' => 'Tabs',
		'category' => 'bpafb-widgets',
		'icon' => 'index-card',
		'description' => 'A modern Tab block with premium segmented control styling.',
		'attributes' => array(
			'items' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'title' => 'First Tab',
						'content' => 'This is the content for the first tab.'
					),
					array(
						'id' => '2',
						'title' => 'Second Tab',
						'content' => 'This is the content for the second tab.'
					),
					array(
						'id' => '3',
						'title' => 'Third Tab',
						'content' => 'This is the content for the third tab.'
					)
				)
			),
			'tabBgColor' => array(
				'type' => 'string',
				'default' => '#f1f5f9'
			),
			'tabActiveColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'textColor' => array(
				'type' => 'string',
				'default' => '#64748b'
			),
			'textActiveColor' => array(
				'type' => 'string',
				'default' => '#0f172a'
			),
			'contentBgColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'contentTextColor' => array(
				'type' => 'string',
				'default' => '#334155'
			),
			'tabBorderRadius' => array(
				'type' => 'number',
				'default' => 12
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'align' => array(
				'wide',
				'full'
			),
			'html' => false,
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js'
	),
	'team' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/team',
		'version' => '0.1.0',
		'title' => 'Team',
		'category' => 'bpafb-widgets',
		'icon' => 'groups',
		'description' => 'Team members showcase block.',
		'attributes' => array(
			'members' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'name' => 'John Smith',
						'role' => 'Team Lead',
						'image' => '',
						'bio' => 'Experienced team lead with expertise in project management.',
						'socialLinks' => array(
							
						)
					),
					array(
						'id' => '2',
						'name' => 'Alina Doe',
						'role' => 'CEO',
						'image' => '',
						'bio' => 'A very good and experienced in this field',
						'socialLinks' => array(
							
						)
					),
					array(
						'id' => '3',
						'name' => 'Aria Smith',
						'role' => 'Manager',
						'image' => '',
						'bio' => 'Manager is very good at her job',
						'socialLinks' => array(
							
						)
					)
				)
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3
			),
			'columnGap' => array(
				'type' => 'number',
				'default' => 25
			),
			'showImage' => array(
				'type' => 'boolean',
				'default' => true
			),
			'imageStyle' => array(
				'type' => 'string',
				'default' => 'circle'
			),
			'imageBorderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'imageBorderColor' => array(
				'type' => 'string',
				'default' => '#dddddd'
			),
			'textColor' => array(
				'type' => 'string',
				'default' => '#333333'
			),
			'descColor' => array(
				'type' => 'string',
				'default' => '#666666'
			),
			'positionColor' => array(
				'type' => 'string',
				'default' => '#4f46e5'
			),
			'bgColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'cardBorderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'cardBorderRadius' => array(
				'type' => 'number',
				'default' => 8
			),
			'cardBorderColor' => array(
				'type' => 'string',
				'default' => '#dddddd'
			),
			'enableBoxShadow' => array(
				'type' => 'boolean',
				'default' => true
			),
			'boxShadowHOffset' => array(
				'type' => 'number',
				'default' => 0
			),
			'boxShadowVOffset' => array(
				'type' => 'number',
				'default' => 2
			),
			'boxShadowBlur' => array(
				'type' => 'number',
				'default' => 8
			),
			'boxShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'boxShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0, 0, 0, 0.1)'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./index.css',
		'supports' => array(
			'anchor' => true
		)
	),
	'testimonial' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/testimonial',
		'version' => '0.1.0',
		'title' => 'Testimonial',
		'category' => 'bpafb-widgets',
		'icon' => 'format-quote',
		'description' => 'Customer testimonials slider block.',
		'attributes' => array(
			'testimonials' => array(
				'type' => 'array',
				'default' => array(
					array(
						'id' => '1',
						'name' => 'John Doe',
						'designation' => 'CEO',
						'image' => '',
						'content' => 'This is an amazing product! Highly recommended.',
						'rating' => 5
					),
					array(
						'id' => '2',
						'name' => 'Alina Doe',
						'designation' => 'Designer',
						'image' => '',
						'content' => 'The quality is good and the delivery was so fast.',
						'rating' => 4
					),
					array(
						'id' => '3',
						'name' => 'Aria Smith',
						'designation' => 'Manager',
						'image' => '',
						'content' => 'Excellent service and fast delivery. The product is exactly as described.',
						'rating' => 5
					)
				)
			),
			'style' => array(
				'type' => 'string',
				'default' => 'style1'
			),
			'showImage' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showRating' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showDots' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showArrows' => array(
				'type' => 'boolean',
				'default' => true
			),
			'textColor' => array(
				'type' => 'string',
				'default' => '#333333'
			),
			'descColor' => array(
				'type' => 'string',
				'default' => '#333333'
			),
			'positionColor' => array(
				'type' => 'string',
				'default' => '#999999'
			),
			'bgColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'arrowIcon' => array(
				'type' => 'string',
				'default' => 'angle'
			),
			'imagePosition' => array(
				'type' => 'string',
				'default' => 'top'
			),
			'imageStyle' => array(
				'type' => 'string',
				'default' => 'circle'
			),
			'textAlign' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'autoPlay' => array(
				'type' => 'boolean',
				'default' => true
			),
			'autoPlaySpeed' => array(
				'type' => 'number',
				'default' => 3000
			),
			'arrowColor' => array(
				'type' => 'string',
				'default' => '#333333'
			),
			'arrowBgColor' => array(
				'type' => 'string',
				'default' => 'transparent'
			),
			'infiniteLoop' => array(
				'type' => 'boolean',
				'default' => true
			),
			'cardBorderWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'cardBorderRadius' => array(
				'type' => 'number',
				'default' => 8
			),
			'cardBorderColor' => array(
				'type' => 'string',
				'default' => '#dddddd'
			),
			'enableBoxShadow' => array(
				'type' => 'boolean',
				'default' => true
			),
			'dotColor' => array(
				'type' => 'string',
				'default' => '#dddddd'
			),
			'activeDotColor' => array(
				'type' => 'string',
				'default' => '#4f46e5'
			),
			'boxShadowHOffset' => array(
				'type' => 'number',
				'default' => 0
			),
			'boxShadowVOffset' => array(
				'type' => 'number',
				'default' => 2
			),
			'boxShadowBlur' => array(
				'type' => 'number',
				'default' => 8
			),
			'boxShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'boxShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0, 0, 0, 0.1)'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./index.css',
		'viewScript' => 'file:./view.js',
		'supports' => array(
			'anchor' => true
		)
	),
	'video' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/video',
		'version' => '0.1.0',
		'title' => 'Video',
		'category' => 'bpafb-widgets',
		'icon' => 'video-alt',
		'description' => 'Video embedding block with customization options.',
		'attributes' => array(
			'videoUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'width' => array(
				'type' => 'string',
				'default' => '100%'
			),
			'height' => array(
				'type' => 'string',
				'default' => '400px'
			),
			'autoplay' => array(
				'type' => 'boolean',
				'default' => false
			),
			'controls' => array(
				'type' => 'boolean',
				'default' => true
			),
			'loop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'editorScript' => 'file:./index.js',
		'style' => 'file:./index.css',
		'supports' => array(
			'anchor' => true
		)
	),
	'author' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-author',
		'version' => '0.1.0',
		'title' => 'Author',
		'category' => 'blockive-template',
		'icon' => 'admin-users',
		'description' => 'Displays the current post\'s author name dynamically, optionally linked to their author archive. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'displayFormat' => array(
				'type' => 'string',
				'default' => 'display_name'
			),
			'isLink' => array(
				'type' => 'boolean',
				'default' => false
			),
			'linkTarget' => array(
				'type' => 'string',
				'default' => '_self'
			),
			'textAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'textHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => false,
				'gradients' => false,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalTextDecoration' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'author-avatar' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-author-avatar',
		'version' => '0.1.0',
		'title' => 'Author Avatar',
		'category' => 'blockive-template',
		'icon' => 'id',
		'description' => 'Displays the current post\'s author avatar dynamically, with size, border and shadow controls. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'size' => array(
				'type' => 'number',
				'default' => 96
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 9999
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 1
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'shadowEnabled' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'breadcrumbs' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-breadcrumbs',
		'version' => '0.1.0',
		'title' => 'Breadcrumbs',
		'category' => 'blockive-template',
		'icon' => 'admin-links',
		'description' => 'Displays a Home > Category > Title breadcrumb trail for the current post dynamically. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'separator' => array(
				'type' => 'string',
				'default' => '/'
			),
			'showHomeIcon' => array(
				'type' => 'boolean',
				'default' => true
			),
			'homeIcon' => array(
				'type' => 'string',
				'default' => 'fa-solid fa-house'
			),
			'textColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'textHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'categories' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-categories',
		'version' => '0.1.0',
		'title' => 'Categories',
		'category' => 'blockive-template',
		'icon' => 'category',
		'description' => 'Displays the current post\'s categories dynamically, as a plain list or as badges, with normal/hover colors. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'separator' => array(
				'type' => 'string',
				'default' => ', '
			),
			'badgeStyle' => array(
				'type' => 'boolean',
				'default' => false
			),
			'isLink' => array(
				'type' => 'boolean',
				'default' => true
			),
			'textColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'textHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'comments-count' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-comments-count',
		'version' => '0.1.0',
		'title' => 'Comments Count',
		'category' => 'blockive-template',
		'icon' => 'admin-comments',
		'description' => 'Displays the current post\'s comment count dynamically. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'icon' => array(
				'type' => 'string',
				'default' => 'fa-regular fa-comment'
			),
			'format' => array(
				'type' => 'string',
				'default' => '{count} Comments'
			),
			'textHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'isLink' => array(
				'type' => 'boolean',
				'default' => true
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'featured-image' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-featured-image',
		'version' => '0.1.0',
		'title' => 'Featured Image',
		'category' => 'blockive-template',
		'icon' => 'format-image',
		'description' => 'Displays the current post\'s featured image dynamically. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'imageSize' => array(
				'type' => 'string',
				'default' => 'large'
			),
			'aspectRatio' => array(
				'type' => 'string',
				'default' => ''
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 0
			),
			'objectFit' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'lazyLoad' => array(
				'type' => 'boolean',
				'default' => true
			),
			'isLink' => array(
				'type' => 'boolean',
				'default' => true
			),
			'overlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'hoverEffect' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderWidth' => array(
				'type' => 'number'
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'shadowEnabled' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'featured-video' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-featured-video',
		'version' => '0.1.0',
		'title' => 'Featured Video',
		'category' => 'blockive-template',
		'icon' => 'video-alt3',
		'description' => 'Displays the current post\'s featured video dynamically (post meta, auto-detected content video, or a manual fallback URL). Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'videoUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'metaKey' => array(
				'type' => 'string',
				'default' => 'featured_video_url'
			),
			'autoDetect' => array(
				'type' => 'boolean',
				'default' => true
			),
			'aspectRatio' => array(
				'type' => 'string',
				'default' => '16/9'
			),
			'borderRadius' => array(
				'type' => 'number',
				'default' => 0
			),
			'borderType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'borderWidth' => array(
				'type' => 'number'
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'shadowEnabled' => array(
				'type' => 'boolean',
				'default' => false
			),
			'shadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'shadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'shadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'modified-date' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-modified-date',
		'version' => '0.1.0',
		'title' => 'Modified Date',
		'category' => 'blockive-template',
		'icon' => 'update',
		'description' => 'Displays the current post\'s last modified date dynamically, with custom format and relative time. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'dateFormat' => array(
				'type' => 'string',
				'default' => ''
			),
			'relative' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true
			),
			'typography' => array(
				'fontSize' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'post-content' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-post-content',
		'version' => '0.1.0',
		'title' => 'Post Content',
		'category' => 'blockive-template',
		'icon' => 'editor-paragraph',
		'description' => 'Displays the current post\'s full content or excerpt dynamically, with optional drop cap and max width. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'displayMode' => array(
				'type' => 'string',
				'default' => 'full'
			),
			'maxWidth' => array(
				'type' => 'number',
				'default' => 0
			),
			'dropCap' => array(
				'type' => 'boolean',
				'default' => false
			),
			'textAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'color' => array(
				'text' => true,
				'background' => false,
				'gradients' => false,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalTextDecoration' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'post-meta' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-post-meta',
		'version' => '0.1.0',
		'title' => 'Post Meta',
		'category' => 'blockive-template',
		'icon' => 'list-view',
		'description' => 'A reorderable row of post meta items (author, date, categories, tags, comments, reading time). Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'items' => array(
				'type' => 'array',
				'default' => array(
					array(
						'key' => 'date',
						'enabled' => true
					),
					array(
						'key' => 'author',
						'enabled' => true
					),
					array(
						'key' => 'categories',
						'enabled' => true
					),
					array(
						'key' => 'comments',
						'enabled' => true
					),
					array(
						'key' => 'tags',
						'enabled' => false
					),
					array(
						'key' => 'readingTime',
						'enabled' => false
					)
				)
			),
			'separator' => array(
				'type' => 'string',
				'default' => '•'
			),
			'showIcons' => array(
				'type' => 'boolean',
				'default' => true
			),
			'linkHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'post-title' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-post-title',
		'version' => '0.1.0',
		'title' => 'Post Title',
		'category' => 'blockive-template',
		'icon' => 'editor-textcolor',
		'description' => 'Displays the current post\'s title dynamically. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'tagName' => array(
				'type' => 'string',
				'default' => 'h2'
			),
			'textAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'isLink' => array(
				'type' => 'boolean',
				'default' => false
			),
			'linkTarget' => array(
				'type' => 'string',
				'default' => '_self'
			),
			'textColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'textHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => false,
				'gradients' => false,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalTextDecoration' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'previous-next-navigation' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-previous-next-navigation',
		'version' => '0.1.0',
		'title' => 'Previous / Next Navigation',
		'category' => 'blockive-template',
		'icon' => 'controls-repeat',
		'description' => 'Links to the previous and next posts, dynamically. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'prevLabel' => array(
				'type' => 'string',
				'default' => 'Previous'
			),
			'nextLabel' => array(
				'type' => 'string',
				'default' => 'Next'
			),
			'prevIcon' => array(
				'type' => 'string',
				'default' => 'fa-solid fa-arrow-left'
			),
			'nextIcon' => array(
				'type' => 'string',
				'default' => 'fa-solid fa-arrow-right'
			),
			'hoverStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'inSameTerm' => array(
				'type' => 'boolean',
				'default' => false
			),
			'linkHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'publish-date' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-publish-date',
		'version' => '0.1.0',
		'title' => 'Publish Date',
		'category' => 'blockive-template',
		'icon' => 'calendar-alt',
		'description' => 'Displays the current post\'s publish date dynamically, with custom format, relative time and icon. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'dateFormat' => array(
				'type' => 'string',
				'default' => ''
			),
			'relative' => array(
				'type' => 'boolean',
				'default' => false
			),
			'icon' => array(
				'type' => 'string',
				'default' => 'fa-regular fa-calendar'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'reading-time' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-reading-time',
		'version' => '0.1.0',
		'title' => 'Reading Time',
		'category' => 'blockive-template',
		'icon' => 'clock',
		'description' => 'Displays the current post\'s estimated reading time dynamically. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'wpm' => array(
				'type' => 'number',
				'default' => 200
			),
			'icon' => array(
				'type' => 'string',
				'default' => 'fa-regular fa-clock'
			),
			'prefix' => array(
				'type' => 'string',
				'default' => ''
			),
			'suffix' => array(
				'type' => 'string',
				'default' => ' min read'
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	),
	'related-posts' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-related-posts',
		'version' => '0.1.0',
		'title' => 'Related Posts',
		'category' => 'blockive-template',
		'icon' => 'layout',
		'description' => 'Displays a grid or slider of posts related to the current post. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'numberOfPosts' => array(
				'type' => 'number',
				'default' => 3
			),
			'layout' => array(
				'type' => 'string',
				'default' => 'grid'
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3
			),
			'gridGap' => array(
				'type' => 'number',
				'default' => 20
			),
			'sliderColumns' => array(
				'type' => 'number',
				'default' => 3
			),
			'sliderAutoplay' => array(
				'type' => 'boolean',
				'default' => false
			),
			'sliderAutoplaySpeed' => array(
				'type' => 'number',
				'default' => 3000
			),
			'sliderLoop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'sliderShowArrows' => array(
				'type' => 'boolean',
				'default' => true
			),
			'sliderShowDots' => array(
				'type' => 'boolean',
				'default' => true
			),
			'sliderSpaceBetween' => array(
				'type' => 'number',
				'default' => 20
			),
			'orderBy' => array(
				'type' => 'string',
				'default' => 'date'
			),
			'order' => array(
				'type' => 'string',
				'default' => 'desc'
			),
			'sameCategory' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showImage' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showDate' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showExcerpt' => array(
				'type' => 'boolean',
				'default' => true
			),
			'contentType' => array(
				'type' => 'string',
				'default' => 'limited'
			),
			'excerptLength' => array(
				'type' => 'number',
				'default' => 20
			),
			'cardStyle' => array(
				'type' => 'string',
				'default' => 'modern'
			),
			'cardBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'cardBorderRadius' => array(
				'type' => 'number',
				'default' => 16
			),
			'cardPadding' => array(
				'type' => 'number',
				'default' => 18
			),
			'cardHoverElevation' => array(
				'type' => 'boolean',
				'default' => true
			),
			'imageZoom' => array(
				'type' => 'boolean',
				'default' => true
			),
			'imageBorderRadius' => array(
				'type' => 'number',
				'default' => 12
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleFontFamily' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleFontSize' => array(
				'type' => 'number'
			),
			'titleFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleLineHeight' => array(
				'type' => 'number'
			),
			'titleLetterSpacing' => array(
				'type' => 'number'
			),
			'titleTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleTextDecoration' => array(
				'type' => 'string',
				'default' => ''
			),
			'dateColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'excerptColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'anchor' => true
		),
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'tags' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'blockive-premium-addon-for-block/tb-tags',
		'version' => '0.1.0',
		'title' => 'Tags',
		'category' => 'blockive-template',
		'icon' => 'tag',
		'description' => 'Displays the current post\'s tags dynamically. Blockive Template Builder only.',
		'usesContext' => array(
			'postId',
			'postType'
		),
		'textdomain' => 'blockive-premium-addon-for-block',
		'attributes' => array(
			'separator' => array(
				'type' => 'string',
				'default' => ', '
			),
			'badgeStyle' => array(
				'type' => 'boolean',
				'default' => false
			),
			'linkHoverColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbUid' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbDisplay' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbOverflow' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbPosition' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerWidthUnit' => array(
				'type' => 'string',
				'default' => 'px'
			),
			'bpafbContainerMinHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerMaxHeight' => array(
				'type' => 'number'
			),
			'bpafbContainerBgType' => array(
				'type' => 'string',
				'default' => 'color'
			),
			'bpafbContainerBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBgImageId' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerBgImageSize' => array(
				'type' => 'string',
				'default' => 'cover'
			),
			'bpafbContainerOverlayColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBorderStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbContainerBorderWidth' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderRadius' => array(
				'type' => 'number'
			),
			'bpafbContainerBorderColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbContainerHoverBoxShadow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbContainerHoverShadowColor' => array(
				'type' => 'string',
				'default' => 'rgba(0,0,0,0.15)'
			),
			'bpafbContainerHoverShadowBlur' => array(
				'type' => 'number',
				'default' => 15
			),
			'bpafbContainerHoverShadowSpread' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHideDesktop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideTablet' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbHideMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbAnimationType' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbAnimationDuration' => array(
				'type' => 'number',
				'default' => 800
			),
			'bpafbAnimationDelay' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbAnimationEasing' => array(
				'type' => 'string',
				'default' => 'ease'
			),
			'bpafbTransformRotate' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformScale' => array(
				'type' => 'number',
				'default' => 100
			),
			'bpafbTransformTranslateX' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbTransformTranslateY' => array(
				'type' => 'number',
				'default' => 0
			),
			'bpafbHoverAnimation' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'bpafbFloatingEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'bpafbZIndex' => array(
				'type' => 'number'
			),
			'bpafbHtmlId' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbHtmlClasses' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbCustomCss' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'bpafbContainerPaddingTop' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTop' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRight' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRight' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottom' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeft' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftTablet' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginTopMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginRightMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginBottomMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerPaddingLeftMobile' => array(
				'type' => 'number'
			),
			'bpafbContainerMarginLeftMobile' => array(
				'type' => 'number'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => false,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalTextTransform' => true,
				'__experimentalTextDecoration' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			),
			'anchor' => true
		),
		'render' => 'file:./render.php'
	)
);
