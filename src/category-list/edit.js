import { __, sprintf } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, PanelColorSettings } from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	ToggleControl,
	Spinner,
	SelectControl,
	TextControl
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { decodeEntities } from '@wordpress/html-entities';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

function buildCategoryTree(categories) {
	const map = {};
	const tree = [];
	categories.forEach(cat => {
		map[cat.id] = { ...cat, children: [] };
	});
	categories.forEach(cat => {
		if (cat.parent && map[cat.parent]) {
			map[cat.parent].children.push(map[cat.id]);
		} else {
			tree.push(map[cat.id]);
		}
	});
	return tree;
}

export default function Edit({ attributes, setAttributes }) {
	const { showCount, showDescription, hideEmpty, limit, orderBy, order, excludeTerms, layoutType, showHierarchy, gap, enableLink, itemBgColor, itemBorderColor, itemBorderWidth, itemBorderRadius, columns, itemPadding, textAlign, enableBoxShadow, removeChildBorder, taxonomy } = attributes;

	const blockProps = useBlockProps({
		className: `bpafb-category-list-wrapper bpafb-layout-${layoutType}`,
	});

	const { categories, isResolving, taxonomies } = useSelect(
		(select) => {
			const parsedExclude = excludeTerms ? excludeTerms.split(',').map(id => parseInt(id.trim(), 10)).filter(id => !isNaN(id)) : [];
			// When Show Hierarchy is on, fetch up to the REST API's own page-size cap (100)
			// so the full term set needed to build an accurate tree is available; `limit`
			// is then applied to top-level nodes only, after the tree is built (see `tree`
			// below). Taxonomies with more than 100 total terms are a known, accepted
			// limitation of hierarchy mode. When hierarchy is off, `limit` is still applied
			// directly as `per_page` (unchanged, efficient server-side truncation).
			const query = {
				per_page: showHierarchy ? 100 : limit,
				hide_empty: hideEmpty,
				orderby: orderBy === 'id' ? 'id' : (orderBy === 'count' ? 'count' : 'name'),
				order: order,
				exclude: parsedExclude,
			};
			return {
				categories: select('core').getEntityRecords('taxonomy', taxonomy, query),
				isResolving: select('core').isResolving('getEntityRecords', ['taxonomy', taxonomy, query]),
				taxonomies: select('core').getTaxonomies({ per_page: -1 }),
			};
		},
		[limit, hideEmpty, orderBy, order, excludeTerms, taxonomy, showHierarchy]
	);

	const taxonomyOptions = taxonomies 
		? taxonomies.map(tax => ({ label: tax.labels && tax.labels.singular_name ? tax.labels.singular_name : tax.name, value: tax.slug }))
		: [{ label: __('Category', 'blockive-premium-addon-for-block'), value: 'category' }];

	const selectedTaxonomy = taxonomies ? taxonomies.find(tax => tax.slug === taxonomy) : null;
	const taxonomyLabel = selectedTaxonomy ? (selectedTaxonomy.labels && selectedTaxonomy.labels.singular_name ? selectedTaxonomy.labels.singular_name : selectedTaxonomy.name) : __('category', 'blockive-premium-addon-for-block');

	const tree = showHierarchy
		? (categories ? (limit > 0 ? buildCategoryTree(categories).slice(0, limit) : buildCategoryTree(categories)) : [])
		: (categories || []);

	const itemStyle = {
		backgroundColor: itemBgColor || undefined,
		borderColor: itemBorderColor || undefined,
		borderWidth: itemBorderWidth !== undefined ? `${itemBorderWidth}px` : undefined,
		borderStyle: itemBorderWidth > 0 ? 'solid' : undefined,
		borderRadius: itemBorderRadius !== undefined ? `${itemBorderRadius}px` : undefined,
		padding: itemPadding !== undefined ? `${itemPadding}px` : '10px',
		textAlign: textAlign,
		boxShadow: enableBoxShadow ? '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)' : undefined,
	};

	const renderCategoryItem = (category, depth = 0) => {
		const currentItemStyle = { ...itemStyle };
		if (depth > 0 && removeChildBorder) {
			currentItemStyle.borderWidth = '0px';
			currentItemStyle.borderStyle = 'none';
		}
		return (
		<div key={category.id} className={`bpafb-category-item bpafb-depth-${depth}`} style={currentItemStyle}>
			<h3 className="bpafb-category-name">
				{enableLink ? (
					<a href={category.link} onClick={(e) => e.preventDefault()}>
						{decodeEntities(category.name)}
					</a>
				) : (
					<span>{decodeEntities(category.name)}</span>
				)}
				{showCount && <span className="bpafb-category-count"> ({category.count})</span>}
			</h3>
			{showDescription && category.description && layoutType !== 'horizontal' && (
				<p className="bpafb-category-description">{category.description}</p>
			)}
			{category.children && category.children.length > 0 && (
				<div className="bpafb-category-children">
					{category.children.map(child => renderCategoryItem(child, depth + 1))}
				</div>
			)}
		</div>
	);
	};

	return (
		<>
			<InspectorTabs
				general={(
			<PanelBody title={__('Settings', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<SelectControl
					label={__('Taxonomy', 'blockive-premium-addon-for-block')}
					value={taxonomy}
					options={taxonomyOptions}
					onChange={(val) => setAttributes({ taxonomy: val })}
				/>

				<SegmentedControl
					label={__('Layout Type', 'blockive-premium-addon-for-block')}
					value={layoutType}
					options={[
						{ label: __('Vertical', 'blockive-premium-addon-for-block'), value: 'vertical' },
						{ label: __('Horizontal', 'blockive-premium-addon-for-block'), value: 'horizontal' },
					]}
					onChange={(val) => setAttributes({ layoutType: val })}
				/>

				<StepperControl
					label={__('Limit', 'blockive-premium-addon-for-block')}
					value={limit}
					onChange={(val) => setAttributes({ limit: val })}
					min={1}
					max={50}
				/>

				{layoutType === 'horizontal' && (
					<StepperControl
						label={__('Columns', 'blockive-premium-addon-for-block')}
						value={columns}
						onChange={(val) => setAttributes({ columns: val })}
						min={1}
						max={6}
					/>
				)}

				<RangeControl
					label={__('Gap Between Items (px)', 'blockive-premium-addon-for-block')}
					value={gap}
					onChange={(val) => setAttributes({ gap: val })}
					min={0}
					max={100}
				/>

				<SegmentedControl
					label={__('Text Alignment', 'blockive-premium-addon-for-block')}
					value={textAlign}
					options={[
						{ label: __('Left', 'blockive-premium-addon-for-block'), value: 'left' },
						{ label: __('Center', 'blockive-premium-addon-for-block'), value: 'center' },
						{ label: __('Right', 'blockive-premium-addon-for-block'), value: 'right' },
					]}
					onChange={(val) => setAttributes({ textAlign: val })}
				/>

				<SegmentedControl
					label={__('Order By', 'blockive-premium-addon-for-block')}
					value={orderBy}
					options={[
						{ label: __('Name', 'blockive-premium-addon-for-block'), value: 'name' },
						{ label: __('Count', 'blockive-premium-addon-for-block'), value: 'count' },
						{ label: __('Term ID', 'blockive-premium-addon-for-block'), value: 'id' },
					]}
					onChange={(val) => setAttributes({ orderBy: val })}
				/>

				<SegmentedControl
					label={__('Order Direction', 'blockive-premium-addon-for-block')}
					value={order}
					options={[
						{ label: __('Ascending', 'blockive-premium-addon-for-block'), value: 'asc' },
						{ label: __('Descending', 'blockive-premium-addon-for-block'), value: 'desc' },
					]}
					onChange={(val) => setAttributes({ order: val })}
				/>

				<TextControl
					label={__('Exclude Categories (IDs)', 'blockive-premium-addon-for-block')}
					help={__('Comma separated term IDs.', 'blockive-premium-addon-for-block')}
					value={excludeTerms}
					onChange={(val) => setAttributes({ excludeTerms: val })}
				/>

				<ToggleControl
					label={__('Show Count', 'blockive-premium-addon-for-block')}
					checked={showCount}
					onChange={(val) => setAttributes({ showCount: val })}
				/>

				<ToggleControl
					label={__('Show Description', 'blockive-premium-addon-for-block')}
					checked={showDescription}
					onChange={(val) => setAttributes({ showDescription: val })}
				/>

				<ToggleControl
					label={__('Enable Link', 'blockive-premium-addon-for-block')}
					checked={enableLink}
					onChange={(val) => setAttributes({ enableLink: val })}
				/>

				<ToggleControl
					label={__('Hide Empty Categories', 'blockive-premium-addon-for-block')}
					checked={hideEmpty}
					onChange={(val) => setAttributes({ hideEmpty: val })}
				/>

				<ToggleControl
					label={__('Show Hierarchy', 'blockive-premium-addon-for-block')}
					checked={showHierarchy}
					onChange={(val) => setAttributes({ showHierarchy: val })}
				/>
			</PanelBody>
				)}
				style={(
					<>
			<PanelColorSettings
				title={__('Item Colors', 'blockive-premium-addon-for-block')}
				initialOpen={false}
				colorSettings={[
					{
						value: itemBgColor,
						onChange: (val) => setAttributes({ itemBgColor: val }),
						label: __('Background Color', 'blockive-premium-addon-for-block'),
					},
					{
						value: itemBorderColor,
						onChange: (val) => setAttributes({ itemBorderColor: val }),
						label: __('Border Color', 'blockive-premium-addon-for-block'),
					},
				]}
			/>
			<PanelBody title={__('Item Appearance', 'blockive-premium-addon-for-block')} initialOpen={false}>
				<RangeControl
					label={__('Padding (px)', 'blockive-premium-addon-for-block')}
					value={itemPadding}
					onChange={(val) => setAttributes({ itemPadding: val })}
					min={0}
					max={50}
				/>
				<RangeControl
					label={__('Border Width (px)', 'blockive-premium-addon-for-block')}
					value={itemBorderWidth}
					onChange={(val) => setAttributes({ itemBorderWidth: val })}
					min={0}
					max={20}
				/>
				<RangeControl
					label={__('Border Radius (px)', 'blockive-premium-addon-for-block')}
					value={itemBorderRadius}
					onChange={(val) => setAttributes({ itemBorderRadius: val })}
					min={0}
					max={100}
				/>
				<ToggleControl
					label={__('Enable Box Shadow', 'blockive-premium-addon-for-block')}
					checked={enableBoxShadow}
					onChange={(val) => setAttributes({ enableBoxShadow: val })}
				/>
				<ToggleControl
					label={__('Remove Border from Child Items', 'blockive-premium-addon-for-block')}
					checked={removeChildBorder}
					onChange={(val) => setAttributes({ removeChildBorder: val })}
				/>
			</PanelBody>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				{isResolving && !categories ? (
					<Spinner />
				) : categories && categories.length > 0 ? (
					<div className="bpafb-category-grid" style={{
						gap: gap !== undefined ? `${gap}px` : '20px',
						gridTemplateColumns: layoutType === 'horizontal' ? `repeat(${columns}, 1fr)` : undefined,
					}}>
						{tree.map(cat => renderCategoryItem(cat))}
					</div>
				) : (
					<p>{sprintf(__('No %s found.', 'blockive-premium-addon-for-block'), taxonomyLabel.toLowerCase())}</p>
				)}
			</div>
		</>
	);
}
