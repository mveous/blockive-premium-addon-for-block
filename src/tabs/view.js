/**
 * Sets up Tabs blocks on the live site: switching tabs by click, and by
 * keyboard (Enter or Space opens a tab, Left/Right arrow keys move to the
 * next or previous tab and open it).
 */
const initBlockiveTabs = () => {
    const tabsWrappers = document.querySelectorAll('.bpafb-tabs-wrapper:not(.bpafb-tabs-initialized)');

    tabsWrappers.forEach(wrapper => {
        wrapper.classList.add('bpafb-tabs-initialized');

        const pills = wrapper.querySelectorAll('.bpafb-tab-pill');
        const panes = wrapper.querySelectorAll('.bpafb-tab-pane');

        const activatePill = (index) => {
            pills.forEach(p => {
                p.classList.remove('active');
                p.setAttribute('aria-selected', 'false');
            });
            panes.forEach(p => p.classList.remove('active'));

            const pill = pills[index];
            pill.classList.add('active');
            pill.setAttribute('aria-selected', 'true');
            if (panes[index]) {
                panes[index].classList.add('active');
            }
        };

        pills.forEach((pill, index) => {
            pill.addEventListener('click', () => activatePill(index));

            pill.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    activatePill(index);
                } else if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                    e.preventDefault();
                    const nextIndex = e.key === 'ArrowRight'
                        ? (index + 1) % pills.length
                        : (index - 1 + pills.length) % pills.length;
                    pills[nextIndex].focus();
                    activatePill(nextIndex);
                }
            });
        });
    });
};

let hasTabsInitialized = false;

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        if (!hasTabsInitialized) {
            initBlockiveTabs();
            hasTabsInitialized = true;
        }
    });
} else {
    if (!hasTabsInitialized) {
        initBlockiveTabs();
        hasTabsInitialized = true;
    }
}
