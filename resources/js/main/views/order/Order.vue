<template>
    <div :class="__smallDesktop? '': 'd-flex flex-column'"  class="w-100 justify-center align-center">

        <!-- Form -->
        <div style="max-width: 65rem">
            <div class="py-16 mb-16">
                <h2 :class="__smallDesktop? 'display-1 px-2': 'display-3'" class="text-center mb-4 secondary--text">
                    {{ texts.order_1 }}
                </h2>
                <p :class="__smallDesktop? 'flex-column': ''" class="text-center mb-8 lh-initial subtitle--text d-flex">
                    <span>
                        <v-icon color="primary" class="mr-2">mdi-checkbox-marked-circle-outline</v-icon>
                        <span class="mr-4 lh-initial">{{ texts.order_2 }}</span>
                    </span>
                    <span>
                        <v-icon color="primary" class="mr-2">mdi-checkbox-marked-circle-outline</v-icon>
                        <span class="lh-initial">{{ texts.order_3 }}</span>
                    </span>
                </p>

                <order-form></order-form>

                <v-divider></v-divider>
            </div>

        </div>

        <!-- Delivered Orders -->
        <delivered-orders></delivered-orders>

<!--        &lt;!&ndash; News &ndash;&gt;-->
<!--        <newsletter></newsletter>-->
    </div>
</template>
<script>
import DeliveredOrders from "../../components/sections/DeliveredOrders";
import Newsletter from "../../components/sections/Newsletter";
import OrderForm from "./OrderForm";
import Screen from "../../../mixins/Screen";
export default {
    name: 'Order',
    mixins: [Screen],
    components: {OrderForm, Newsletter, DeliveredOrders},
    data(){
        return {}
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    }
}
</script>
