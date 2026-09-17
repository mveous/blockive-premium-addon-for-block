import { __, sprintf } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';

const TEMPLATE_POST_TYPE = window.bpafbTemplateBuilder?.postType || 'blockive_template';

// Mirrors Bpafb_Template_Post_Type::get_free_template_types() - the PHP
// side stays the single source of truth (it's what the frontend renderer
// actually enforces), this is only its localized copy. A Pro build flips
// the underlying `bpafb_free_template_types` filter to return every
// viewable post type, which unlocks the options below automatically.
const FREE_POST_TYPES = window.bpafbTemplateBuilder?.freePostTypes || [ 'post', 'page' ];

const isFreePostType = ( slug ) => FREE_POST_TYPES.includes( slug );

const TemplateSettingsPanel = () => {
	const [ meta, setMeta ] = useEntityProp( 'postType', TEMPLATE_POST_TYPE, 'meta' );

	const templateType = meta?._bpafb_template_type || 'post';

	// Built from the site's actual viewable post types (not a hardcoded
	// Post/Page/"Custom Post Type" placeholder) so every real post type -
	// WooCommerce products, event CPTs, anything a theme or plugin
	// registers - shows up by name, available or "(Pro)" depending on
	// whether it's in FREE_POST_TYPES.
	const postTypes = useSelect(
		( select ) =>
			select( 'core' )
				.getPostTypes( { per_page: -1 } )
				?.filter( ( postType ) => postType.viewable ) || [],
		[]
	);

	const postTypeOptions = postTypes.length
		? postTypes.map( ( postType ) => {
				const free = isFreePostType( postType.slug );
				return {
					label: free
						? postType.name
						: sprintf(
							/* translators: %s: post type name, e.g. "Products". */
							__( '%s (Pro)', 'blockive-premium-addon-for-block' ),
							postType.name
						),
					value: postType.slug,
					disabled: ! free,
				};
		  } )
		: [
				{ label: __( 'Post', 'blockive-premium-addon-for-block' ), value: 'post' },
				{ label: __( 'Page', 'blockive-premium-addon-for-block' ), value: 'page' },
		  ];

	return (
		<PluginDocumentSettingPanel
			name="bpafb-template-settings"
			title={ __( 'Template Settings', 'blockive-premium-addon-for-block' ) }
			className="bpafb-template-settings-panel"
		>
			<PanelRow>
				<SelectControl
					label={ __( 'Template Type', 'blockive-premium-addon-for-block' ) }
					help={ __(
						'The post type this template is designed for. Template Blocks use it to source live preview data and to know which dynamic fields apply. The free version supports Post and Page templates.',
						'blockive-premium-addon-for-block'
					) }
					value={ templateType }
					options={ postTypeOptions }
					onChange={ ( value ) => {
						if ( ! isFreePostType( value ) ) {
							return;
						}
						setMeta( { ...meta, _bpafb_template_type: value } );
					} }
				/>
			</PanelRow>
		</PluginDocumentSettingPanel>
	);
};

export default function registerTemplateSettingsPanel() {
	registerPlugin( 'bpafb-template-settings', {
		render: TemplateSettingsPanel,
	} );
}

