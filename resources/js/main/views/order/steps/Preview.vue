<template>
    <v-card class="mb-8" min-height="12.5rem">
        <v-card-text class="pt-8 px-8 py-12">
            <v-row justify="center">
                <v-col cols="12" class="d-flex justify-center mb-8">
                    <v-slide-group show-arrows>
                        <v-slide-item v-for="(item, index) in images" :key="index">
                            <avatar
                                size="10rem"
                                :rounded="true"
                                :avatar="item"
                                class="ml-2"
                            ></avatar>
                        </v-slide-item>
                    </v-slide-group>
                </v-col>
                <v-col cols="12" md="6">
                    <div class="d-flex justify-space-between mb-4">
                        <span class="fs-18 subtitle--text">{{ texts.order_21 }}</span>
                        <span class="fs-18 font-weight-medium secondary--text">{{ orderObj.values.from_address }}</span>
                    </div>
                    <div class="d-flex justify-space-between mb-4">
                        <span class="fs-18 subtitle--text">{{ texts.order_22 }}</span>
                        <span class="fs-18 font-weight-medium secondary--text">{{ orderObj.values.to_address }}</span>
                    </div>
                    <div v-if="waitingTo" class="d-flex justify-space-between mb-4">
                        <span class="fs-18 subtitle--text">{{ texts.order_23 }}</span>
                        <span class="fs-18 font-weight-medium secondary--text">{{ waitingTo.date }}</span>
                    </div>
                    <v-divider class="mb-6"></v-divider>
                    <div class="d-flex justify-space-between">
                        <span class="fs-18 subtitle--text">{{ texts.order_12 }}</span>
                        <span class="fs-18 font-weight-medium secondary--text">{{ orderObj.values.quantity }}</span>
                    </div>
                </v-col>

                <v-col cols="8">
                    <v-divider class="my-10 primary elevation-8"></v-divider>
                </v-col>

                <v-col cols="12" md="6">
                    <div class="d-flex justify-space-between mb-4">
                        <span class="fs-18 subtitle--text">{{ texts.order_27 }}</span>
                        <span class="fs-18 font-weight-medium secondary--text">{{ __formatAmount(priceInt)  }} * {{ orderObj.values.quantity }}</span>
                    </div>
                    <div class="d-flex justify-space-between mb-4">
                        <span class="fs-18 subtitle--text">{{ texts.order_24 }}</span>
                        <span class="fs-18 font-weight-medium secondary--text">{{ $store.state.texts.contract_price }}</span>
                    </div>
                    <div class="d-flex justify-space-between mb-4">
                        <span class="fs-18 subtitle--text">{{ texts.order_25 }}</span>
                        <span class="fs-18 font-weight-medium secondary--text">{{ escoCommission }} %</span>
                    </div>
                    <div class="d-flex justify-space-between mb-4">
                        <span class="fs-18 subtitle--text">{{ texts.order_26 }}</span>
                        <span class="fs-18 font-weight-medium secondary--text">{{ commission }} %</span>
                    </div>
                    <v-divider class="mb-6"></v-divider>
                    <div class="d-flex justify-space-between mb-4">
                        <span class="fs-18 secondary--text">{{ texts.order_27 }}:</span>
                        <span class="fs-18 font-weight-bold primary--text">{{  __formatAmount(totalPrice) }} + {{ texts.order_24 }}</span>
                    </div>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>
<script>
import Avatar from "../../../../components/Avatar";
import Helpers from "../../../../mixins/Helpers";
export default {
    name: 'Preview',
    mixins: [Helpers],
    components: {Avatar},
    props: {
        orderObj: {
            required: true,
            type: Object
        },
        images: {
            default: () => []
        },
        waiting: {
            default: () => []
        }
    },
    computed: {
        waitingTo(){
            return this.waiting.find(i => i.value === this.orderObj.values.waiting_time);
        },
        priceInt(){
            return this.orderObj.values.price?
                this.orderObj.values.price
                    .replace('.00', '')
                    .replace(/[^0-9 ]/g, ''):
                null;
        },
        commission(){
            return this.$store.state.settings.payment_system_commission;
        },
        escoCommission(){
            return this.$store.state.settings.esco_commission;
        },
        totalPrice(){
            return this.priceInt? (this.priceInt*this.orderObj.values.quantity)+
                ((this.commission+this.escoCommission)*(this.priceInt*this.orderObj.values.quantity)/100): 0;
        },
        texts(){
            return this.$store.state.texts;
        }
    }
}
</script>
