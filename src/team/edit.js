import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	MediaUpload,
	MediaUploadCheck,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
	RangeControl,
	ColorPalette,
	ToggleControl,
	ColorPicker,
	SelectControl,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

export default function Edit({ attributes, setAttributes }) {
	const { 
		members, 
		columns,
		columnGap, 
		showImage, 
		imageStyle,
		imageBorderWidth,
		imageBorderColor,
		textColor, 
		descColor,
		positionColor,
		bgColor,
		cardBorderWidth,
		cardBorderRadius,
		cardBorderColor,
		enableBoxShadow,
		boxShadowHOffset,
		boxShadowVOffset,
		boxShadowBlur,
		boxShadowSpread,
		boxShadowColor,
	} = attributes;

	const customStyles = {
		'--bpafb-team-text-color': textColor,
		'--bpafb-team-desc-color': descColor,
		'--bpafb-team-position-color': positionColor,
		'--bpafb-team-bg-color': bgColor,
		'--bpafb-team-columns': columns,
		'--bpafb-team-column-gap': `${columnGap}px`,
		'--bpafb-card-border-width': `${cardBorderWidth}px`,
		'--bpafb-card-border-radius': `${cardBorderRadius}px`,
		'--bpafb-card-border-color': cardBorderColor,
		'--bpafb-card-box-shadow': enableBoxShadow ? `${boxShadowHOffset}px ${boxShadowVOffset}px ${boxShadowBlur}px ${boxShadowSpread}px ${boxShadowColor}` : 'none',
		'--bpafb-image-border-width': `${imageBorderWidth}px`,
		'--bpafb-image-border-color': imageBorderColor,
	};

	const blockProps = useBlockProps({
		className: `bpafb-team-wrapper bpafb-image-style-${imageStyle}`,
		style: customStyles,
	});

	const updateMember = (index, key, value) => {
		const newMembers = [...members];
		newMembers[index] = { ...newMembers[index], [key]: value };
		setAttributes({ members: newMembers });
	};

	const addMember = () => {
		setAttributes({
			members: [
				...members,
				{
					id: Date.now().toString(),
					name: `Team Member #${members.length + 1}`,
					role: 'Position',
					image: '',
					bio: 'Member bio goes here...',
					socialLinks: [],
				},
			],
		});
	};

	const removeMember = (index) => {
		const newMembers = members.filter((_, i) => i !== index);
		setAttributes({ members: newMembers });
	};

	return (
		<>
			<InspectorTabs
				general={(
					<>
			<PanelBody title={__('Team Members', 'blockive-premium-addon-for-block')} initialOpen={true}>
				{members.map((member, index) => (
					<div key={member.id} style={{ marginBottom: '15px', paddingBottom: '15px', borderBottom: '1px solid #eee' }}>
						<TextControl
							label={__('Name', 'blockive-premium-addon-for-block')}
							value={member.name}
							onChange={(val) => updateMember(index, 'name', val)}
						/>
						<TextControl
							label={__('Role', 'blockive-premium-addon-for-block')}
							value={member.role}
							onChange={(val) => updateMember(index, 'role', val)}
						/>
						<TextControl
							label={__('Bio', 'blockive-premium-addon-for-block')}
							value={member.bio}
							onChange={(val) => updateMember(index, 'bio', val)}
							help="Short bio about the team member"
						/>
						<div style={{ marginBottom: '10px' }}>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={(media) => updateMember(index, 'image', media.url)}
									allowedTypes={['image']}
									value={member.image}
									render={({ open }) => (
										<div style={{ display: 'flex', gap: '10px' }}>
											<Button onClick={open} isPrimary size="small">
												{member.image ? __('Change Image', 'blockive-premium-addon-for-block') : __('Select Image', 'blockive-premium-addon-for-block')}
											</Button>
											{member.image && (
												<Button isDestructive size="small" onClick={() => updateMember(index, 'image', '')}>
													{__('Remove Image', 'blockive-premium-addon-for-block')}
												</Button>
											)}
										</div>
									)}
								/>
							</MediaUploadCheck>
						</div>
						<Button isDestructive onClick={() => removeMember(index)} size="small">
							{__('Remove Member', 'blockive-premium-addon-for-block')}
						</Button>
					</div>
				))}
				<Button isPrimary onClick={addMember}>
					{__('Add Team Member', 'blockive-premium-addon-for-block')}
				</Button>
			</PanelBody>

			<PanelBody title={__('Settings', 'blockive-premium-addon-for-block')}>
				<ToggleControl
					label={__('Show Image', 'blockive-premium-addon-for-block')}
					checked={showImage}
					onChange={(val) => setAttributes({ showImage: val })}
				/>
				<StepperControl
					label={__('Columns', 'blockive-premium-addon-for-block')}
					value={columns}
					onChange={(val) => setAttributes({ columns: val })}
					min={1}
					max={6}
				/>
				<RangeControl
					label={__('Column Gap', 'blockive-premium-addon-for-block')}
					value={columnGap}
					onChange={(val) => setAttributes({ columnGap: val })}
					min={0}
					max={100}
				/>
			</PanelBody>
					</>
				)}
				style={(
					<>
			<PanelBody title={__('Image Styles', 'blockive-premium-addon-for-block')}>
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
				<RangeControl
					label={__('Image Border Width (px)', 'blockive-premium-addon-for-block')}
					value={imageBorderWidth}
					onChange={(val) => setAttributes({ imageBorderWidth: val })}
					min={0}
					max={20}
				/>
			</PanelBody>

			<PanelBody title={__('Card Styles', 'blockive-premium-addon-for-block')}>
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
					<label>{__('Image Border Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={imageBorderColor}
						onChange={(val) => setAttributes({ imageBorderColor: val })}
					/>
				</div>
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
			</PanelBody>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				<div className="bpafb-team-grid">
					{members.map((member) => (
						<div key={member.id} className="bpafb-team-card">
							{showImage && member.image && <img src={member.image} alt={member.name} className="bpafb-team-image" />}
							<h3 className="bpafb-team-name">{member.name}</h3>
							<p className="bpafb-team-role">{member.role}</p>
							<p className="bpafb-team-bio">{member.bio}</p>
						</div>
					))}
				</div>
			</div>
		</>
	);
}
