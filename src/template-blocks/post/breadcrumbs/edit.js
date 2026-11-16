import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';

import InspectorTabs from '../../../components/inspector-tabs';
import ColorStateControls from '../../../components/color-state-controls';
import usePreviewContext from '../../shared/use-preview-context';

export default function Edit( { attributes, setAttributes } ) {
	const { separator, showHomeIcon, homeIcon, textColor, textHoverColor } = attributes;

	const { record, isResolving } = usePreviewContext();

	const previewTitle = record?.title?.rendered
		? record.title.rendered.replace( /<[^>]+>/g, '' )
		: __( 'Sample Post Title', 'blockive-premium-addon-for-block' );

	const embeddedTerms = record?._embedded?.[ 'wp:term' ] || [];
	const previewCategory = embeddedTerms
		.flat()
		.find( ( term ) => term && term.taxonomy === 'category' );

	const trail = [
		{
			key: 'home',
			label: showHomeIcon ? null : __( 'Home', 'blockive-premium-addon-for-block' ),
			icon: showHomeIcon ? homeIcon : null,
		},
		...( previewCategory
			? [ { key: 'term', label: previewCategory.name } ]
			: [ { key: 'term', label: __( 'Category', 'blockive-premium-addon-for-block' ) } ] ),
		{ key: 'current', label: previewTitle, current: true },
	];

	const blockProps = useBlockProps( {
		className: 'bpafb-tb-breadcrumbs',
		style: { color: textColor || undefined },
	} );

	return (
		<>
			<InspectorTabs
				general={
					<PanelBody title={ __( 'Settings', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<TextControl
							label={ __( 'Separator', 'blockive-premium-addon-for-block' ) }
							value={ separator }
							onChange={ ( value ) => setAttributes( { separator: value } ) }
						/>
						<ToggleControl
							label={ __( 'Show Home Icon', 'blockive-premium-addon-for-block' ) }
							checked={ !! showHomeIcon }
							onChange={ ( value ) => setAttributes( { showHomeIcon: value } ) }
						/>
						{ showHomeIcon && (
							<TextControl
								label={ __( 'Home Icon (Font Awesome class)', 'blockive-premium-addon-for-block' ) }
								value={ homeIcon }
								onChange={ ( value ) => setAttributes( { homeIcon: value } ) }
								help={ __( 'e.g. fa-solid fa-house', 'blockive-premium-addon-for-block' ) }
							/>
						) }
					</PanelBody>
				}
				style={
					<PanelBody title={ __( 'Colors', 'blockive-premium-addon-for-block' ) } initialOpen={ true }>
						<ColorStateControls
							normal={ [
								{
									label: __( 'Link Color', 'blockive-premium-addon-for-block' ),
									value: textColor,
									onChange: ( value ) => setAttributes( { textColor: value } ),
								},
							] }
							hover={ [
								{
									label: __( 'Link Color', 'blockive-premium-addon-for-block' ),
									value: textHoverColor,
									onChange: ( value ) => setAttributes( { textHoverColor: value } ),
								},
							] }
						/>
						<p className="bpafb-help-text">
							{ __( 'Font, size, weight and other typography options are available in the native Styles panel above.', 'blockive-premium-addon-for-block' ) }
						</p>
					</PanelBody>
				}
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>

			<nav { ...blockProps } aria-label={ __( 'Breadcrumb', 'blockive-premium-addon-for-block' ) }>
				{ isResolving && ! record
					? __( 'Loading…', 'blockive-premium-addon-for-block' )
					: trail.map( ( item, index ) => (
							<span className="bpafb-tb-breadcrumb-item" key={ item.key }>
								{ index > 0 && <span className="bpafb-tb-breadcrumb-sep">{ separator }</span> }
								{ item.current ? (
									<span className="bpafb-tb-breadcrumb-current">{ item.label }</span>
								) : (
									<a href="#breadcrumb-preview" onClick={ ( event ) => event.preventDefault() }>
										{ item.icon && <i className={ item.icon } /> }
										{ item.label }
									</a>
								) }
							</span>
					  ) ) }
			</nav>
		</>
	);
}
