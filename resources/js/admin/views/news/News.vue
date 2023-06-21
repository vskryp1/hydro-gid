<template>
    <v-card class="h-100 d-flex flex-column">
        <v-card-title class="py-2 elevation-4 mb-4" style="z-index: 1">
            <h2 class="mr-4 fs-24 font-weight-regular">News</h2>
            <v-spacer></v-spacer>
            <v-text-field
                class="mt-0 pt-0 mb-1 mr-6"
                @input="getData({search: $event})"
                :value="query.search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
                clearable
                style="max-width: 15rem"
            ></v-text-field>
            <v-btn @click="showForm()" tile small color="primary">+ Add new news</v-btn>
        </v-card-title>
        <v-card-text class="pb-0">

            <v-data-table
                :headers="headers"
                :items="paginate.data"
                hide-default-footer
                :loading="loading"
                loader-height="1"
                disable-sort
                disable-pagination
            >

                <template v-slot:item.image="{ item }">
                    <div class="d-flex align-center py-2">
                        <avatar size="2.5rem" :object="item" :offset-right="true"></avatar>
                    </div>
                </template>
                <template v-slot:item.localization.title="{ item }">
                    {{ item.localization.title }}
                </template>

                <template v-slot:item.actions="{ item }">
                    <div class="d-flex align-center">
                        <v-btn @click="showForm(item)" icon small color="primary">
                            <v-icon small color="primary">mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn @click="showDelete(item)" icon small color="red">
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

<!--        Student Form-->
        <news-form
            v-model="newsDialog"
            :news="newsItem"
            @saved="getData()"
        ></news-form>

<!--        Confirm Delete-->
        <confirm
            v-if="deleteItem"
            v-model="deleteDialog"
            :loading="deleteLoading"
            @confirmed="destroy()"
        ></confirm>
    </v-card>
</template>
<script>
import Confirm from "../../../components/Confirm";
import NewsForm from "./components/NewsForm";
import Avatar from "../../../components/Avatar";
export default {
    name: 'News',
    components: {Confirm,NewsForm,Avatar},
    props: {
        articles: {
            required: true,
            type: Object
        },
        // countries: {
        //     required: true,
        //     type: Array
        // },
        // genders: {
        //     required: true,
        //     type: Array
        // },
    },
    data(){
        return {
            loading: false,
            query: {
                search: null,
                page: 1
            },
            headers: [
                { text: 'Image', value: 'image' },
                { text: 'Default Title', value: 'localization.title' },
                { text: 'Default Description', value: 'localization.description' },
                // { text: 'Phone', value: 'phone' },
                // { text: 'Email', value: 'email' },
                // { text: 'Title', value: 'localizations.en.title' },
                // { text: 'Examination', value: 'examination' },
                // { text: 'Lesson', value: 'lesson' },
                // { text: 'Activities', value: 'completed' },
                // { text: 'Words', value: 'words' },
                // { text: 'Registered', value: 'date_formatted' },
                { text: 'Actions', value: 'actions'},
            ],
            paginate: this.articles,

            newsDialog: false,
            newsItem: null,

            deleteDialog: false,
            deleteItem: null,
            deleteLoading: false
        }
    },
    methods: {
        showForm(item = null){
            // this.newsItem = item;
            this.newsDialog = true;
            axios.get(this.$store.state.path+'news/info/'+item.id)
                .then(response => {
                    this.loading = false;
                    this.newsItem = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                })
        },
        showDelete(item = null){
            this.deleteItem = item;
            this.deleteDialog = true;
        },

        getData(q = {}){
            for (const [key, value] of Object.entries(q)) {
                this.query[key] = value;
            }
            if (!q.page){
                this.query.page = 1;
            }
            this.loading = true;
            axios.get(this.$store.state.path+'news/paginate',{ params: this.query })
                .then(response => {
                    this.loading = false;
                    this.paginate = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                })
        },

        destroy(){
            this.deleteLoading = true;
            axios.delete(this.$store.state.path+'news/delete/'+this.deleteItem.id)
                .then(response => {
                    this.getData({page: this.paginate.current_page})
                    this.deleteLoading = false;
                    this.deleteDialog = false;
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                })
                .catch(error => {
                    this.deleteLoading = false;
                    this.__errorResponse(error);
                })
        }
    }
}
</script>
