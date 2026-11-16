import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const {
		targetDate,
		timerType,
		targetTimestamp,
		evergreenHours,
		evergreenMinutes,
		evergreenId,
		expireAction,
		expireMessage,
		expireRedirect,
		showDays,
		showHours,
		showMinutes,
		showSeconds,
		labelDays,
		labelHours,
		labelMinutes,
		labelSeconds,
		styleType,
		boxBgColor,
		boxBorderColor,
		boxBorderWidth,
		boxBorderRadius,
		numberColor,
		labelColor,
		gap,
		alignment,
		animationType,
		animationDuration,
		animationDelay,
	} = attributes;

	const customStyles = {
		'--bpafb-cd-gap': gap !== undefined ? `${gap}px` : '20px',
		'--bpafb-cd-box-bg': styleType === 'block' ? (boxBgColor || 'transparent') : 'transparent',
		'--bpafb-cd-borderWidth': styleType === 'block' ? `${boxBorderWidth || 0}px` : '0px',
		'--bpafb-cd-borderColor': styleType === 'block' ? (boxBorderColor || 'transparent') : 'transparent',
		'--bpafb-cd-borderRadius': styleType === 'block' ? `${boxBorderRadius || 0}px` : '0px',
		'--bpafb-cd-number-color': numberColor || 'inherit',
		'--bpafb-cd-label-color': labelColor || 'inherit',
	};

	if (animationType !== 'none') {
		customStyles.animationDuration = animationDuration || '1s';
		customStyles.animationDelay = animationDelay || '0s';
	}

	const blockProps = useBlockProps.save({
		className: `bpafb-countdown-style-${styleType} align${alignment} ${animationType !== 'none' ? `bpafb-animate-${animationType}` : ''}`,
		style: customStyles,
	});

	const evergreen = timerType === 'evergreen';
	if (!evergreen && !targetDate) return null;

	// Only added when used, so timers saved before these options existed
	// keep their exact markup.
	const extra = {};
	if (evergreen) {
		extra['data-evergreen'] = String(evergreenSeconds(evergreenHours, evergreenMinutes));
		extra['data-evergreen-id'] = evergreenId || undefined;
	} else if (typeof targetTimestamp === 'number') {
		extra['data-target-time'] = String(targetTimestamp);
	}
	if (expireAction && expireAction !== 'none') {
		extra['data-expire-action'] = expireAction;
		if (expireAction === 'redirect') {
			extra['data-expire-redirect'] = expireRedirect || undefined;
		}
	}

	return (
		<div {...blockProps}>
			<div
				className="bpafb-countdown-wrapper"
				data-target-date={evergreen ? undefined : targetDate}
				{...extra}
				role="timer"
				aria-live="off"
				aria-label={__('Countdown timer', 'blockive-premium-addon-for-block')}
			>
				{showDays && (
					<div className="bpafb-countdown-item bpafb-cd-days">
						<div className="bpafb-countdown-number">00</div>
						<div className="bpafb-countdown-label">{labelDays}</div>
					</div>
				)}
				{showHours && (
					<div className="bpafb-countdown-item bpafb-cd-hours">
						<div className="bpafb-countdown-number">00</div>
						<div className="bpafb-countdown-label">{labelHours}</div>
					</div>
				)}
				{showMinutes && (
					<div className="bpafb-countdown-item bpafb-cd-minutes">
						<div className="bpafb-countdown-number">00</div>
						<div className="bpafb-countdown-label">{labelMinutes}</div>
					</div>
				)}
				{showSeconds && (
					<div className="bpafb-countdown-item bpafb-cd-seconds">
						<div className="bpafb-countdown-number">00</div>
						<div className="bpafb-countdown-label">{labelSeconds}</div>
					</div>
				)}
			</div>
			{expireAction === 'message' && (
				<div className="bpafb-countdown-expired" hidden>
					{expireMessage}
				</div>
			)}
		</div>
	);
}

/**
 * Evergreen length in seconds (at least one minute).
 *
 * @param {number} hours   Hours.
 * @param {number} minutes Minutes.
 * @return {number}
 */
export function evergreenSeconds(hours, minutes) {
	return Math.max(60, ((hours || 0) * 60 + (minutes || 0)) * 60);
}
