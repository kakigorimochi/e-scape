/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Buefy from 'buefy';
import 'buefy/dist/buefy.css';
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';

require('./bootstrap');

window.Vue = require('vue');

Vue.use(Buefy);
Vue.use(Datetime);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('datetime', Datetime);
Vue.component('home', require('@/pages/home').default);
Vue.component('index', require('@/pages/index').default);
Vue.component('login', require('@/pages/login').default);
Vue.component('register', require('@/pages/register').default);

Vue.component('commuter-e-modeofpayment', require('@/pages/commuter/modeofpayment').default);
Vue.component('commuter-e-newbalance', require('@/pages/commuter/newbalance').default);
Vue.component('commuter-e-payment', require('@/pages/commuter/payment').default);
Vue.component('commuter-e-ticket', require('@/pages/commuter/ticket').default);
Vue.component('commuter-e-topup', require('@/pages/commuter/topup').default);
Vue.component('commuter-e-wallet', require('@/pages/commuter/ewallet').default);
Vue.component('commuter-index', require('@/pages/commuter/index').default);

Vue.component('operator-e-dispatch', require('@/pages/operator/dispatches').default);
Vue.component('operator-index', require('@/pages/operator/index').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
        arrayFind(array, condition) {
            const item = array.find(condition);
            return array.indexOf(item);
        },
        prompt(msg = 'Oops, something went wrong') {
            this.$buefy.toast.open({
                duration: 5000,
                message: msg,
                position: 'is-bottom',
                type: 'is-dark'
            });
        }
    }
});

export default app;
