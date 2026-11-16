import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, BaseControl, ColorPalette } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import usePreviewContext from '../../shared/use-preview-context';

const SAMPLE_COUNT = 5;

/**
 * Mirrors the render.php formatting logic: replaces the {count} token and,
 * for the default-shaped format, swaps the plural "Comments" word for the
 * singular "Comment" when the count is 1.
 */
function formatCommentsLabel( format, count ) {
	let label = format || '{count} Comments';
	if ( count === 1 ) {
		label = label.replace( /\bComments\b/i, __( 'Comment', 'blockive-premium-addon-for-block' ) );
	}
	return label.replace( '{count}', count );
}

export default function Edit( { attributes, setAttributes } ) {
	const { icon, format, isLink, textHoverColor } = attributes;

	const { isResolving } = usePreviewContext();

	const blockProps = useBlockProps( { className: 'bpafb-tb-comments-count' } );

	const label = formatCommentsLabel( format, SAMPLE_COUNT );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<TextControl
							label={ __( 'Icon (Font Awesome class)', 'blockive-premium-addon-for-block' ) }
							value={ icon }
							onChange={ ( value ) => setAttributes( { icon: value } ) }
							help={ __( 'e.g. fa-regular fa-comment', 'blockive-premium-addon-for-block' ) }
						/>
						<TextControl
							label={ __( 'Text Format', 'blockive-premium-addon-for-block' ) }
							value={ format }
							onChange={ ( value ) => setAttributes( { format: value } ) }
							help={ __( 'Use {count} as a placeholder for the comment count.', 'blockive-premium-addon-for-block' ) }
						/>
						<ToggleControl
							label={ __( 'Link to Comments', 'blockive-premium-addon-for-block' ) }
							checked={ !! isLink }
							onChange={ ( value ) => setAttributes( { isLink: value } ) }
						/>
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<BaseControl label={ __( 'Link Hover Color', 'blockive-premium-addon-for-block' ) }>
							<ColorPalette
								value={ textHoverColor }
								onChange={ ( value ) => setAttributes( { textHoverColor: value } ) }
							/>
						</BaseControl>
						<p className="bpafb-help-text">
							{ __( 'Text and typography options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<span { ...blockProps }>
				{ isResolving ? (
					__( 'Loading…', 'blockive-premium-addon-for-block' )
				) : (
					<a href="#comments-preview" onClick={ ( event ) => event.preventDefault() } className={ isLink ? '' : 'bpafb-tb-comments-count-nolink' }>
						{ icon && <i className={ icon } /> } { label }
					</a>
				) }
			</span>
		</>
	);
}
