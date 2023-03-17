import Vue from 'vue';
import { Button, Select, Option } from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Hydraulic from "./views/Hydraulic.vue";

Vue.component(Button.name, Button);
Vue.component(Select.name, Select);
Vue.component(Option.name, Option);

new Vue({
    el: '#hydraulic',
    render: h => h(Hydraulic),
});
