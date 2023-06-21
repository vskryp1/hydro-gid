<template>
    <v-card class="h-100 d-flex flex-column" style="min-height: 78vh;">
        <v-card-title class="py-2 elevation-4 mb-4" style="z-index: 1">
            <h2 class="mr-4 fs-24 font-weight-regular">Orders</h2>
            <v-spacer></v-spacer>
            <v-text-field
                class="mt-0 pt-0 mb-1 mr-6"
                @input="__getPaginate({search: $event})"
                :value="$data.__paginateQuery.search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
                clearable
                style="max-width: 15rem"
            ></v-text-field>

            <a href="/" style="margin-left: 15px; margin-right: 5px;  margin-top: 16px;" class="d-md-block d-lg-none v-btn v-btn--is-elevated v-btn--has-bg v-btn--tile theme--light v-size--small primary"><span class="v-btn__content">Home</span></a>
            <a style="margin-right: 5px;  margin-top: 16px;" href="/dashboard/profile"  class="d-md-block d-lg-none v-btn v-btn--is-elevated v-btn--has-bg v-btn--tile theme--light v-size--small primary"><span class="v-btn__content">Profile</span></a>
            <v-btn @click="showForm()" :class="__smallDesktop? 'mt-4': ''" tile small color="primary">+ Add new order</v-btn>

        </v-card-title>
        <v-card-text class="py-0">
            <v-data-table
                v-if="$data.__paginate"
                :headers="headers"
                :items="$data.__paginate.data"
                hide-default-footer
                :loading="$data.__dataLoading"
                loader-height="1"
                disable-sort
                disable-pagination
            >

                <template v-slot:item.from="{ item }">
                    <div class="d-flex align-center">
                        <avatar :object="item.from_location.country" :offset-right="true" size="1.5rem"></avatar>
                        <span class="em-small-text secondary--text">{{ item.from_location.address }}</span>
                    </div>
                </template>

                <template v-slot:item.to="{ item }">
                    <div class="d-flex align-center">
                        <avatar :object="item.to_location.country" :offset-right="true" size="1.5rem"></avatar>
                        <span class="em-small-text secondary--text">{{ item.to_location.address }}</span>
                    </div>
                </template>

                <template v-slot:item.price="{ item }">
                    <span class="font-weight-medium fs-15">{{ __formatAmount(item.price) }}</span>
                </template>

                <template v-slot:item.url="{ item }">
                    <a :href="item.url" target="_blank" style="max-width: 15rem" class="em-cut-text d-block">{{ item.url }}</a>
                </template>

                 <template v-slot:item.image="{ item }">
                    <avatar :object="item" size="3.125rem"></avatar>
                </template>

                <template v-slot:item.description="{ item }">
                    <v-menu :close-on-content-click="false" max-width="20rem">
                        <template v-slot:activator="{on}">
                            <div v-on="on" style="max-width: 15rem" class="em-cut-text d-block pointer">
                                {{ item.description }}
                            </div>
                        </template>
                        <v-card>
                            <v-card-text>{{ item.description }}</v-card-text>
                        </v-card>
                    </v-menu>
                </template>

                <template v-slot:item.status="{ item }">
                    <v-chip small label :color="statusColor(item.status)">
                        <span class="text-capitalize white--text">{{ item.status }}</span>
                    </v-chip>
                </template>

                <template v-slot:item.actions="{ item }">
                    <div class="d-flex align-center">
                        <v-btn @click="showForm(item)" icon small color="primary">
                            <v-icon small color="primary">mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn
                            @click="$store.commit('confirm', {callback: destroy, args: item.id, btnText: 'Delete'})"
                            :loading="destroyId === item.id"
                            icon
                            small
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
                v-if="$data.__paginate"
                @input="__getPaginate({page: $event})"
                :value="$data.__paginate.current_page"
                :length="Math.ceil($data.__paginate.total/$data.__paginate.per_page)"
                total-visible="10"
            ></v-pagination>
        </v-card-actions>

        <!--Order Form-->
        <order-form
            v-model="orderDialog"
            :order="orderItem"
            :waiting="waiting"
            @saved="__getPaginate()"
        ></order-form>
    </v-card>
</template>
<script>
import Helpers from "../../../mixins/Helpers";
import OrderForm from "./OrderForm";
import Avatar from "../../../components/Avatar";
import Screen from "../../../mixins/Screen";

export default {
    name: 'Orders',
    components: {Avatar, OrderForm},
    mixins: [Helpers, Screen],
    data(){
        return {
            headers: [
                { text: 'From', value: 'from' },
                { text: 'To', value: 'to' },
                { text: 'Name', value: 'name' },
                { text: 'Image', value: 'image' },
                { text: 'URL', value: 'url' },
                { text: 'Quantity', value: 'quantity' },
                { text: 'Price', value: 'price' },
                { text: 'Description', value: 'description' },
                { text: 'Status', value: 'status' },
                { text: 'Actions', value: 'actions'},
            ],

            waiting: [],
            destroyId: null,
            orderDialog: false,
            orderItem: null
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

        showForm(item = null){
            this.orderItem = item;
            this.orderDialog = true;
        },

        destroy(id){
            this.destroyId = id
            axios.delete(this.$store.state.path+'orders/destroy/'+id)
                .then(response => {
                    this.destroyId = null;
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                    this.__getPaginate();
                })
                .catch(error => {
                    this.destroyId = null;
                    this.__errorResponse(error);
                })
        }
    },
    created() {
        this.$data.__dataRoute = 'orders/data';
        this.$data.__paginateRoute = 'orders/paginate';

        this.__getData({loader: true, locals: ['paginate']});
    }
}
</script>
