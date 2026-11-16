/**
 * Marks every Blockive block as a Mveous block in the editor: a small
 * Mveous logo in the corner of the block's icon (inserter, toolbar, list
 * view, block card), and the logo next to the Blockive categories in the
 * inserter. Settings come from bpafbBrand (see bpafb_enqueue_editor_assets()).
 *
 * The block filter has to be in place before the blocks register, so every
 * Blockive block script depends on this one (bpafb_brand_script_first()).
 */
( function ( element, hooks, blocks, components, data ) {
	const settings = window.bpafbBrand || {};
	if ( ! settings.logo ) {
		return;
	}

	const el = element.createElement;
	const NAMESPACE = 'blockive-premium-addon-for-block/';
	const CATEGORIES = [ 'bpafb-widgets', 'blockive-template', 'blockive-site' ];

	const badge = () =>
		el( 'img', {
			className: 'bpafb-brand-icon__badge',
			src: settings.logo,
			alt: '',
			'aria-hidden': 'true',
			draggable: false,
		} );

	/**
	 * The icon as it would be drawn on its own: a Dashicon name, an
	 * element, or a component.
	 *
	 * @param {*} src Icon source.
	 * @return {Element|null} Icon element.
	 */
	function iconElement( src ) {
		if ( typeof src === 'string' ) {
			return components.Dashicon ? el( components.Dashicon, { icon: src } ) : el( 'span', { className: 'dashicons dashicons-' + src } );
		}
		if ( typeof src === 'function' ) {
			return el( src );
		}
		return src || null;
	}

	function withBrand( blockSettings, name ) {
		if ( ! name || name.indexOf( NAMESPACE ) !== 0 || ! blockSettings.icon ) {
			return blockSettings;
		}
		const icon = blockSettings.icon;
		const isObject = typeof icon === 'object' && ! element.isValidElement( icon ) && 'src' in icon;
		const src = isObject ? icon.src : icon;
		if ( src && src.props && src.props[ 'data-bpafb-brand' ] ) {
			return blockSettings;
		}

		const branded = el( 'span', { className: 'bpafb-brand-icon', 'data-bpafb-brand': true }, iconElement( src ), badge() );

		return {
			...blockSettings,
			icon: isObject ? { ...icon, src: branded } : branded,
		};
	}

	hooks.addFilter( 'blocks.registerBlockType', 'bpafb/brand-icon', withBrand );

	// The logo beside the Blockive categories' titles in the inserter. The
	// editor sets its categories again when it starts, so this follows the
	// category list rather than running once.
	const categoryIcon = el( 'img', { className: 'bpafb-brand-category-icon', src: settings.logo, alt: '', 'aria-hidden': 'true' } );
	const updateCategories = () => {
		( blocks.getCategories() || [] ).forEach( ( category ) => {
			if ( CATEGORIES.includes( category.slug ) && category.icon !== categoryIcon ) {
				blocks.updateCategory( category.slug, { icon: categoryIcon } );
			}
		} );
	};
	updateCategories();
	data.subscribe( updateCategories, 'core/blocks' );
} )( window.wp.element, window.wp.hooks, window.wp.blocks, window.wp.components, window.wp.data );
