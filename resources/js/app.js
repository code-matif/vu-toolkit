import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import AOS from 'aos'
import 'aos/dist/aos.css'

if (window.location.pathname.startsWith('/admin')) {
    // Admin Section
    import('./admin.js');
} else {
    // Site Section
    import('./site.js');
}

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)

        AOS.init();

        const preloader = document.querySelector('#preloader');
        if (preloader) {
            preloader.style.opacity = 1.5;
            setTimeout(() => {
                preloader.remove();
            }, 1000);
        }
    },
})
