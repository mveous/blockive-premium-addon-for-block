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

// Where this template shows. "single" is the free plugin's original,
// implicit kind: a single post/page content override, configured the rest
// of this panel plus Display Conditions below. "header" and "footer" are
// simpler: once published, they show everywhere on the site, in their own
// <header>/<footer> element (see Bpafb_Template_Kinds /
// Bpafb_Template_Theme_Locations) - no post type or per-page condition to
// set. Pro's own, richer Template Type panel (with Archive/Search/404/
// Popup/etc. on top of these same two) replaces this control entirely; see
// blockive-premium-addon-for-block-pro/src/template-builder-pro/template-kind-panel.js.
const KIND_OPTIONS = [
	{ label: __( 'Single Post/Page', 'blockive-premium-addon-for-block' ), value: 'single' },
	{ label: __( 'Header', 'blockive-premium-addon-for-block' ), value: 'header' },
	{ label: __( 'Footer', 'blockive-premium-addon-for-block' ), value: 'footer' },
];

const TemplateSettingsPanel = () => {
	const [ meta, setMeta ] = useEntityProp( 'postType', TEMPLATE_POST_TYPE, 'meta' );

	const kind = meta?._bpafb_template_kind || 'single';
	const isSingle = 'single' === kind;

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
					label={ __( 'Template Location', 'blockive-premium-addon-for-block' ) }
					help={ isSingle
						? __( "Replaces a single post or page's own content.", 'blockive-premium-addon-for-block' )
						: __( 'Shows everywhere on the site, in its own header/footer element, once published.', 'blockive-premium-addon-for-block' ) }
					value={ kind }
					options={ KIND_OPTIONS }
					onChange={ ( value ) => setMeta( { ...meta, _bpafb_template_kind: value } ) }
				/>
			</PanelRow>

			{ isSingle && (
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
			) }
		</PluginDocumentSettingPanel>
	);
};

export default function registerTemplateSettingsPanel() {
	registerPlugin( 'bpafb-template-settings', {
		render: TemplateSettingsPanel,
	} );
}

