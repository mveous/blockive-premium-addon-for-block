import { __ } from '@wordpress/i18n';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { BaseControl, ColorPalette, GradientPicker, Button } from '@wordpress/components';

import SegmentedControl from '../segmented-control';

const TYPE_OPTIONS = [
	{ label: __( 'Solid Color', 'blockive-premium-addon-for-block' ), value: 'color' },
	{ label: __( 'Gradient', 'blockive-premium-addon-for-block' ), value: 'gradient' },
	{ label: __( 'Image', 'blockive-premium-addon-for-block' ), value: 'image' },
];

const SIZE_OPTIONS = [
	{ label: __( 'Cover', 'blockive-premium-addon-for-block' ), value: 'cover' },
	{ label: __( 'Contain', 'blockive-premium-addon-for-block' ), value: 'contain' },
	{ label: __( 'Auto', 'blockive-premium-addon-for-block' ), value: 'auto' },
];

/**
 * values: { bgType, bgColor, bgGradient, bgImageUrl, bgImageId, bgImageSize, overlayColor }
 * onChange( key, value )
 */
export default function BackgroundControls( { values = {}, onChange } ) {
	const {
		bgType = 'color',
		bgColor = '',
		bgGradient = '',
		bgImageUrl = '',
		bgImageSize = 'cover',
		overlayColor = '',
	} = values;

	return (
		<>
			<SegmentedControl
				label={ __( 'Background Type', 'blockive-premium-addon-for-block' ) }
				value={ bgType }
				options={ TYPE_OPTIONS }
				onChange={ ( val ) => onChange( 'bgType', val ) }
			/>

			{ bgType === 'color' && (
				<BaseControl label={ __( 'Background Color', 'blockive-premium-addon-for-block' ) }>
					<ColorPalette value={ bgColor } onChange={ ( val ) => onChange( 'bgColor', val ) } />
				</BaseControl>
			) }

			{ bgType === 'gradient' && (
				<BaseControl label={ __( 'Background Gradient', 'blockive-premium-addon-for-block' ) }>
					<GradientPicker value={ bgGradient || undefined } onChange={ ( val ) => onChange( 'bgGradient', val ) } />
				</BaseControl>
			) }

			{ bgType === 'image' && (
				<>
					<BaseControl label={ __( 'Background Image', 'blockive-premium-addon-for-block' ) }>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => {
									onChange( 'bgImageUrl', media.url );
									onChange( 'bgImageId', media.id );
								} }
								allowedTypes={ [ 'image' ] }
								value={ values.bgImageId }
								render={ ( { open } ) => (
									<Button variant="secondary" onClick={ open }>
										{ bgImageUrl
											? __( 'Replace Image', 'blockive-premium-addon-for-block' )
											: __( 'Select Image', 'blockive-premium-addon-for-block' ) }
									</Button>
								) }
							/>
						</MediaUploadCheck>
						{ bgImageUrl && (
							<Button
								variant="link"
								isDestructive
								onClick={ () => {
									onChange( 'bgImageUrl', '' );
									onChange( 'bgImageId', 0 );
								} }
							>
								{ __( 'Remove Image', 'blockive-premium-addon-for-block' ) }
							</Button>
						) }
					</BaseControl>
					<SegmentedControl
						label={ __( 'Image Fit', 'blockive-premium-addon-for-block' ) }
						value={ bgImageSize }
						options={ SIZE_OPTIONS }
						onChange={ ( val ) => onChange( 'bgImageSize', val ) }
					/>
					<BaseControl label={ __( 'Overlay Color', 'blockive-premium-addon-for-block' ) }>
						<ColorPalette value={ overlayColor } onChange={ ( val ) => onChange( 'overlayColor', val ) } />
					</BaseControl>
				</>
			) }
		</>
	);
}
