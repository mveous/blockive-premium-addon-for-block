import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	BlockControls,
	AlignmentControl,
} from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	RangeControl,
	BaseControl,
	ColorPalette,
	Button,
	TextControl,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';
import { getSafeSocialIconsUrl } from './utils';

const PREDEFINED_NETWORKS = [
	{ label: 'Facebook', value: 'facebook', icon: 'fab fa-facebook-f', color: '#1877F2' },
	{ label: 'Twitter (X)', value: 'twitter', icon: 'fa-brands fa-x-twitter', color: '#000000' },
	{ label: 'YouTube', value: 'youtube', icon: 'fab fa-youtube', color: '#FF0000' },
	{ label: 'Instagram', value: 'instagram', icon: 'fab fa-instagram', color: '#E1306C' },
	{ label: 'LinkedIn', value: 'linkedin', icon: 'fab fa-linkedin-in', color: '#0077B5' },
	{ label: 'Pinterest', value: 'pinterest', icon: 'fab fa-pinterest-p', color: '#E60023' },
	{ label: 'WhatsApp', value: 'whatsapp', icon: 'fab fa-whatsapp', color: '#25D366' },
	{ label: 'Custom', value: 'custom', icon: 'fas fa-link', color: '#888888' },
];

export default function Edit({ attributes, setAttributes }) {
	const {
		items,
		shape,
		alignment,
		iconSize,
		iconPadding,
		iconSpacing,
		colorType,
		customPrimaryColor,
		customSecondaryColor,
		hoverAnimation,
	} = attributes;

	const blockProps = useBlockProps({
		className: `bpafb-social-icons-wrapper bpafb-align-${alignment} bpafb-social-shape-${shape} bpafb-social-hover-${hoverAnimation}`
	});

	// Handle Repeater Item Add
	const addItem = () => {
		const newItem = {
			id: Date.now().toString(),
			network: 'facebook',
			icon: 'fab fa-facebook-f',
			link: '#',
			color: '#1877F2'
		};
		setAttributes({ items: [...items, newItem] });
	};

	// Handle Repeater Item Update
	const updateItem = (index, key, value) => {
		const newItems = [...items];
		newItems[index] = { ...newItems[index], [key]: value };

		// Auto-update icon and color if network changes
		if (key === 'network') {
			const preset = PREDEFINED_NETWORKS.find(n => n.value === value);
			if (preset) {
				newItems[index] = { ...newItems[index], icon: preset.icon, color: preset.color };
			}
		}

		setAttributes({ items: newItems });
	};

	// Handle Repeater Item Remove
	const removeItem = (index) => {
		const newItems = items.filter((_, i) => i !== index);
		setAttributes({ items: newItems });
	};

	// Move item up/down
	const moveItem = (index, dir) => {
		if ((dir === -1 && index === 0) || (dir === 1 && index === items.length - 1)) return;
		const newItems = [...items];
		const temp = newItems[index];
		newItems[index] = newItems[index + dir];
		newItems[index + dir] = temp;
		setAttributes({ items: newItems });
	};

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
			<PanelBody title={__('Social Icons', 'blockive-premium-addon-for-block')} initialOpen={true}>
				{items.map((item, index) => (
					<div key={item.id} style={{ border: '1px solid #ccc', padding: '10px', marginBottom: '10px', borderRadius: '4px', backgroundColor: '#f9f9f9' }}>
						<div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '10px' }}>
							<strong>{__('Icon', 'blockive-premium-addon-for-block')} {index + 1}</strong>
							<div>
								<Button isSmall onClick={() => moveItem(index, -1)} disabled={index === 0}>↑</Button>
								<Button isSmall onClick={() => moveItem(index, 1)} disabled={index === items.length - 1}>↓</Button>
								<Button isSmall isDestructive onClick={() => removeItem(index)}>X</Button>
							</div>
						</div>
						
						<SelectControl
							label={__('Network', 'blockive-premium-addon-for-block')}
							value={item.network}
							options={PREDEFINED_NETWORKS}
							onChange={(val) => updateItem(index, 'network', val)}
						/>

						{item.network === 'custom' && (
							<TextControl
								label={__('Custom Icon Class (FontAwesome)', 'blockive-premium-addon-for-block')}
								value={item.icon}
								onChange={(val) => updateItem(index, 'icon', val)}
								help="e.g. fab fa-github"
							/>
						)}

						<TextControl
							label={__('Link URL', 'blockive-premium-addon-for-block')}
							value={item.link}
							onChange={(val) => updateItem(index, 'link', val)}
						/>
					</div>
				))}
				<Button isPrimary onClick={addItem} style={{ width: '100%', justifyContent: 'center' }}>
					{__('Add New Icon', 'blockive-premium-addon-for-block')}
				</Button>
			</PanelBody>

			<PanelBody title={__('Settings', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<SegmentedControl
					label={__('Shape', 'blockive-premium-addon-for-block')}
					value={shape}
					options={[
						{ label: 'Rounded', value: 'rounded' },
						{ label: 'Square', value: 'square' },
						{ label: 'Circle', value: 'circle' },
					]}
					onChange={(val) => setAttributes({ shape: val })}
				/>
				<SegmentedControl
					label={__('Hover Animation', 'blockive-premium-addon-for-block')}
					value={hoverAnimation}
					options={[
						{ label: 'None', value: 'none' },
						{ label: 'Grow', value: 'grow' },
						{ label: 'Shrink', value: 'shrink' },
						{ label: 'Pulse', value: 'pulse' },
					]}
					onChange={(val) => setAttributes({ hoverAnimation: val })}
				/>
				<RangeControl
					label={__('Icon Size', 'blockive-premium-addon-for-block')}
					value={iconSize}
					onChange={(val) => setAttributes({ iconSize: val })}
					min={10}
					max={100}
				/>
				<RangeControl
					label={__('Padding', 'blockive-premium-addon-for-block')}
					value={iconPadding}
					onChange={(val) => setAttributes({ iconPadding: val })}
					min={0}
					max={50}
				/>
				<RangeControl
					label={__('Spacing', 'blockive-premium-addon-for-block')}
					value={iconSpacing}
					onChange={(val) => setAttributes({ iconSpacing: val })}
					min={0}
					max={50}
				/>
			</PanelBody>
					</>
				)}
				style={(
			<PanelBody title={__('Colors', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<SegmentedControl
					label={__('Color Type', 'blockive-premium-addon-for-block')}
					value={colorType}
					options={[
						{ label: 'Official Color', value: 'official' },
						{ label: 'Custom', value: 'custom' },
					]}
					onChange={(val) => setAttributes({ colorType: val })}
				/>
				{colorType === 'custom' && (
					<>
						<BaseControl label={__('Primary Color (Background)', 'blockive-premium-addon-for-block')}>
							<ColorPalette
								value={customPrimaryColor}
								onChange={(val) => setAttributes({ customPrimaryColor: val })}
							/>
						</BaseControl>
						<BaseControl label={__('Secondary Color (Icon)', 'blockive-premium-addon-for-block')}>
							<ColorPalette
								value={customSecondaryColor}
								onChange={(val) => setAttributes({ customSecondaryColor: val })}
							/>
						</BaseControl>
					</>
				)}
			</PanelBody>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				{items.map((item, index) => {
					// Pre-calculate styles mapping customization logic
					const bg = colorType === 'custom' ? customPrimaryColor : item.color;
					const color = colorType === 'custom' ? customSecondaryColor : '#ffffff';
					
					return (
						<a
							key={item.id}
							href={getSafeSocialIconsUrl(item.link) || '#'}
							className="bpafb-social-icon-item"
							style={{ 
								backgroundColor: bg,
								color: color,
								fontSize: `${iconSize}px`,
								padding: `${iconPadding}px`,
								marginRight: `${iconSpacing}px`, // spacing between icons
								// Prevent last item from having right margin
								...(index === items.length - 1 ? { marginRight: 0 } : {}),
								width: `${iconSize + (iconPadding * 2)}px`,
								height: `${iconSize + (iconPadding * 2)}px`
							}}
							onClick={(e) => e.preventDefault()} // prevent navigation in editor
							aria-label={`Visit our ${item.network}`}
						>
							<i className={item.icon}></i>
						</a>
					);
				})}
				{items.length === 0 && (
					<p>{__('Click "Add New Icon" in the sidebar to add social links.', 'blockive-premium-addon-for-block')}</p>
				)}
			</div>
		</>
	);
}
