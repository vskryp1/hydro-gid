<template>
    <div class="d-flex flex-column w-100 justify-center align-center">

        <deliver-carousel></deliver-carousel>
        <section class="w-100 mb-10">
            <v-card class="d-flex justify-center pa-8">
                <div class="d-flex flex-column align-center justify-center" style="width: 60rem;max-width: 75rem">
                    <v-row no-gutters>
                        <v-col cols="12" lg="4" md="4" sm="4" class="d-flex">
                            <v-avatar color="indigo" size="30" class="mr-3 ml-3">
                                <v-icon dark>
                                    mdi-check
                                </v-icon>
                            </v-avatar>
                            <div>
                                <p class="font-weight-bold fs-18">
                                  {{ texts.deliver_21 }}
                                </p>
                                <p>
                                  {{ texts.deliver_22 }}
                                </p>
                            </div>
                        </v-col>
                        <v-col cols="12" lg="4" md="4" sm="4" class="d-flex">
                            <v-avatar color="indigo" size="30" class="mr-3 ml-3">
                                <v-icon dark>
                                    mdi-check
                                </v-icon>
                            </v-avatar>
                            <div>
                                <p class="font-weight-bold fs-18">
                                  {{ texts.deliver_23 }}
                                </p>
                                <p>
                                  {{ texts.deliver_24 }}
                                </p>
                            </div>
                        </v-col>
                        <v-col cols="12" lg="4" md="4" sm="4" class="d-flex">
                            <v-avatar color="indigo" size="30" class="mr-3 ml-3">
                                <v-icon dark>
                                    mdi-check
                                </v-icon>
                            </v-avatar>
                            <div>
                                <p class="font-weight-bold fs-18">
                                  {{ texts.deliver_25 }}
                                </p>
                                <p>
                                  {{ texts.deliver_26 }}
                                </p>
                            </div>
                        </v-col>
                    </v-row>
                </div>
            </v-card>
        </section>


        <!-- Popular Destinations -->
        <popular-destinations></popular-destinations>

        <!-- Popular Destinations -->
        <how-earn></how-earn>

        <!-- Popular Destinations -->
        <faq></faq>

    </div>
</template>
<script>
import createNumberMask from 'text-mask-addons/dist/createNumberMask';
import DeliveredOrders from "../../components/sections/DeliveredOrders";
import Newsletter from "../../components/sections/Newsletter";
import AvatarInput from "../../../components/form/AvatarInput/AvatarInput";
import Order from "../../models/Order";
import SelectPhone from "../../../components/form/SelectPhone";
import Avatar from "../../../components/Avatar";
import Helpers from "../../../mixins/Helpers";
import AddressInput from "../../../components/form/AddressInput";
import DeliverCarousel from "../../components/sections/DeliverCarousel";
import PopularDestinations from "../../components/sections/PopularDestinations";
import Faq from "../../components/sections/Faq";
import HowEarn from "../../components/sections/HowEarn";
export default {
    name: 'Deliver',
    components: {
        HowEarn,
        Faq,
        PopularDestinations,
        AddressInput, Avatar, SelectPhone, AvatarInput, Newsletter, DeliveredOrders,DeliverCarousel},
    mixins: [Helpers],
    data(){
        return {
            step: 1,
            orderObj: new Order(),
            currencyMask: createNumberMask({
                prefix: '$',
                allowDecimal: true,
                includeThousandsSeparator: true,
                allowNegative: false,
            }),
            loading: false,
            waiting: [],
            images: [],
            priceInt: 0,
            totalPrice: 0,
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        },

        waitingTo(){
            return this.waiting.find(i => i.value === this.orderObj.values.waiting_time);
        }
    },
    methods: {
        next(scope){
            this.$validator.validateAll(scope).then(valid => {
                if (valid){
                    this.step++;
                    if (scope === 'route'){
                        this.totalPrice = (this.priceInt*this.orderObj.values.quantity)+((this.$store.state.settings.payment_system_commission+this.$store.state.settings.esco_commission)*(this.priceInt*this.orderObj.values.quantity)/100)
                    }
                }
            })
            // this.step ++;
        },

        renderImages(){
            this.images = [];
            this.orderObj.values.image_files.forEach(file => {
                this.images.push(URL.createObjectURL(file))
            })
        },
        save(){
            this.loading = true;
            this.orderObj.create(this.$store.state.path+'order/save')
                .then(response => {
                    this.loading = false;
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                    window.location.href = this.$store.state.dashboardPath+'orders';
                })
                .catch(error => {
                    this.loading = false;
                    this.__errorResponse(error);
                })
        },

        initialize() {
            // const input = document.getElementById('addressFrom');
            // const autocomplete = new google.maps.places.Autocomplete(input);
        }
    },
    created() {
        this.$data.__dataRoute = 'order/data';
        this.__getData({loader: true});
    }
}
</script>
