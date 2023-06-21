import Vue from 'vue'
import vuetify from './plugins/vuetify'
import VueMask from 'v-mask'
import VeeValidate from 'vee-validate';
import Croppa from 'vue-croppa';
import store from './store/index';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import VueObserveVisibility from 'vue-observe-visibility';
import VueRouter from 'vue-router'

import MainApp from "../layouts/MainApp";
import Home from "./views/home/Home";
import Login from "./views/auth/Login";
import Search from "./views/search/Search";
import Order from "./views/order/Order";
import Deliver from "./views/deliver/Deliver";
import Support from "./views/support/Support";

require('../bootstrap');

if (process.env.MIX_APP_ENV === 'production') {
    Vue.config.devtools = false;
    Vue.config.debug = false;
    Vue.config.silent = true;
}

axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if (error.response.status === 419) {
        window.location.reload();
    }
    return Promise.reject(error)
})

const csrf = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');
Vue.prototype.$csrf = csrf;

Vue.use(VeeValidate);
Vue.use(VueMask);
Vue.use(Croppa);
Vue.use(VueObserveVisibility);
Vue.use(VueRouter)

Vue.component('MainApp', MainApp);
Vue.component('home', Home);
Vue.component('order', Order);
Vue.component('deliver', Deliver);
Vue.component('support', Support);
Vue.component('search', Search);
Vue.component('login', Login);

let theme = localStorage.getItem('theme');
theme = theme? JSON.parse(theme): null
store.commit('dark', theme? theme.dark: false);

const app = new Vue({ vuetify, store}).$mount('#app')
