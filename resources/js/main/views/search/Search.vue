<template>
    <div>
        <div class="mx-auto" style="max-width: 75rem;margin-top: 20px">
            <v-row>
                <v-col cols="12" md="8">

                    <template v-if="paginate">
                        <order-card
                            v-for="item in paginate.data"
                            :key="item.id"
                            :item="item"
                            :zoom="true"
                            @showSuggest="showSuggest"
                            @getData="getData()"
                        ></order-card>
<!--                        <div v-for="item in paginate.data" :key="item.id" style="height: 22rem" class="position-relative mb-4">-->
<!--                            <v-card-->
<!--                                tile-->
<!--                                :class="__smallDesktop? 'zoom-card': ''"-->
<!--                                class="position-absolute t-0 r-0"-->
<!--                                style="max-width: unset;"-->
<!--                            >-->
<!--                                <v-card-text class="d-flex">-->
<!--                                    <div v-if="!__smallDesktop" style="width: 22rem; height: 20rem" class="mr-4">-->
<!--                                        <v-carousel-->
<!--                                            height="20rem"-->
<!--                                            hide-delimiter-background-->
<!--                                            show-arrows-on-hover-->
<!--                                            hide-delimiters-->
<!--                                            progress-->
<!--                                            progress-color="secondary"-->
<!--                                        >-->
<!--                                            <v-carousel-item v-for="(image, i) in item.images" :key="'image'+i">-->
<!--                                                <v-img width="22rem" height="20rem" :src="image.uri"></v-img>-->
<!--                                            </v-carousel-item>-->
<!--                                        </v-carousel>-->
<!--                                    </div>-->
<!--                                    <div class="w-100 d-flex flex-column">-->
<!--                                        <div>-->
<!--                                            <h2 class="font-weight-medium fs-24 secondary&#45;&#45;text mb-4 em-cut-text" style="width: 22rem">-->
<!--                                                {{ item.name }}-->
<!--                                            </h2>-->
<!--                                            <div class="d-flex align-center mb-2">-->
<!--                                                <avatar-->
<!--                                                    v-if="item.from_location.country"-->
<!--                                                    :object="item.from_location.country"-->
<!--                                                    size="1rem"-->
<!--                                                    :offset-right="true"-->
<!--                                                ></avatar>-->
<!--                                                <p class="em-small-text subtitle&#45;&#45;text mb-0">-->
<!--                                                    {{ item.from_location.address }}-->
<!--                                                </p>-->
<!--                                                <v-icon class="mx-2" small color="primary">mdi-arrow-right</v-icon>-->
<!--                                                <avatar-->
<!--                                                    v-if="item.to_location.country"-->
<!--                                                    :object="item.to_location.country"-->
<!--                                                    size="1rem"-->
<!--                                                    :offset-right="true"-->
<!--                                                ></avatar>-->
<!--                                                <p class="em-small-text subtitle&#45;&#45;text mb-0">-->
<!--                                                    {{ item.to_location.address }}-->
<!--                                                </p>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex align-center mb-4">-->
<!--                                            <span class="em-small-text font-weight-bold secondary&#45;&#45;text mb-0">-->
<!--                                                Not later {{ item.wait_to }}-->
<!--                                            </span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex align-center justify-space-between mb-4">-->
<!--                                                <v-chip outlined color="primary" class="pl-0 mr-4">-->
<!--                                                    <div class="d-flex align-center">-->
<!--                                                        <avatar-->
<!--                                                            :object="item.user"-->
<!--                                                            size="2.5rem"-->
<!--                                                            :offset-right="true"-->
<!--                                                        ></avatar>-->
<!--                                                        <p class="em-small-text primary&#45;&#45;text mb-0">-->
<!--                                                            {{ item.user.name }}-->
<!--                                                        </p>-->
<!--                                                    </div>-->
<!--                                                </v-chip>-->
<!--                                                <div v-if="item.url">-->
<!--                                                    <a :href="item.url" target="_blank" class="primary&#45;&#45;text">-->
<!--                                                        <v-icon color="primary">mdi-eye</v-icon>-->
<!--                                                        <span>View on site</span>-->
<!--                                                    </a>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <v-divider class="mb-4"></v-divider>-->
<!--                                            <div class="d-flex align-center justify-space-between mb-2">-->
<!--                                        <span class="em-small-text subtitle&#45;&#45;text">-->
<!--                                            Quantity-->
<!--                                        </span>-->
<!--                                                <span class="em-small-text font-weight-bold secondary&#45;&#45;text">-->
<!--                                            x{{ item.quantity }}-->
<!--                                        </span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex align-center justify-space-between mb-2">-->
<!--                                            <span class="em-small-text subtitle&#45;&#45;text">-->
<!--                                                Price-->
<!--                                            </span>-->
<!--                                                <span class="em-small-text font-weight-bold secondary&#45;&#45;text">-->
<!--                                            {{ __formatAmount(item.price) }}-->
<!--                                        </span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex align-center justify-space-between mb-2">-->
<!--                                            <span class="em-small-text subtitle&#45;&#45;text">-->
<!--                                                Total Price-->
<!--                                            </span>-->
<!--                                                <span class="em-small-text font-weight-bold secondary&#45;&#45;text">-->
<!--                                            {{ __formatAmount(item.total_price) }}-->
<!--                                        </span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex align-center justify-space-between mb-6">-->
<!--                                        <span class="em-small-text subtitle&#45;&#45;text">-->
<!--                                            Reward-->
<!--                                        </span>-->
<!--                                                <span class="em-small-text font-weight-bold secondary&#45;&#45;text">-->
<!--                                            {{ $store.state.texts.contract_price }}-->
<!--                                        </span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <v-spacer></v-spacer>-->
<!--                                        <div>-->
<!--                                            <v-btn-->
<!--                                                :disabled="user && !item.can_suggest"-->
<!--                                                @click="user? showSuggest(item): __middlewareAuth(getData)"-->
<!--                                                height="2.5rem"-->
<!--                                                block-->
<!--                                                color="primary"-->
<!--                                            >-->
<!--                                                Suggest delivery-->
<!--                                            </v-btn>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </v-card-text>-->
<!--                            </v-card>-->
<!--                        </div>-->
                    </template>

                </v-col>
                <v-col cols="12" md="4">
                    <v-card tile class="mb-6">
                        <v-card-text class="pa-6">

                            <address-input
                                label="From"
                                :hide-details="true"
                                :clearable="true"
                                v-model="query.from_address"
                                @placeChanged="query.from_obj = $event"
                            ></address-input>
                            <v-btn @click="replaceLocations()" icon small color="primary" >
                                <v-icon color="primary">mdi-swap-horizontal</v-icon>
                            </v-btn>
                            <address-input
                                label="To"
                                :hide-details="true"
                                :clearable="true"
                                v-model="query.to_address"
                                @placeChanged="query.to_obj = $event"
                            ></address-input>

                        </v-card-text>
                    </v-card>
                    <v-card tile class="mb-6">
                        <v-card-text class="pa-6">
                            <p class="font-weight-medium em-medium-text secondary--text mb-1">Sort</p>
                            <v-select
                                class="pt-0"
                                v-model="query.sort"
                                :items="sort"
                                item-text="name"
                                item-value="value"
                                outlined
                                hide-details
                            ></v-select>
                        </v-card-text>
                    </v-card>
                    <v-card tile class="mb-6">
                        <v-card-text class="pa-6">
                            <p class="font-weight-medium em-medium-text secondary--text mb-1">Name</p>
                            <v-text-field
                                class="pt-0"
                                placeholder="Name of Product"
                                v-model="query.name"
                                outlined
                            ></v-text-field>
                            <p class="font-weight-medium em-medium-text secondary--text mb-1">Price</p>
                            <v-row>
                                <v-col cols="6">
                                    <v-text-field
                                        class="pt-0"
                                        placeholder="From"
                                        v-model="query.price_from"
                                        hide-details
                                        outlined
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="6">
                                    <v-text-field
                                        class="pt-0"
                                        placeholder="To"
                                        v-model="query.price_to"
                                        outlined
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                    <v-card tile class="mb-6">
                        <v-card-text class="pa-6">
                            <v-btn
                                @click="getData()"
                                :loading="loading"
                                class="h-100 pa-3"
                                color="primary"
                                block
                            >
                                Search Orders
                            </v-btn>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </div>

        <!--Suggest Dialog-->
        <suggest-delivery
            v-if="suggestOrder"
            v-model="suggestDialog"
            :order="suggestOrder"
            @suggestSent="getData()"
        ></suggest-delivery>
    </div>
