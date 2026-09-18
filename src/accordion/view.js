/**
 * Sets up Accordion blocks on the live site. Skips any wrapper that
 * already has the "initialized" class, so we don't add the same click
 * events twice on the same block.
 */
const initBlockiveAccordion = () => {
    const accordions = document.querySelectorAll('.bpafb-accordion-wrapper:not(.bpafb-accordion-initialized)');

    accordions.forEach(accordion => {
        accordion.classList.add('bpafb-accordion-initialized');

        const items = accordion.querySelectorAll('.bpafb-accordion-item');

        items.forEach(item => {
            const header = item.querySelector('.bpafb-accordion-header');
            const content = item.querySelector('.bpafb-accordion-content');

            if (header && content) {
                const toggleItem = () => {
                    const isActive = item.classList.contains('active');

                    // Single-open behavior: close every other item first.
                    items.forEach(otherItem => {
                        otherItem.classList.remove('active');
                        const otherContent = otherItem.querySelector('.bpafb-accordion-content');
                        if (otherContent) otherContent.style.display = 'none';
                        const otherHeader = otherItem.querySelector('.bpafb-accordion-header');
                        if (otherHeader) otherHeader.setAttribute('aria-expanded', 'false');

                        const openIcon = otherItem.querySelector('.bpafb-icon-open');
                        const closeIcon = otherItem.querySelector('.bpafb-icon-close');
                        if (openIcon) openIcon.style.display = 'inline';
                        if (closeIcon) closeIcon.style.display = 'none';
                    });

                    if (!isActive) {
                        item.classList.add('active');
                        content.style.display = 'block';
                        header.setAttribute('aria-expanded', 'true');

                        const openIcon = item.querySelector('.bpafb-icon-open');
                        const closeIcon = item.querySelector('.bpafb-icon-close');
                        if (openIcon) openIcon.style.display = 'none';
                        if (closeIcon) closeIcon.style.display = 'inline';
                    }
                };

                header.addEventListener('click', toggleItem);

                header.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        toggleItem();
                    }
                });
            }
        });
    });
};

let hasInitialized = false;

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        if (!hasInitialized) {
            initBlockiveAccordion();
            hasInitialized = true;
        }
    });
} else {
    if (!hasInitialized) {
        initBlockiveAccordion();
        hasInitialized = true;
    }
}
