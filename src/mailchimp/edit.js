import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	ColorPalette,
	RangeControl,
	ToggleControl,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';

export default function Edit({ attributes, setAttributes }) {
	const { 
		title, subtitle, placeholderText, buttonText, 
		titleColor, subtitleColor, inputBgColor, 
		buttonBgColor, buttonTextColor, formAction,
		inputBorderRadius, buttonBorderRadius,
		buttonHoverBgColor, buttonHoverTextColor,
		showInputIcon, inputIconBgColor, inputIconColor,
		showButtonIcon, inputBorderWidth, inputBorderColor,
		buttonBorderWidth, buttonBorderColor, formGap
	} = attributes;

	const titleStyle = titleColor ? { color: titleColor } : undefined;
	const subtitleStyle = subtitleColor ? { color: subtitleColor } : undefined;
	const inputStyle = {
		backgroundColor: inputBgColor || undefined,
		borderRadius: `${inputBorderRadius}px`,
	};
	const buttonStyle = {
		backgroundColor: buttonBgColor || undefined,
		color: buttonTextColor || undefined,
		borderRadius: `${buttonBorderRadius}px`,
		border: `${buttonBorderWidth}px solid ${buttonBorderColor}`,
	};

	const customStyles = {};
	if (buttonHoverBgColor) customStyles['--bpafb-mailchimp-btn-hover-bg'] = buttonHoverBgColor;
	if (buttonHoverTextColor) customStyles['--bpafb-mailchimp-btn-hover-text'] = buttonHoverTextColor;

	const blockProps = useBlockProps({
		className: 'bpafb-mailchimp-wrapper',
	});

	return (
		<>
			<InspectorTabs
				general={(
			<PanelBody title={__('Content', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<TextControl
					label={__('Title', 'blockive-premium-addon-for-block')}
					value={title}
					onChange={(val) => setAttributes({ title: val })}
				/>
				<TextControl
					label={__('Subtitle', 'blockive-premium-addon-for-block')}
					value={subtitle}
					onChange={(val) => setAttributes({ subtitle: val })}
				/>
				<TextControl
					label={__('Placeholder Text', 'blockive-premium-addon-for-block')}
					value={placeholderText}
					onChange={(val) => setAttributes({ placeholderText: val })}
				/>
				<TextControl
					label={__('Button Text', 'blockive-premium-addon-for-block')}
					value={buttonText}
					onChange={(val) => setAttributes({ buttonText: val })}
				/>
				<TextControl
					label={__('MailChimp Form Action URL', 'blockive-premium-addon-for-block')}
					help={__('Paste the action URL from your MailChimp embedded form code here.', 'blockive-premium-addon-for-block')}
					value={formAction}
					onChange={(val) => setAttributes({ formAction: val })}
				/>
			</PanelBody>
				)}
				style={(
					<>
			<PanelBody title={__('Colors', 'blockive-premium-addon-for-block')}>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Title Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={titleColor}
						onChange={(val) => setAttributes({ titleColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Subtitle Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={subtitleColor}
						onChange={(val) => setAttributes({ subtitleColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Input Background Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={inputBgColor}
						onChange={(val) => setAttributes({ inputBgColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Button Background Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={buttonBgColor}
						onChange={(val) => setAttributes({ buttonBgColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Button Text Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={buttonTextColor}
						onChange={(val) => setAttributes({ buttonTextColor: val })}
					/>
				</div>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Button Hover Background Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={buttonHoverBgColor}
						onChange={(val) => setAttributes({ buttonHoverBgColor: val })}
					/>
				</div>
				<div>
					<label>{__('Button Hover Text Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={buttonHoverTextColor}
						onChange={(val) => setAttributes({ buttonHoverTextColor: val })}
					/>
				</div>
			</PanelBody>

			<PanelBody title={__('Border Radius', 'blockive-premium-addon-for-block')}>
				<RangeControl
					label={__('Input Border Radius', 'blockive-premium-addon-for-block')}
					value={inputBorderRadius}
					onChange={(val) => setAttributes({ inputBorderRadius: val })}
					min={0}
					max={50}
				/>
				<RangeControl
					label={__('Button Border Radius', 'blockive-premium-addon-for-block')}
					value={buttonBorderRadius}
					onChange={(val) => setAttributes({ buttonBorderRadius: val })}
					min={0}
					max={50}
				/>
			</PanelBody>

			<PanelBody title={__('Spacing', 'blockive-premium-addon-for-block')}>
				<RangeControl
					label={__('Gap Between Input and Button', 'blockive-premium-addon-for-block')}
					value={formGap}
					onChange={(val) => setAttributes({ formGap: val })}
					min={0}
					max={50}
				/>
			</PanelBody>

			<PanelBody title={__('Icons & Borders', 'blockive-premium-addon-for-block')}>
				<ToggleControl
					label={__('Show Input Envelope Icon', 'blockive-premium-addon-for-block')}
					checked={showInputIcon}
					onChange={(val) => setAttributes({ showInputIcon: val })}
				/>
				{showInputIcon && (
					<>
						<div style={{ marginBottom: '15px' }}>
							<label>{__('Input Icon Background', 'blockive-premium-addon-for-block')}</label>
							<ColorPalette
								value={inputIconBgColor}
								onChange={(val) => setAttributes({ inputIconBgColor: val })}
							/>
						</div>
						<div style={{ marginBottom: '15px' }}>
							<label>{__('Input Icon Color', 'blockive-premium-addon-for-block')}</label>
							<ColorPalette
								value={inputIconColor}
								onChange={(val) => setAttributes({ inputIconColor: val })}
							/>
						</div>
					</>
				)}

				<ToggleControl
					label={__('Show Button Checkmark Icon', 'blockive-premium-addon-for-block')}
					checked={showButtonIcon}
					onChange={(val) => setAttributes({ showButtonIcon: val })}
				/>

				<hr style={{ margin: '20px 0' }} />

				<RangeControl
					label={__('Input Border Width', 'blockive-premium-addon-for-block')}
					value={inputBorderWidth}
					onChange={(val) => setAttributes({ inputBorderWidth: val })}
					min={0}
					max={10}
				/>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Input Border Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={inputBorderColor}
						onChange={(val) => setAttributes({ inputBorderColor: val })}
					/>
				</div>

				<hr style={{ margin: '20px 0' }} />

				<RangeControl
					label={__('Button Border Width', 'blockive-premium-addon-for-block')}
					value={buttonBorderWidth}
					onChange={(val) => setAttributes({ buttonBorderWidth: val })}
					min={0}
					max={10}
				/>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Button Border Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={buttonBorderColor}
						onChange={(val) => setAttributes({ buttonBorderColor: val })}
					/>
				</div>
			</PanelBody>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				<div className="bpafb-mailchimp-content" style={Object.keys(customStyles).length > 0 ? customStyles : undefined}>
					<h2 className="bpafb-mailchimp-title" style={titleStyle}>{title}</h2>
					<p className="bpafb-mailchimp-subtitle" style={subtitleStyle}>{subtitle}</p>
					<form className="bpafb-mailchimp-form" style={{ gap: `${formGap}px` }}>
						<div className="bpafb-mailchimp-input-wrapper" style={{ 
							display: 'flex', 
							border: `${inputBorderWidth}px solid ${inputBorderColor}`,
							borderRadius: `${inputBorderRadius}px`,
							overflow: 'hidden',
							backgroundColor: inputBgColor || '#ffffff',
							flex: 1
						}}>
							{showInputIcon && (
								<div className="bpafb-mailchimp-input-icon" style={{
									backgroundColor: inputIconBgColor,
									color: inputIconColor,
									padding: '0 15px',
									display: 'flex',
									alignItems: 'center',
									justifyContent: 'center',
									borderRight: `${inputBorderWidth}px solid ${inputBorderColor}`
								}}>
									<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
								</div>
							)}
							<input
								type="email"
								name="EMAIL"
								className="bpafb-mailchimp-input"
								placeholder={placeholderText}
								aria-label={placeholderText || __('Email address', 'blockive-premium-addon-for-block')}
								style={{
									...inputStyle,
									border: 'none',
									borderRadius: 0,
									backgroundColor: 'transparent',
								}}
								disabled
							/>
						</div>
						<button type="button" className="bpafb-mailchimp-button" style={buttonStyle} disabled>
							{showButtonIcon && (
								<svg style={{ marginRight: '8px' }} width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>
							)}
							{buttonText}
						</button>
					</form>
				</div>
			</div>
		</>
	);
}
