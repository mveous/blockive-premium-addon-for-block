const DEFAULT_ALLOWED_PROTOCOLS = [ 'http:', 'https:', 'mailto:', 'tel:' ];

/**
 * Returns the given URL if it uses an allowed protocol, is a relative URL,
 * or (when allowAnchor is true) is an in-page anchor. Returns an empty
 * string for any other scheme (e.g. javascript:, data:, vbscript:).
 *
 * Shared by every block that accepts a user-entered link/media URL, so a
 * future change to the allowlist only needs to be made in one place.
 *
 * @param {string}  url                        The URL to check.
 * @param {Object}  [options]
 * @param {Array}   [options.allowedProtocols] Protocols allowed besides relative/anchor URLs.
 * @param {boolean} [options.allowAnchor]      Whether a leading "#" in-page anchor is allowed.
 */
export function getSafeUrl( url, { allowedProtocols = DEFAULT_ALLOWED_PROTOCOLS, allowAnchor = true } = {} ) {
	if ( ! url ) {
		return url;
	}

	const trimmed = url.trim();

	// Browsers strip tab/newline/CR from a URL anywhere in the string before
	// parsing it (per the WHATWG URL spec), so "java\tscript:" is navigated
	// to as "javascript:" even though it doesn't match the scheme regex
	// below as-is. Stripping them first closes that evasion.
	const stripped = trimmed.replace( /[\t\n\r]/g, '' );

	if ( stripped.startsWith( '/' ) || ( allowAnchor && stripped.startsWith( '#' ) ) ) {
		return url;
	}

	const schemeMatch = stripped.match( /^([a-zA-Z][a-zA-Z0-9+.-]*:)/ );

	if ( ! schemeMatch ) {
		return url;
	}

	return allowedProtocols.includes( schemeMatch[ 1 ].toLowerCase() ) ? url : '';
}
