/**
 * Countdown Timer: counts down to a fixed date, or for evergreen timers to
 * the end of a per-visitor period (its end time kept in localStorage). At
 * zero, the timer can hide, show its message, or go to another page.
 */

/**
 * The end time in ms.
 *
 * @param {HTMLElement} timer .bpafb-countdown-wrapper element.
 * @return {number} NaN when there is none.
 */
function endTime(timer) {
	const evergreen = parseInt(timer.dataset.evergreen, 10);
	if (evergreen > 0) {
		const key = 'bpafb-countdown-' + (timer.dataset.evergreenId || evergreen);
		let end = NaN;
		try {
			end = parseInt(window.localStorage.getItem(key), 10);
		} catch (e) {}
		if (!end) {
			end = Date.now() + evergreen * 1000;
			try {
				window.localStorage.setItem(key, String(end));
			} catch (e) {}
		}
		return end;
	}
	// Saved in the site's time zone; older timers only have the local date.
	const exact = parseInt(timer.dataset.targetTime, 10);
	return exact > 0 ? exact : new Date(timer.dataset.targetDate).getTime();
}

/**
 * A redirect target on http(s) that is not this page, or ''.
 *
 * @param {string} url Entered URL.
 * @return {string}
 */
function redirectUrl(url) {
	if (!url) {
		return '';
	}
	try {
		const target = new URL(url, window.location.href);
		// The page without its hash, query arguments in any order.
		const page = (link) => {
			const params = new URLSearchParams(link.search);
			params.sort();
			return link.origin + link.pathname.replace(/\/$/, '') + '?' + params.toString();
		};
		if (!/^https?:$/.test(target.protocol) || page(target) === page(window.location)) {
			return '';
		}
		return target.href;
	} catch (e) {
		return '';
	}
}

/**
 * Whether an ended timer sent this tab to another page in the last few
 * seconds (then it does not again), so a page that leads back to itself
 * under another address cannot redirect in a loop.
 *
 * @return {boolean}
 */
function recentlyRedirected() {
	const key = 'bpafb-countdown-redirected';
	try {
		const last = parseInt(window.sessionStorage.getItem(key), 10);
		if (last && Date.now() - last < 5000) {
			return true;
		}
		window.sessionStorage.setItem(key, String(Date.now()));
	} catch (e) {}
	return false;
}

function expire(timer) {
	const block = timer.parentElement;
	switch (timer.dataset.expireAction) {
		case 'hide':
			block.style.display = 'none';
			break;
		case 'message': {
			const message = block.querySelector('.bpafb-countdown-expired');
			if (message) {
				timer.style.display = 'none';
				message.hidden = false;
			}
			break;
		}
		case 'redirect': {
			const url = redirectUrl(timer.dataset.expireRedirect);
			if (url && !recentlyRedirected()) {
				window.location.assign(url);
			}
			break;
		}
	}
}

const pad = (value) => (value < 10 ? '0' + value : String(value));

function initTimer(timer) {
	const target = endTime(timer);
	if (isNaN(target)) {
		return;
	}

	const daysEl = timer.querySelector('.bpafb-cd-days .bpafb-countdown-number');
	const hoursEl = timer.querySelector('.bpafb-cd-hours .bpafb-countdown-number');
	const minsEl = timer.querySelector('.bpafb-cd-minutes .bpafb-countdown-number');
	const secsEl = timer.querySelector('.bpafb-cd-seconds .bpafb-countdown-number');
	let interval;

	const set = (el, value) => {
		if (el) {
			el.innerText = value;
		}
	};

	const update = () => {
		const distance = target - Date.now();
		if (distance <= 0) {
			[daysEl, hoursEl, minsEl, secsEl].forEach((el) => set(el, '00'));
			clearInterval(interval);
			expire(timer);
			return false;
		}
		set(daysEl, pad(Math.floor(distance / 864e5)));
		set(hoursEl, pad(Math.floor((distance % 864e5) / 36e5)));
		set(minsEl, pad(Math.floor((distance % 36e5) / 6e4)));
		set(secsEl, pad(Math.floor((distance % 6e4) / 1000)));
		return true;
	};

	if (update()) {
		interval = setInterval(update, 1000);
	}
}

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('.bpafb-countdown-wrapper').forEach(initTimer);
});
