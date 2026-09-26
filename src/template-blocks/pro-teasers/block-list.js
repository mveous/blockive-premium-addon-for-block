/**
 * Registry of the Pro-only Template Blocks: WooCommerce, Events, Dynamic
 * Field, and the header / footer / archive / single blocks.
 *
 * These blocks aren't implemented in the free version yet - only Post/Page
 * templates are supported so far (see Bpafb_Template_Post_Type::FREE_TEMPLATE_TYPES).
 * They're listed here purely so the inserter can advertise them as "(Pro)"
 * via the teaser block registered for each in ./index.js; slug, title, and
 * icon match what the real blocks used before they shipped.
 */
export const PRO_TEASER_BLOCKS = [
	// WooCommerce.
	{ slug: 'product-title', title: 'Product Title', icon: 'editor-textcolor' },
	{
		slug: 'product-gallery',
		title: 'Product Gallery',
		icon: 'format-gallery',
	},
	{ slug: 'product-images', title: 'Product Images', icon: 'format-image' },
	{ slug: 'product-price', title: 'Product Price', icon: 'tag' },
	{ slug: 'product-sale-badge', title: 'Sale Badge', icon: 'megaphone' },
	{ slug: 'product-rating', title: 'Product Rating', icon: 'star-filled' },
	{ slug: 'product-add-to-cart', title: 'Add To Cart', icon: 'cart' },
	{ slug: 'product-sku', title: 'Product SKU', icon: 'id' },
	{ slug: 'product-stock', title: 'Product Stock', icon: 'clipboard' },
	{
		slug: 'product-short-description',
		title: 'Product Short Description',
		icon: 'editor-alignleft',
	},
	{
		slug: 'product-description',
		title: 'Product Description',
		icon: 'editor-justify',
	},
	{
		slug: 'product-attributes',
		title: 'Product Attributes',
		icon: 'list-view',
	},
	{ slug: 'product-meta', title: 'Product Meta', icon: 'list-view' },
	{ slug: 'product-tabs', title: 'Product Tabs', icon: 'index-card' },
	{
		slug: 'product-variations',
		title: 'Product Variations',
		icon: 'screenoptions',
	},
	{ slug: 'product-related', title: 'Related Products', icon: 'grid-view' },
	{ slug: 'product-upsells', title: 'Upsells', icon: 'arrow-up-alt' },
	{ slug: 'product-cross-sells', title: 'Cross Sells', icon: 'randomize' },

	// Events.
	{ slug: 'event-title', title: 'Event Title', icon: 'calendar-alt' },
	{ slug: 'event-image', title: 'Event Image', icon: 'format-image' },
	{ slug: 'event-date', title: 'Event Date', icon: 'calendar' },
	{ slug: 'event-time', title: 'Event Time', icon: 'clock' },
	{ slug: 'event-venue', title: 'Venue', icon: 'location-alt' },
	{ slug: 'event-organizer', title: 'Organizer', icon: 'admin-users' },
	{ slug: 'event-cost', title: 'Event Cost', icon: 'tickets-alt' },
	{ slug: 'event-map', title: 'Event Map', icon: 'location' },
	{
		slug: 'event-register-button',
		title: 'Register Button',
		icon: 'megaphone',
	},

	// Universal Dynamic Field.
	{ slug: 'dynamic-field', title: 'Dynamic Field', icon: 'editor-code' },

	// Header & Footer.
	{ slug: 'site-logo', title: 'Site Logo', icon: 'format-image' },
	{ slug: 'site-title', title: 'Site Title', icon: 'admin-site-alt3' },
	{ slug: 'site-tagline', title: 'Site Tagline', icon: 'editor-quote' },
	{ slug: 'page-title', title: 'Page Title', icon: 'heading' },
	{ slug: 'search-form', title: 'Search Form', icon: 'search' },
	{ slug: 'menu-cart', title: 'Menu Cart', icon: 'cart' },
	{ slug: 'login', title: 'Login', icon: 'admin-users' },
	{ slug: 'sitemap', title: 'Sitemap', icon: 'networking' },
	{ slug: 'copyright', title: 'Copyright', icon: 'shield' },

	// Archive & Single.
	{ slug: 'archive-posts', title: 'Archive Posts', icon: 'grid-view' },
	{ slug: 'archive-products', title: 'Archive Products', icon: 'products' },
	{ slug: 'author-box', title: 'Author Box', icon: 'id' },
	{ slug: 'post-comments', title: 'Post Comments', icon: 'admin-comments' },
	{ slug: 'post-excerpt', title: 'Post Excerpt', icon: 'excerpt-view' },
];
