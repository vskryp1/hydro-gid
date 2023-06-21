<template>
    <v-card class="h-100 d-flex flex-column">
        <v-card-title class="align-center">
            Settings
        </v-card-title>
        <setting-form
            :settings="settings"
        ></setting-form>
    </v-card>
</template>
<script>
import Helpers from "../../../mixins/Helpers";
import SettingForm from "./components/SettingForm";
export default {
    name: 'Settings',
    mixins: [Helpers],
    components: {SettingForm},
    props: {
        settings: {
            required: true,
            type: Object
        },
    },
    data(){
        return {
            loading: false,
        }
    },
    computed: {
        headers(){
            let arr = [{ text: 'KEY', value: 'key' }];
            this.languages.forEach(l => arr.push({ text: l.code, value: l.code }))
            arr.push({ text: '', value: 'actions', align: 'right'});
            return arr;
        }
    },
    methods: {
        getData(q = {}){
            for (const [key, value] of Object.entries(q)) {
                this.query[key] = value;
            }
            if (!q.page){
                this.query.page = 1;
            }
            this.loading = true;
            axios.get(this.$store.state.path+'languages/paginate',{ params: this.query })
                .then(response => {
                    this.loading = false;
                    this.paginate = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                })
        },

        showText(item = null){
            this.textItem = item;
            this.textDialog = true;
        },
        showLanguage(item = null){
            this.languageItem = item;
            this.languageDialog = true;
        },

        updateData(){
            this.__getData({route: 'languages/data'})
        },

        destroy(id){
            axios.delete(this.$store.state.path+'languages/destroy/'+id)
                .then(response => {
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                    this.updateData();
                })
                .catch(error => {
                    this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                })
        },

        destroyText(id){
            axios.delete(this.$store.state.path+'languages/text/destroy/'+id)
                .then(response => {
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                    this.getData();
                })
                .catch(error => {
                    this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                })
        }
    }
}
</script>
