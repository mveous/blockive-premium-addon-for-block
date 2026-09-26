import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	BlockControls,
	AlignmentControl,
} from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	ColorPalette,
	BaseControl,
	RangeControl,
	TextControl,
	ToggleControl,
	TextareaControl,
} from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import { getDate } from '@wordpress/date';

import { evergreenSeconds } from './save';

import InspectorTabs from '../components/inspector-tabs';
import AdvancedTab from '../components/advanced-tab';

export default function Edit({ attributes, setAttributes }) {
	const {
		targetDate,
		timerType,
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

	const [timeLeft, setTimeLeft] = useState({ days: '00', hours: '00', minutes: '00', seconds: '00' });

	const evergreen = timerType === 'evergreen';
	const hasTarget = evergreen || !!targetDate;

	// Evergreen timers get their own storage key, so two of them on a site
	// do not share one visitor's end time.
	useEffect(() => {
		if (evergreen && !evergreenId) {
			setAttributes({ evergreenId: Math.random().toString(36).slice(2, 10) });
		}
	}, [evergreen, evergreenId]);

	useEffect(() => {
		if (!hasTarget) return;
		// Evergreen: the preview shows the full length, standing still.
		const target = evergreen ? Date.now() + evergreenSeconds(evergreenHours, evergreenMinutes) * 1000 + 999 : getDate(targetDate).getTime();

		if (isNaN(target)) return;

		const updateTimeLeft = () => {
			const now = new Date().getTime();
			const distance = target - now;

			if (distance <= 0) {
				setTimeLeft({ days: '00', hours: '00', minutes: '00', seconds: '00' });
				return;
			}

			const days = Math.floor(distance / (1000 * 60 * 60 * 24));
			const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			const seconds = Math.floor((distance % (1000 * 60)) / 1000);

			setTimeLeft({
				days: days < 10 ? '0' + days : days,
				hours: hours < 10 ? '0' + hours : hours,
				minutes: minutes < 10 ? '0' + minutes : minutes,
				seconds: seconds < 10 ? '0' + seconds : seconds,
			});
		};

		updateTimeLeft();
		if (evergreen) return;
		const interval = setInterval(updateTimeLeft, 1000);

		return () => clearInterval(interval);
	}, [targetDate, evergreen, evergreenHours, evergreenMinutes]);

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

	const blockProps = useBlockProps({
		className: `bpafb-countdown-style-${styleType} align${alignment} ${animationType !== 'none' ? `bpafb-animate-${animationType}` : ''}`,
		style: customStyles,
	});

	return (
		<>
			<BlockControls>
				<AlignmentControl
					value={alignment}
					onChange={(newAlign) => setAttributes({ alignment: newAlign || 'center' })}
				/>
			</BlockControls>

			<InspectorTabs
				general={(
					<>
			<PanelBody title={__('Timer Settings', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<SelectControl
					label={__('Timer Type', 'blockive-premium-addon-for-block')}
					value={timerType}
					options={[
						{ label: __('Due Date', 'blockive-premium-addon-for-block'), value: 'due' },
						{ label: __('Evergreen (per visitor)', 'blockive-premium-addon-for-block'), value: 'evergreen' },
					]}
					onChange={(val) => setAttributes({ timerType: val })}
				/>
				{evergreen ? (
					<>
						<RangeControl label={__('Hours', 'blockive-premium-addon-for-block')} value={evergreenHours} onChange={(val) => setAttributes({ evergreenHours: val || 0 })} min={0} max={720} />
						<RangeControl label={__('Minutes', 'blockive-premium-addon-for-block')} value={evergreenMinutes} onChange={(val) => setAttributes({ evergreenMinutes: val || 0 })} min={0} max={59} />
						<p className="components-base-control__help">{__('Each visitor gets this much time from their first visit (remembered in their browser).', 'blockive-premium-addon-for-block')}</p>
					</>
				) : (
					<TextControl
						label={__('Target Date & Time', 'blockive-premium-addon-for-block')}
						type="datetime-local"
						value={targetDate}
						onChange={(val) => {
							// The exact moment in the site's time zone, so every visitor sees the same end.
							const time = val ? getDate(val).getTime() : NaN;
							setAttributes({ targetDate: val, targetTimestamp: isNaN(time) ? undefined : time });
						}}
						help={__('In the site\'s time zone (Settings → General).', 'blockive-premium-addon-for-block')}
					/>
				)}

				<SelectControl
					label={__('View Style', 'blockive-premium-addon-for-block')}
					value={styleType}
					options={[
						{ label: 'Block (Boxes)', value: 'block' },
						{ label: 'Inline', value: 'inline' },
					]}
					onChange={(val) => setAttributes({ styleType: val })}
				/>

				<ToggleControl
					label={__('Show Days', 'blockive-premium-addon-for-block')}
					checked={showDays}
					onChange={(val) => setAttributes({ showDays: val })}
				/>
				{showDays && (
					<TextControl label={__('Days Label', 'blockive-premium-addon-for-block')} value={labelDays} onChange={(val) => setAttributes({ labelDays: val })} />
				)}

				<ToggleControl
					label={__('Show Hours', 'blockive-premium-addon-for-block')}
					checked={showHours}
					onChange={(val) => setAttributes({ showHours: val })}
				/>
				{showHours && (
					<TextControl label={__('Hours Label', 'blockive-premium-addon-for-block')} value={labelHours} onChange={(val) => setAttributes({ labelHours: val })} />
				)}

				<ToggleControl
					label={__('Show Minutes', 'blockive-premium-addon-for-block')}
					checked={showMinutes}
					onChange={(val) => setAttributes({ showMinutes: val })}
				/>
				{showMinutes && (
					<TextControl label={__('Minutes Label', 'blockive-premium-addon-for-block')} value={labelMinutes} onChange={(val) => setAttributes({ labelMinutes: val })} />
				)}

				<ToggleControl
					label={__('Show Seconds', 'blockive-premium-addon-for-block')}
					checked={showSeconds}
					onChange={(val) => setAttributes({ showSeconds: val })}
				/>
				{showSeconds && (
					<TextControl label={__('Seconds Label', 'blockive-premium-addon-for-block')} value={labelSeconds} onChange={(val) => setAttributes({ labelSeconds: val })} />
				)}
			</PanelBody>
			<PanelBody title={__('When the Timer Ends', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<SelectControl
					label={__('Action', 'blockive-premium-addon-for-block')}
					value={expireAction}
					options={[
						{ label: __('Show 00:00', 'blockive-premium-addon-for-block'), value: 'none' },
						{ label: __('Hide the Timer', 'blockive-premium-addon-for-block'), value: 'hide' },
						{ label: __('Show a Message', 'blockive-premium-addon-for-block'), value: 'message' },
						{ label: __('Go to a Page', 'blockive-premium-addon-for-block'), value: 'redirect' },
					]}
					onChange={(val) => setAttributes({ expireAction: val })}
				/>
				{expireAction === 'message' && (
					<TextareaControl label={__('Message', 'blockive-premium-addon-for-block')} value={expireMessage} onChange={(val) => setAttributes({ expireMessage: val })} placeholder={__('This offer has ended.', 'blockive-premium-addon-for-block')} />
				)}
				{expireAction === 'redirect' && (
					<TextControl label={__('Page URL', 'blockive-premium-addon-for-block')} type="url" value={expireRedirect} onChange={(val) => setAttributes({ expireRedirect: val })} help={__('A web address (https://…) or a path on this site.', 'blockive-premium-addon-for-block')} />
				)}
			</PanelBody>
					</>
				)}
				style={(
					<>
			<PanelBody title={__('Styling', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<RangeControl
					label={__('Space Between (Gap)', 'blockive-premium-addon-for-block')}
					value={gap}
					onChange={(val) => setAttributes({ gap: val })}
					min={0}
					max={100}
				/>

				{styleType === 'block' && (
					<>
						<RangeControl
							label={__('Border Width (px)', 'blockive-premium-addon-for-block')}
							value={boxBorderWidth}
							onChange={(val) => setAttributes({ boxBorderWidth: val })}
							min={0}
							max={20}
						/>
						<RangeControl
							label={__('Border Radius (px)', 'blockive-premium-addon-for-block')}
							value={boxBorderRadius}
							onChange={(val) => setAttributes({ boxBorderRadius: val })}
							min={0}
							max={100}
						/>
						<BaseControl label={__('Box Background Color', 'blockive-premium-addon-for-block')}>
							<ColorPalette value={boxBgColor} onChange={(val) => setAttributes({ boxBgColor: val })} />
						</BaseControl>
						<BaseControl label={__('Box Border Color', 'blockive-premium-addon-for-block')}>
							<ColorPalette value={boxBorderColor} onChange={(val) => setAttributes({ boxBorderColor: val })} />
						</BaseControl>
					</>
				)}
				
				<BaseControl label={__('Number Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette value={numberColor} onChange={(val) => setAttributes({ numberColor: val })} />
				</BaseControl>
				<BaseControl label={__('Label Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette value={labelColor} onChange={(val) => setAttributes({ labelColor: val })} />
				</BaseControl>
			</PanelBody>

			<PanelBody title={__('Motion Effects', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<SelectControl
					label={__('Entrance Animation', 'blockive-premium-addon-for-block')}
					value={animationType}
					options={[
						{ label: 'None', value: 'none' },
						{ label: 'Fade In', value: 'fadeIn' },
						{ label: 'Fade In Up', value: 'fadeInUp' },
						{ label: 'Fade In Down', value: 'fadeInDown' },
						{ label: 'Zoom In', value: 'zoomIn' },
						{ label: 'Slide In Left', value: 'slideInLeft' },
						{ label: 'Slide In Right', value: 'slideInRight' },
					]}
					onChange={(val) => setAttributes({ animationType: val })}
				/>
				{animationType !== 'none' && (
					<>
						<TextControl
							label={__('Animation Duration', 'blockive-premium-addon-for-block')}
							value={animationDuration}
							onChange={(val) => setAttributes({ animationDuration: val })}
						/>
						<TextControl
							label={__('Animation Delay', 'blockive-premium-addon-for-block')}
							value={animationDelay}
							onChange={(val) => setAttributes({ animationDelay: val })}
						/>
					</>
				)}
			</PanelBody>
					</>
				)}
				advanced={<AdvancedTab attributes={attributes} setAttributes={setAttributes} />}
			/>

			<div {...blockProps}>
				<div
					className="bpafb-countdown-wrapper"
					role="timer"
					aria-live="off"
					aria-label={__('Countdown timer', 'blockive-premium-addon-for-block')}
				>
					{!hasTarget && (
						<div style={{ padding: '20px', border: '1px dashed #ccc', textAlign: 'center', width: '100%' }}>
							{__('Please set a target date in the block settings.', 'blockive-premium-addon-for-block')}
						</div>
					)}
					
					{hasTarget && showDays && (
						<div className="bpafb-countdown-item bpafb-cd-days">
							<div className="bpafb-countdown-number">{timeLeft.days}</div>
							<div className="bpafb-countdown-label">{labelDays}</div>
						</div>
					)}
					{hasTarget && showHours && (
						<div className="bpafb-countdown-item bpafb-cd-hours">
							<div className="bpafb-countdown-number">{timeLeft.hours}</div>
							<div className="bpafb-countdown-label">{labelHours}</div>
						</div>
					)}
					{hasTarget && showMinutes && (
						<div className="bpafb-countdown-item bpafb-cd-minutes">
							<div className="bpafb-countdown-number">{timeLeft.minutes}</div>
							<div className="bpafb-countdown-label">{labelMinutes}</div>
						</div>
					)}
					{hasTarget && showSeconds && (
						<div className="bpafb-countdown-item bpafb-cd-seconds">
							<div className="bpafb-countdown-number">{timeLeft.seconds}</div>
							<div className="bpafb-countdown-label">{labelSeconds}</div>
						</div>
					)}
				</div>
			</div>
		</>
	);
}
