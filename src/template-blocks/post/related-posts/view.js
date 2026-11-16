import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

/**
 * Frontend hydration for the Related Posts block's Slider layout.
 */
function initRelatedPostsSliders() {
	// The block's own wrapper also carries a "bpafb-tb-related-posts-slider"
	// class (added for the slider layout alongside the "-grid" variant used
	// for the grid layout) - .swiper narrows this to the actual Swiper
	// container nested inside it, not that outer wrapper.
	const sliders = document.querySelectorAll( '.bpafb-tb-related-posts-slider.swiper' );

	sliders.forEach( ( sliderEl ) => {
		if ( sliderEl.dataset.bpafbSwiperInitialized ) {
			return;
		}
		sliderEl.dataset.bpafbSwiperInitialized = 'true';

		const slidesPerView = parseInt( sliderEl.dataset.slidesPerView, 10 ) || 3;
		const isAutoplay = sliderEl.dataset.autoplay === 'true';
		const autoplaySpeed = parseInt( sliderEl.dataset.autoplaySpeed, 10 ) || 3000;
		const isLoop = sliderEl.dataset.loop === 'true';
		const spaceBetween = parseInt( sliderEl.dataset.spaceBetween, 10 ) || 20;

		const modules = [ Navigation, Pagination ];
		if ( isAutoplay ) {
			modules.push( Autoplay );
		}

		const paginationEl = sliderEl.querySelector( '.swiper-pagination' );
		const prevEl = sliderEl.querySelector( '.swiper-button-prev' );
		const nextEl = sliderEl.querySelector( '.swiper-button-next' );

		const swiperInstance = new Swiper( sliderEl, {
			modules,
			slidesPerView: 1,
			spaceBetween,
			loop: isLoop,
			autoplay: isAutoplay
				? {
					delay: autoplaySpeed,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
				}
				: false,
			pagination: paginationEl
				? {
					el: paginationEl,
					clickable: true,
				}
				: false,
			navigation: prevEl && nextEl
				? {
					nextEl,
					prevEl,
				}
				: false,
			breakpoints: {
				640: {
					slidesPerView: Math.min( 2, slidesPerView ),
					spaceBetween,
				},
				1024: {
					slidesPerView: slidesPerView,
					spaceBetween,
				},
			},
		} );

		if ( isAutoplay && swiperInstance.autoplay ) {
			sliderEl.addEventListener( 'mouseenter', () => swiperInstance.autoplay.stop() );
			sliderEl.addEventListener( 'mouseleave', () => swiperInstance.autoplay.start() );
		}
	} );
}

if ( document.readyState === 'loading' ) {
	document.addEventListener( 'DOMContentLoaded', initRelatedPostsSliders );
} else {
	initRelatedPostsSliders();
}

