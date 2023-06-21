<template>
    <v-card class="h-100 d-flex flex-column">
        <v-card-title class="align-center">
            <v-row no-gutters>
                <v-col cols="12" md="8">
                    <div class="d-flex flex-wrap align-center">
                        <v-chip
                            v-for="lang in languages"
                            :key="lang.id"
                            class="mr-2 pr-2 mb-1"
                            label
                            outlined
                            :color="lang.default? 'primary': 'secondary'"
                            :class="lang.default? 'elevation-4': ''"
                        >
                            <div class="d-flex align-center">
                                <avatar
                                    :elevation="true"
                                    size="1.2rem!important"
                                    :object="lang.country"
                                    :offset-right="true"
                                ></avatar>
                                <span class="font-weight-medium mr-4"> {{ lang.code }} </span>
                                <v-btn @click="showLanguage(lang)" :color="lang.default? 'primary': 'secondary'" icon x-small>
                                    <v-icon :color="lang.default? 'primary': 'secondary'" small>mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn
                                    v-if="languages.length > 1"
                                    @click="$store.commit('confirm', {callback: destroy, args: lang.id, btnText: 'Delete'})"
                                    icon
                                    x-small
                                    color="red"
                                >
                                    <v-icon small color="red">mdi-close</v-icon>
                                </v-btn>
                            </div>
                        </v-chip>
                        <v-btn @click="showLanguage()" fab x-small color="primary" class="mb-1">
                            <v-icon>mdi-plus</v-icon>
                        </v-btn>
                    </div>
                </v-col>
                <v-col cols="12" md="4" class="d-flex align-baseline">
                    <v-text-field
                        dense
                        @input="getData({search: $event})"
                        :value="query.search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                        clearable
                        class="mr-4"
                    ></v-text-field>
                    <v-btn @click="showText()" outlined small tile color="primary">+ add text</v-btn>
                </v-col>
            </v-row>
        </v-card-title>
        <v-card-text>
            <v-data-table
                dense
                :headers="headers"
                :items="paginate.data"
                hide-default-footer
                :loading="loading"
                loader-height="1"
                disable-sort
                disable-pagination
            >
                <template v-for="item in headers" v-slot:[`header.${item.value}`]>
                    <template v-if="languages.find(i => i.code === item.value)">
                        <div class="d-flex align-center">
                            <avatar
                                :elevation="true"
                                size="1rem"
                                :object="languages.find(i => i.code === item.value).country"
                                :offset-right="true"
                            ></avatar>
                            <span class="font-weight-medium">
                                {{ languages.find(i => i.code === item.value).code }}
                                ({{ languages.find(i => i.code === item.value).name }})
                            </span>
                        </div>
                    </template>
                    <span v-else>{{ item.text }}</span>
                </template>

                <template v-slot:item.key="{ item }">
                    <span class="font-weight-bold">{{ item.key }}</span>
                </template>

                <template v-for="lang in languages" v-slot:[`item.${lang.code}`]="{item}">
                    <span> {{ ( item.texts.find(t => t.language_id === lang.id) || {}).text || '' }} </span>
                </template>

                <template v-slot:item.actions="{ item }">
                    <div class="d-flex align-center justify-end">
                        <v-btn @click="showText(item)" icon x-small color="primary">
                            <v-icon small color="primary">mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn
                            @click="$store.commit('confirm', {callback: destroyText, args: item.id, btnText: 'Delete'})"
                            icon x-small
                            color="red"
                        >
                            <v-icon small color="red">mdi-close</v-icon>
                        </v-btn>
                    </div>
                </template>
            </v-data-table>
        </v-card-text>
        <v-spacer></v-spacer>
        <v-card-actions class="justify-center">
            <v-pagination
                @input="getData({page: $event})"
                :value="paginate.current_page"
                :length="Math.ceil(paginate.total/paginate.per_page)"
                total-visible="10"
            ></v-pagination>
        </v-card-actions>

        <!--Text Form-->
        <text-form
            v-model="textDialog"
            :text="textItem"
            :languages="languages"
            @saved="getData()"
        ></text-form>

        <!--Language Form-->
        <language-form
            v-model="languageDialog"
            :language="languageItem"
            :countries="countries"
            @saved="updateData()"
        ></language-form>
    </v-card>
</template>
<script>
import Avatar from "../../../components/Avatar";
import TextForm from "./components/TextForm";
import LanguageForm from "./components/LanguageForm";
import Helpers from "../../../mixins/Helpers";
export default {
    name: 'Languages',
    mixins: [Helpers],
    components: {LanguageForm, TextForm, Avatar},
    props: {
        texts: {
            required: true,
            type: Object
        },
        languages: {
            required: true,
            type: Array
        },
        countries: {
            required: true,
            type: Array
        },
    },
    data(){
        return {
            loading: false,
            query: {
                search: null,
                letter: null,
                page: 1
            },
            paginate: this.texts,

            textItem: null,
            textDialog: false,

            languageItem: null,
            languageDialog: false,
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
