import { useSelect } from '@wordpress/data';

/**
 * Gives Template Blocks something real to preview with, in the editor.
 *
 * While editing a `blockive_template`, there is no real post being shown,
 * so each Template Block needs a stand-in post to preview. This gets the
 * newest published post of the given type. If `record` comes back null,
 * the block should show plain placeholder text instead.
 *
 * @param {string} [forcedPostType] Post type to preview. Defaults to the
 *                                  template's own set type, or 'post'.
 * @return {{ postType: string, record: Object|null, isResolving: boolean }}
 */
export default function usePreviewContext( forcedPostType ) {
	return useSelect(
		( select ) => {
			const editor = select( 'core/editor' );
			const templateMeta = editor ? editor.getEditedPostAttribute( 'meta' ) : undefined;
			const postType = forcedPostType || templateMeta?._bpafb_template_type || 'post';

			const query = {
				per_page: 1,
				orderby: 'date',
				order: 'desc',
				status: 'publish',
				_embed: true,
			};

			const records = select( 'core' ).getEntityRecords( 'postType', postType, query );
			const isResolving = select( 'core' ).isResolving( 'getEntityRecords', [
				'postType',
				postType,
				query,
			] );

			return {
				postType,
				record: records && records.length ? records[ 0 ] : null,
				isResolving: !! isResolving,
			};
		},
		[ forcedPostType ]
	);
}

/**
 * Gets the featured image URL, at the given size (or the full size if that
 * one is not found), from a preview record's `wp:featuredmedia` data. This
 * is the same shape the REST API returns with `_embed: true`.
 *
 * @param {Object|null} record Entity record fetched with `_embed: true`.
 * @param {string}      [size] Preferred image size key, e.g. 'medium'.
 * @return {string|null}
 */
export function getEmbeddedFeaturedImageUrl( record, size = 'full' ) {
	const media = record?._embedded?.[ 'wp:featuredmedia' ]?.[ 0 ];
	if ( ! media ) {
		return null;
	}
	return (
		media.media_details?.sizes?.[ size ]?.source_url ||
		media.source_url ||
		null
	);
}

/**
 * Gets the author's display name from a preview record.
 *
 * @param {Object|null} record Entity record fetched with `_embed: true`.
 * @return {string|null}
 */
export function getEmbeddedAuthorName( record ) {
	return record?._embedded?.author?.[ 0 ]?.name || null;
}
