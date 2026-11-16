import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
	RangeControl,
	ToggleControl,
	ColorPalette,
	SelectControl,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

export default function Edit({ attributes, setAttributes }) {
	const {
		beforeImage,
		afterImage,
		beforeLabel,
		afterLabel,
		showLabels,
		labelColor,
		labelBackgroundColor,
		labelPosition,
		separatorColor,
		arrowColor,
		sliderPosition,
		height,
	} = attributes;

	const customStyles = {
		height: height,
		'--bpafb-label-color': labelColor,
		'--bpafb-label-bg': labelBackgroundColor,
		'--bpafb-separator-color': separatorColor,
		'--bpafb-arrow-color': arrowColor,
	};

	const blockProps = useBlockProps({
		className: 'bpafb-image-comparison',
		style: customStyles,
	});

	return (
		<>
			<InspectorTabs
				general={(
					<>
			<PanelBody title={__('Images', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<div style={{ marginBottom: '15px' }}>
					<label style={{ display: 'block', marginBottom: '8px' }}>{__('Before Image', 'blockive-premium-addon-for-block')}</label>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={(media) => setAttributes({ beforeImage: media.url })}
							allowedTypes={['image']}
							value={beforeImage}
							render={({ open }) => (
								<Button onClick={open} isPrimary>
									{beforeImage ? __('Change Image', 'blockive-premium-addon-for-block') : __('Select Image', 'blockive-premium-addon-for-block')}
								</Button>
							)}
						/>
					</MediaUploadCheck>
				</div>

				<div style={{ marginBottom: '15px' }}>
					<label style={{ display: 'block', marginBottom: '8px' }}>{__('After Image', 'blockive-premium-addon-for-block')}</label>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={(media) => setAttributes({ afterImage: media.url })}
							allowedTypes={['image']}
							value={afterImage}
							render={({ open }) => (
								<Button onClick={open} isPrimary>
									{afterImage ? __('Change Image', 'blockive-premium-addon-for-block') : __('Select Image', 'blockive-premium-addon-for-block')}
								</Button>
							)}
						/>
					</MediaUploadCheck>
				</div>
			</PanelBody>

			<PanelBody title={__('Settings', 'blockive-premium-addon-for-block')}>
				<ToggleControl
					label={__('Show Labels', 'blockive-premium-addon-for-block')}
					checked={showLabels}
					onChange={(val) => setAttributes({ showLabels: val })}
				/>

				{showLabels && (
					<>
						<TextControl
							label={__('Before Label', 'blockive-premium-addon-for-block')}
							value={beforeLabel}
							onChange={(val) => setAttributes({ beforeLabel: val })}
						/>
						<TextControl
							label={__('After Label', 'blockive-premium-addon-for-block')}
							value={afterLabel}
							onChange={(val) => setAttributes({ afterLabel: val })}
						/>
						<SegmentedControl
							label={__('Label Position', 'blockive-premium-addon-for-block')}
							value={labelPosition}
							options={[
								{ label: __('Top', 'blockive-premium-addon-for-block'), value: 'top' },
								{ label: __('Center', 'blockive-premium-addon-for-block'), value: 'center' },
								{ label: __('Bottom', 'blockive-premium-addon-for-block'), value: 'bottom' },
							]}
							onChange={(val) => setAttributes({ labelPosition: val })}
						/>
					</>
				)}

				<RangeControl
					label={__('Initial Slider Position (%)', 'blockive-premium-addon-for-block')}
					value={sliderPosition}
					onChange={(val) => setAttributes({ sliderPosition: val })}
					min={0}
					max={100}
					step={1}
				/>

				<TextControl
					label={__('Height (e.g., 400px)', 'blockive-premium-addon-for-block')}
					value={height}
					onChange={(val) => setAttributes({ height: val })}
				/>
			</PanelBody>
					</>
				)}
				style={(
					<>
			<PanelBody title={__('Colors', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Separator Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={separatorColor}
						onChange={(val) => setAttributes({ separatorColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Arrow Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={arrowColor}
						onChange={(val) => setAttributes({ arrowColor: val })}
					/>
				</div>
				{showLabels && (
					<>
						<div style={{ marginBottom: '15px' }}>
							<label>{__('Label Text Color', 'blockive-premium-addon-for-block')}</label>
							<ColorPalette
								value={labelColor}
								onChange={(val) => setAttributes({ labelColor: val })}
							/>
						</div>
						<div style={{ marginBottom: '15px' }}>
							<label>{__('Label Background Color', 'blockive-premium-addon-for-block')}</label>
							<ColorPalette
								value={labelBackgroundColor}
								onChange={(val) => setAttributes({ labelBackgroundColor: val })}
							/>
						</div>
					</>
				)}
			</PanelBody>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div
				{...blockProps}
				data-position={sliderPosition}
				data-label-position={labelPosition}
			>
				<div className="bpafb-comparison-image after-image" style={{ backgroundImage: afterImage ? `url(${afterImage})` : 'none' }}>
					{showLabels && <span className="bpafb-label after-label">{afterLabel}</span>}
				</div>
				<div className="bpafb-comparison-image before-image" style={{ backgroundImage: beforeImage ? `url(${beforeImage})` : 'none', clipPath: `inset(0 ${100 - sliderPosition}% 0 0)` }}>
					{showLabels && <span className="bpafb-label before-label">{beforeLabel}</span>}
				</div>
				{beforeImage && (
					<img src={beforeImage} alt="" style={{ visibility: 'hidden', display: 'block', width: '100%', height: 'auto', pointerEvents: 'none' }} />
				)}
				<div className="bpafb-comparison-handle" style={{ left: `${sliderPosition}%` }}>
					<span className="bpafb-handle-icon"></span>
				</div>
			</div>
		</>
	);
}