</template>
<script>
import AddressInput from "../../../components/form/AddressInput";
import Screen from "../../../mixins/Screen";
import Helpers from "../../../mixins/Helpers";
import Avatar from "../../../components/Avatar";
import SuggestDelivery from "../../components/modals/SuggestDelivery";
import OrderCard from "../../../components/order/OrderCard";

export default {
    name: 'Search',
    mixins: [Screen, Helpers],
    components: {OrderCard, SuggestDelivery, Avatar, AddressInput},
    data(){
        return {
            query: {
                from: null,
                from_obj: null,
                from_address: null,

                to: null,
                to_obj: null,
                to_address: null,

                sort: 'price_ascending',
                name: null,
                price_from: null,
                price_to: null,
            },
            sort: [
                {name: 'Price Ascending', value: 'price_ascending'},
                {name: 'Price Descending', value: 'price_descending'},
            ],

            paginate: null,
            loading: false,

            suggestDialog: false,
            suggestOrder: null
        }
    },
    computed: {
        fromCountry(){
            return this.query.from? this.$store.state.countries.find(c => c.id === this.query.from): null;
        },
        toCountry(){
            return this.query.to? this.$store.state.countries.find(c => c.id === this.query.to): null;
        },
        commission(){
            return this.$store.state.settings.payment_system_commission;
        },
        escoCommission(){
            return this.$store.state.settings.esco_commission;
        },
        user(){
            return this.$store.state.user;
        }
    },
    methods: {
        showSuggest(item){
            this.suggestOrder = item;
            this.suggestDialog = true;
        },

        getParams(){
            const params = this.__copyObject(this.__getRouteQuery());
            for (const [key, value] of Object.entries(params)) {
                this.query[key] =
                    (key === 'to' || key === 'from') && !isNaN(value)?
                        parseInt(value): value;
            }

            if (this.fromCountry){
                this.query.from_address = this.fromCountry.name
            }
            if (this.toCountry){
                this.query.to_address = this.toCountry.name
            }

            this.getData();
        },

        replaceLocations(){
            let qFrom = this.query.from;
            let qFromAddress = this.query.from_address;
            let qFromObj = this.__copyObject(this.query.from_obj);

            this.query.from = this.query.to;
            this.query.from_address = this.query.to_address;
            this.query.from_obj = this.__copyObject(this.query.to_obj);

            this.query.to = qFrom;
            this.query.to_address = qFromAddress;
            this.query.to_obj = qFromObj;
        },

        calcPrice(item){
            return (parseInt(item.price)*parseInt(item.quantity));
        },

        getData(){
            this.loading = true;
            axios.get(this.$store.state.path+'search/paginate', {params: this.query})
                .then(response => {
                    this.loading = false;
                    this.paginate = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.$store.commit("setAlert", {
                        type: "error",
                        message: error.response.data.message,
                    });
                })
        },
    },
    mounted() {

    },
    created() {
        this.getParams();
    }
}
</script>
<style>
.zoom-card:hover {
    z-index: 99;
    animation: zoom-in 1s ease;
    transform: scale(1.2, 1.2);
}
@keyframes zoom-in {
    0% {
        transform: scale(1, 1);
        width: 100%;
    }
    100% {
        transform: scale(1.2, 1.2);
    }
}
</style>
