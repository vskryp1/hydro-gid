<template>
    <v-card class="mb-8" min-height="12.5rem">
        <v-card-text class="pt-8 px-8 pb-0">
            <v-form>
                <v-row justify="center">
                    <v-col cols="12" md="6">
                        <div class="mb-8">
                            <p class="font-weight-medium em-medium-text mb-2">{{ texts.order_16 }}</p>
                            <address-input
                                name="from"
                                class="mb-2"
                                label="From Address"
                                v-validate="orderObj.rules.from_address"
                                v-model="orderObj.values.from_address"
                                :error-messages="errors.collect('from')"
                                @placeChanged="orderObj.values.from_obj = $event"
                            ></address-input>
                            <address-input
                                name="to"
                                label="To Address"
                                v-validate="orderObj.rules.to_address"
                                v-model="orderObj.values.to_address"
                                :error-messages="errors.collect('to')"
                                @placeChanged="orderObj.values.to_obj = $event"
                            ></address-input>
                            <div class="d-flex align-start">
                                <v-icon color="primary" class="mr-2" small>mdi-information-outline</v-icon>
                                <p class="em-small-text subtitle--text mb-6">
                                    {{ texts.order_17 }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-8">
                            <p class="font-weight-medium em-medium-text mb-2">{{ texts.order_18 }}</p>
                            <v-select
                                autocomplete="off"
                                :label="texts.order_19"
                                v-model="orderObj.values.waiting_time"
                                name="waiting_time"
                                v-validate="orderObj.rules.waiting_time"
                                :error-messages="errors.collect('waiting_time')"
                                data-vv-as="waiting time"
                                :items="waiting"
                                item-value="value"
                                item-text="name"
                            >
                                <template v-slot:selection="{item}">
                                    <div class="d-flex align-center justify-space-between w-100">
                                        <span>{{ item.name }}</span>
                                        <span class="primary--text">{{ item.date }}</span>
                                    </div>
                                </template>
                                <template v-slot:item="{item}">
                                    <div class="d-flex align-center justify-space-between w-100">
                                        <span>{{ item.name }}</span>
                                        <span class="primary--text">{{ item.date }}</span>
                                    </div>
                                </template>
                            </v-select>
                            <div class="d-flex align-start">
                                <v-icon color="primary" class="mr-2" small>mdi-information-outline</v-icon>
                                <p class="em-small-text subtitle--text mb-6">
                                    {{ texts.order_20 }}
                                </p>
                            </div>
                        </div>
                    </v-col>
                    <!--                                        <v-col cols="12" md="6" class="pb-8">-->
                    <!--                                            <google-map></google-map>-->
                    <!--                                        </v-col>-->
                </v-row>
            </v-form>
        </v-card-text>
    </v-card>
</template>
<script>
import AddressInput from "../../../../components/form/AddressInput";
import Helpers from "../../../../mixins/Helpers";
export default {
    name: 'Route',
    mixins: [Helpers],
    components: {AddressInput},
    props: {
        orderObj: {
            required: true,
            type: Object
        },
        waiting: {
            default: () => []
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    },
}
</script>
