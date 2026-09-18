/**
 * Animates Progress Bar blocks' fill width and number count-up when they
 * scroll into view, via IntersectionObserver.
 */

document.addEventListener('DOMContentLoaded', () => {
	const initProgressBars = () => {
		const progressBars = document.querySelectorAll('.bpafb-progress-bar-wrapper[data-blockive-progress]:not(.bpafb-pb-initialized)');

		if (!progressBars.length) return;

		const observer = new IntersectionObserver((entries, observerInstance) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					const wrapper = entry.target;
					const fillArea = wrapper.querySelector('.bpafb-pb-fill');
					const numberElements = wrapper.querySelectorAll('.bpafb-pb-number');

					const targetPercentage = parseFloat(wrapper.getAttribute('data-percentage')) || 0;
					const duration = parseInt(wrapper.getAttribute('data-duration'), 10) || 1500;

					// The bar starts at its real width, so visitors without
					// JavaScript still see the right value. We set it to 0%
					// here, then force the browser to redraw, so visitors
					// with JavaScript see it grow from 0.
					if (fillArea) {
						fillArea.style.transition = 'none';
						fillArea.style.width = '0%';
						fillArea.offsetHeight; // eslint-disable-line no-unused-expressions -- force reflow
						fillArea.style.transition = `width ${duration}ms cubic-bezier(0.165, 0.84, 0.44, 1)`;
						fillArea.style.width = `${targetPercentage}%`;
					}

					if (numberElements.length > 0) {
						let startTimestamp = null;

						const step = (timestamp) => {
							if (!startTimestamp) startTimestamp = timestamp;
							const progress = Math.min((timestamp - startTimestamp) / duration, 1);

							// Makes the count-up start fast and slow down near the end.
							const easeOut = 1 - Math.pow(1 - progress, 4);

							const currentVal = Math.floor(easeOut * targetPercentage);

							numberElements.forEach(el => {
								el.textContent = currentVal;
							});

							if (progress < 1) {
								window.requestAnimationFrame(step);
							} else {
								numberElements.forEach(el => {
									el.textContent = targetPercentage;
								});
							}
						};
						window.requestAnimationFrame(step);
					}

					wrapper.classList.add('bpafb-pb-initialized');
					observerInstance.unobserve(wrapper);
				}
			});
		}, {
			rootMargin: '0px 0px -50px 0px',
			threshold: 0.1
		});

		progressBars.forEach(bar => {
			observer.observe(bar);
		});
	};

	initProgressBars();
});
