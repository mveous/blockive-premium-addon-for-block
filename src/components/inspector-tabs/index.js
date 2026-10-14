import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { TabPanel } from '@wordpress/components';

import Accordion from '../accordion';
import { AdvancedSettingsSection, AdvancedStyleSection, useClaimBpafbUid } from '../advanced-tab';

const TABS = [
	{ name: 'general', title: __( 'General', 'blockive-premium-addon-for-block' ), className: 'bpafb-inspector-tab-general' },
	{ name: 'style', title: __( 'Style', 'blockive-premium-addon-for-block' ), className: 'bpafb-inspector-tab-style' },
	{ name: 'advanced', title: __( 'Advanced', 'blockive-premium-addon-for-block' ), className: 'bpafb-inspector-tab-advanced' },
];

/**
 * Blockive's own inspector sidebar: a single custom General / Style /
 * Advanced tab bar nested inside WordPress's native Settings tab (see
 * CLAUDE.md's "Inspector UI" section for why this replaced the previous
 * native-Settings/Styles-only structure). Every block in both plugins
 * renders its sidebar through this one component, so this is the single
 * place that shell lives.
 *
 * `general` and `style` are each a block's own PanelBody list (unchanged
 * from before); the shared Advanced control set is now rendered directly
 * here instead of being passed in by the caller.
 */
export default function InspectorTabs( { general, style, attributes, setAttributes } ) {
	useClaimBpafbUid( attributes, setAttributes );

	return (
		<InspectorControls>
			<div className="bpafb-inspector">
				<TabPanel className="bpafb-inspector-tabs" tabs={ TABS }>
					{ ( tab ) => {
						if ( tab.name === 'general' ) {
							return <Accordion>{ general }</Accordion>;
						}
						if ( tab.name === 'style' ) {
							return (
								<Accordion>
									{ style }
									{ style && (
										<p className="bpafb-inspector-section-label">
											{ __( 'Wrapper', 'blockive-premium-addon-for-block' ) }
										</p>
									) }
									{ /* Called directly, not as <AdvancedStyleSection/>: both
									   sections are plain, hook-free functions, and Accordion
									   needs their actual rendered PanelBody tree to coordinate
									   open state -- a JSX element for an unrendered component
									   is opaque until React itself renders it. */ }
									{ AdvancedStyleSection( { attributes, setAttributes } ) }
								</Accordion>
							);
						}
						return (
							<Accordion>
								{ AdvancedSettingsSection( { attributes, setAttributes } ) }
							</Accordion>
						);
					} }
				</TabPanel>
			</div>
		</InspectorControls>
	);
}
