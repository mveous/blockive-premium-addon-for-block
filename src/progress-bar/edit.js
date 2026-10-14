import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	BlockControls,
	AlignmentControl,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	ToggleControl,
	SelectControl,
	BaseControl,
	ColorPalette,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

const themeColors = [
	{ name: 'Indigo', color: '#4f46e5' },
	{ name: 'Blue', color: '#2563eb' },
	{ name: 'Dark Slate', color: '#0f172a' },
	{ name: 'Gray Element', color: '#f1f5f9' },
	{ name: 'Slate Gray', color: '#475569' },
	{ name: 'White', color: '#ffffff' },
	{ name: 'Red', color: '#ef4444' },
	{ name: 'Green', color: '#22c55e' },
	{ name: 'Gradient Mix', color: 'linear-gradient(90deg, #4f46e5 0%, #0ea5e9 100%)' },
];

export default function Edit({ attributes, setAttributes }) {
	const {
		title,
		percentage,
		displayPercentage,
		layoutStyle,
		barHeight,
		borderRadius,
		isStriped,
		isAnimated,
		animationDuration,
		titleColor,
		percentageColor,
		barColor,
		trackColor,
		innerTextColor,
		alignment,
	} = attributes;

	const customStyles = {
		'--bpafb-pb-height': `${barHeight !== undefined ? barHeight : 18}px`,
		'--bpafb-pb-radius': `${borderRadius !== undefined ? borderRadius : 50}px`,
		'--bpafb-pb-title-color': titleColor || '#1e293b',
		'--bpafb-pb-percent-color': percentageColor || '#1e293b',
		'--bpafb-pb-track-bg': trackColor || '#f1f5f9',
		'--bpafb-pb-inner-text': innerTextColor || '#ffffff',
	};

	let barBgStyle = {};
	if (barColor && barColor.includes('gradient')) {
		barBgStyle.backgroundImage = barColor;
	} else {
		barBgStyle.backgroundColor = barColor || '#4f46e5';
	}

	const blockProps = useBlockProps();

	return (
		<>
			<BlockControls>
				<AlignmentControl
					value={alignment}
					onChange={(newAlign) => setAttributes({ alignment: newAlign || 'left' })}
				/>
			</BlockControls>

			<InspectorTabs
				general={(
					<>
						<PanelBody title={__('Content Settings', 'blockive-premium-addon-for-block')} initialOpen={true}>
							<RangeControl
								label={__('Percentage (%)', 'blockive-premium-addon-for-block')}
								value={percentage}
								onChange={(val) => setAttributes({ percentage: val })}
								min={0}
								max={100}
							/>
							<ToggleControl
								label={__('Display Percentage Label?', 'blockive-premium-addon-for-block')}
								checked={displayPercentage}
								onChange={(val) => setAttributes({ displayPercentage: val })}
							/>
							<SegmentedControl
								label={__('Layout Style', 'blockive-premium-addon-for-block')}
								value={layoutStyle}
								options={[
									{ label: 'Standard (Top Info)', value: 'standard' },
									{ label: 'Inline Inside Bar', value: 'inside' },
								]}
								onChange={(val) => setAttributes({ layoutStyle: val })}
							/>
						</PanelBody>
					</>
				)}
				style={(
					<>
						<PanelBody title={__('Design Options', 'blockive-premium-addon-for-block')} initialOpen={true}>
							<RangeControl
								label={__('Bar Height (px)', 'blockive-premium-addon-for-block')}
								value={barHeight}
								onChange={(val) => setAttributes({ barHeight: val })}
								min={5}
								max={100}
							/>
							<RangeControl
								label={__('Border Radius (px)', 'blockive-premium-addon-for-block')}
								value={borderRadius}
								onChange={(val) => setAttributes({ borderRadius: val })}
								min={0}
								max={50}
							/>
							<ToggleControl
								label={__('Striped Bar?', 'blockive-premium-addon-for-block')}
								checked={isStriped}
								onChange={(val) => setAttributes({ isStriped: val })}
							/>
							{isStriped && (
								<ToggleControl
									label={__('Animate Stripes? (Scrolling)', 'blockive-premium-addon-for-block')}
									checked={isAnimated}
									onChange={(val) => setAttributes({ isAnimated: val })}
								/>
							)}
							<RangeControl
								label={__('Entrance Animation Speed (ms)', 'blockive-premium-addon-for-block')}
								value={animationDuration}
								onChange={(val) => setAttributes({ animationDuration: val })}
								min={500}
								max={5000}
								step={100}
								help={__('Controls how long the bar takes to fill up.', 'blockive-premium-addon-for-block')}
							/>
						</PanelBody>

						<PanelBody title={__('Colors', 'blockive-premium-addon-for-block')} initialOpen={false}>
							<BaseControl label={__('Bar Progress Color', 'blockive-premium-addon-for-block')}>
								<ColorPalette colors={themeColors} value={barColor || '#4f46e5'} onChange={(val) => setAttributes({ barColor: val })} />
							</BaseControl>
							<BaseControl label={__('Track Background', 'blockive-premium-addon-for-block')}>
								<ColorPalette colors={themeColors} value={trackColor || '#f1f5f9'} onChange={(val) => setAttributes({ trackColor: val })} />
							</BaseControl>
							<BaseControl label={__('Title Color', 'blockive-premium-addon-for-block')}>
								<ColorPalette colors={themeColors} value={titleColor || '#1e293b'} onChange={(val) => setAttributes({ titleColor: val })} />
							</BaseControl>
							<BaseControl label={__('Percentage Color', 'blockive-premium-addon-for-block')}>
								<ColorPalette colors={themeColors} value={percentageColor || '#1e293b'} onChange={(val) => setAttributes({ percentageColor: val })} />
							</BaseControl>

							{layoutStyle === 'inside' && (
								<BaseControl label={__('Inner Text Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={innerTextColor || '#ffffff'} onChange={(val) => setAttributes({ innerTextColor: val })} />
								</BaseControl>
							)}
						</PanelBody>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				<div 
					className={`bpafb-progress-bar-wrapper bpafb-pb-style-${layoutStyle || 'standard'}`}
					style={{ ...customStyles, textAlign: alignment || 'left' }}
				>
					{layoutStyle === 'standard' && (
						<div className="bpafb-pb-header">
							<RichText
								tagName="span"
								className="bpafb-pb-title"
								value={title}
								onChange={(val) => setAttributes({ title: val })}
								placeholder={__('Skill or Metric', 'blockive-premium-addon-for-block')}
							/>
							{displayPercentage && (
								<span className="bpafb-pb-percentage">{percentage}%</span>
							)}
						</div>
					)}

					<div
						className="bpafb-pb-track"
						role="progressbar"
						aria-valuenow={percentage}
						aria-valuemin={0}
						aria-valuemax={100}
						aria-label={title || __('Progress', 'blockive-premium-addon-for-block')}
					>
						<div
							className={`bpafb-pb-fill ${isStriped ? 'bpafb-pb-striped' : ''} ${isStriped && isAnimated ? 'bpafb-pb-striped-animated' : ''}`}
							style={{
								width: `${percentage}%`,
								...barBgStyle
							}}
						>
							{layoutStyle === 'inside' && (
								<div className="bpafb-pb-inner-content">
									<RichText
										tagName="span"
										className="bpafb-pb-inner-title"
										value={title}
										onChange={(val) => setAttributes({ title: val })}
										placeholder={__('Label', 'blockive-premium-addon-for-block')}
									/>
									{displayPercentage && (
										<span className="bpafb-pb-inner-percent">{percentage}%</span>
									)}
								</div>
							)}
						</div>
					</div>
				</div>
			</div>
		</>
	);
}
