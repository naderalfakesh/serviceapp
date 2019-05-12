/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import './bootstrap';

import Vue from 'vue';
import Vuetify from 'vuetify';

// router info
import Routes from '@/js/routes.js';

// component file
import App from '@/js/views/App';
//Nav
import mynav from '@/js/components/my-nav';
Vue.component('My-nav',mynav);
//sidebar
import mysidebar from '@/js/components/my-sidebar';
Vue.component('My-sidebar',mysidebar);
//header
import myheader from '@/js/components/my-header';
Vue.component('My-header',myheader);



Vue.use(Vuetify);


const app = new Vue({
    el: '#app',
    router: Routes, 
    render: h => h(App),
    
});

export default app;


