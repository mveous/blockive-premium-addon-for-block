const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

const extraEntry = {
	'template-builder/index': path.resolve(
		__dirname,
		'src/template-builder/index.js'
	),
	'template-blocks/index': path.resolve(
		__dirname,
		'src/template-blocks/index.js'
	),
};

// @wordpress/scripts sets `entry` to a function that lazily discovers every
// block.json-based entry (see getWebpackEntryPoints in its utils/config.js),
// so it must be called (and awaited, since it may return a Promise) rather
// than spread, or every existing block entry silently disappears.
async function withExtraEntry(config) {
	const base =
		typeof config.entry === 'function'
			? await config.entry()
			: config.entry;

	return {
		...config,
		entry: {
			...base,
			...extraEntry,
		},
	};
}

// @wordpress/scripts exports either a single config or an array of configs
// (script + module builds) depending on the project's block.json entries.
// Only add the extra entry to the first (script) config either way, so every
// existing block entry keeps building exactly as before.
// Exported as an async function, which webpack natively supports, since
// resolving the base entry may require awaiting a Promise.
module.exports = async () => {
	if (Array.isArray(defaultConfig)) {
		return [
			await withExtraEntry(defaultConfig[0]),
			...defaultConfig.slice(1),
		];
	}

	return withExtraEntry(defaultConfig);
};
