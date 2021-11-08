require('./bootstrap');

// Importa os modulos

import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
//add these two line
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
//Esta linha habilita o uso do vuetify
Vue.use(Vuetify);

const app = document.getElementById('app');        

new Vue({ 
     //Essas linhas renderizam o vuetify no diretorio resources/js/Pages
    vuetify: new Vuetify(), 
render: (h) =>
    h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        },
    }),
    }).$mount(app);