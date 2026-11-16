import { getSafeUrl } from '../utils/safe-url';

/**
 * Returns the given URL if it uses a safe protocol (http, https, mailto, tel),
 * is a relative URL, or is an in-page anchor. Returns an empty string for any
 * other scheme (e.g. javascript:, data:, vbscript:).
 */
export function getSafeSocialIconsUrl( url ) {
	return getSafeUrl( url );
}
