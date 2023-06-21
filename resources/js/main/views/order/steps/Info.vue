<template>
    <v-card class="mb-8" min-height="12.5rem">
        <v-card-text class="pt-8 px-8 pb-0">
            <v-row>
                <v-col cols="12" md="5">
                    <avatar-input
                        :class="__smallDesktop? 'mb-4': ''"
                        :multiple="true"
                        border-radius="0.3125rem"
                        :size="__smallDesktop? '12rem': '20rem'"
                        v-model="orderObj.values.image_files"
                        @input="renderImages()"
                        name="images"
                        v-validate="orderObj.rules.image_files"
                        :error-messages="errors.collect('images')"
                        data-vv-as="image"
                    ></avatar-input>
                </v-col>
                <v-col cols="12" md="7">
                    <div :class="__smallDesktop? 'flex-column': ''" class="d-flex">
<!--                        <v-checkbox-->
<!--                            label="Неважно откуда"-->
<!--                            v-model="orderObj.values.no_matter_where"-->
<!--                            :true-value="1"-->
<!--                            :false-value="0"-->
<!--                            @change="toggleUrl"-->
<!--                            class="mr-6 mt-1"-->
<!--                        ></v-checkbox>-->
                        <v-text-field
                            :disabled="urlDisabled"
                            autocomplete="off"
                            class="mt-0 pt-0"
                            :label="texts.order_5"
                            :placeholder="texts.order_6"
                            v-model="orderObj.values.url"
                            name="url"
                            v-validate="urlDisabled? '': orderObj.rules.url"
                            :error-messages="errors.collect('url')"
                            data-vv-as="link"
                        ></v-text-field>
                    </div>
                    <v-text-field
                        autocomplete="off"
                        :label="texts.order_7"
                        :placeholder="texts.order_8"
                        v-model="orderObj.values.name"
                        name="name"
                        v-validate="orderObj.rules.name"
                        :error-messages="errors.collect('name')"
                        data-vv-as="name"
                    ></v-text-field>
                    <v-row no-gutters>
                        <v-col cols="12" md="5" class="pr-2">
                            <v-text-field
                                autocomplete="off"
                                v-mask="currencyMask"
                                :label="texts.order_9"
                                :placeholder="texts.order_10"
                                :hint="texts.order_11"
                                v-model="orderObj.values.price"
                                name="price"
                                v-validate="orderObj.rules.price"
                                :error-messages="errors.collect('price')"
                                data-vv-as="price"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" md="7" class="pl-2">
                            <div class="fs-15" style="margin-top: 0.625rem">
                                {{  texts.order_12 }}: <span class="primary--text">{{ orderObj.values.quantity }}</span>
                            </div>
                            <v-slider
                                :max="100"
                                :min="1"
                                v-model="orderObj.values.quantity"
                                name="quantity"
                                v-validate="orderObj.rules.quantity"
                                :error-messages="errors.collect('quantity')"
                                data-vv-as="quantity"
                            >
                                <template v-slot:prepend>
                                    <v-icon @click="orderObj.values.quantity --">
                                        mdi-minus
                                    </v-icon>
                                </template>
                                <template v-slot:append>
                                    <v-icon @click="orderObj.values.quantity ++">
                                        mdi-plus
                                    </v-icon>
                                </template>
                            </v-slider>
                        </v-col>
                    </v-row>
                    <v-textarea
                        autocomplete="off"
                        :label="texts.order_13"
                        :placeholder="texts.order_14"
                        v-model="orderObj.values.description"
                        name="description"
                        v-validate="orderObj.rules.description"
                        :error-messages="errors.collect('description')"
                        data-vv-as="info"
                    ></v-textarea>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>
<script>
import AvatarInput from "../../../../components/form/AvatarInput/AvatarInput";
import createNumberMask from "text-mask-addons/dist/createNumberMask";
import Screen from "../../../../mixins/Screen";
export default {
    name: 'Info',
    components: {AvatarInput},
    mixins: [Screen],
    props: {
        orderObj: {
            required: true,
            type: Object
        }
    },
    data(){
        return {
            currencyMask: createNumberMask({
                prefix: '$',
                allowDecimal: true,
                includeThousandsSeparator: true,
                allowNegative: false,
            }),
            urlDisabled: false,
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    },
    methods: {
        renderImages(){
            let images = [];
            this.orderObj.values.image_files.forEach(file => {
                images.push(URL.createObjectURL(file))
            })
            this.$emit('renderImages', images);
        },
        toggleUrl(val){
            this.orderObj.values.url = '';
            this.urlDisabled = !!val;
            this.$validator.reset();
        }
    }
}
</script>
