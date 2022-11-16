/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

require('./bootstrap');

window.Vue = require('vue');

Vue.use(Buefy)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('home', require('@/pages/home').default);
Vue.component('index', require('@/pages/index').default);

Vue.component('commuter-login', require('@/pages/commuter/login').default);
Vue.component('commuter-register', require('@/pages/commuter/register').default);

Vue.component('operator-login', require('@/pages/operator/login').default);
Vue.component('operator-register', require('@/pages/operator/register').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

export default app;
