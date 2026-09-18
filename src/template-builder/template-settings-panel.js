import { __, sprintf } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';

const TEMPLATE_POST_TYPE = window.bpafbTemplateBuilder?.postType || 'blockive_template';

// This is just a copy, sent from PHP, of
// Bpafb_Template_Post_Type::get_free_template_types(). The PHP side is
// what actually controls this on the live site. A Pro build changes the
// `bpafb_free_template_types` filter to return every viewable post type,
// which unlocks the options below on its own.
const FREE_POST_TYPES = window.bpafbTemplateBuilder?.freePostTypes || [ 'post', 'page' ];

export const isFreePostType = ( slug ) => FREE_POST_TYPES.includes( slug );

/**
 * Builds the list of post types a template can target, using the site's
 * real viewable post types. Each one is either open to use, or marked
 * "(Pro)", based on FREE_POST_TYPES. This is exported so Pro's own
 * Template Type panel can use the same list and the same rules (see
 * blockive-premium-addon-for-block-pro/src/template-builder-pro/template-kind-panel.js).
 *
 * @return {Array<{label: string, value: string, disabled?: boolean}>}
 */
export function usePostTypeOptions() {
	const postTypes = useSelect(
		( select ) =>
			select( 'core' )
				.getPostTypes( { per_page: -1 } )
				?.filter( ( postType ) => postType.viewable ) || [],
		[]
	);

	return postTypes.length
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
}

const TemplateSettingsPanel = () => {
	const [ meta, setMeta ] = useEntityProp( 'postType', TEMPLATE_POST_TYPE, 'meta' );

	const templateType = meta?._bpafb_template_type || 'post';
	const postTypeOptions = usePostTypeOptions();

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

