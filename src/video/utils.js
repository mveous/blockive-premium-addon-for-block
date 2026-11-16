import { getSafeUrl } from '../utils/safe-url';

const ALLOWED_PROTOCOLS = [ 'http:', 'https:' ];

/**
 * Returns the given URL if it uses a safe protocol (http, https) or is a
 * relative URL. Returns an empty string for any other scheme (e.g.
 * javascript:, data:, vbscript:). Video sources are always either a Media
 * Library URL or a relative path, so mailto:/tel: are intentionally not
 * allowed here (unlike the link-URL variant of this helper used elsewhere).
 *
 * @param {string} url The URL to check.
 */
export function getSafeVideoUrl( url ) {
	return getSafeUrl( url, { allowedProtocols: ALLOWED_PROTOCOLS, allowAnchor: false } );
}
