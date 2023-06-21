<template>
    <v-card class="h-100 d-flex flex-column">
        <v-card-title class="py-2 elevation-4 mb-4" style="z-index: 1">
            <h2 class="mr-4 fs-24 font-weight-regular">Users</h2>
            <v-spacer></v-spacer>
            <v-autocomplete
                class="mt-0 pt-0 mb-1 mr-6"
                @input="getData({country: $event})"
                :value="query.country"
                label="Country"
                single-line
                hide-details
                clearable
                :items="countries"
                item-text="name"
                item-value="id"
                style="max-width: 15rem"
            >
                <template v-slot:selection="{ item }">
                    <div class="d-flex align-center">
                        <avatar :elevation="true" size="1.5rem" :object="item" :offset-right="true"></avatar>
                        <span>{{ item.name }}</span>
                    </div>
                </template>
                <template v-slot:item="{ item }">
                    <div class="d-flex align-center">
                        <avatar :elevation="true" size="1.5rem" :object="item" :offset-right="true"></avatar>
                        <span>{{ item.name }}</span>
                    </div>
                </template>
            </v-autocomplete>
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

                <!--User Info-->
                <template v-slot:item.user="{ item }">
                    <v-menu tile offset-y :close-on-content-click="false">
                        <template v-slot:activator="{on}">
                            <button
                                v-on="on"
                                v-ripple
                                class="d-flex justify-space-between py-2 px-4 w-100"
                                style="margin-left: -1rem; height: 3.5rem;"
                            >
                                <div class="d-flex align-center pr-2">
                                    <avatar size="2rem" :object="item" :offset-right="true"></avatar>
                                    <div>
                                        <div class="lh-initial text-left">
                                            <span class="font-weight-bold fs-12 mr-2 lh-initial">{{ item.name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <v-icon small class="align-self-baseline" color="primary">mdi-information-outline</v-icon>
                            </button>
                        </template>
                        <v-card tile class="px-4 py-2">
                            <table class="w-100" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="pr-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                        <span class="em-small-text lh-initial">Name</span>
                                    </td>
                                    <td class="pl-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                        <span class="em-small-text font-weight-medium lh-initial">{{ item.name }}</span>
                                    </td>
                                </tr>
                                <tr v-if="item.country">
                                    <td class="pr-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                        <span class="em-small-text lh-initial">Country</span>
                                    </td>
                                    <td class="pl-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                        <div class="d-flex align-center">
                                            <avatar size="1rem" :object="item.country" :offset-right="true"></avatar>
                                            <span class="em-small-text lh-initial font-weight-medium">{{ item.country.name }}</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="item.address">
                                    <td class="pr-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                        <span class="em-small-text lh-initial">Address</span>
                                    </td>
                                    <td class="pl-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                        <div class="d-flex align-center">
                                            <span class="em-small-text lh-initial font-weight-medium">{{ item.address }}</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                        <span class="em-small-text lh-initial">Phone</span>
                                    </td>
                                    <td class="pl-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                        <a :href="`tel:${item.phone}`" class="grey--text em-small-text text--darken-2" style="text-decoration: underline">{{ item.phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-1 py-2">
                                        <span class="em-small-text lh-initial">Email</span>
                                    </td>
                                    <td class="pl-1 py-2">
                                        <a :href="`mailto:${item.email}`" class="grey--text em-small-text text--darken-2" style="text-decoration: underline">{{ item.email }}</a>
                                    </td>
                                </tr>
                            </table>
                        </v-card>
                    </v-menu>
                </template>

                <!--Actions-->
                <template v-slot:item.actions="{ item }">
                    <div class="d-flex align-center justify-end">
                        <v-btn @click="showDelete(item)" icon color="red">
                            <v-icon color="red">mdi-close</v-icon>
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

        <!--Confirm Delete-->
        <confirm
            v-if="deleteItem"
            v-model="deleteDialog"
            :loading="deleteLoading"
            @confirmed="destroy()"
        ></confirm>
    </v-card>
</template>
<script>
import Avatar from "../../../components/Avatar";
import Confirm from "../../../components/Confirm";
export default {
    name: 'Users',
    components: {Confirm, Avatar},
    props: {
        users: {
            required: true,
            type: Object
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
                country: null,
                search: null,
                page: 1
            },
            headers: [
                { text: 'User', value: 'user' },
                { text: 'Orders Count', value: 'orders_count' },
                { text: 'Trips Count', value: 'trips_count' },
                { text: 'Active Chats', value: 'chats_count' },
                { text: 'Registered', value: 'date_formatted' },
                { text: 'Actions', value: 'actions'},
            ],
            paginate: this.users,

            deleteDialog: false,
            deleteItem: null,
            deleteLoading: false
        }
    },
    methods: {
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
            axios.get(this.$store.state.path+'users/paginate',{ params: this.query })
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
            axios.delete(this.$store.state.path+'users/delete/'+this.deleteItem.id)
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
