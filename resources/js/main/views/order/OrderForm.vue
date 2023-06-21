<template>
    <v-stepper v-model="step" vertical class="transparent" flat>

        <!--Information-->
        <v-stepper-step step="1" :complete="step > 1">
            {{ texts.order_4 }}
        </v-stepper-step>
        <v-stepper-content step="1">

            <info ref="order" :order-obj="orderObj" @renderImages="images = $event"></info>

            <v-btn @click="next('order')" color="primary">
                {{$store.state.texts.continue}}
            </v-btn>
        </v-stepper-content>

        <!--Address and Date-->
        <v-stepper-step step="2" :complete="step > 2">
            {{ texts.order_15 }}
        </v-stepper-step>
        <v-stepper-content step="2">

            <route ref="route" :order-obj="orderObj" :waiting="waiting"></route>

            <v-btn @click="step --" class="mr-2" text>
                <v-icon>mdi-chevron-left</v-icon><span class="mr-2"> {{$store.state.texts.back}}</span>
            </v-btn>
            <v-btn color="primary" @click="next('route')">
                {{$store.state.texts.continue}}
            </v-btn>
        </v-stepper-content>

        <!--Preview-->
        <v-stepper-step step="3" :complete="step > 3">
            {{$store.state.texts.order_overview}}
        </v-stepper-step>
        <v-stepper-content step="3">

            <preview
                :order-obj="orderObj"
                :images="images"
                :waiting="waiting"
            ></preview>

            <v-btn @click="step --" class="mr-2" text>
                <v-icon>mdi-chevron-left</v-icon><span class="mr-2">{{$store.state.texts.back}}</span>
            </v-btn>
            <v-btn @click="__middlewareAuth(save)" :loading="loading" color="primary">
                {{$store.state.texts.save}}
            </v-btn>
        </v-stepper-content>
    </v-stepper>
</template>
<script>
import Order from "../../models/Order";
import Helpers from "../../../mixins/Helpers";
import Preview from "./steps/Preview";
import Route from "./steps/Route";
import Info from "./steps/Info";

export default {
    name: 'OrderForm',
    components: {Info, Route, Preview},
    mixins: [Helpers],
    data(){
        return {
            step: 1,
            orderObj: new Order(),

            loading: false,
            waiting: [],
            images: [],
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        },
    },
    methods: {
        next(ref){
            this.$refs[ref].$validator.validateAll().then(valid => {
                if (valid && !this.$refs[ref].errors.items.length){
                    this.step++;
                }
            })
            // this.step++;
        },
        save(){
            fbq('init', '185425124483639');
            fbq('track', 'PageView');
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
    },
    created() {
        this.$data.__dataRoute = 'order/data';
        this.__getData({loader: true});
    }

}
</script>
