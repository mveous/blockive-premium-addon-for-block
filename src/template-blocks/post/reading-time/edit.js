import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import usePreviewContext from '../../shared/use-preview-context';

const SAMPLE_WORD_COUNT = 850;

function stripTags( html ) {
	return ( html || '' ).replace( /<[^>]+>/g, ' ' );
}

function countWords( text ) {
	const trimmed = text.trim();
	return trimmed ? trimmed.split( /\s+/ ).length : 0;
}

export default function Edit( { attributes, setAttributes } ) {
	const { wpm, icon, prefix, suffix } = attributes;

	const { record, isResolving } = usePreviewContext();

	const wordCount = record?.content?.rendered
		? countWords( stripTags( record.content.rendered ) )
		: SAMPLE_WORD_COUNT;

	const minutes = Math.max( 1, Math.ceil( wordCount / ( wpm || 200 ) ) );

	const blockProps = useBlockProps( { className: 'bpafb-tb-reading-time' } );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<RangeControl
							label={ __( 'Words Per Minute', 'blockive-premium-addon-for-block' ) }
							value={ wpm }
							onChange={ ( value ) => setAttributes( { wpm: value } ) }
							min={ 50 }
							max={ 500 }
						/>
						<TextControl
							label={ __( 'Icon (Font Awesome class)', 'blockive-premium-addon-for-block' ) }
							value={ icon }
							onChange={ ( value ) => setAttributes( { icon: value } ) }
							help={ __( 'e.g. fa-regular fa-clock', 'blockive-premium-addon-for-block' ) }
						/>
						<TextControl
							label={ __( 'Prefix', 'blockive-premium-addon-for-block' ) }
							value={ prefix }
							onChange={ ( value ) => setAttributes( { prefix: value } ) }
						/>
						<TextControl
							label={ __( 'Suffix', 'blockive-premium-addon-for-block' ) }
							value={ suffix }
							onChange={ ( value ) => setAttributes( { suffix: value } ) }
						/>
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<p className="bpafb-help-text">
							{ __( 'Text and typography options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<span { ...blockProps }>
				{ isResolving && ! record
					? __( 'Loading…', 'blockive-premium-addon-for-block' )
					: (
						<>
							{ icon && <i className={ icon } /> }
							{ ' ' }
							{ prefix }
							{ minutes }
							{ suffix }
						</>
					) }
			</span>
		</>
	);
}
