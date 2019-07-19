window.$ = window.jQuery = require('jquery');

require('bootstrap');

import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'

import Alertify from './VuePlugins/Alertify';
import ErrorsCatcher from './VuePlugins/ErrorsCatcher';

Vue.use(VueAxios, axios)
Vue.use(Alertify);
Vue.use(ErrorsCatcher);

import App from './components/App.vue';

Vue.component('Loader', require('./components/Loader.vue').default);
Vue.component('List', require('./components/List.vue').default);

window.app = new Vue(App).$mount('#app');
