import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        path: '/dashboard/',
        mainPath: '/',
        dashboardPath: '/dashboard/',
        getPath: '/get/',
        imagePath: '/images/',
        logo: '/images/logo.png',
        support: '/images/admin.png',
        loader: false,

        user: null,
        appUrl: null,
        appName: 'Escobar Logistics',
        language: null,
        languages: [],
        texts: [],

        window: {
            height: 0,
            width: 0
        },
        alert: {
            value: false,
            type: null,
            message: null
        },
        confirm: {
            value: false,
            callback: null,
            args: null,
            btnText: null
        }
    },

    getters: {
        // Here we will create a getter
    },

    mutations: {
        setData(state, data){
            state[data.key] = data.value && typeof data.value === 'object' && !Array.isArray(data.value)?
                {...data.value}: data.value;
        },
        updateData(state, data){
            for (const [objKey, objValue] of Object.entries(data.value)) {
                state[data.key][objKey] = objValue && typeof objValue === 'object' && !Array.isArray(objValue)?
                    {...objValue}: objValue;
            }
        },
        loader(state, val){
            state.loader = val;
        },
        dark(state, val){
            state.logo = val? '/images/logo.png': '/images/logo.png'
        },
        setAlert(state, alert){
            state.alert.value = true;
            state.alert.type = alert.type;
            state.alert.message = alert.message;
        },
        closeAlert(state){
            state.alert.value = false;
            state.alert.type = null;
            state.alert.message = null;
        },
        confirm(state, data){
            state.confirm.value = true;
            if (typeof data === "function"){
                state.confirm.callback = data;
                state.confirm.btnText = 'Confirm';
            }else{
                state.confirm.callback = data.callback;
                state.confirm.args = data.args;
                state.confirm.btnText = data.btnText || null;
            }
        },
    },

    actions: {}
});
