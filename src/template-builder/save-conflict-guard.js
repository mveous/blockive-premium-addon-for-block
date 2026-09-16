import { __, sprintf } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { Modal, Button } from '@wordpress/components';
import { useSelect, useDispatch, select as selectData } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { useEffect, useState } from '@wordpress/element';

const TEMPLATE_POST_TYPE = window.bpafbTemplateBuilder?.postType || 'blockive_template';

/**
 * Classname of the button that actually performs the save - shared by the
 * "Publish" button inside the pre-publish flyout and the "Update" button
 * shown once a template is already published, so intercepting clicks on it
 * covers both the first publish and every later update.
 */
const PUBLISH_BUTTON_SELECTOR = '.editor-post-publish-button__button';

const getRecordTitle = ( record ) => {
	if ( ! record ) {
		return '';
	}
	if ( typeof record.title === 'string' ) {
		return record.title;
	}
	if ( record.title && typeof record.title === 'object' ) {
		return record.title.rendered || record.title.raw || '';
	}
	return '';
};

const SaveConflictGuard = () => {
	const [ meta ] = useEntityProp( 'postType', TEMPLATE_POST_TYPE, 'meta' );
	const { editPost, savePost } = useDispatch( 'core/editor' );
	const { saveEntityRecord } = useDispatch( 'core' );

	const [ isConfirmOpen, setIsConfirmOpen ] = useState( false );
	const [ isSaving, setIsSaving ] = useState( false );

	const currentPostId = useSelect( ( select ) => select( 'core/editor' ).getCurrentPostId(), [] );
	const targetPostType = meta?._bpafb_template_type || 'post';
	const scope = meta?._bpafb_display_condition_scope || 'all';
	// _bpafb_template_kind is a Pro-only meta key (see Bpafb_Pro_Template_Kinds
	// in the Pro plugin) marking a template for a header/footer/archive/etc.
	// location instead of this "single post/page content override" concept -
	// absent here entirely (free version, or a template never touched by the
	// Pro Kind control) always means "single". This guard's whole premise -
	// "all Posts" vs. "all Posts" - only makes sense between two single-kind
	// templates; a Header-kind template left at the default Template Type/
	// scope values (never having a reason to change fields that don't apply
	// to it) must never be treated as conflicting with an actual single-kind
	// template, on either side of the comparison below.
	const kind = meta?._bpafb_template_kind || 'single';

	const targetPostTypeLabel = useSelect(
		( select ) => select( 'core' ).getPostType( targetPostType )?.labels?.name || targetPostType,
		[ targetPostType ]
	);

	const conflictingTemplate = useSelect(
		( select ) => {
			if ( scope !== 'all' || kind !== 'single' ) {
				return null;
			}
			const records = select( 'core' ).getEntityRecords( 'postType', TEMPLATE_POST_TYPE, {
				status: 'publish',
				per_page: -1,
				exclude: [ currentPostId ],
				context: 'view',
			} );
			if ( ! records ) {
				return null;
			}
			return (
				records.find(
					( record ) =>
						( record.meta?._bpafb_template_type || 'post' ) === targetPostType &&
						( record.meta?._bpafb_display_condition_scope || 'all' ) === 'all' &&
						( record.meta?._bpafb_template_kind || 'single' ) === 'single'
				) || null
			);
		},
		[ scope, kind, targetPostType, currentPostId ]
	);

	useEffect( () => {
		const handleClick = ( event ) => {
			if ( ! conflictingTemplate ) {
				return;
			}
			if ( ! event.target.closest( PUBLISH_BUTTON_SELECTOR ) ) {
				return;
			}
			event.preventDefault();
			event.stopImmediatePropagation();
			setIsConfirmOpen( true );
		};

		document.addEventListener( 'click', handleClick, true );
		return () => document.removeEventListener( 'click', handleClick, true );
	}, [ conflictingTemplate ] );

	if ( ! isConfirmOpen ) {
		return null;
	}

	const handleCancel = () => {
		if ( isSaving ) {
			return;
		}
		setIsConfirmOpen( false );
	};

	const handleConfirm = async () => {
		setIsSaving( true );
		try {
			// Save the current template first - only demote the previous one
			// once we know this save actually succeeded, so a failed/blocked
			// save (e.g. Gutenberg refuses to save an empty, untitled post)
			// never leaves the post type with no active template at all.
			await editPost( { status: 'publish' } );
			await savePost();

			const saveSucceeded = selectData( 'core/editor' ).didPostSaveRequestSucceed();

			if ( saveSucceeded && conflictingTemplate ) {
				await saveEntityRecord( 'postType', TEMPLATE_POST_TYPE, {
					id: conflictingTemplate.id,
					status: 'draft',
				} );
			}
		} finally {
			setIsSaving( false );
			setIsConfirmOpen( false );
		}
	};

	return (
		<Modal
			title={ __( 'Replace the existing template?', 'blockive-premium-addon-for-block' ) }
			onRequestClose={ handleCancel }
			className="bpafb-template-conflict-modal"
		>
			<p>
				{ sprintf(
					/* translators: 1: post type name, e.g. "Posts". 2: title of the existing conflicting template. */
					__(
						'You already have a template ("%2$s") applied to all %1$s. If you save this template, it will become the active one and "%2$s" will be moved to Draft.',
						'blockive-premium-addon-for-block'
					),
					targetPostTypeLabel,
					getRecordTitle( conflictingTemplate )
				) }
			</p>
			<div className="bpafb-template-conflict-modal__actions">
				<Button variant="tertiary" onClick={ handleCancel } disabled={ isSaving }>
					{ __( 'Cancel', 'blockive-premium-addon-for-block' ) }
				</Button>
				<Button variant="primary" onClick={ handleConfirm } isBusy={ isSaving } disabled={ isSaving }>
					{ __( 'Save & Move Previous to Draft', 'blockive-premium-addon-for-block' ) }
				</Button>
			</div>
		</Modal>
	);
};

export default function registerSaveConflictGuard() {
	registerPlugin( 'bpafb-template-save-conflict-guard', {
		render: SaveConflictGuard,
	} );
}
