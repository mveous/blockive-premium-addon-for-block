import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, TextControl, SelectControl, BaseControl, ColorPalette, Button } from '@wordpress/components';
import { useState, Fragment } from '@wordpress/element';

import InspectorTabs from '../../../components/inspector-tabs';
import AdvancedTab from '../../../components/advanced-tab';
import usePreviewContext from '../../shared/use-preview-context';
import { formatPreviewDate } from '../../shared/format';

const LABELS = {
	date: __( 'Date', 'blockive-premium-addon-for-block' ),
	author: __( 'Author', 'blockive-premium-addon-for-block' ),
	categories: __( 'Categories', 'blockive-premium-addon-for-block' ),
	tags: __( 'Tags', 'blockive-premium-addon-for-block' ),
	comments: __( 'Comments', 'blockive-premium-addon-for-block' ),
	readingTime: __( 'Reading Time', 'blockive-premium-addon-for-block' ),
};

const SAMPLE_VALUES = {
	date: __( 'January 1, 2026', 'blockive-premium-addon-for-block' ),
	author: __( 'Jane Doe', 'blockive-premium-addon-for-block' ),
	categories: __( 'News', 'blockive-premium-addon-for-block' ),
	tags: __( 'Sample Tag', 'blockive-premium-addon-for-block' ),
	comments: __( '3 Comments', 'blockive-premium-addon-for-block' ),
	readingTime: __( '4 min read', 'blockive-premium-addon-for-block' ),
};

// Mirrors the icon assigned to each item key in Bpafb_Post_Meta_Items::get_html()
// (includes/class-bpafb-post-meta-items.php) so the editor preview matches the
// frontend exactly instead of falling back to a generic icon.
const ICONS = {
	date: 'fa-regular fa-calendar',
	author: 'fa-regular fa-user',
	categories: 'fa-regular fa-folder',
	tags: 'fa-solid fa-tags',
	comments: 'fa-regular fa-comment',
	readingTime: 'fa-regular fa-clock',
};

/**
 * Minimal HTML5 drag-and-drop reorderable list. @wordpress/components has no
 * built-in sortable list, so this implements just enough drag-and-drop to
 * reorder the `items` attribute array without pulling in a new dependency.
 */
function ReorderableItemsList( { items, onChange } ) {
	const [ dragIndex, setDragIndex ] = useState( null );

	const moveItem = ( from, to ) => {
		if ( from === to || from == null || to == null ) {
			return;
		}
		const next = [ ...items ];
		const [ moved ] = next.splice( from, 1 );
		next.splice( to, 0, moved );
		onChange( next );
	};

	return (
		<ul className="bpafb-post-meta-reorder-list">
			{ items.map( ( item, index ) => (
				<li
					key={ item.key }
					className="bpafb-post-meta-reorder-item"
					draggable
					onDragStart={ () => setDragIndex( index ) }
					onDragOver={ ( event ) => event.preventDefault() }
					onDrop={ ( event ) => {
						event.preventDefault();
						moveItem( dragIndex, index );
						setDragIndex( null );
					} }
				>
					<span className="bpafb-post-meta-drag-handle" aria-hidden="true">
						<i className="fa-solid fa-grip-vertical" />
					</span>
					<ToggleControl
						label={ LABELS[ item.key ] || item.key }
						checked={ !! item.enabled }
						onChange={ ( checked ) => {
							const next = items.map( ( it, i ) => ( i === index ? { ...it, enabled: checked } : it ) );
							onChange( next );
						} }
					/>
					<Button
						icon="arrow-up-alt2"
						label={ __( 'Move up', 'blockive-premium-addon-for-block' ) }
						onClick={ () => moveItem( index, index - 1 ) }
						disabled={ index === 0 }
						size="small"
					/>
					<Button
						icon="arrow-down-alt2"
						label={ __( 'Move down', 'blockive-premium-addon-for-block' ) }
						onClick={ () => moveItem( index, index + 1 ) }
						disabled={ index === items.length - 1 }
						size="small"
					/>
				</li>
			) ) }
		</ul>
	);
}

