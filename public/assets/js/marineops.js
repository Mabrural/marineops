(() => {
    const sidebar = document.getElementById('appSidebar');
    const backdrop = document.querySelector('.sidebar-backdrop');
    const openSidebar = () => { sidebar?.classList.add('is-open'); backdrop?.classList.add('is-visible'); document.body.style.overflow = 'hidden'; };
    const closeSidebar = () => { sidebar?.classList.remove('is-open'); backdrop?.classList.remove('is-visible'); document.body.style.overflow = ''; };

    document.querySelectorAll('[data-sidebar-toggle]').forEach((button) => button.addEventListener('click', openSidebar));
    document.querySelectorAll('[data-sidebar-close]').forEach((button) => button.addEventListener('click', closeSidebar));
    window.addEventListener('resize', () => { if (window.innerWidth >= 992) closeSidebar(); }, { passive: true });

    if (window.jQuery && window.bootstrap) {
        window.jQuery.fn.modal = function (action) {
            return this.each(function () {
                const modal = window.bootstrap.Modal.getOrCreateInstance(this);
                action === 'hide' ? modal.hide() : modal.show();
            });
        };
    }

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => navigator.serviceWorker.register('/sw.js').catch(() => {}), { once: true });
    }
})();
