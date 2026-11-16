import { useBlockProps } from '@wordpress/block-editor';
import { getSafeVideoUrl } from './utils';

export default function Save({ attributes }) {
	const { videoUrl, width, height, autoplay, controls, loop } = attributes;

	const customStyles = {
		width: width,
		height: height,
	};

	const blockProps = useBlockProps.save({
		className: 'bpafb-video-container',
		style: customStyles,
	});

	return (
		<div {...blockProps}>
			{videoUrl && (
				<video
					controls={controls ? true : undefined}
					autoPlay={autoplay ? true : undefined}
					loop={loop ? true : undefined}
					muted={autoplay ? true : undefined}
					style={{ width: '100%', height: '100%', objectFit: 'contain' }}
				>
					<source src={getSafeVideoUrl(videoUrl)} />
					Your browser does not support the video tag.
				</video>
			)}
		</div>
	);
}
