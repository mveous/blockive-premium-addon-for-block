/**
 * The regular blocks only Blockive Pro has. Slug, title, and icon match
 * the real block's block.json, so the inserter shows them as they will
 * look once Pro is on. Nested Carousel's Slide is left out, since it only
 * exists inside a Nested Carousel.
 */
export const LOCKED_BLOCKS = [
	// Content.
	{
		slug: 'animated-headline',
		title: 'Animated Headline',
		icon: 'editor-textcolor',
	},
	{ slug: 'blockquote', title: 'Blockquote', icon: 'format-quote' },
	{ slug: 'call-to-action', title: 'Call to Action', icon: 'megaphone' },
	{ slug: 'code-highlight', title: 'Code Highlight', icon: 'editor-code' },
	{ slug: 'flip-box', title: 'Flip Box', icon: 'image-flip-horizontal' },
	{ slug: 'icon', title: 'Icon', icon: 'star-filled' },
	{ slug: 'icon-list', title: 'Icon List', icon: 'editor-ul' },
	{ slug: 'price-list', title: 'Price List', icon: 'money-alt' },
	{
		slug: 'progress-tracker',
		title: 'Progress Tracker',
		icon: 'performance',
	},
	{
		slug: 'table-of-contents',
		title: 'Table of Contents',
		icon: 'list-view',
	},
	{ slug: 'template', title: 'Template', icon: 'layout' },

	// Media.
	{ slug: 'gallery', title: 'Gallery', icon: 'format-gallery' },
	{ slug: 'hotspot', title: 'Hotspot', icon: 'location' },
	{ slug: 'media-carousel', title: 'Media Carousel', icon: 'images-alt2' },
	{ slug: 'nested-carousel', title: 'Nested Carousel', icon: 'slides' },
	{ slug: 'slides', title: 'Slides', icon: 'slides' },
	{
		slug: 'testimonial-carousel',
		title: 'Testimonial Carousel',
		icon: 'format-quote',
	},
	{ slug: 'reviews', title: 'Reviews', icon: 'star-filled' },
	{ slug: 'video-playlist', title: 'Video Playlist', icon: 'playlist-video' },
	{ slug: 'google-maps', title: 'Google Maps', icon: 'location-alt' },
	{ slug: 'facebook-embed', title: 'Facebook Embed', icon: 'facebook' },

	// Posts & Loops.
	{ slug: 'loop-grid', title: 'Loop Grid', icon: 'grid-view' },
	{ slug: 'loop-carousel', title: 'Loop Carousel', icon: 'slides' },
	{ slug: 'loop-filter', title: 'Loop Filter', icon: 'filter' },
	{ slug: 'portfolio', title: 'Portfolio', icon: 'portfolio' },

	// Navigation & Layout.
	{ slug: 'menu', title: 'Menu', icon: 'menu' },
	{ slug: 'mega-menu', title: 'Mega Menu', icon: 'grid-view' },
	{ slug: 'off-canvas', title: 'Off-Canvas', icon: 'align-pull-right' },

	// Marketing.
	{ slug: 'form', title: 'Form', icon: 'feedback' },
	{
		slug: 'floating-buttons',
		title: 'Floating Buttons',
		icon: 'format-chat',
	},
	{ slug: 'link-in-bio', title: 'Link in Bio', icon: 'id' },
	{ slug: 'share-buttons', title: 'Share Buttons', icon: 'share' },

	// WooCommerce.
	{ slug: 'products', title: 'Products', icon: 'products' },
	{
		slug: 'product-categories',
		title: 'Product Categories',
		icon: 'category',
	},
	{ slug: 'add-to-cart', title: 'Add to Cart Button', icon: 'cart' },
];
