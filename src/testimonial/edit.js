import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	TextareaControl,
	Button,
	SelectControl,
	ToggleControl,
	RangeControl,
	ColorPalette,
	ColorPicker,
} from '@wordpress/components';
import { useState } from '@wordpress/element';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

export default function Edit({ attributes, setAttributes }) {
	const {
		testimonials,
		style,
		showImage,
		showRating,
		showDots,
		showArrows,
		textColor,
		descColor,
		positionColor,
		bgColor,
		arrowIcon,
		imagePosition,
		imageStyle,
		textAlign,
		autoPlay,
		autoPlaySpeed,
		arrowColor,
		arrowBgColor,
		infiniteLoop,
		cardBorderWidth,
		cardBorderRadius,
		cardBorderColor,
		enableBoxShadow,
		dotColor,
		activeDotColor,
		boxShadowHOffset,
		boxShadowVOffset,
		boxShadowBlur,
		boxShadowSpread,
		boxShadowColor,
	} = attributes;

	const [activeIndex, setActiveIndex] = useState(0);

	const customStyles = {
		'--bpafb-testimonial-text-color': textColor,
		'--bpafb-testimonial-desc-color': descColor,
		'--bpafb-testimonial-position-color': positionColor,
		'--bpafb-testimonial-bg-color': bgColor,
		'--bpafb-arrow-color': arrowColor,
		'--bpafb-arrow-bg-color': arrowBgColor,
		'--bpafb-card-border-width': `${cardBorderWidth}px`,
		'--bpafb-card-border-radius': `${cardBorderRadius}px`,
		'--bpafb-card-border-color': cardBorderColor,
		'--bpafb-card-box-shadow': enableBoxShadow ? `${boxShadowHOffset}px ${boxShadowVOffset}px ${boxShadowBlur}px ${boxShadowSpread}px ${boxShadowColor}` : 'none',
		'--bpafb-dot-color': dotColor,
		'--bpafb-active-dot-color': activeDotColor,
	};

	const blockProps = useBlockProps({
		className: `bpafb-testimonial-wrapper bpafb-testimonial-${style} bpafb-image-pos-${imagePosition} bpafb-image-style-${imageStyle} bpafb-text-align-${textAlign}`,
		style: customStyles,
	});

	const updateTestimonial = (index, key, value) => {
		const newTestimonials = [...testimonials];
		newTestimonials[index] = { ...newTestimonials[index], [key]: value };
		setAttributes({ testimonials: newTestimonials });
	};

	const addTestimonial = () => {
		setAttributes({
			testimonials: [
				...testimonials,
				{
					id: Date.now().toString(),
					name: `Testimonial Author #${testimonials.length + 1}`,
					designation: 'Position',
					image: '',
					content: 'Enter testimonial content here...',
					rating: 5,
				},
			],
		});
		setActiveIndex(testimonials.length);
	};

	const removeTestimonial = (index) => {
		if (testimonials.length <= 1) return;
		const newTestimonials = testimonials.filter((_, i) => i !== index);
		setAttributes({ testimonials: newTestimonials });
		setActiveIndex(0);
	};

	return (
		<>
			<InspectorTabs
				general={(
					<>
			<PanelBody title={__('Testimonials', 'blockive-premium-addon-for-block')} initialOpen={true}>
				{testimonials.map((testimonial, index) => (
					<div key={testimonial.id} style={{ marginBottom: '15px', border: '1px solid #ddd', padding: '10px' }}>
						<TextControl
							label={__('Name', 'blockive-premium-addon-for-block')}
							value={testimonial.name}
							onChange={(val) => updateTestimonial(index, 'name', val)}
						/>
						<TextControl
							label={__('Designation', 'blockive-premium-addon-for-block')}
							value={testimonial.designation}
							onChange={(val) => updateTestimonial(index, 'designation', val)}
						/>
						<TextareaControl
							label={__('Testimonial Content', 'blockive-premium-addon-for-block')}
							value={testimonial.content}
							onChange={(val) => updateTestimonial(index, 'content', val)}
						/>
						<div style={{ marginBottom: '10px' }}>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={(media) => updateTestimonial(index, 'image', media.url)}
									allowedTypes={['image']}
									value={testimonial.image}
									render={({ open }) => (
										<div style={{ display: 'flex', gap: '10px' }}>
											<Button onClick={open} isPrimary size="small">
												{testimonial.image ? __('Change Image', 'blockive-premium-addon-for-block') : __('Select Image', 'blockive-premium-addon-for-block')}
											</Button>
											{testimonial.image && (
												<Button isDestructive size="small" onClick={() => updateTestimonial(index, 'image', '')}>
													{__('Remove Image', 'blockive-premium-addon-for-block')}
												</Button>
											)}
										</div>
									)}
								/>
							</MediaUploadCheck>
						</div>
						<StepperControl
							label={__('Rating', 'blockive-premium-addon-for-block')}
							value={testimonial.rating}
							onChange={(val) => updateTestimonial(index, 'rating', val)}
							min={1}
							max={5}
						/>
						<Button isDestructive onClick={() => removeTestimonial(index)} size="small" disabled={testimonials.length <= 1}>
							{__('Remove', 'blockive-premium-addon-for-block')}
						</Button>
					</div>
				))}
				<Button isPrimary onClick={addTestimonial}>
					{__('Add Testimonial', 'blockive-premium-addon-for-block')}
				</Button>
			</PanelBody>

			<PanelBody title={__('Settings', 'blockive-premium-addon-for-block')}>
				<ToggleControl
					label={__('Show Image', 'blockive-premium-addon-for-block')}
					checked={showImage}
					onChange={(val) => setAttributes({ showImage: val })}
				/>
				<ToggleControl
					label={__('Show Rating', 'blockive-premium-addon-for-block')}
					checked={showRating}
					onChange={(val) => setAttributes({ showRating: val })}
				/>
				<ToggleControl
					label={__('Show Dots', 'blockive-premium-addon-for-block')}
					checked={showDots}
					onChange={(val) => setAttributes({ showDots: val })}
				/>
				<ToggleControl
					label={__('Show Arrows', 'blockive-premium-addon-for-block')}
					checked={showArrows}
					onChange={(val) => setAttributes({ showArrows: val })}
				/>
				<SegmentedControl
					label={__('Arrow Icon', 'blockive-premium-addon-for-block')}
					value={arrowIcon}
					options={[
						{ label: __('Angle (❮ ❯)', 'blockive-premium-addon-for-block'), value: 'angle' },
						{ label: __('Chevron (‹ ›)', 'blockive-premium-addon-for-block'), value: 'chevron' },
						{ label: __('Long Arrow (← →)', 'blockive-premium-addon-for-block'), value: 'long-arrow' },
					]}
					onChange={(val) => setAttributes({ arrowIcon: val })}
				/>
				<ToggleControl
					label={__('Auto Play', 'blockive-premium-addon-for-block')}
					checked={autoPlay}
					onChange={(val) => setAttributes({ autoPlay: val })}
				/>
				{autoPlay && (
					<RangeControl
						label={__('Auto Play Speed (ms)', 'blockive-premium-addon-for-block')}
						value={autoPlaySpeed}
						onChange={(val) => setAttributes({ autoPlaySpeed: val })}
						min={1000}
						max={10000}
						step={500}
					/>
				)}
				<ToggleControl
					label={__('Infinite Loop', 'blockive-premium-addon-for-block')}
					checked={infiniteLoop}
					onChange={(val) => setAttributes({ infiniteLoop: val })}
				/>
			</PanelBody>
					</>
				)}
				style={(
					<>
			<PanelBody title={__('Card Styles', 'blockive-premium-addon-for-block')}>
				<SegmentedControl
					label={__('Image Position', 'blockive-premium-addon-for-block')}
					value={imagePosition}
					options={[
						{ label: __('Top', 'blockive-premium-addon-for-block'), value: 'top' },
						{ label: __('Bottom', 'blockive-premium-addon-for-block'), value: 'bottom' },
						{ label: __('Left', 'blockive-premium-addon-for-block'), value: 'left' },
						{ label: __('Right', 'blockive-premium-addon-for-block'), value: 'right' },
					]}
					onChange={(val) => setAttributes({ imagePosition: val })}
				/>
				<SegmentedControl
					label={__('Image Style', 'blockive-premium-addon-for-block')}
					value={imageStyle}
					options={[
						{ label: __('Circle', 'blockive-premium-addon-for-block'), value: 'circle' },
						{ label: __('Rounded', 'blockive-premium-addon-for-block'), value: 'rounded' },
						{ label: __('Square', 'blockive-premium-addon-for-block'), value: 'square' },
					]}
					onChange={(val) => setAttributes({ imageStyle: val })}
				/>
				<SegmentedControl
					label={__('Text Alignment', 'blockive-premium-addon-for-block')}
					value={textAlign}
					options={[
						{ label: __('Left', 'blockive-premium-addon-for-block'), value: 'left' },
						{ label: __('Center', 'blockive-premium-addon-for-block'), value: 'center' },
						{ label: __('Right', 'blockive-premium-addon-for-block'), value: 'right' },
					]}
					onChange={(val) => setAttributes({ textAlign: val })}
				/>
				<ToggleControl
					label={__('Enable Box Shadow', 'blockive-premium-addon-for-block')}
					checked={enableBoxShadow}
					onChange={(val) => setAttributes({ enableBoxShadow: val })}
				/>
				{enableBoxShadow && (
					<div style={{ marginLeft: '10px', paddingLeft: '10px', borderLeft: '2px solid #ddd', marginBottom: '15px' }}>
						<RangeControl
							label={__('Horizontal Offset', 'blockive-premium-addon-for-block')}
							value={boxShadowHOffset}
							onChange={(val) => setAttributes({ boxShadowHOffset: val })}
							min={-50}
							max={50}
						/>
						<RangeControl
							label={__('Vertical Offset', 'blockive-premium-addon-for-block')}
							value={boxShadowVOffset}
							onChange={(val) => setAttributes({ boxShadowVOffset: val })}
							min={-50}
							max={50}
						/>
						<RangeControl
							label={__('Blur Radius', 'blockive-premium-addon-for-block')}
							value={boxShadowBlur}
							onChange={(val) => setAttributes({ boxShadowBlur: val })}
							min={0}
							max={100}
						/>
						<RangeControl
							label={__('Spread Radius', 'blockive-premium-addon-for-block')}
							value={boxShadowSpread}
							onChange={(val) => setAttributes({ boxShadowSpread: val })}
							min={-50}
							max={50}
						/>
					</div>
				)}
				<RangeControl
					label={__('Border Width (px)', 'blockive-premium-addon-for-block')}
					value={cardBorderWidth}
					onChange={(val) => setAttributes({ cardBorderWidth: val })}
					min={0}
					max={20}
				/>
				<RangeControl
					label={__('Border Radius (px)', 'blockive-premium-addon-for-block')}
					value={cardBorderRadius}
					onChange={(val) => setAttributes({ cardBorderRadius: val })}
					min={0}
					max={100}
				/>
			</PanelBody>

			<PanelBody title={__('Colors', 'blockive-premium-addon-for-block')}>
				{enableBoxShadow && (
					<div style={{ marginBottom: '15px' }}>
						<label>{__('Box Shadow Color', 'blockive-premium-addon-for-block')}</label>
						<ColorPicker
							color={boxShadowColor}
							onChange={(val) => setAttributes({ boxShadowColor: val })}
							enableAlpha
							defaultValue="rgba(0, 0, 0, 0.1)"
						/>
					</div>
				)}
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Card Border Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={cardBorderColor}
						onChange={(val) => setAttributes({ cardBorderColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Text Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={textColor}
						onChange={(val) => setAttributes({ textColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Description Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={descColor}
						onChange={(val) => setAttributes({ descColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Position Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={positionColor}
						onChange={(val) => setAttributes({ positionColor: val })}
					/>
				</div>
				<div>
					<label>{__('Background Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={bgColor}
						onChange={(val) => setAttributes({ bgColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Arrow Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={arrowColor}
						onChange={(val) => setAttributes({ arrowColor: val })}
					/>
				</div>
				<div>
					<label>{__('Arrow Background Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={arrowBgColor}
						onChange={(val) => setAttributes({ arrowBgColor: val })}
					/>
				</div>
				{showDots && (
					<>
						<div style={{ marginBottom: '15px', marginTop: '15px' }}>
							<label>{__('Dot Color', 'blockive-premium-addon-for-block')}</label>
							<ColorPalette
								value={dotColor}
								onChange={(val) => setAttributes({ dotColor: val })}
							/>
						</div>
						<div>
							<label>{__('Active Dot Color', 'blockive-premium-addon-for-block')}</label>
							<ColorPalette
								value={activeDotColor}
								onChange={(val) => setAttributes({ activeDotColor: val })}
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

			<div {...blockProps}>
				<div className="bpafb-testimonial-slider">
					{testimonials.map((testimonial, index) => (
						<div
							key={testimonial.id}
							className={`bpafb-testimonial-item ${activeIndex === index ? 'active' : ''}`}
						>
							{showImage && testimonial.image && (
								<img
									src={testimonial.image}
									alt={testimonial.name}
									className="bpafb-testimonial-image"
								/>
							)}
							<div className="bpafb-testimonial-text-wrap">
								<p className="bpafb-testimonial-content">{testimonial.content}</p>
								{showRating && (
									<div className="bpafb-testimonial-rating" role="img" aria-label={`${testimonial.rating} ${__('out of 5 stars', 'blockive-premium-addon-for-block')}`}>
										{[...Array(testimonial.rating)].map((_, i) => (
											<span key={i} className="bpafb-star" aria-hidden="true">★</span>
										))}
									</div>
								)}
								<p className="bpafb-testimonial-name">{testimonial.name}</p>
								<p className="bpafb-testimonial-designation">{testimonial.designation}</p>
							</div>
						</div>
					))}

					{showArrows && (
						<>
							<button
								className="bpafb-arrow bpafb-prev"
								type="button"
								aria-label={__('Previous testimonial', 'blockive-premium-addon-for-block')}
								onClick={() => {
									if (!infiniteLoop && activeIndex === 0) return;
									setActiveIndex((activeIndex - 1 + testimonials.length) % testimonials.length);
								}}
								style={{ opacity: (!infiniteLoop && activeIndex === 0) ? 0.5 : 1, cursor: (!infiniteLoop && activeIndex === 0) ? 'not-allowed' : 'pointer' }}
							>
								{arrowIcon === 'chevron' ? '‹' : arrowIcon === 'long-arrow' ? '←' : '❮'}
							</button>
							<button
								className="bpafb-arrow bpafb-next"
								type="button"
								aria-label={__('Next testimonial', 'blockive-premium-addon-for-block')}
								onClick={() => {
									if (!infiniteLoop && activeIndex === testimonials.length - 1) return;
									setActiveIndex((activeIndex + 1) % testimonials.length);
								}}
								style={{ opacity: (!infiniteLoop && activeIndex === testimonials.length - 1) ? 0.5 : 1, cursor: (!infiniteLoop && activeIndex === testimonials.length - 1) ? 'not-allowed' : 'pointer' }}
							>
								{arrowIcon === 'chevron' ? '›' : arrowIcon === 'long-arrow' ? '→' : '❯'}
							</button>
						</>
					)}

					{showDots && (
						<div className="bpafb-testimonial-dots">
							{testimonials.map((_, index) => (
								<button
									key={index}
									className={`bpafb-dot ${activeIndex === index ? 'active' : ''}`}
									type="button"
									aria-label={`${__('Go to testimonial', 'blockive-premium-addon-for-block')} ${index + 1}`}
									onClick={() => setActiveIndex(index)}
								/>
							))}
						</div>
					)}
				</div>
			</div>
		</>
	);
}
