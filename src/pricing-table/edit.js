import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	BlockControls,
	AlignmentControl,
	RichText,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	ColorPalette,
	BaseControl,
	RangeControl,
	ToggleControl,
	Button,
	SelectControl,
} from '@wordpress/components';
import { useState } from '@wordpress/element';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

const themeColors = [
	{ name: 'Indigo', color: '#4f46e5' },
	{ name: 'Blue', color: '#2563eb' },
	{ name: 'Dark Slate', color: '#0f172a' },
	{ name: 'Gray Element', color: '#f1f5f9' },
	{ name: 'Slate Gray', color: '#475569' },
	{ name: 'White', color: '#ffffff' },
	{ name: 'Red', color: '#ef4444' },
	{ name: 'Green', color: '#22c55e' },
];

export default function Edit({ attributes, setAttributes }) {
	const {
		tables,
		columns,
		columnGap,
		layoutStyle,
		alignment,
		headerBgColor,
		headerTitleColor,
		headerSubtitleColor,
		priceColor,
		featureTextColor,
		buttonBgColor,
		buttonTextColor,
		buttonBorderColor,
		buttonBorderWidth,
		buttonBorderRadius,
		badgeBgColor,
		badgeTextColor,
		boxBgColor,
		borderColor,
		borderWidth,
		borderRadius,
		boxShadow,
	} = attributes;

	// Keep track of which table is currently being edited in the inspector
	const [activeTableIndex, setActiveTableIndex] = useState(0);

	const customStyles = {
		'--bpafb-pt-header-bg': headerBgColor || '#4f46e5',
		'--bpafb-pt-header-title-color': headerTitleColor || '#ffffff',
		'--bpafb-pt-header-subtitle-color': headerSubtitleColor || '#ffffff',
		'--bpafb-pt-price-color': priceColor || '#0f172a',
		'--bpafb-pt-feature-text': featureTextColor || '#475569',
		'--bpafb-pt-button-bg': buttonBgColor || '#4f46e5',
		'--bpafb-pt-button-text': buttonTextColor || '#ffffff',
		'--bpafb-pt-btn-border-color': buttonBorderColor || 'transparent',
		'--bpafb-pt-btn-border-width': `${buttonBorderWidth !== undefined ? buttonBorderWidth : 0}px`,
		'--bpafb-pt-btn-border-radius': `${buttonBorderRadius !== undefined ? buttonBorderRadius : 50}px`,
		'--bpafb-pt-badge-bg': badgeBgColor || 'linear-gradient(135deg, #ef4444, #b91c1c)',
		'--bpafb-pt-badge-color': badgeTextColor || '#ffffff',
		'--bpafb-pt-box-bg': boxBgColor || '#ffffff',
		'--bpafb-pt-borderColor': borderColor || '#f1f5f9',
		'--bpafb-pt-borderWidth': `${borderWidth !== undefined ? borderWidth : 1}px`,
		'--bpafb-pt-borderRadius': `${borderRadius !== undefined ? borderRadius : 16}px`,
		'--bpafb-pt-columns': columns,
		'--bpafb-pt-column-gap': `${columnGap}px`,
	};

	const blockProps = useBlockProps({
		className: `bpafb-pricing-wrapper align${alignment || 'center'}`,
		style: customStyles,
	});

	const updateTable = (index, key, value) => {
		const newTables = [...(tables || [])];
		newTables[index] = { ...newTables[index], [key]: value };
		setAttributes({ tables: newTables });
	};

	const addTable = () => {
		const newTables = [
			...(tables || []),
			{
				id: Date.now().toString(),
				title: `Plan ${(tables || []).length + 1}`,
				subtitle: 'Plan description',
				image: '',
				isFeatured: false,
				featuredBadge: 'Most Popular',
				currency: '$',
				price: '99',
				period: '/ month',
				buttonText: 'Get Started',
				buttonUrl: '#',
				features: [
					{ id: Date.now().toString() + '1', text: 'Feature 1', active: true, icon: 'fas fa-check' },
				],
			},
		];
		setAttributes({ tables: newTables });
		setActiveTableIndex(newTables.length - 1);
	};

	const removeTable = (index) => {
		const newTables = (tables || []).filter((_, i) => i !== index);
		setAttributes({ tables: newTables });
		if (activeTableIndex >= newTables.length) {
			setActiveTableIndex(Math.max(0, newTables.length - 1));
		}
	};

	const updateFeature = (tableIndex, featureIndex, key, value) => {
		const newTables = [...(tables || [])];
		const newFeatures = [...newTables[tableIndex].features];
		newFeatures[featureIndex] = { ...newFeatures[featureIndex], [key]: value };
		newTables[tableIndex] = { ...newTables[tableIndex], features: newFeatures };
		setAttributes({ tables: newTables });
	};

	const addFeature = (tableIndex) => {
		const newTables = [...(tables || [])];
		newTables[tableIndex] = {
			...newTables[tableIndex],
			features: [
				...(newTables[tableIndex].features || []),
				{ id: Date.now().toString(), text: 'New Feature', active: true, icon: 'fas fa-check' },
			],
		};
		setAttributes({ tables: newTables });
	};

	const removeFeature = (tableIndex, featureIndex) => {
		const newTables = [...(tables || [])];
		newTables[tableIndex] = {
			...newTables[tableIndex],
			features: newTables[tableIndex].features.filter((_, i) => i !== featureIndex),
		};
		setAttributes({ tables: newTables });
	};

	const activeTable = tables && tables.length > 0 ? tables[activeTableIndex] : null;

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
			<PanelBody title={__('Pricing Tables', 'blockive-premium-addon-for-block')} initialOpen={true}>
				{tables && tables.length > 0 ? (
					<>
						<div style={{ marginBottom: '15px' }}>
							<SelectControl
								label={__('Select Table to Edit', 'blockive-premium-addon-for-block')}
								value={activeTableIndex}
								options={tables.map((t, idx) => ({ label: t.title || `Table ${idx + 1}`, value: idx }))}
								onChange={(val) => setActiveTableIndex(Number(val))}
							/>
						</div>

						<div style={{ border: '1px solid #ccc', padding: '15px', borderRadius: '4px', marginBottom: '15px' }}>
							<ToggleControl
								label={__('Highlight as Featured?', 'blockive-premium-addon-for-block')}
								checked={activeTable.isFeatured}
								onChange={(val) => updateTable(activeTableIndex, 'isFeatured', val)}
							/>
							{activeTable.isFeatured && (
								<TextControl
									label={__('Featured Badge Text', 'blockive-premium-addon-for-block')}
									value={activeTable.featuredBadge}
									onChange={(val) => updateTable(activeTableIndex, 'featuredBadge', val)}
								/>
							)}

							<TextControl
								label={__('Currency Symbol', 'blockive-premium-addon-for-block')}
								value={activeTable.currency}
								onChange={(val) => updateTable(activeTableIndex, 'currency', val)}
							/>
							<TextControl
								label={__('Period Prefix/Suffix', 'blockive-premium-addon-for-block')}
								value={activeTable.period}
								onChange={(val) => updateTable(activeTableIndex, 'period', val)}
							/>
							
							<div style={{ marginTop: '15px', marginBottom: '15px' }}>
								<label style={{ display: 'block', marginBottom: '8px' }}>{__('Table Image (Optional)', 'blockive-premium-addon-for-block')}</label>
								<MediaUploadCheck>
									<MediaUpload
										onSelect={(media) => updateTable(activeTableIndex, 'image', media.url)}
										allowedTypes={['image']}
										value={activeTable.image}
										render={({ open }) => (
											<div style={{ display: 'flex', gap: '10px' }}>
												<Button onClick={open} isPrimary size="small">
													{activeTable.image ? __('Change', 'blockive-premium-addon-for-block') : __('Select Image', 'blockive-premium-addon-for-block')}
												</Button>
												{activeTable.image && (
													<Button isDestructive size="small" onClick={() => updateTable(activeTableIndex, 'image', '')}>
														{__('Remove', 'blockive-premium-addon-for-block')}
													</Button>
												)}
											</div>
										)}
									/>
								</MediaUploadCheck>
							</div>

							<div style={{ marginTop: '20px', borderTop: '1px solid #eee', paddingTop: '15px' }}>
								<h4>{__('Features', 'blockive-premium-addon-for-block')}</h4>
								{activeTable.features && activeTable.features.map((feature, featureIndex) => (
									<div key={feature.id} style={{ marginBottom: '10px', padding: '10px', backgroundColor: '#f8f9fa', borderRadius: '4px' }}>
										<ToggleControl
											label={__('Is Active?', 'blockive-premium-addon-for-block')}
											checked={feature.active}
											onChange={(val) => updateFeature(activeTableIndex, featureIndex, 'active', val)}
										/>
										<TextControl
											label={__('FontAwesome Class', 'blockive-premium-addon-for-block')}
											value={feature.icon || (feature.active ? 'fas fa-check' : 'fas fa-times')}
											onChange={(val) => updateFeature(activeTableIndex, featureIndex, 'icon', val)}
										/>
										<Button isDestructive size="small" onClick={() => removeFeature(activeTableIndex, featureIndex)}>
											{__('Remove Feature', 'blockive-premium-addon-for-block')}
										</Button>
									</div>
								))}
								<Button isSecondary onClick={() => addFeature(activeTableIndex)}>
									{__('Add Feature', 'blockive-premium-addon-for-block')}
								</Button>
							</div>

							<div style={{ marginTop: '20px', borderTop: '1px solid #eee', paddingTop: '15px' }}>
								<TextControl
									label={__('Button URL', 'blockive-premium-addon-for-block')}
									value={activeTable.buttonUrl}
									onChange={(val) => updateTable(activeTableIndex, 'buttonUrl', val)}
								/>
							</div>

							<div style={{ marginTop: '20px', borderTop: '1px solid #eee', paddingTop: '15px' }}>
								<h4>{__('Table Custom Colors', 'blockive-premium-addon-for-block')}</h4>
								<p style={{ fontSize: '12px', color: '#666', marginBottom: '15px' }}>Leave empty to use Global Style settings.</p>
								<BaseControl label={__('Header Background Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.headerBgColor} onChange={(val) => updateTable(activeTableIndex, 'headerBgColor', val)} />
								</BaseControl>
								<BaseControl label={__('Header Title Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.headerTitleColor} onChange={(val) => updateTable(activeTableIndex, 'headerTitleColor', val)} />
								</BaseControl>
								<BaseControl label={__('Header Subtitle Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.headerSubtitleColor} onChange={(val) => updateTable(activeTableIndex, 'headerSubtitleColor', val)} />
								</BaseControl>
								<BaseControl label={__('Table Background Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.boxBgColor} onChange={(val) => updateTable(activeTableIndex, 'boxBgColor', val)} />
								</BaseControl>
								<BaseControl label={__('Badge Background Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.badgeBgColor} onChange={(val) => updateTable(activeTableIndex, 'badgeBgColor', val)} />
								</BaseControl>
								<BaseControl label={__('Badge Text Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.badgeTextColor} onChange={(val) => updateTable(activeTableIndex, 'badgeTextColor', val)} />
								</BaseControl>
								<BaseControl label={__('Price Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.priceColor} onChange={(val) => updateTable(activeTableIndex, 'priceColor', val)} />
								</BaseControl>
								<BaseControl label={__('Feature Text Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.featureTextColor} onChange={(val) => updateTable(activeTableIndex, 'featureTextColor', val)} />
								</BaseControl>
								<BaseControl label={__('Button Background Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.buttonBgColor} onChange={(val) => updateTable(activeTableIndex, 'buttonBgColor', val)} />
								</BaseControl>
								<BaseControl label={__('Button Text Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.buttonTextColor} onChange={(val) => updateTable(activeTableIndex, 'buttonTextColor', val)} />
								</BaseControl>
								<BaseControl label={__('Button Border Color', 'blockive-premium-addon-for-block')}>
									<ColorPalette colors={themeColors} value={activeTable.buttonBorderColor} onChange={(val) => updateTable(activeTableIndex, 'buttonBorderColor', val)} />
								</BaseControl>
							</div>
							
							<div style={{ marginTop: '20px' }}>
								<Button isDestructive onClick={() => removeTable(activeTableIndex)}>
									{__('Remove Entire Table', 'blockive-premium-addon-for-block')}
								</Button>
							</div>
						</div>
					</>
				) : (
					<p>{__('No tables added yet.', 'blockive-premium-addon-for-block')}</p>
				)}
				<Button isPrimary onClick={addTable} style={{ width: '100%', justifyContent: 'center' }}>
					{__('Add New Table', 'blockive-premium-addon-for-block')}
				</Button>
			</PanelBody>

			<PanelBody title={__('Grid Layout', 'blockive-premium-addon-for-block')} initialOpen={false}>
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
			<PanelBody title={__('Layout Style', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<SegmentedControl
					label={__('Design Preset', 'blockive-premium-addon-for-block')}
					value={layoutStyle}
					options={[
						{ label: 'Style 1: Standard Card', value: 'style1' },
						{ label: 'Style 2: Clean Line (Transparent Header)', value: 'style2' },
						{ label: 'Style 3: Floating Gradient Header', value: 'style3' },
					]}
					onChange={(val) => setAttributes({ layoutStyle: val })}
				/>
			</PanelBody>

			<PanelBody title={__('Style Settings', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<RangeControl
					label={__('Border Width (px)', 'blockive-premium-addon-for-block')}
					value={borderWidth !== undefined ? borderWidth : 1}
					onChange={(val) => setAttributes({ borderWidth: val })}
					min={0}
					max={10}
				/>
				<RangeControl
					label={__('Border Radius (px)', 'blockive-premium-addon-for-block')}
					value={borderRadius !== undefined ? borderRadius : 16}
					onChange={(val) => setAttributes({ borderRadius: val })}
					min={0}
					max={50}
				/>
				<ToggleControl
					label={__('Enable Box Shadow', 'blockive-premium-addon-for-block')}
					checked={boxShadow !== undefined ? boxShadow : true}
					onChange={(val) => setAttributes({ boxShadow: val })}
				/>

				<BaseControl label={__('Header Background Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={headerBgColor || '#4f46e5'} onChange={(val) => setAttributes({ headerBgColor: val })} />
				</BaseControl>
				<BaseControl label={__('Header Title Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={headerTitleColor || '#ffffff'} onChange={(val) => setAttributes({ headerTitleColor: val })} />
				</BaseControl>
				<BaseControl label={__('Header Subtitle Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={headerSubtitleColor || '#ffffff'} onChange={(val) => setAttributes({ headerSubtitleColor: val })} />
				</BaseControl>
				<BaseControl label={__('Table Background Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={boxBgColor || '#ffffff'} onChange={(val) => setAttributes({ boxBgColor: val })} />
				</BaseControl>
				<BaseControl label={__('Badge Background Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={badgeBgColor} onChange={(val) => setAttributes({ badgeBgColor: val })} />
				</BaseControl>
				<BaseControl label={__('Badge Text Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={badgeTextColor || '#ffffff'} onChange={(val) => setAttributes({ badgeTextColor: val })} />
				</BaseControl>
				<BaseControl label={__('Price Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={priceColor || '#0f172a'} onChange={(val) => setAttributes({ priceColor: val })} />
				</BaseControl>
				<BaseControl label={__('Feature Text Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={featureTextColor || '#475569'} onChange={(val) => setAttributes({ featureTextColor: val })} />
				</BaseControl>
				<BaseControl label={__('Border Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={borderColor || '#f1f5f9'} onChange={(val) => setAttributes({ borderColor: val })} />
				</BaseControl>
				<BaseControl label={__('Button Background Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={buttonBgColor || '#4f46e5'} onChange={(val) => setAttributes({ buttonBgColor: val })} />
				</BaseControl>
				<BaseControl label={__('Button Text Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={buttonTextColor || '#ffffff'} onChange={(val) => setAttributes({ buttonTextColor: val })} />
				</BaseControl>
				<BaseControl label={__('Button Border Color', 'blockive-premium-addon-for-block')}>
					<ColorPalette colors={themeColors} value={buttonBorderColor} onChange={(val) => setAttributes({ buttonBorderColor: val })} />
				</BaseControl>
				<RangeControl
					label={__('Button Border Width (px)', 'blockive-premium-addon-for-block')}
					value={buttonBorderWidth !== undefined ? buttonBorderWidth : 0}
					onChange={(val) => setAttributes({ buttonBorderWidth: val })}
					min={0}
					max={10}
				/>
				<RangeControl
					label={__('Button Border Radius (px)', 'blockive-premium-addon-for-block')}
					value={buttonBorderRadius !== undefined ? buttonBorderRadius : 50}
					onChange={(val) => setAttributes({ buttonBorderRadius: val })}
					min={0}
					max={100}
				/>
			</PanelBody>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				<div className="bpafb-pricing-grid">
					{tables && tables.map((table, tIndex) => {
						const tableStyles = {
							...(table.headerBgColor && { '--bpafb-pt-header-bg': table.headerBgColor }),
							...(table.headerTitleColor && { '--bpafb-pt-header-title-color': table.headerTitleColor }),
							...(table.headerSubtitleColor && { '--bpafb-pt-header-subtitle-color': table.headerSubtitleColor }),
							...(table.priceColor && { '--bpafb-pt-price-color': table.priceColor }),
							...(table.featureTextColor && { '--bpafb-pt-feature-text': table.featureTextColor }),
							...(table.buttonBgColor && { '--bpafb-pt-button-bg': table.buttonBgColor }),
							...(table.buttonTextColor && { '--bpafb-pt-button-text': table.buttonTextColor }),
							...(table.buttonBorderColor && { '--bpafb-pt-btn-border-color': table.buttonBorderColor }),
							...(table.badgeBgColor && { '--bpafb-pt-badge-bg': table.badgeBgColor }),
							...(table.badgeTextColor && { '--bpafb-pt-badge-color': table.badgeTextColor }),
							...(table.boxBgColor && { '--bpafb-pt-box-bg': table.boxBgColor }),
						};

						return (
						<div
							key={table.id}
							className={`bpafb-pricing-table bpafb-pricing-${layoutStyle || 'style1'} ${table.isFeatured ? 'is-featured' : ''} ${boxShadow ? 'has-shadow' : ''}`}
							style={tableStyles}
						>
							{table.isFeatured && (
								<div className="bpafb-pricing-badge">{table.featuredBadge}</div>
							)}

							<div className="bpafb-pricing-header">
								<RichText
									tagName="h3"
									className="bpafb-pricing-title"
									value={table.title}
									onChange={(val) => updateTable(tIndex, 'title', val)}
									placeholder={__('Plan Title', 'blockive-premium-addon-for-block')}
								/>
								<RichText
									tagName="p"
									className="bpafb-pricing-subtitle"
									value={table.subtitle}
									onChange={(val) => updateTable(tIndex, 'subtitle', val)}
									placeholder={__('Plan description...', 'blockive-premium-addon-for-block')}
								/>
							</div>

							{table.image && (
								<div className="bpafb-pricing-image-wrap" style={{ margin: '20px 0' }}>
									<img src={table.image} alt="Pricing Plan" style={{ maxWidth: '100%', height: 'auto', display: 'block', margin: '0 auto' }} />
								</div>
							)}

							<div className="bpafb-pricing-price-area">
								<span className="bpafb-pricing-currency">{table.currency}</span>
								<RichText
									tagName="span"
									className="bpafb-pricing-amount"
									value={table.price}
									onChange={(val) => updateTable(tIndex, 'price', val)}
									placeholder="99"
								/>
								<span className="bpafb-pricing-period">{table.period}</span>
							</div>

							<ul className="bpafb-pricing-features">
								{table.features && table.features.map((feature, fIndex) => (
									<li key={feature.id} className={feature.active ? 'active' : 'inactive'}>
										<i className={feature.icon || (feature.active ? 'fas fa-check' : 'fas fa-times')}></i>
										<RichText
											tagName="span"
											value={feature.text}
											onChange={(val) => updateFeature(tIndex, fIndex, 'text', val)}
											placeholder={__('Feature', 'blockive-premium-addon-for-block')}
										/>
									</li>
								))}
							</ul>

							<div className="bpafb-pricing-footer">
								<RichText
									tagName="a"
									className="bpafb-pricing-button"
									value={table.buttonText}
									onChange={(val) => updateTable(tIndex, 'buttonText', val)}
									placeholder={__('Button Text', 'blockive-premium-addon-for-block')}
									onClick={(e) => e.preventDefault()}
								/>
							</div>
						</div>
					)})}
				</div>
			</div>
		</>
	);
}
