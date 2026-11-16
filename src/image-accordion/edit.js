import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	RichText,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	PanelBody,
	ColorPalette,
	RangeControl,
	TextControl,
	Button,
	ResponsiveWrapper,
	SelectControl,
	ToggleControl,
	TextareaControl,
} from '@wordpress/components';
import { useState } from '@wordpress/element';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';
import { getSafeUrl } from '../utils/safe-url';

export default function Edit({ attributes, setAttributes }) {
	const {
		items,
		titleColor,
		contentColor,
		overlayOpacity,
		animationDuration,
		height,
		imageSize,
		imagePosition,
		showTitle,
		showContent,
	} = attributes;

	const [activeIndex, setActiveIndex] = useState(0);

	const customStyles = {
		'--bpafb-image-accordion-title-color': titleColor,
		'--bpafb-image-accordion-content-color': contentColor,
		'--bpafb-image-accordion-overlay-opacity': overlayOpacity,
		'--bpafb-image-accordion-animation': animationDuration,
		'--bpafb-image-accordion-height': height,
		'--bpafb-image-accordion-bg-size': imageSize,
		'--bpafb-image-accordion-bg-position': imagePosition,
	};

	const blockProps = useBlockProps({
		className: 'bpafb-image-accordion-wrapper',
		style: customStyles,
	});

	const updateItem = (index, key, value) => {
		const newItems = [...items];
		newItems[index] = { ...newItems[index], [key]: value };
		setAttributes({ items: newItems });
	};

	const addItem = () => {
		setAttributes({
			items: [
				...items,
				{
					id: Date.now().toString(),
					title: `Image Accordion Item #${items.length + 1}`,
					imageUrl: '',
					content: 'Enter content here...',
				},
			],
		});
		setActiveIndex(items.length);
	};

	const removeItem = (index) => {
		const newItems = items.filter((_, i) => i !== index);
		setAttributes({ items: newItems });
		setActiveIndex(0);
	};

	return (
		<>
			<InspectorTabs
				general={(
					<>
			<PanelBody title={__('Image Accordion Items', 'blockive-premium-addon-for-block')} initialOpen={true}>
				{items.map((item, index) => (
					<div key={item.id} style={{ marginBottom: '15px', border: '1px solid #ddd', padding: '10px' }}>
						<TextControl
							label={__('Title', 'blockive-premium-addon-for-block')}
							value={item.title}
							onChange={(val) => updateItem(index, 'title', val)}
						/>
						<TextareaControl
							label={__('Description', 'blockive-premium-addon-for-block')}
							value={item.content}
							onChange={(val) => updateItem(index, 'content', val)}
						/>
						<div style={{ marginBottom: '10px' }}>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={(media) => updateItem(index, 'imageUrl', media.url)}
									allowedTypes={['image']}
									value={item.imageUrl}
									render={({ open }) => (
										<Button onClick={open} isPrimary>
											{item.imageUrl ? __('Change Image', 'blockive-premium-addon-for-block') : __('Select Image', 'blockive-premium-addon-for-block')}
										</Button>
									)}
								/>
							</MediaUploadCheck>
						</div>
						<Button isDestructive onClick={() => removeItem(index)}>
							{__('Remove Item', 'blockive-premium-addon-for-block')}
						</Button>
					</div>
				))}
				<Button isPrimary onClick={addItem}>
					{__('Add Item', 'blockive-premium-addon-for-block')}
				</Button>
			</PanelBody>

			<PanelBody title={__('Settings', 'blockive-premium-addon-for-block')}>
				<ToggleControl
					label={__('Show Title', 'blockive-premium-addon-for-block')}
					checked={showTitle}
					onChange={(val) => setAttributes({ showTitle: val })}
				/>
				<ToggleControl
					label={__('Show Description', 'blockive-premium-addon-for-block')}
					checked={showContent}
					onChange={(val) => setAttributes({ showContent: val })}
				/>
			</PanelBody>
					</>
				)}
				style={(
					<>
			<PanelBody title={__('Styling', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Title Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={titleColor}
						onChange={(val) => setAttributes({ titleColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Content Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={contentColor}
						onChange={(val) => setAttributes({ contentColor: val })}
					/>
				</div>
				<TextControl
					label={__('Height', 'blockive-premium-addon-for-block')}
					value={height}
					onChange={(val) => setAttributes({ height: val })}
					help={__('e.g. 400px, 50vh', 'blockive-premium-addon-for-block')}
				/>
				<TextControl
					label={__('Animation Duration', 'blockive-premium-addon-for-block')}
					value={animationDuration}
					onChange={(val) => setAttributes({ animationDuration: val })}
					help={__('e.g. 0.3s, 500ms', 'blockive-premium-addon-for-block')}
				/>
				<RangeControl
					label={__('Overlay Opacity', 'blockive-premium-addon-for-block')}
					value={overlayOpacity}
					onChange={(val) => setAttributes({ overlayOpacity: val })}
					min={0}
					max={1}
					step={0.1}
				/>
				<SegmentedControl
					label={__('Image Size', 'blockive-premium-addon-for-block')}
					value={imageSize}
					options={[
						{ label: __('Cover', 'blockive-premium-addon-for-block'), value: 'cover' },
						{ label: __('Contain', 'blockive-premium-addon-for-block'), value: 'contain' },
						{ label: __('Auto', 'blockive-premium-addon-for-block'), value: 'auto' },
					]}
					onChange={(val) => setAttributes({ imageSize: val })}
				/>
				<SelectControl
					label={__('Image Position', 'blockive-premium-addon-for-block')}
					value={imagePosition}
					options={[
						{ label: __('Center Center', 'blockive-premium-addon-for-block'), value: 'center center' },
						{ label: __('Center Top', 'blockive-premium-addon-for-block'), value: 'center top' },
						{ label: __('Center Bottom', 'blockive-premium-addon-for-block'), value: 'center bottom' },
						{ label: __('Left Center', 'blockive-premium-addon-for-block'), value: 'left center' },
						{ label: __('Left Top', 'blockive-premium-addon-for-block'), value: 'left top' },
						{ label: __('Left Bottom', 'blockive-premium-addon-for-block'), value: 'left bottom' },
						{ label: __('Right Center', 'blockive-premium-addon-for-block'), value: 'right center' },
						{ label: __('Right Top', 'blockive-premium-addon-for-block'), value: 'right top' },
						{ label: __('Right Bottom', 'blockive-premium-addon-for-block'), value: 'right bottom' },
					]}
					onChange={(val) => setAttributes({ imagePosition: val })}
				/>
			</PanelBody>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				<div className="bpafb-image-accordion">
					{items.map((item, index) => (
						<div
							key={item.id}
							className={`bpafb-image-accordion-item ${activeIndex === index ? 'active' : ''}`}
							role="button"
							tabIndex={0}
							aria-current={activeIndex === index ? 'true' : 'false'}
							onClick={() => setActiveIndex(index)}
							onKeyDown={(event) => {
								if (event.key === 'Enter' || event.key === ' ') {
									event.preventDefault();
									setActiveIndex(index);
								}
							}}
							style={{
								backgroundImage: item.imageUrl ? `url(${getSafeUrl(item.imageUrl, { allowAnchor: false })})` : 'none',
							}}
						>
							<div className="bpafb-image-accordion-content">
								{showTitle && <h3>{item.title}</h3>}
								{showContent && <p>{item.content}</p>}
							</div>
						</div>
					))}
				</div>
			</div>
		</>
	);
}
