import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	BlockControls,
	AlignmentControl,
} from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	TextControl,
	RangeControl,
	ToggleControl,
	BaseControl,
	ColorPalette,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';

export default function Edit({ attributes, setAttributes }) {
	const {
		content,
		level,
		alignment,
		link,
		linkTarget,
		textShadowColor,
		textShadowBlur,
		textShadowX,
		textShadowY,
		blendMode,
		animationType,
		animationDuration,
		animationDelay,
	} = attributes;

	const customStyles = {};
	if (alignment) customStyles.textAlign = alignment;

	if (textShadowX || textShadowY || textShadowBlur) {
		customStyles.textShadow = `${textShadowX || 0}px ${textShadowY || 0}px ${textShadowBlur || 0}px ${textShadowColor || '#000'}`;
	}
	if (blendMode && blendMode !== 'normal') {
		customStyles.mixBlendMode = blendMode;
	}
	if (animationType !== 'none') {
		customStyles.animationDuration = animationDuration;
		customStyles.animationDelay = animationDelay;
	}

	const blockProps = useBlockProps({
		className: animationType !== 'none' ? `bpafb-animate-${animationType}` : '',
		style: customStyles,
	});

	const TagName = `h${level}`;

	return (
		<>
			<BlockControls>
				<AlignmentControl
					value={alignment}
					onChange={(newAlign) => setAttributes({ alignment: newAlign })}
				/>
			</BlockControls>

			<InspectorTabs
				general={(
					<>
			<PanelBody title={__('Settings', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<SelectControl
					label={__('HTML Tag', 'blockive-premium-addon-for-block')}
					value={level}
					options={[
						{ label: 'H1', value: 1 },
						{ label: 'H2', value: 2 },
						{ label: 'H3', value: 3 },
						{ label: 'H4', value: 4 },
						{ label: 'H5', value: 5 },
						{ label: 'H6', value: 6 },
					]}
					onChange={(newLevel) => setAttributes({ level: parseInt(newLevel) })}
				/>
				<TextControl
					label={__('Link', 'blockive-premium-addon-for-block')}
					value={link}
					onChange={(val) => setAttributes({ link: val })}
				/>
				{link && (
					<ToggleControl
						label={__('Open in new tab', 'blockive-premium-addon-for-block')}
						checked={linkTarget === '_blank'}
						onChange={(val) => setAttributes({ linkTarget: val ? '_blank' : '_self' })}
					/>
				)}
			</PanelBody>
					</>
				)}
				style={(
					<>
			<PanelBody title={__('Motion Effects', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<SelectControl
					label={__('Entrance Animation', 'blockive-premium-addon-for-block')}
					value={animationType}
					options={[
						{ label: 'None', value: 'none' },
						{ label: 'Fade In', value: 'fadeIn' },
						{ label: 'Fade In Up', value: 'fadeInUp' },
						{ label: 'Fade In Down', value: 'fadeInDown' },
						{ label: 'Zoom In', value: 'zoomIn' },
						{ label: 'Slide In Left', value: 'slideInLeft' },
						{ label: 'Slide In Right', value: 'slideInRight' },
					]}
					onChange={(val) => setAttributes({ animationType: val })}
				/>
				{animationType !== 'none' && (
					<>
						<TextControl
							label={__('Animation Duration (e.g., 1s, 500ms)', 'blockive-premium-addon-for-block')}
							value={animationDuration}
							onChange={(val) => setAttributes({ animationDuration: val })}
						/>
						<TextControl
							label={__('Animation Delay (e.g., 0s, 200ms)', 'blockive-premium-addon-for-block')}
							value={animationDelay}
							onChange={(val) => setAttributes({ animationDelay: val })}
						/>
					</>
				)}
			</PanelBody>

			<PanelBody title={__('Advanced Effects', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<SelectControl
					label={__('Blend Mode', 'blockive-premium-addon-for-block')}
					value={blendMode}
					options={[
						{ label: 'Normal', value: 'normal' },
						{ label: 'Multiply', value: 'multiply' },
						{ label: 'Screen', value: 'screen' },
						{ label: 'Overlay', value: 'overlay' },
						{ label: 'Darken', value: 'darken' },
						{ label: 'Lighten', value: 'lighten' },
						{ label: 'Color Dodge', value: 'color-dodge' },
						{ label: 'Color Burn', value: 'color-burn' },
						{ label: 'Difference', value: 'difference' },
						{ label: 'Exclusion', value: 'exclusion' },
						{ label: 'Hue', value: 'hue' },
						{ label: 'Saturation', value: 'saturation' },
						{ label: 'Color', value: 'color' },
						{ label: 'Luminosity', value: 'luminosity' },
					]}
					onChange={(val) => setAttributes({ blendMode: val })}
				/>

				<BaseControl label={__('Text Shadow Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette
						value={textShadowColor}
						onChange={(val) => setAttributes({ textShadowColor: val })}
					/>
				</BaseControl>

				<RangeControl
					label={__('Text Shadow Blur', 'blockive-premium-addon-for-block')}
					value={textShadowBlur}
					onChange={(val) => setAttributes({ textShadowBlur: val })}
					min={0}
					max={100}
				/>
				<RangeControl
					label={__('Text Shadow X', 'blockive-premium-addon-for-block')}
					value={textShadowX}
					onChange={(val) => setAttributes({ textShadowX: val })}
					min={-100}
					max={100}
				/>
				<RangeControl
					label={__('Text Shadow Y', 'blockive-premium-addon-for-block')}
					value={textShadowY}
					onChange={(val) => setAttributes({ textShadowY: val })}
					min={-100}
					max={100}
				/>
			</PanelBody>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<RichText
				{...blockProps}
				tagName={TagName}
				value={content}
				onChange={(val) => setAttributes({ content: val })}
				placeholder={__('Enter heading...', 'blockive-premium-addon-for-block')}
				allowedFormats={['core/bold', 'core/italic', 'core/link']}
			/>
		</>
	);
}
