import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
	ToggleControl,
	SelectControl,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

export default function Edit({ attributes, setAttributes }) {
	const { animationUrl, width, height, align, linkUrl, linkTarget } = attributes;

	const alignmentMap = {
		left: 'flex-start',
		center: 'center',
		right: 'flex-end',
	};

	const customStyles = {
		display: 'flex',
		justifyContent: alignmentMap[align] || 'center',
	};

	const blockProps = useBlockProps({
		className: 'bpafb-lottie-wrapper',
		style: customStyles,
	});

	return (
		<>
			<InspectorTabs
				general={(
					<PanelBody title={__('Lottie Animation', 'blockive-premium-addon-for-block')} initialOpen={true}>
						<div style={{ marginBottom: '15px' }}>
							<label style={{ display: 'block', marginBottom: '8px' }}>{__('Animation Source (GIF/MP4)', 'blockive-premium-addon-for-block')}</label>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={(media) => setAttributes({ animationUrl: media.url })}
									allowedTypes={['image/gif', 'video/mp4']}
									value={animationUrl}
									render={({ open }) => (
										<div style={{ display: 'flex', gap: '10px' }}>
											<Button onClick={open} isSecondary>
												{__('Upload GIF / MP4', 'blockive-premium-addon-for-block')}
											</Button>
											{animationUrl && (
												<Button isDestructive onClick={() => setAttributes({ animationUrl: '' })}>
													{__('Remove', 'blockive-premium-addon-for-block')}
												</Button>
											)}
										</div>
									)}
								/>
							</MediaUploadCheck>
						</div>

						<TextControl
							label={__('Link URL', 'blockive-premium-addon-for-block')}
							value={linkUrl}
							onChange={(val) => setAttributes({ linkUrl: val })}
							help={__('Add a link to the animation (optional)', 'blockive-premium-addon-for-block')}
						/>

						{linkUrl && (
							<ToggleControl
								label={__('Open in new tab', 'blockive-premium-addon-for-block')}
								checked={linkTarget}
								onChange={(val) => setAttributes({ linkTarget: val })}
							/>
						)}
					</PanelBody>
				)}
				style={(
					<PanelBody title={__('Dimensions', 'blockive-premium-addon-for-block')} initialOpen={true}>
						<TextControl
							label={__('Width (e.g., 100px, 100%)', 'blockive-premium-addon-for-block')}
							value={width}
							onChange={(val) => setAttributes({ width: val })}
						/>

						<TextControl
							label={__('Height (e.g., 100px)', 'blockive-premium-addon-for-block')}
							value={height}
							onChange={(val) => setAttributes({ height: val })}
						/>

						<SegmentedControl
							label={__('Alignment', 'blockive-premium-addon-for-block')}
							value={align}
							options={[
								{ label: __('Left', 'blockive-premium-addon-for-block'), value: 'left' },
								{ label: __('Center', 'blockive-premium-addon-for-block'), value: 'center' },
								{ label: __('Right', 'blockive-premium-addon-for-block'), value: 'right' },
							]}
							onChange={(val) => setAttributes({ align: val })}
						/>
					</PanelBody>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				<div className="bpafb-lottie-container" style={{ width: width, height: height }}>
					{animationUrl ? (
						animationUrl.includes('.mp4') ? (
							<video src={animationUrl} autoPlay={true} loop={true} muted={true} playsInline={true} style={{ width: '100%', height: '100%', objectFit: 'contain' }} />
						) : (
							<img src={animationUrl} alt={__('Animation', 'blockive-premium-addon-for-block')} style={{ width: '100%', height: '100%', objectFit: 'contain' }} />
						)
					) : (
						<div style={{ width: '100%', height: '100%', minHeight: '50px' }} />
					)}
				</div>
			</div>
		</>
	);
}
