<template>
    <div>
    <!--      Filters  -->
    <v-card-title class="py-2 elevation-4 mb-4" style="z-index: 1">
        <h2 class="mr-4 fs-24 font-weight-regular">Orders</h2>
        <v-spacer></v-spacer>
        <v-autocomplete
            class="mt-0 pt-0 mb-1 mr-6"
            @input="getData({from_country: $event})"
            :value="query.from_country"
            label="From Country"
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
        <v-autocomplete
            class="mt-0 pt-0 mb-1 mr-6"
            @input="getData({to_country: $event})"
            :value="query.to_country"
            label="To Country"
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
    <!--      End Filters  -->
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
                        style="margin-left: -1rem;"
                    >
                        <div class="d-flex align-center pr-2">
                            <avatar size="2rem" :object="item.user" :offset-right="true"></avatar>
                            <div>
                                <div class="lh-initial text-left">
                                    <span class="font-weight-bold fs-12 mr-2 lh-initial">{{ item.user.name }}</span>
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
                                <span class="em-small-text font-weight-medium lh-initial">{{ item.user.name }}</span>
                            </td>
                        </tr>
                        <tr v-if="item.user.country">
                            <td class="pr-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                <span class="em-small-text lh-initial">Country</span>
                            </td>
                            <td class="pl-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                <div class="d-flex align-center">
                                    <avatar size="1rem" :object="item.user.country" :offset-right="true"></avatar>
                                    <span class="em-small-text lh-initial font-weight-medium">{{ item.user.country.name }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="item.user.address">
                            <td class="pr-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                <span class="em-small-text lh-initial">Address</span>
                            </td>
                            <td class="pl-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                <div class="d-flex align-center">
                                    <span class="em-small-text lh-initial font-weight-medium">{{ item.user.address }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pr-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                <span class="em-small-text lh-initial">Phone</span>
                            </td>
                            <td class="pl-1 py-2" style="border-bottom: 1px solid #BDBDBD">
                                <a :href="`tel:${item.user.phone}`" class="grey--text em-small-text text--darken-2" style="text-decoration: underline">
                                    {{ item.user.phone }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="pr-1 py-2">
                                <span class="em-small-text lh-initial">Email</span>
                            </td>
                            <td class="pl-1 py-2">
                                <a :href="`mailto:${item.user.email}`" class="grey--text em-small-text text--darken-2" style="text-decoration: underline">
                                    {{ item.user.email }}
                                </a>
                            </td>
                        </tr>
                    </table>
                </v-card>
            </v-menu>
        </template>

        <template v-slot:item.from="{ item }">
            <v-menu tile offset-y :close-on-content-click="false">
                <template v-slot:activator="{on}">
                    <button
                        v-on="on"
                        v-ripple
                        class="d-flex justify-space-between py-2 px-4 w-100"
                        style="margin-left: -1rem;"
                    >
                        <div class="d-flex align-center">
                            <avatar :object="item.from_location.country" :offset-right="true" size="1.5rem"></avatar>
                        </div>
                        <v-icon small class="align-self-baseline ml-2" color="primary">mdi-information-outline</v-icon>
                    </button>
                </template>
                <v-card tile class="px-4 py-2" style="max-width: 20rem">
                            <span class="em-small-text font-weight-medium lh-initial">
                                {{ item.from_location.address }}
                            </span>
                </v-card>
            </v-menu>
        </template>

        <template v-slot:item.to="{ item }">
            <v-menu tile offset-y :close-on-content-click="false">
                <template v-slot:activator="{on}">
                    <button
                        v-on="on"
                        v-ripple
                        class="d-flex justify-space-between py-2 px-4 w-100"
                        style="margin-left: -1rem;"
                    >
                        <div class="d-flex align-center">
                            <avatar :object="item.to_location.country" :offset-right="true" size="1.5rem"></avatar>
                        </div>
                        <v-icon small class="align-self-baseline ml-2" color="primary">mdi-information-outline</v-icon>
                    </button>
                </template>
                <v-card tile class="px-4 py-2" style="max-width: 20rem">
                            <span class="em-small-text font-weight-medium lh-initial">
                                {{ item.to_location.address }}
                            </span>
                </v-card>
            </v-menu>
        </template>

        <template v-slot:item.name="{ item }">
            <v-menu tile offset-y :close-on-content-click="false">
                <template v-slot:activator="{on}">
                    <button
                        v-on="on"
                        v-ripple
                        class="d-flex justify-space-between py-2 px-4 w-100"
                        style="margin-left: -1rem; margin-right: -1rem"
                    >
                        <p class="mb-0 em-cut-text" style="max-width: 10rem">{{ item.name }}</p>
                        <v-btn v-if="item.url" :href="item.url" icon target="_blank" small color="primary" class="ml-2">
                            <v-icon small color="primary">mdi-open-in-new</v-icon>
                        </v-btn>
                        <v-icon small class="align-self-baseline ml-2" color="primary">mdi-information-outline</v-icon>
                    </button>
                </template>
                <v-card tile class="px-4 py-2" style="max-width: 20rem">
                    <table class="w-100" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="pr-1 py-1" style="border-bottom: 1px solid #BDBDBD; vertical-align: baseline">
                                <span class="em-small-text lh-initial">Name</span>
                            </td>
                            <td class="pl-1 py-1" style="border-bottom: 1px solid #BDBDBD">
                                <span class="em-small-text font-weight-medium lh-initial">{{ item.name }}</span>
                            </td>
                        </tr>
                        <tr v-if="item.description">
                            <td class="pr-1 py-1" style="vertical-align: baseline" :style="item.url? {'border-bottom': '1px solid #BDBDBD'}: {}">
                                <span class="em-small-text lh-initial">Description</span>
                            </td>
                            <td class="pl-1 py-2" :style="item.url? {'border-bottom': '1px solid #BDBDBD'}: {}">
                                <div class="d-flex align-center">
                                    <span class="em-small-text lh-initial font-weight-medium">{{ item.description }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="item.url">
                            <td class="pr-1 py-1" style="vertical-align: baseline">
                                <span class="em-small-text lh-initial">Url</span>
                            </td>
                            <td class="pl-1 py-1">
                                <a :href="item.url" target="_blank" class="grey--text em-small-text text--darken-2" style="text-decoration: underline">{{ item.url }}</a>
                            </td>
                        </tr>
                    </table>
                </v-card>
            </v-menu>
        </template>

        <template v-slot:item.price="{ item }">
            <span class="font-weight-medium fs-15">{{ __formatAmount(item.price) }}</span>
        </template>


        <template v-slot:item.total_price="{ item }">
            <span class="font-weight-medium fs-15">{{ __formatAmount(item.total_price) }}</span>
        </template>

        <template v-slot:item.status="{ item }">
            <v-menu tile offset-y :close-on-content-click="false">
                <template v-slot:activator="{on}">
                    <v-chip v-on="on" class="mr-2" small label :color="statusColor(item.status)">
                                <span class="text-capitalize white--text text-center" style="width: 4rem">
                                    {{ __valToText(item.status) }}
                                </span>
                    </v-chip>
                </template>
                <v-card class="px-4 py-2">
                    <v-radio-group
                        @change="updateStatus(item.id, $event)"
                        :value="item.status"
                        column
                        dense
                        hide-details
                        class="mt-0"
                    >
                        <v-radio
                            v-for="status in statuses"
                            :key="status"
                            :label="status"
                            :color="statusColor(status)"
                            :value="status"
                        >
                            <template slot="label">
                                        <span :class="status === item.status? `${statusColor(status)}--text`: 'black--text'" class="text-capitalize">
                                            {{ __valToText(status) }}
                                        </span>
                            </template>
                        </v-radio>
                    </v-radio-group>
                </v-card>
            </v-menu>
        </template>

        <template v-slot:item.actions="{ item }">
            <div class="d-flex align-center">
                <v-btn
                    @click="showDelete(item)"
                    icon
                    color="red"
                >
                    <v-icon color="red">mdi-close</v-icon>
                </v-btn>
            </div>
        </template>
    </v-data-table>

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
    </div>
</template>



<script>
    import Helpers from "../../../mixins/Helpers";
    import Confirm from "../../../components/Confirm";
    import Avatar from "../../../components/Avatar";

    export default {
        name: "OrdersActive",
        mixins: [Helpers],
        components: {Confirm, Avatar},
        props: {
            orders: { required: true, type: Object},
            headers: { required: true, type: Array },
            countries: { required: true, type: Array},
            statuses: { required: true, type: Array},
        },
        data() {
            return {
                loading: false,
                query: {
                    from_country: null,
                    to_country: null,
                    search: null,
                    page: 1
                },
                paginate: this.orders,
                deleteDialog: false,
                deleteItem: null,
                deleteLoading: false
            }
        },
        methods: {
            statusColor(status){
                switch(status) {
                    case 'completed':
                        return 'success';
                    case 'pending':
                        return 'orange';
                    case 'in_progress':
                        return 'blue';
                    case 'rejected':
                        return 'danger';
                }
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
                axios.get(this.$store.state.path+'orders/paginate',{ params: this.query })
                    .then(response => {
                        this.loading = false;
                        this.paginate = response.data;
                    })
                    .catch(error => {
                        this.loading = false;
                        this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                    })
            },

            updateStatus(id, status){
                axios.post(this.$store.state.path+'orders/update-status/'+id, {status: status})
                    .then(response => {
                        this.getData({page: this.paginate.current_page})
                        this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                    })
                    .catch(error => {
                        this.__errorResponse(error);
                    })
            },

            destroy(){
                this.deleteLoading = true;
                axios.delete(this.$store.state.path+'orders/delete/'+this.deleteItem.id)
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