export default function Edit( { attributes, setAttributes } ) {
	const { items, separator, showIcons, badgeStyle = 'none', badgeBgColor, badgeTextColor, linkHoverColor } = attributes;
	const { record } = usePreviewContext();

	const blockProps = useBlockProps( { className: 'bpafb-tb-post-meta' } );

	const previewValue = ( key ) => {
		if ( ! record ) {
			return SAMPLE_VALUES[ key ];
		}
		switch ( key ) {
			case 'date':
				return formatPreviewDate( record.date );
			default:
				return SAMPLE_VALUES[ key ];
		}
	};

	const enabledItems = items.filter( ( item ) => item.enabled );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Meta Items', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<p className="bpafb-help-text">
							{ __( 'Drag to reorder. Toggle to show or hide.', 'blockive-premium-addon-for-block' ) }
						</p>
						<ReorderableItemsList items={ items } onChange={ ( next ) => setAttributes( { items: next } ) } />
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Style', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<TextControl
							label={ __( 'Separator', 'blockive-premium-addon-for-block' ) }
							value={ separator }
							onChange={ ( value ) => setAttributes( { separator: value } ) }
						/>
						<ToggleControl
							label={ __( 'Show Icons', 'blockive-premium-addon-for-block' ) }
							checked={ !! showIcons }
							onChange={ ( value ) => setAttributes( { showIcons: value } ) }
						/>
						<SelectControl
							label={ __( 'Badge Style', 'blockive-premium-addon-for-block' ) }
							value={ badgeStyle }
							options={ [
								{ label: __( 'None', 'blockive-premium-addon-for-block' ), value: 'none' },
								{ label: __( 'Solid', 'blockive-premium-addon-for-block' ), value: 'solid' },
								{ label: __( 'Soft', 'blockive-premium-addon-for-block' ), value: 'soft' },
								{ label: __( 'Outline', 'blockive-premium-addon-for-block' ), value: 'outline' },
							] }
							onChange={ ( value ) => setAttributes( { badgeStyle: value } ) }
						/>
						{ badgeStyle !== 'none' && (
							<>
								<BaseControl label={ __( 'Badge Background Color', 'blockive-premium-addon-for-block' ) }>
									<ColorPalette
										value={ badgeBgColor }
										onChange={ ( value ) => setAttributes( { badgeBgColor: value } ) }
									/>
								</BaseControl>
								<BaseControl label={ __( 'Badge Text Color', 'blockive-premium-addon-for-block' ) }>
									<ColorPalette
										value={ badgeTextColor }
										onChange={ ( value ) => setAttributes( { badgeTextColor: value } ) }
									/>
								</BaseControl>
							</>
						) }
						<BaseControl label={ __( 'Link Hover Color', 'blockive-premium-addon-for-block' ) }>
							<ColorPalette
								value={ linkHoverColor }
								onChange={ ( value ) => setAttributes( { linkHoverColor: value } ) }
							/>
						</BaseControl>
						<p className="bpafb-help-text">
							{ __( 'Applies to any linked items (Categories, Tags) within this block.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				advanced={ <AdvancedTab attributes={ attributes } setAttributes={ setAttributes } /> }
			/>

			<div { ...blockProps }>
				{ enabledItems.map( ( item, index ) => (
					<Fragment key={ item.key }>
						{ index > 0 && separator && <span className="bpafb-tb-post-meta-sep">{ separator }</span> }
						<span
							className={ `bpafb-tb-post-meta-item${ badgeStyle !== 'none' ? ` bpafb-tb-post-meta-item--badge-${ badgeStyle }` : '' }` }
							style={ badgeStyle !== 'none' ? {
								'--bpafb-meta-badge-bg': badgeBgColor || undefined,
								'--bpafb-meta-badge-color': badgeTextColor || undefined,
							} : undefined }
						>
							{ showIcons && <i className={ ICONS[ item.key ] || 'fa-regular fa-circle' } /> }
							{ ' ' }
							{ previewValue( item.key ) }
						</span>
					</Fragment>
				) ) }
			</div>
		</>
	);
}
