/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import Vuex from 'vuex';


Vue.use(Vuex);

const store=new Vuex.Store({
    state:{
        item:{},
        transact:{status:'',message:''}


    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


Vue.component('home-cp',require('./components/Home.vue').default);
Vue.component('brand-cp', require('./components/Brands.vue').default);
Vue.component('input-cp', require('./components/Input.vue').default);
Vue.component('table-cp', require('./components/Table.vue').default);
Vue.component('card-cp', require('./components/Card.vue').default);
Vue.component('login-cp',require('./components/Login.vue').default);
Vue.component('dmodal-cp',require('./components/dmodal.vue').default);
Vue.component('modal-cp',require('./components/Modal.vue').default);
Vue.component('name-cp',require('./components/Name.vue').default);
Vue.component('alert-cp',require('./components/Alert.vue').default);
Vue.component('aval-cp',require('./components/Aval.vue').default);
Vue.component('dview-cp',require('./components/DView.vue').default);
Vue.component('dbrands-cp',require('./components/DBrands.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
