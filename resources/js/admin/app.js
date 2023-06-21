require('../bootstrap');

import Vue from 'vue'
import vuetify from './plugins/vuetify'
import VueMask from 'v-mask'
import VeeValidate from 'vee-validate';
import Croppa from 'vue-croppa';
import store from './store/index'
import VueObserveVisibility from 'vue-observe-visibility';

import AdminApp from '../layouts/AdminApp';
import Index from './views/Index'
import ChatsPage from "./views/chats/ChatsPage";
import Users from "./views/users/Users";
import Languages from "./views/languages/Languages";
import Settings from "./views/settings/Settings";
import News from "./views/news/News";
import Orders from "./views/orders/Orders";

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

Vue.component('AdminApp', AdminApp);
Vue.component('index', Index);
Vue.component('languages', Languages);
Vue.component('settings', Settings);
Vue.component('news', News);
Vue.component('chats-page', ChatsPage);
Vue.component('users', Users);
Vue.component('orders', Orders);

const app = new Vue({ vuetify, store}).$mount('#app')
