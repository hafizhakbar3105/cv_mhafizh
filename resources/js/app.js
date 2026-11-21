import './bootstrap';

// Setiap file di ./sections/ dimuat lazy, hanya bila elemen [data-section="<nama>"] ada di halaman.
const sectionModules = import.meta.glob('./sections/*.js');

async function initSections() {
    const targets = document.querySelectorAll('[data-section]');

    await Promise.all(
        [...targets].map(async (el) => {
            const loader = sectionModules[`./sections/${el.dataset.section}.js`];
            if (!loader) return;

            try {
                const module = await loader();
                module.init?.();
            } catch (error) {
                console.error(`[sections] gagal menginisialisasi "${el.dataset.section}"`, error);
            }
        }),
    );
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSections, { once: true });
} else {
    initSections();
}
