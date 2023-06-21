import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import {projectColors} from "../../assets/colors";
Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        dark: false,
        themes: projectColors,
    },
})
