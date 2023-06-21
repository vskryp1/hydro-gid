import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import {projectColors} from "../../assets/colors";
Vue.use(Vuetify)

let theme = localStorage.getItem('theme');
theme = theme? JSON.parse(theme): null

export default new Vuetify({
    theme: {
        dark: theme? theme.dark: false,
        themes: projectColors,
    },
})
