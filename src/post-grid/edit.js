import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, PanelColorSettings } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { dateI18n } from '@wordpress/date';
import { decodeEntities } from '@wordpress/html-entities';
import {
	PanelBody,
	RangeControl,
	SelectControl,
	ToggleControl,
	TextControl,
} from '@wordpress/components';

import InspectorTabs from '../components/inspector-tabs';
import SegmentedControl from '../components/segmented-control';
import StepperControl from '../components/stepper-control';

export default function Edit({ attributes, setAttributes }) {
	const {
		columns,
		postsPerPage,
		orderBy,
		order,
		showImage,
		showExcerpt,
		showDate,
		showAuthor,
		postType,
		dateFormat,
		titleColor,
		dateColor,
		authorColor,
		excerptColor,
		cardBgColor,
		cardBorderRadius,
		cardBorderColor,
		cardBorderWidth,
		cardBorderStyle,
	} = attributes;

	const { posts, isResolving, postTypes } = useSelect(
		(select) => {
			const query = {
				per_page: postsPerPage,
				orderby: orderBy === 'id' ? 'id' : (orderBy === 'rand' ? 'rand' : (orderBy === 'title' ? 'title' : 'date')),
				order: order,
				_embed: true,
			};
			return {
				posts: select('core').getEntityRecords('postType', postType, query),
				isResolving: select('core').isResolving('getEntityRecords', ['postType', postType, query]),
				postTypes: select('core').getPostTypes({ per_page: -1 }),
			};
		},
		[postsPerPage, orderBy, order, postType]
	);

	const postTypeOptions = postTypes 
		? postTypes.filter(type => type.viewable).map(type => ({ label: type.labels.singular_name, value: type.slug }))
		: [{ label: __('Post', 'blockive-premium-addon-for-block'), value: 'post' }];

	const blockProps = useBlockProps({
		className: 'bpafb-post-grid-wrapper',
	});

	return (
		<>
			<InspectorTabs
				general={(
					<>
			<PanelBody title={__('Layout', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<StepperControl
					label={__('Columns', 'blockive-premium-addon-for-block')}
					value={columns}
					onChange={(val) => setAttributes({ columns: val })}
					min={1}
					max={4}
				/>

				<StepperControl
					label={__('Posts Per Page', 'blockive-premium-addon-for-block')}
					value={postsPerPage}
					onChange={(val) => setAttributes({ postsPerPage: val })}
					min={1}
					max={50}
				/>
			</PanelBody>

			<PanelBody title={__('Query', 'blockive-premium-addon-for-block')}>
				<SelectControl
					label={__('Post Type', 'blockive-premium-addon-for-block')}
					value={postType}
					options={postTypeOptions}
					onChange={(val) => setAttributes({ postType: val })}
				/>
				<SegmentedControl
					label={__('Order By', 'blockive-premium-addon-for-block')}
					value={orderBy}
					options={[
						{ label: 'Date', value: 'date' },
						{ label: 'Title', value: 'title' },
						{ label: 'Random', value: 'rand' },
					]}
					onChange={(val) => setAttributes({ orderBy: val })}
				/>

				<SegmentedControl
					label={__('Order', 'blockive-premium-addon-for-block')}
					value={order}
					options={[
						{ label: 'Descending', value: 'desc' },
						{ label: 'Ascending', value: 'asc' },
					]}
					onChange={(val) => setAttributes({ order: val })}
				/>
			</PanelBody>

			<PanelBody title={__('Display', 'blockive-premium-addon-for-block')}>
				<ToggleControl
					label={__('Show Image', 'blockive-premium-addon-for-block')}
					checked={showImage}
					onChange={(val) => setAttributes({ showImage: val })}
				/>

				<ToggleControl
					label={__('Show Excerpt', 'blockive-premium-addon-for-block')}
					checked={showExcerpt}
					onChange={(val) => setAttributes({ showExcerpt: val })}
				/>

				<ToggleControl
					label={__('Show Date', 'blockive-premium-addon-for-block')}
					checked={showDate}
					onChange={(val) => setAttributes({ showDate: val })}
				/>

				{showDate && (
					<TextControl
						label={__('Date Format', 'blockive-premium-addon-for-block')}
						help={__('Leave empty to use WordPress default format, e.g. "F j, Y"', 'blockive-premium-addon-for-block')}
						value={dateFormat}
						onChange={(val) => setAttributes({ dateFormat: val })}
					/>
				)}

				<ToggleControl
					label={__('Show Author', 'blockive-premium-addon-for-block')}
					checked={showAuthor}
					onChange={(val) => setAttributes({ showAuthor: val })}
				/>
			</PanelBody>
					</>
				)}
				style={(
					<>
			<PanelBody title={__('Card Style', 'blockive-premium-addon-for-block')} initialOpen={true}>
				<RangeControl
					label={__('Border Radius', 'blockive-premium-addon-for-block')}
					value={cardBorderRadius}
					onChange={(val) => setAttributes({ cardBorderRadius: val })}
					min={0}
					max={50}
				/>
				<RangeControl
					label={__('Border Width', 'blockive-premium-addon-for-block')}
					value={cardBorderWidth}
					onChange={(val) => setAttributes({ cardBorderWidth: val })}
					min={0}
					max={20}
				/>
				<SelectControl
					label={__('Border Style', 'blockive-premium-addon-for-block')}
					value={cardBorderStyle}
					options={[
						{ label: 'None', value: 'none' },
						{ label: 'Solid', value: 'solid' },
						{ label: 'Dashed', value: 'dashed' },
						{ label: 'Dotted', value: 'dotted' },
						{ label: 'Double', value: 'double' },
					]}
					onChange={(val) => setAttributes({ cardBorderStyle: val })}
				/>
			</PanelBody>

			<PanelColorSettings
				title={__('Colors', 'blockive-premium-addon-for-block')}
				initialOpen={false}
				colorSettings={[
					{
						value: cardBgColor,
						onChange: (val) => setAttributes({ cardBgColor: val }),
						label: __('Card Background Color', 'blockive-premium-addon-for-block'),
					},
					{
						value: cardBorderColor,
						onChange: (val) => setAttributes({ cardBorderColor: val }),
						label: __('Card Border Color', 'blockive-premium-addon-for-block'),
					},
					{
						value: titleColor,
						onChange: (val) => setAttributes({ titleColor: val }),
						label: __('Title Color', 'blockive-premium-addon-for-block'),
					},
					{
						value: dateColor,
						onChange: (val) => setAttributes({ dateColor: val }),
						label: __('Date Color', 'blockive-premium-addon-for-block'),
					},
					{
						value: authorColor,
						onChange: (val) => setAttributes({ authorColor: val }),
						label: __('Author Color', 'blockive-premium-addon-for-block'),
					},
					{
						value: excerptColor,
						onChange: (val) => setAttributes({ excerptColor: val }),
						label: __('Excerpt Color', 'blockive-premium-addon-for-block'),
					},
				]}
			/>
					</>
				)}
				attributes={attributes}
				setAttributes={setAttributes}
			/>

			<div {...blockProps}>
				{isResolving && !posts ? (
					<div className="bpafb-post-grid-loading">Loading posts...</div>
				) : posts && posts.length > 0 ? (
					<div className="bpafb-post-grid" style={{ gridTemplateColumns: `repeat(${columns}, 1fr)` }}>
						{posts.map(post => {
							const featuredImage = post._embedded && post._embedded['wp:featuredmedia'] && post._embedded['wp:featuredmedia'].length > 0 
								? post._embedded['wp:featuredmedia'][0].source_url 
								: null;
							
							return (
								<article key={post.id} className="bpafb-post-card" style={{ 
									backgroundColor: cardBgColor, 
									borderRadius: cardBorderRadius !== undefined ? `${cardBorderRadius}px` : undefined,
									borderColor: cardBorderColor || undefined,
									borderWidth: cardBorderWidth !== undefined && cardBorderWidth > 0 ? `${cardBorderWidth}px` : undefined,
									borderStyle: cardBorderWidth !== undefined && cardBorderWidth > 0 ? cardBorderStyle : undefined,
								}}>
									{showImage && (
										<div className="bpafb-post-image">
											{featuredImage ? (
												<img src={featuredImage} alt={decodeEntities(post.title.rendered)} style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
											) : (
												<div style={{ backgroundColor: '#f0f0f0', width: '100%', paddingBottom: '75%' }}></div>
											)}
										</div>
									)}
									<div className="bpafb-post-content">
										{showDate && (
											<span className="bpafb-post-date" style={{ color: dateColor }}>
												{dateFormat ? dateI18n(dateFormat, post.date) : dateI18n('F j, Y', post.date)}
											</span>
										)}
										<h3 className="bpafb-post-title">
											<a href={post.link} onClick={(e) => e.preventDefault()} style={{ color: titleColor }}>{decodeEntities(post.title.rendered)}</a>
										</h3>
										{showAuthor && (
										<span className="bpafb-post-author" style={{ color: authorColor }}>
											{__('By', 'blockive-premium-addon-for-block')} {post._embedded && post._embedded.author && post._embedded.author[0] ? post._embedded.author[0].name : __('Author', 'blockive-premium-addon-for-block')}
										</span>
									)}
										{showExcerpt && (
											<div className="bpafb-post-excerpt" style={{ color: excerptColor }} dangerouslySetInnerHTML={{ __html: post.excerpt.rendered }} />
										)}
									</div>
								</article>
							);
						})}
					</div>
				) : (
					<p>{__('No posts found.', 'blockive-premium-addon-for-block')}</p>
				)}
			</div>
		</>
	);
}
