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
	BaseControl,
	SelectControl,
	TextControl,
	ToggleControl,
	RangeControl,
	Button,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';
import ColorStateControls from '../components/color-state-controls';

export default function Edit({ attributes, setAttributes }) {
	const {
		imageUrl,
		imageId,
		imageAlt,
		title,
		titleTag,
		description,
		linkUrl,
		linkText,
		linkTarget,
		imagePosition,
		contentAlign,
		verticalAlign,
		imageSize,
		imageRadius,
		titleColor,
		titleColorHover,
		descColor,
		linkColor,
		linkColorHover,
		boxBgColor,
		boxBgColorHover,
		imageSpacing,
	} = attributes;

	const customStyles = {
		'--bpafb-imgbox-img-radius': `${imageRadius}px`,
		'--bpafb-imgbox-title-color': titleColor,
		'--bpafb-imgbox-title-color-hover': titleColorHover,
		'--bpafb-imgbox-desc-color': descColor,
		'--bpafb-imgbox-link-color': linkColor,
		'--bpafb-imgbox-link-color-hover': linkColorHover,
		'--bpafb-imgbox-box-bg': boxBgColor,
		'--bpafb-imgbox-box-bg-hover': boxBgColorHover,
		'--bpafb-imgbox-spacing': `${imageSpacing}px`,
		'--bpafb-imgbox-align': contentAlign,
		'--bpafb-imgbox-valign': verticalAlign === 'top' ? 'flex-start' : (verticalAlign === 'bottom' ? 'flex-end' : 'center'),
		'--bpafb-imgbox-img-width': imageSize,
	};

	const blockProps = useBlockProps({
		className: `bpafb-image-box-wrapper bpafb-image-box--${imagePosition}`,
		style: customStyles,
	});

	const onSelectImage = (media) => {
		setAttributes({
			imageUrl: media.url,
			imageId: media.id,
			imageAlt: media.alt || media.title || '',
		});
	};

	const removeImage = () => {
		setAttributes({
			imageUrl: '',
			imageId: 0,
			imageAlt: '',
		});
	};

	const generalTab = (
		<PanelBody title={__('Content', 'blockive-premium-addon-for-block')} initialOpen={true}>
			<BaseControl label={__('Image', 'blockive-premium-addon-for-block')} className="bpafb-image-upload-control">
				{imageUrl ? (
					<div className="bpafb-image-preview" style={{ marginBottom: '10px' }}>
						<img src={imageUrl} alt={imageAlt} style={{ maxWidth: '100%', height: 'auto', borderRadius: '4px' }} />
						<Button isDestructive onClick={removeImage} style={{ marginTop: '5px' }}>
							{__('Remove Image', 'blockive-premium-addon-for-block')}
						</Button>
					</div>
				) : (
					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelectImage}
							allowedTypes={['image']}
							value={imageId}
							render={({ open }) => (
								<Button isPrimary onClick={open}>
									{__('Choose Image', 'blockive-premium-addon-for-block')}
								</Button>
							)}
						/>
					</MediaUploadCheck>
				)}
			</BaseControl>

			<SelectControl
				label={__('Title HTML Tag', 'blockive-premium-addon-for-block')}
				value={titleTag}
				options={[
					{ label: 'H2', value: 'h2' },
					{ label: 'H3', value: 'h3' },
					{ label: 'H4', value: 'h4' },
					{ label: 'H5', value: 'h5' },
					{ label: 'H6', value: 'h6' },
					{ label: 'P', value: 'p' },
					{ label: 'DIV', value: 'div' },
				]}
				onChange={(val) => setAttributes({ titleTag: val })}
			/>

			<TextControl
				label={__('Link URL', 'blockive-premium-addon-for-block')}
				value={linkUrl}
				onChange={(val) => setAttributes({ linkUrl: val })}
				type="url"
			/>

			{linkUrl && (
				<ToggleControl
					label={__('Open in new tab', 'blockive-premium-addon-for-block')}
					checked={linkTarget}
					onChange={(val) => setAttributes({ linkTarget: val })}
				/>
			)}

			<SegmentedControl
				label={__('Image Position', 'blockive-premium-addon-for-block')}
				value={imagePosition}
				options={[
					{ label: 'Top', value: 'top' },
					{ label: 'Left', value: 'left' },
					{ label: 'Right', value: 'right' },
				]}
				onChange={(val) => setAttributes({ imagePosition: val })}
			/>

			<SegmentedControl
				label={__('Content Alignment', 'blockive-premium-addon-for-block')}
				value={contentAlign}
				options={[
					{ label: 'Left', value: 'left' },
					{ label: 'Center', value: 'center' },
					{ label: 'Right', value: 'right' },
					{ label: 'Justify', value: 'justify' },
				]}
				onChange={(val) => setAttributes({ contentAlign: val })}
			/>

			{(imagePosition === 'left' || imagePosition === 'right') && (
				<SegmentedControl
					label={__('Vertical Alignment', 'blockive-premium-addon-for-block')}
					value={verticalAlign}
					options={[
						{ label: 'Top', value: 'top' },
						{ label: 'Middle', value: 'middle' },
						{ label: 'Bottom', value: 'bottom' },
					]}
					onChange={(val) => setAttributes({ verticalAlign: val })}
				/>
			)}
		</PanelBody>
	);

	const styleTab = (
		<>
			<PanelBody title={__('Image Styling', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<TextControl
					label={__('Image Width (e.g., 100%, 200px)', 'blockive-premium-addon-for-block')}
					value={imageSize}
					onChange={(val) => setAttributes({ imageSize: val })}
				/>
				<RangeControl
					label={__('Image Spacing', 'blockive-premium-addon-for-block')}
					value={imageSpacing}
					onChange={(val) => setAttributes({ imageSpacing: val })}
					min={0}
					max={100}
				/>
				<RangeControl
					label={__('Image Border Radius', 'blockive-premium-addon-for-block')}
					value={imageRadius}
					onChange={(val) => setAttributes({ imageRadius: val })}
					min={0}
					max={100}
				/>
			</PanelBody>

			<PanelBody title={__('Colors', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<ColorStateControls
					normal={[
						{ label: __('Box Background', 'blockive-premium-addon-for-block'), value: boxBgColor, onChange: (val) => setAttributes({ boxBgColor: val }) },
						{ label: __('Title Color', 'blockive-premium-addon-for-block'), value: titleColor, onChange: (val) => setAttributes({ titleColor: val }) },
						{ label: __('Description Color', 'blockive-premium-addon-for-block'), value: descColor, onChange: (val) => setAttributes({ descColor: val }) },
						{ label: __('Link Color', 'blockive-premium-addon-for-block'), value: linkColor, onChange: (val) => setAttributes({ linkColor: val }) },
					]}
					hover={[
						{ label: __('Box Background (Hover)', 'blockive-premium-addon-for-block'), value: boxBgColorHover, onChange: (val) => setAttributes({ boxBgColorHover: val }) },
						{ label: __('Title Color (Hover)', 'blockive-premium-addon-for-block'), value: titleColorHover, onChange: (val) => setAttributes({ titleColorHover: val }) },
						{ label: __('Link Color (Hover)', 'blockive-premium-addon-for-block'), value: linkColorHover, onChange: (val) => setAttributes({ linkColorHover: val }) },
					]}
				/>
			</PanelBody>
		</>
	);

	return (
		<>
			<InspectorTabs
				general={generalTab}
				style={styleTab}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				{imageUrl && (
					<div className="bpafb-image-box-img-wrapper">
						<img src={imageUrl} alt={imageAlt} className="bpafb-image-box-img" />
					</div>
				)}

				<div className="bpafb-image-box-content">
					<RichText
						tagName={titleTag}
						className="bpafb-image-box-title"
						value={title}
						onChange={(val) => setAttributes({ title: val })}
						placeholder={__('Enter title...', 'blockive-premium-addon-for-block')}
					/>

					<RichText
						tagName="div"
						className="bpafb-image-box-description"
						value={description}
						onChange={(val) => setAttributes({ description: val })}
						placeholder={__('Enter description...', 'blockive-premium-addon-for-block')}
					/>

					{linkUrl && linkText && (
						<RichText
							tagName="div"
							className="bpafb-image-box-link"
							value={linkText}
							onChange={(val) => setAttributes({ linkText: val })}
							placeholder={__('Link Text...', 'blockive-premium-addon-for-block')}
						/>
					)}
				</div>
			</div>
		</>
	);
}
