import { __ } from '@wordpress/i18n';
import { SelectControl, RangeControl } from '@wordpress/components';

export const ANIMATION_OPTIONS = [
	{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
	{ label: __( 'Fade In', 'blockive-premium-addon-for-block' ), value: 'fadeIn' },
	{ label: __( 'Fade In Up', 'blockive-premium-addon-for-block' ), value: 'fadeInUp' },
	{ label: __( 'Fade In Down', 'blockive-premium-addon-for-block' ), value: 'fadeInDown' },
	{ label: __( 'Fade In Left', 'blockive-premium-addon-for-block' ), value: 'fadeInLeft' },
	{ label: __( 'Fade In Right', 'blockive-premium-addon-for-block' ), value: 'fadeInRight' },
	{ label: __( 'Zoom In', 'blockive-premium-addon-for-block' ), value: 'zoomIn' },
	{ label: __( 'Zoom Out', 'blockive-premium-addon-for-block' ), value: 'zoomOut' },
	{ label: __( 'Bounce', 'blockive-premium-addon-for-block' ), value: 'bounce' },
	{ label: __( 'Slide In Up', 'blockive-premium-addon-for-block' ), value: 'slideInUp' },
];

const EASING_OPTIONS = [
	{ label: __( 'Ease', 'blockive-premium-addon-for-block' ), value: 'ease' },
	{ label: __( 'Linear', 'blockive-premium-addon-for-block' ), value: 'linear' },
	{ label: __( 'Ease In', 'blockive-premium-addon-for-block' ), value: 'ease-in' },
	{ label: __( 'Ease Out', 'blockive-premium-addon-for-block' ), value: 'ease-out' },
	{ label: __( 'Ease In Out', 'blockive-premium-addon-for-block' ), value: 'ease-in-out' },
];

/**
 * values: { animationType, animationDuration, animationDelay, animationEasing }
 * onChange( key, value )
 */
export default function AnimationControls( { values = {}, onChange } ) {
	const {
		animationType = 'none',
		animationDuration = 800,
		animationDelay = 100,
		animationEasing = 'ease',
	} = values;

	return (
		<>
			<SelectControl
				label={ __( 'Animation Type', 'blockive-premium-addon-for-block' ) }
				value={ animationType }
				options={ ANIMATION_OPTIONS }
				onChange={ ( val ) => onChange( 'animationType', val ) }
			/>
			{ animationType !== 'none' && (
				<>
					<RangeControl
						label={ __( 'Duration (ms)', 'blockive-premium-addon-for-block' ) }
						value={ animationDuration }
						onChange={ ( val ) => onChange( 'animationDuration', val ) }
						min={ 100 }
						max={ 3000 }
						step={ 50 }
					/>
					<RangeControl
						label={ __( 'Delay (ms)', 'blockive-premium-addon-for-block' ) }
						value={ animationDelay }
						onChange={ ( val ) => onChange( 'animationDelay', val ) }
						min={ 0 }
						max={ 3000 }
						step={ 50 }
					/>
					<SelectControl
						label={ __( 'Easing', 'blockive-premium-addon-for-block' ) }
						value={ animationEasing }
						options={ EASING_OPTIONS }
						onChange={ ( val ) => onChange( 'animationEasing', val ) }
					/>
				</>
			) }
		</>
	);
}
