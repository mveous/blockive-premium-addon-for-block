import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	BlockControls,
	AlignmentControl,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl, RangeControl, ToggleControl, BaseControl, ColorPalette } from '@wordpress/components';
import { RawHTML } from '@wordpress/element';

import InspectorTabs from '../../../components/inspector-tabs';
import SegmentedControl from '../../../components/segmented-control';
import usePreviewContext from '../../shared/use-preview-context';

export default function Edit( { attributes, setAttributes } ) {
	const { displayMode, maxWidth, dropCap, textAlign, linkHoverColor } = attributes;

	const { record, isResolving } = usePreviewContext();

	let previewHtml;

	if ( displayMode === 'excerpt' ) {
		const rawExcerpt = record?.excerpt?.rendered
			? record.excerpt.rendered.replace( /<[^>]+>/g, ' ' ).replace( /\s+/g, ' ' ).trim()
			: '';
		const placeholder = __(
			'This is a sample excerpt. A short summary of the post content will be displayed here.',
			'blockive-premium-addon-for-block'
		);
		previewHtml = `<p>${ rawExcerpt || ( ! isResolving ? placeholder : '' ) }</p>`;
	} else {
		const rawHtml = record?.content?.rendered || '';
		const placeholderHtml = `<p>${ __(
			'This is sample post content. The full post content will be displayed here dynamically when this template is used on a real post.',
			'blockive-premium-addon-for-block'
		) }</p>`;
		previewHtml = rawHtml || ( ! isResolving ? placeholderHtml : '' );
	}

	const blockProps = useBlockProps( {
		className: `bpafb-tb-post-content${ dropCap ? ' bpafb-has-drop-cap' : '' }`,
		style: {
			textAlign: textAlign || undefined,
			maxWidth: maxWidth ? `${ maxWidth }px` : undefined,
		},
	} );

	return (
		<>
			<BlockControls>
				<AlignmentControl
					value={ textAlign }
					onChange={ ( value ) => setAttributes( { textAlign: value } ) }
				/>
			</BlockControls>

			<InspectorTabs
				general={
					<PanelBody title={ __( 'Content', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<SegmentedControl
							label={ __( 'Display', 'blockive-premium-addon-for-block' ) }
							value={ displayMode }
							options={ [
								{ label: __( 'Full Content', 'blockive-premium-addon-for-block' ), value: 'full' },
								{ label: __( 'Excerpt', 'blockive-premium-addon-for-block' ), value: 'excerpt' },
							] }
							onChange={ ( value ) => setAttributes( { displayMode: value } ) }
						/>
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Style', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<RangeControl
							label={ __( 'Max Width (px, 0 = none)', 'blockive-premium-addon-for-block' ) }
							value={ maxWidth }
							onChange={ ( value ) => setAttributes( { maxWidth: value } ) }
							min={ 0 }
							max={ 1600 }
						/>
						<ToggleControl
							label={ __( 'Drop Cap', 'blockive-premium-addon-for-block' ) }
							checked={ !! dropCap }
							onChange={ ( value ) => setAttributes( { dropCap: value } ) }
						/>
						<BaseControl label={ __( 'Link Hover Color', 'blockive-premium-addon-for-block' ) }>
							<ColorPalette
								value={ linkHoverColor }
								onChange={ ( value ) => setAttributes( { linkHoverColor: value } ) }
							/>
						</BaseControl>
						<p className="bpafb-help-text">
							{ __( 'Font, size, weight, color and other typography options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<div { ...blockProps }>
				<RawHTML>{ previewHtml }</RawHTML>
			</div>
		</>
	);
}
