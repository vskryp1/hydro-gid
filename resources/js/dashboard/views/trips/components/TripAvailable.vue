<template>
    <v-card class="h-100 d-flex flex-column" :style="{'min-height': __smallDesktop? 'unset': '83vh'}">
        <div v-if="__smallDesktop" class="d-flex justify-end pr-1">
            <v-btn @click="$emit('close')" icon small color="danger">
                <v-icon color="danger">mdi-close</v-icon>
            </v-btn>
        </div>
        <v-card-title class="justify-space-between flex-nowrap">
            <v-btn v-if="!__smallDesktop" @click="$emit('close')" color="secondary" icon class="mr-6">
                <v-icon color="secondary">mdi-keyboard-return</v-icon>
            </v-btn>
            <div class="d-flex align-center justify-space-between w-100">
                <div class="d-flex align-center">
                    <avatar :object="trip.from_location.country" :offset-right="true" size="1.8rem"></avatar>
                    <v-icon color="primary" style="transform: rotate(45deg)">mdi-airplane</v-icon>
                </div>
                <span class="secondary--text fs-24">{{ trip.date }}</span>
                <div class="d-flex align-center">
                    <v-icon color="primary" class="mr-2" style="transform: rotate(135deg)">mdi-airplane</v-icon>
                    <avatar :object="trip.to_location.country" :offset-right="true" size="1.8rem"></avatar>
                </div>
            </div>
        </v-card-title>
        <v-divider></v-divider>
        <order-card
            v-for="(item, index) in trip.available_orders"
            :key="item.id"
            :item="item"
            :zoom="false"
            :images="true"
            :profile="true"
            :bottom-offset="index < trip.available_orders.length - 1"
            @showSuggest="showSuggest"
            @getData="$emit('getData')"
        ></order-card>

        <!--Suggest Dialog-->
        <suggest-delivery
            v-if="suggestOrder"
            v-model="suggestDialog"
            :order="suggestOrder"
            @suggestSent="$emit('getData')"
        ></suggest-delivery>
    </v-card>
</template>
<script>
import Avatar from "../../../../components/Avatar";
import OrderCard from "../../../../components/order/OrderCard";
import SuggestDelivery from "../../../../main/components/modals/SuggestDelivery";
import Screen from "../../../../mixins/Screen";
export default {
    name: 'TripAvailable',
    components: {SuggestDelivery, OrderCard, Avatar},
    mixins: [Screen],
    props: {
        trip: {
            required: true,
            type: Object
        }
    },
    data(){
        return {
            suggestDialog: false,
            suggestOrder: null
        }
    },
    methods: {
        showSuggest(item){
            this.suggestOrder = item;
            this.suggestDialog = true;
        },
    }
}
</script>
