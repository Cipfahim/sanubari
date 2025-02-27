require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import globalMixins from './mixins'
import PrimeVue from 'primevue/config';
import 'vue3-tel-input/dist/vue3-tel-input.css'

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
        }),
})
    .mixin(globalMixins)
    .use(InertiaPlugin, PrimeVue)
    .mount(el);

InertiaProgress.init({delay: 0, color: '#45ff00', showSpinner: true});
