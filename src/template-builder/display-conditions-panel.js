import { __, sprintf } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { PanelRow, SelectControl, TextControl, ToggleControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';

const TEMPLATE_POST_TYPE = window.bpafbTemplateBuilder?.postType || 'blockive_template';

// Mirrors Bpafb_Template_Display_Conditions::is_specific_scope_enabled() -
// the PHP side stays the single source of truth, this is only its
// localized copy.
const SPECIFIC_SCOPE_ENABLED = !! window.bpafbTemplateBuilder?.specificScopeEnabled;

const DisplayConditionsPanel = () => {
	const [ meta, setMeta ] = useEntityProp( 'postType', TEMPLATE_POST_TYPE, 'meta' );

	const targetPostType = meta?._bpafb_template_type || 'post';
	const scope = meta?._bpafb_display_condition_scope || 'all';
	const priority = Number.isFinite( meta?._bpafb_template_priority ) ? meta._bpafb_template_priority : 10;

	const targetPostTypeLabel = useSelect(
		( select ) => select( 'core' ).getPostType( targetPostType )?.labels?.name || targetPostType,
		[ targetPostType ]
	);

	return (
		<PluginDocumentSettingPanel
			name="bpafb-display-conditions"
			title={ __( 'Display Conditions', 'blockive-premium-addon-for-block' ) }
			className="bpafb-display-conditions-panel"
		>
			<PanelRow>
				<SelectControl
					label={ __( 'Apply this template to', 'blockive-premium-addon-for-block' ) }
					value={ scope }
					options={ [
						{
							label: sprintf(
								/* translators: %s: post type name, e.g. "Products". */
								__( 'All %s', 'blockive-premium-addon-for-block' ),
								targetPostTypeLabel
							),
							value: 'all',
						},
						{
							label: SPECIFIC_SCOPE_ENABLED
								? __( 'Specific posts', 'blockive-premium-addon-for-block' )
								: sprintf(
									/* translators: %s: "(Pro)" suffix marking this option as a Pro-only feature. */
									__( 'Specific posts %s', 'blockive-premium-addon-for-block' ),
									__( '(Pro)', 'blockive-premium-addon-for-block' )
								),
							value: 'specific',
							disabled: ! SPECIFIC_SCOPE_ENABLED,
						},
					] }
					onChange={ ( value ) => {
						// Disabled options can't be picked, but guard anyway so
						// the meta can never be set to "specific" from here.
						if ( 'specific' === value && ! SPECIFIC_SCOPE_ENABLED ) {
							return;
						}
						setMeta( { ...meta, _bpafb_display_condition_scope: value } );
					} }
				/>
			</PanelRow>

			<PanelRow>
				<TextControl
					type="number"
					label={ __( 'Priority', 'blockive-premium-addon-for-block' ) }
					value={ priority }
					onChange={ ( value ) => {
						const parsed = parseInt( value, 10 );
						setMeta( { ...meta, _bpafb_template_priority: Number.isNaN( parsed ) ? 10 : parsed } );
					} }
				/>
			</PanelRow>

			<PanelRow>
				<ToggleControl
					label={ __( 'Full width (no sidebar)', 'blockive-premium-addon-for-block' ) }
					checked={ !! meta?._bpafb_full_width }
					onChange={ ( value ) => setMeta( { ...meta, _bpafb_full_width: value } ) }
				/>
			</PanelRow>

			<PanelRow>
				<ToggleControl
					label={ __( "Hide theme's post title", 'blockive-premium-addon-for-block' ) }
					checked={ meta?._bpafb_hide_title !== false }
					onChange={ ( value ) => setMeta( { ...meta, _bpafb_hide_title: value } ) }
				/>
			</PanelRow>

			<PanelRow>
				<ToggleControl
					label={ __( "Hide theme's featured image", 'blockive-premium-addon-for-block' ) }
					checked={ meta?._bpafb_hide_featured_image !== false }
					onChange={ ( value ) => setMeta( { ...meta, _bpafb_hide_featured_image: value } ) }
				/>
			</PanelRow>

			<PanelRow>
				<ToggleControl
					label={ __( 'Hide comments', 'blockive-premium-addon-for-block' ) }
					checked={ !! meta?._bpafb_hide_comments }
					onChange={ ( value ) => setMeta( { ...meta, _bpafb_hide_comments: value } ) }
				/>
			</PanelRow>

			<PanelRow>
				<ToggleControl
					label={ __( 'Hide post navigation (previous/next)', 'blockive-premium-addon-for-block' ) }
					checked={ !! meta?._bpafb_hide_post_nav }
					onChange={ ( value ) => setMeta( { ...meta, _bpafb_hide_post_nav: value } ) }
				/>
			</PanelRow>
		</PluginDocumentSettingPanel>
	);
};

export default function registerDisplayConditionsPanel() {
	registerPlugin( 'bpafb-display-conditions', {
		render: DisplayConditionsPanel,
	} );
}
