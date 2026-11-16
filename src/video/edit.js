import { __ } from '@wordpress/i18n';
import { useBlockProps, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
	ToggleControl,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import { getSafeVideoUrl } from './utils';

export default function Edit({ attributes, setAttributes }) {
	const { videoUrl, width, height, autoplay, controls, loop } = attributes;

	const customStyles = {
		width: width,
		height: height,
	};

	const blockProps = useBlockProps({
		className: 'bpafb-video-container',
		style: customStyles,
	});

	const generalTab = (
		<PanelBody title={__('Video Settings', 'blockive-premium-addon-for-block')} initialOpen={true}>
			<div style={{ marginBottom: '15px' }}>
				<label style={{ display: 'block', marginBottom: '8px' }}>{__('Video File', 'blockive-premium-addon-for-block')}</label>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={(media) => setAttributes({ videoUrl: media.url })}
						allowedTypes={['video']}
						value={videoUrl}
						render={({ open }) => (
							<Button onClick={open} isPrimary>
								{videoUrl ? __('Change Video', 'blockive-premium-addon-for-block') : __('Select Video', 'blockive-premium-addon-for-block')}
							</Button>
						)}
					/>
				</MediaUploadCheck>
			</div>

			<ToggleControl
				label={__('Autoplay', 'blockive-premium-addon-for-block')}
				checked={autoplay}
				onChange={(val) => setAttributes({ autoplay: val })}
			/>

			<ToggleControl
				label={__('Show Controls', 'blockive-premium-addon-for-block')}
				checked={controls}
				onChange={(val) => setAttributes({ controls: val })}
			/>

			<ToggleControl
				label={__('Loop', 'blockive-premium-addon-for-block')}
				checked={loop}
				onChange={(val) => setAttributes({ loop: val })}
			/>
		</PanelBody>
	);

	const styleTab = (
		<PanelBody title={__('Dimensions', 'blockive-premium-addon-for-block')} initialOpen={true}>
			<TextControl
				label={__('Width (e.g., 100%, 600px)', 'blockive-premium-addon-for-block')}
				value={width}
				onChange={(val) => setAttributes({ width: val })}
			/>

			<TextControl
				label={__('Height (e.g., 400px)', 'blockive-premium-addon-for-block')}
				value={height}
				onChange={(val) => setAttributes({ height: val })}
			/>
		</PanelBody>
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
				{videoUrl ? (
					<video
						key={`${videoUrl}-${controls}-${autoplay}-${loop}`}
						controls={controls ? true : undefined}
						autoPlay={autoplay ? true : undefined}
						loop={loop ? true : undefined}
						muted={autoplay ? true : undefined}
						style={{ width: '100%', height: '100%', objectFit: 'contain' }}
					>
						<source src={getSafeVideoUrl(videoUrl)} />
						{__('Your browser does not support the video tag.', 'blockive-premium-addon-for-block')}
					</video>
				) : (
					<div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', minHeight: '200px', width: '100%', background: '#f0f0f0', color: '#999' }}>
						{__('Select a video to display', 'blockive-premium-addon-for-block')}
					</div>
				)}
			</div>
		</>
	);
}
