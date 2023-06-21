import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        path: '/',
        mainPath: '/',
        dashboardPath: '/dashboard/',
        getPath: '/get/',
        socialAuthPath: '/login/',
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
        countries: [],
        destinations: [],

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
        },

        login: {
            value: false,
            callback: null,
            args: null
        },

        chat: null,

        authSocials: [
            {
                name: 'Google',
                value: 'google',
                icon: 'mdi-google-plus',
                color: '#C50707'
            },
            // {
            //     name: 'Twitter',
            //     value: 'twitter',
            //     icon: 'mdi-twitter',
            //     color: '#1D9BF0'
            // },
            // {
            //     name: 'Facebook',
            //     value: 'facebook',
            //     icon: 'mdi-facebook',
            //     color: '#2196F3'
            // },
        ]
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
        login(state, data){
            state.login.value = true;
            if (typeof data === "function"){
                state.login.callback = data;
            }else{
                state.login.callback = data.callback;
                state.login.args = data.args;
            }
        },
    },

    actions: {

    }
});
