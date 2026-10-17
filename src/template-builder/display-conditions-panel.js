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

	const kind = meta?._bpafb_template_kind || 'single';
	const isSingle = 'single' === kind;

	const targetPostType = meta?._bpafb_template_type || 'post';
	const scope = meta?._bpafb_display_condition_scope || 'all';
	const priority = Number.isFinite( meta?._bpafb_template_priority ) ? meta._bpafb_template_priority : 10;

	const targetPostTypeLabel = useSelect(
		( select ) => select( 'core' ).getPostType( targetPostType )?.labels?.name || targetPostType,
		[ targetPostType ]
	);

	// Header and Footer always apply site-wide in the free version (no
	// per-page conditions to pick), so this panel only shows them a plain
	// notice plus the same Priority tiebreaker the single-post override
	// already uses, in case more than one Header or Footer gets published
	// at once. Pro's own Display Conditions panel (with a full rule list -
	// Archive/Search/404/User Role/etc.) replaces this panel entirely for
	// every kind; see template-kind-panel.js in the Pro plugin.
	if ( ! isSingle ) {
		return (
			<PluginDocumentSettingPanel
				name="bpafb-display-conditions"
				title={ __( 'Display Conditions', 'blockive-premium-addon-for-block' ) }
				className="bpafb-display-conditions-panel"
			>
				<PanelRow>
					<p>
						{ 'header' === kind
							? __( 'This Header shows on every page of the site once published.', 'blockive-premium-addon-for-block' )
							: __( 'This Footer shows on every page of the site once published.', 'blockive-premium-addon-for-block' ) }
					</p>
				</PanelRow>
				<PanelRow>
					<TextControl
						type="number"
						label={ __( 'Priority', 'blockive-premium-addon-for-block' ) }
						help={ __( 'If more than one is published, the lower priority number wins.', 'blockive-premium-addon-for-block' ) }
						value={ priority }
						onChange={ ( value ) => {
							const parsed = parseInt( value, 10 );
							setMeta( { ...meta, _bpafb_template_priority: Number.isNaN( parsed ) ? 10 : parsed } );
						} }
					/>
				</PanelRow>
			</PluginDocumentSettingPanel>
		);
	}

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
						...( SPECIFIC_SCOPE_ENABLED
							? [ { label: __( 'Specific posts', 'blockive-premium-addon-for-block' ), value: 'specific' } ]
							: [] ),
					] }
					onChange={ ( value ) => {
						// "specific" isn't offered as an option at all when
						// disabled, but guard anyway so the meta can never be
						// set to it from here.
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
