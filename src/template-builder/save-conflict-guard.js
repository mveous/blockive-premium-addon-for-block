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
	// _bpafb_template_kind marks a template as a single post/page content
	// override ("single", the default), or as a Header/Footer shown
	// site-wide (see Bpafb_Template_Kinds). Pro adds further kinds
	// (archive/search/404/popup/etc. - see Bpafb_Pro_Template_Kinds) that
	// this guard still has no reason to flag, since those go through
	// Display Conditions rules instead of one implicit "applies everywhere"
	// state.
	const kind = meta?._bpafb_template_kind || 'single';
	const isHeaderOrFooter = 'header' === kind || 'footer' === kind;

	const targetPostTypeLabel = useSelect(
		( select ) => select( 'core' ).getPostType( targetPostType )?.labels?.name || targetPostType,
		[ targetPostType ]
	);

	const conflictingTemplate = useSelect(
		( select ) => {
			if ( ! isHeaderOrFooter && ( scope !== 'all' || kind !== 'single' ) ) {
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
			if ( isHeaderOrFooter ) {
				// Header and Footer always apply site-wide (see
				// Bpafb_Template_Kinds::get_matching_template_id()), so any
				// other published template of the same kind is a conflict,
				// regardless of its Template Type/scope fields - those don't
				// apply to this kind and are never changed from their
				// defaults.
				return records.find( ( record ) => ( record.meta?._bpafb_template_kind || 'single' ) === kind ) || null;
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
		[ scope, kind, isHeaderOrFooter, targetPostType, currentPostId ]
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
				{ isHeaderOrFooter
					? sprintf(
						/* translators: 1: "Header" or "Footer". 2: title of the existing conflicting template. */
						__(
							'You already have a %1$s template ("%2$s") published. If you save this template, it will become the active %1$s and "%2$s" will be moved to Draft.',
							'blockive-premium-addon-for-block'
						),
						'header' === kind
							? __( 'Header', 'blockive-premium-addon-for-block' )
							: __( 'Footer', 'blockive-premium-addon-for-block' ),
						getRecordTitle( conflictingTemplate )
					)
					: sprintf(
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
