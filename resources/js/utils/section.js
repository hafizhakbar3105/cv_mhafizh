/**
 * Mount helper untuk section homepage.
 * - Idempoten: pemanggilan kedua pada elemen yang sama mengembalikan controller yang sama.
 * - Aman bila elemen tidak ada: mengembalikan null.
 * - setup(el, { onCleanup }) boleh mengembalikan fungsi cleanup atau mendaftarkannya lewat onCleanup.
 */
const registry = new WeakMap();

export function mountSection(name, setup = () => undefined, root = document) {
    const el = root.querySelector(`[data-section="${name}"]`);
    if (!el) return null;
    if (registry.has(el)) return registry.get(el);

    const cleanups = [];
    const onCleanup = (fn) => cleanups.push(fn);
    const result = setup(el, { onCleanup });
    if (typeof result === 'function') cleanups.push(result);

    const controller = {
        name,
        el,
        destroy() {
            while (cleanups.length) cleanups.pop()();
            registry.delete(el);
            el.removeAttribute('data-ready');
        },
    };

    el.setAttribute('data-ready', 'true');
    registry.set(el, controller);
    return controller;
}
