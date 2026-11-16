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
	Button,
} from '@wordpress/components';
import { useEffect, useRef } from '@wordpress/element';
import Chart from 'chart.js/auto';

import InspectorTabs from '../components/inspector-tabs';

export default function Edit({ attributes, setAttributes }) {
	const {
		chartData,
		legendPosition,
		cutout,
		borderWidth,
		borderColor,
		animationSpeed,
		alignment,
	} = attributes;

	const chartRef = useRef(null);
	const chartInstance = useRef(null);

	const blockProps = useBlockProps({
		className: `align${alignment}`,
	});

	useEffect(() => {
		if (!chartRef.current) return;

		// Destroy previous instance
		if (chartInstance.current) {
			chartInstance.current.destroy();
		}

		const data = {
			labels: chartData.map(item => item.label),
			datasets: [{
				data: chartData.map(item => item.value),
				backgroundColor: chartData.map(item => item.bg),
				borderColor: borderColor || '#ffffff',
				borderWidth: borderWidth !== undefined ? borderWidth : 2,
			}]
		};

		const config = {
			type: cutout > 0 ? 'doughnut' : 'pie',
			data: data,
			options: {
				responsive: true,
				maintainAspectRatio: true,
				animation: {
					duration: 0 // Disable animation in editor for better perf
				},
				cutout: cutout > 0 ? `${cutout}%` : 0,
				plugins: {
					legend: {
						display: legendPosition !== 'none',
						position: legendPosition === 'none' ? 'top' : legendPosition,
					}
				}
			}
		};

		chartInstance.current = new Chart(chartRef.current, config);

		return () => {
			if (chartInstance.current) {
				chartInstance.current.destroy();
			}
		};
	}, [chartData, legendPosition, cutout, borderWidth, borderColor]);

	const updateItem = (index, key, value) => {
		const newData = [...chartData];
		newData[index] = { ...newData[index], [key]: key === 'value' ? parseFloat(value) || 0 : value };
		setAttributes({ chartData: newData });
	};

	const addItem = () => {
		setAttributes({
			chartData: [
				...chartData,
				{ id: Date.now().toString(), label: `Item ${chartData.length + 1}`, value: 100, bg: '#cbd5e1' }
			]
		});
	};

	const removeItem = (index) => {
		const newData = chartData.filter((_, i) => i !== index);
		setAttributes({ chartData: newData });
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
						<PanelBody title={__('Chart Data', 'blockive-premium-addon-for-block')} initialOpen={true}>
							{chartData.map((item, index) => (
								<div key={item.id} style={{ marginBottom: '15px', padding: '10px', border: '1px solid #e2e8f0', borderRadius: '4px' }}>
									<TextControl
										label={__('Label', 'blockive-premium-addon-for-block')}
										value={item.label}
										onChange={(val) => updateItem(index, 'label', val)}
									/>
									<TextControl
										label={__('Value', 'blockive-premium-addon-for-block')}
										type="number"
										value={item.value}
										onChange={(val) => updateItem(index, 'value', val)}
									/>
									<BaseControl label={__('Slice Color', 'blockive-premium-addon-for-block')}>
										<ColorPalette
											value={item.bg}
											onChange={(val) => updateItem(index, 'bg', val || '#000')}
										/>
									</BaseControl>
									<Button isDestructive onClick={() => removeItem(index)} style={{ marginTop: '10px' }}>
										{__('Remove Item', 'blockive-premium-addon-for-block')}
									</Button>
								</div>
							))}
							<Button isPrimary onClick={addItem}>
								{__('Add Slice', 'blockive-premium-addon-for-block')}
							</Button>
						</PanelBody>

						<PanelBody title={__('Chart Settings', 'blockive-premium-addon-for-block')} initialOpen={false}>
							<RangeControl
								label={__('Cutout % (Make it a Donut)', 'blockive-premium-addon-for-block')}
								value={cutout}
								onChange={(val) => setAttributes({ cutout: val })}
								min={0}
								max={90}
								help={__('Set > 0 to create a Donut Chart.', 'blockive-premium-addon-for-block')}
							/>
							<SelectControl
								label={__('Legend Position', 'blockive-premium-addon-for-block')}
								value={legendPosition}
								options={[
									{ label: 'Top', value: 'top' },
									{ label: 'Bottom', value: 'bottom' },
									{ label: 'Left', value: 'left' },
									{ label: 'Right', value: 'right' },
									{ label: 'None', value: 'none' },
								]}
								onChange={(val) => setAttributes({ legendPosition: val })}
							/>
						</PanelBody>
					</>
				)}
				style={(
					<PanelBody title={__('Styling', 'blockive-premium-addon-for-block')} initialOpen={true}>
						<RangeControl
							label={__('Border Width (px)', 'blockive-premium-addon-for-block')}
							value={borderWidth}
							onChange={(val) => setAttributes({ borderWidth: val })}
							min={0}
							max={10}
						/>
						<BaseControl label={__('Border Color', 'blockive-premium-addon-for-block')}>
							<ColorPalette value={borderColor} onChange={(val) => setAttributes({ borderColor: val || 'transparent' })} />
						</BaseControl>
						<RangeControl
							label={__('Animation Speed (ms)', 'blockive-premium-addon-for-block')}
							value={animationSpeed}
							onChange={(val) => setAttributes({ animationSpeed: val })}
							min={0}
							max={5000}
							step={100}
							help={__('Only applies to the live site frontend.', 'blockive-premium-addon-for-block')}
						/>
					</PanelBody>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				<div className="bpafb-pie-chart-wrapper">
					{chartData && chartData.length > 0 ? (
						<canvas ref={chartRef}></canvas>
					) : (
						<div className="bpafb-chart-error">{__('Please add data to show the chart.', 'blockive-premium-addon-for-block')}</div>
					)}
				</div>
			</div>
		</>
	);
}
