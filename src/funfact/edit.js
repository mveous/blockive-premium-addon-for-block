import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	RangeControl,
	ColorPalette,
	Button,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

export default function Edit({ attributes, setAttributes }) {
	const { items, columns, numberColor, textColor, duration, gap } = attributes;

	const blockProps = useBlockProps({
		className: 'bpafb-funfact-wrapper',
	});

	// Handle Repeater Item Add
	const addItem = () => {
		const newItem = {
			id: Date.now().toString(),
			number: '100',
			prefix: '',
			suffix: '',
			title: __('New Fun Fact', 'blockive-premium-addon-for-block')
		};
		setAttributes({ items: [...items, newItem] });
	};

	// Handle Repeater Item Update
	const updateItem = (index, key, value) => {
		const newItems = [...items];
		newItems[index] = { ...newItems[index], [key]: value };
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
			<InspectorTabs
				general={(
					<>
			<PanelBody title={__('Fun Facts', 'blockive-premium-addon-for-block')} initialOpen={true}>
				{(items || []).map((item, index) => (
					<div key={item.id || index} style={{ border: '1px solid #ccc', padding: '10px', marginBottom: '10px', borderRadius: '4px', backgroundColor: '#f9f9f9' }}>
						<div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '10px' }}>
							<strong>{__('Fact', 'blockive-premium-addon-for-block')} {index + 1}</strong>
							<div>
								<Button isSmall onClick={() => moveItem(index, -1)} disabled={index === 0}>↑</Button>
								<Button isSmall onClick={() => moveItem(index, 1)} disabled={index === items.length - 1}>↓</Button>
								<Button isSmall isDestructive onClick={() => removeItem(index)}>X</Button>
							</div>
						</div>
						
						<TextControl
							label={__('Number', 'blockive-premium-addon-for-block')}
							value={item.number}
							onChange={(val) => updateItem(index, 'number', val)}
						/>
						<TextControl
							label={__('Prefix', 'blockive-premium-addon-for-block')}
							value={item.prefix}
							onChange={(val) => updateItem(index, 'prefix', val)}
						/>
						<TextControl
							label={__('Suffix', 'blockive-premium-addon-for-block')}
							value={item.suffix}
							onChange={(val) => updateItem(index, 'suffix', val)}
						/>
						<TextControl
							label={__('Title', 'blockive-premium-addon-for-block')}
							value={item.title}
							onChange={(val) => updateItem(index, 'title', val)}
						/>
					</div>
				))}
				<Button isPrimary onClick={addItem} style={{ width: '100%', justifyContent: 'center' }}>
					{__('Add New Fact', 'blockive-premium-addon-for-block')}
				</Button>
			</PanelBody>

			<PanelBody title={__('Settings', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<StepperControl
					label={__('Columns', 'blockive-premium-addon-for-block')}
					value={columns}
					onChange={(val) => setAttributes({ columns: val })}
					min={1}
					max={4}
				/>
				<RangeControl
					label={__('Card Gap (px)', 'blockive-premium-addon-for-block')}
					value={gap}
					onChange={(val) => setAttributes({ gap: val })}
					min={0}
					max={100}
				/>
				<RangeControl
					label={__('Animation Duration (ms)', 'blockive-premium-addon-for-block')}
					value={duration}
					onChange={(val) => setAttributes({ duration: val })}
					min={500}
					max={3000}
					step={100}
				/>
			</PanelBody>
					</>
				)}
				style={(
			<PanelBody title={__('Colors', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<div style={{ marginBottom: '15px' }}>
					<label>{__('Number Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={numberColor}
						onChange={(val) => setAttributes({ numberColor: val })}
					/>
				</div>
				<div>
					<label>{__('Text Color', 'blockive-premium-addon-for-block')}</label>
					<ColorPalette
						value={textColor}
						onChange={(val) => setAttributes({ textColor: val })}
					/>
				</div>
			</PanelBody>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps} style={{
				display: 'grid',
				gridTemplateColumns: `repeat(${columns || 3}, 1fr)`,
				gap: `${gap}px`,
			}}>
				{(items || []).map((item, index) => (
					<div key={item.id || index} className="bpafb-funfact-item">
						<div className="bpafb-funfact-content">
							<div className="bpafb-funfact-number">
								<span className="bpafb-funfact-prefix" style={{ color: numberColor }}>{item.prefix || ''}</span>
								<span className="bpafb-funfact-counter" style={{ color: numberColor }}>{item.number || '0'}</span>
								<span className="bpafb-funfact-suffix" style={{ color: numberColor }}>{item.suffix || ''}</span>
							</div>
							<h3 className="bpafb-funfact-title" style={{ color: textColor }}>{item.title || ''}</h3>
						</div>
					</div>
				))}
			</div>
		</>
	);
}
