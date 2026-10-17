import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { Modal, Button, SelectControl, TextControl } from '@wordpress/components';
import { select as selectData } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { useState } from '@wordpress/element';
import { KIND_OPTIONS } from './template-settings-panel';

const TEMPLATE_POST_TYPE = window.bpafbTemplateBuilder?.postType || 'blockive_template';

// Short blurbs shown under the Template Location select, keyed by
// KIND_OPTIONS' own values.
const KIND_DESCRIPTIONS = {
	single: __( 'Overrides a single post or page\'s own content.', 'blockive-premium-addon-for-block' ),
	header: __( 'Replaces the theme\'s header on the site.', 'blockive-premium-addon-for-block' ),
	footer: __( 'Replaces the theme\'s footer on the site.', 'blockive-premium-addon-for-block' ),
};

/**
 * Asks for a name and which kind of template is being made (Single Post/
 * Page, Header, or Footer) as soon as a brand-new Blockive Template is
 * opened, instead of leaving it untitled and defaulted to "Single Post/
 * Page" until the user happens to notice the sidebar panel. Both fields are
 * kept in local state, not written to the title / meta directly, until
 * "Create Template" is pressed - so Skip or closing the modal (the X
 * button, Escape) leaves the new template exactly as it was, with nothing
 * typed here saved.
 *
 * Whether the modal should open at all is decided once, from a plain
 * `select()` read at mount, rather than a `useSelect()` subscription -
 * writing the staged values on Create edits the post, which would
 * immediately flip `isCleanNewPost()` to false if that read stayed
 * reactive, closing the modal (or worse, reopening it) out from under the
 * user.
 *
 * Pro replaces this control entirely with its own version covering every
 * kind (Archive/Search/404/Popup/etc. on top of these same three); see
 * template-kind-picker-modal.js in the Pro plugin.
 */
const TemplateKindPickerModal = () => {
	const [ isOpen ] = useState( () => {
		const editor = selectData( 'core/editor' );
		return editor.getCurrentPostType() === TEMPLATE_POST_TYPE && editor.isCleanNewPost();
	} );
	const [ isDismissed, setIsDismissed ] = useState( false );

	const [ title, setTitle ] = useState( '' );
	const [ kind, setKind ] = useState( 'single' );

	const [ , setEntityTitle ] = useEntityProp( 'postType', TEMPLATE_POST_TYPE, 'title' );
	const [ meta, setMeta ] = useEntityProp( 'postType', TEMPLATE_POST_TYPE, 'meta' );

	if ( ! isOpen || isDismissed ) {
		return null;
	}

	const handleCreate = () => {
		setEntityTitle( title );
		setMeta( { ...meta, _bpafb_template_kind: kind } );
		setIsDismissed( true );
	};

	return (
		<Modal
			title={ __( 'Create a New Template', 'blockive-premium-addon-for-block' ) }
			onRequestClose={ () => setIsDismissed( true ) }
			className="bpafb-template-kind-picker-modal"
			shouldCloseOnClickOutside={ false }
		>
			<TextControl
				label={ __( 'Template Name', 'blockive-premium-addon-for-block' ) }
				value={ title }
				onChange={ setTitle }
				placeholder={ __( 'E.g. Main Header', 'blockive-premium-addon-for-block' ) }
			/>
			<SelectControl
				label={ __( 'Template Location', 'blockive-premium-addon-for-block' ) }
				value={ kind }
				options={ KIND_OPTIONS }
				help={ KIND_DESCRIPTIONS[ kind ] }
				onChange={ setKind }
			/>
			<div className="bpafb-template-kind-picker-modal__actions">
				<Button variant="tertiary" onClick={ () => setIsDismissed( true ) }>
					{ __( 'Skip', 'blockive-premium-addon-for-block' ) }
				</Button>
				<Button variant="primary" onClick={ handleCreate } disabled={ ! title.trim() }>
					{ __( 'Create Template', 'blockive-premium-addon-for-block' ) }
				</Button>
			</div>
		</Modal>
	);
};

export default function registerTemplateKindPickerModal() {
	registerPlugin( 'bpafb-template-kind-picker', {
		render: TemplateKindPickerModal,
	} );
}
