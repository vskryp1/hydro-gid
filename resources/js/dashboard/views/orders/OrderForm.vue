<template>
    <v-dialog v-model="dialog" persistent max-width="55rem">
        <v-card>
            <v-card-text>
                <v-btn @click="dialog = false" icon small color="danger" class="float-end">
                    <v-icon color="danger">mdi-close</v-icon>
                </v-btn>
                <div :class="__smallDesktop? 'px-2': 'px-8 pt-4'">
                    <v-form class="mb-6">
                        <p class="font-weight-medium em-medium-text mb-4">Основная информация</p>
                        <v-row>
                            <v-col cols="12" md="5">
                                <avatar-input
                                    :multiple="true"
                                    border-radius="0.3125rem"
                                    :size="__smallDesktop? '10rem': '18rem'"
                                    v-model="orderObj.values.image_files"
                                    :preview="orderObj.values.images"
                                    name="images"
                                    v-validate="order? '': orderObj.rules.image_files"
                                    @delete="orderObj.values.image_deletes = $event"
                                    :removable="false"
                                    :error-messages="errors.collect('images')"
                                    data-vv-as="изображения"
                                ></avatar-input>
                            </v-col>
                            <v-col cols="12" md="7">
                                <div class="d-flex">
<!--                                    <v-checkbox-->
<!--                                        label="Неважно откуда"-->
<!--                                        v-model="orderObj.values.no_matter_where"-->
<!--                                        :true-value="1"-->
<!--                                        :false-value="0"-->
<!--                                        @change="toggleUrl"-->
<!--                                        class="mr-6 mt-1"-->
<!--                                    ></v-checkbox>-->
                                    <v-text-field
                                        :disabled="!!urlDisabled"
                                        autocomplete="off"
                                        class="mt-0 pt-0"
                                        label="Ссылка на товар"
                                        placeholder="Укажите ссылку на товар"
                                        v-model="orderObj.values.url"
                                        name="url"
                                        v-validate="urlDisabled? '': orderObj.rules.url"
                                        :error-messages="errors.collect('url')"
                                        data-vv-as="ссылка"
                                    ></v-text-field>
                                </div>
                                <v-text-field
                                    autocomplete="off"
                                    label="Название товара"
                                    placeholder="Укажите название товара"
                                    v-model="orderObj.values.name"
                                    name="name"
                                    v-validate="orderObj.rules.name"
                                    :error-messages="errors.collect('name')"
                                    data-vv-as="название"
                                ></v-text-field>
                                <v-row no-gutters>
                                    <v-col cols="12" md="5" class="pr-2">
                                        <v-text-field
                                            autocomplete="off"
                                            v-mask="currencyMask"
                                            label="Цена на сайте"
                                            placeholder="Укажите цену товара"
                                            hint="не включая стоимость доставки"
                                            v-model="orderObj.values.price"
                                            name="price"
                                            v-validate="orderObj.rules.price"
                                            :error-messages="errors.collect('price')"
                                            data-vv-as="цена"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="7" class="pl-2">
                                        <div class="fs-15" style="margin-top: 0.625rem">
                                            Количество: <span class="primary--text">{{ orderObj.values.quantity }}</span>
                                        </div>
                                        <v-slider
                                            :max="100"
                                            :min="1"
                                            v-model="orderObj.values.quantity"
                                            name="quantity"
                                            v-validate="orderObj.rules.quantity"
                                            :error-messages="errors.collect('quantity')"
                                            data-vv-as="количество"
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
                                    label="Информация о товаре"
                                    placeholder="Укажите цвет, размер и так далее"
                                    v-model="orderObj.values.description"
                                    name="description"
                                    rows="3"
                                    v-validate="orderObj.rules.description"
                                    :error-messages="errors.collect('description')"
                                    data-vv-as="информация"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="6">
                                <div class="mb-8">
                                    <p class="font-weight-medium em-medium-text mb-1">Маршрут доставки</p>
                                    <address-input
                                        label="From Address"
                                        v-model="orderObj.values.address_from"
                                        name="address_from"
                                        v-validate="orderObj.rules.address_from"
                                        :error-messages="errors.collect('address_from')"
                                        data-vv-as="from address"
                                        @placeChanged="orderObj.values.from_obj = $event"
                                    ></address-input>
                                    <address-input
                                        label="To Address"
                                        v-model="orderObj.values.address_to"
                                        name="address_to"
                                        v-validate="orderObj.rules.address_to"
                                        :error-messages="errors.collect('address_to')"
                                        data-vv-as="to address"
                                        @placeChanged="orderObj.values.to_obj = $event"
                                    ></address-input>
                                    <div class="d-flex align-start">
                                        <v-icon color="primary" class="mr-2" small>mdi-information-outline</v-icon>
                                        <p class="em-small-text subtitle--text mb-6">
                                            Заказ доставит путешественник {{ $store.state.appName }},
                                            который направляется в ваш город.
                                            Укажите страну, в которой нужно сделать покупку, и город,
                                            в который нужно ее доставить.
                                        </p>
                                    </div>
                                </div>
                            </v-col>
                            <v-col cols="12" md="6">
                                <div>
                                    <p class="font-weight-medium em-medium-text mb-1">Как долго вы готовы ждать?</p>
                                    <v-select
                                        autocomplete="off"
                                        label="Срок ожидания"
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
                                            Чем дольше срок ожидания, тем больше выгодных предложений вы получите.
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-weight-medium em-medium-text mb-4">Обзор заказа</p>
                                    <div class="d-flex justify-space-between mb-2">
                                        <span class="fs-14 subtitle--text">Стоимость товара</span>
                                        <span class="fs-14 font-weight-medium secondary--text">{{ __formatAmount(priceInt)  }} * {{ orderObj.values.quantity }}</span>
                                    </div>
                                    <div class="d-flex justify-space-between mb-2">
                                        <span class="fs-14 subtitle--text">Вознаграждение</span>
                                        <span class="fs-14 font-weight-medium secondary--text">{{ $store.state.texts.contract_price }}</span>
                                    </div>
                                    <div class="d-flex justify-space-between mb-2">
                                        <span class="fs-14 subtitle--text">Комиссия {{ $store.state.appName }}</span>
                                        <span class="fs-14 font-weight-medium secondary--text">{{ $store.state.settings.esco_commission }} %</span>
                                    </div>
                                    <div class="d-flex justify-space-between mb-2">
                                        <span class="fs-14 subtitle--text">Комиссия платежной системы</span>
                                        <span class="fs-14 font-weight-medium secondary--text">{{ $store.state.settings.payment_system_commission }} %</span>
                                    </div>
                                    <v-divider class="mb-4"></v-divider>
                                    <div class="d-flex justify-space-between mb-2">
                                        <span class="fs-14 secondary--text">Стоимость:</span>
                                        <span class="fs-14 font-weight-bold primary--text">{{  __formatAmount(totalPrice) }} + вознаграждение</span>
                                    </div>
                                </div>
                            </v-col>
                        </v-row>
                    </v-form>
                </div>
                <div class="d-flex justify-center mb-2">
                    <v-btn
                        @click="save()"
                        :loading="loading"
                        color="primary"
                    >Save Order</v-btn>
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>
import AddressInput from "../../../components/form/AddressInput";
import Order from "../../models/Order";
import Helpers from "../../../mixins/Helpers";
import AvatarInput from "../../../components/form/AvatarInput/AvatarInput";
import createNumberMask from "text-mask-addons/dist/createNumberMask";
import Avatar from "../../../components/Avatar";
import Screen from "../../../mixins/Screen";
export default {
    name: 'OrderForm',
    mixins: [Helpers, Screen],
    components: {Avatar, AvatarInput, AddressInput},
    props: {
        value: {
            default: null
        },
        order: {
            default: null
        },
        waiting: {
            required: true,
            type: Array
        }
    },
    data(){
        return {
            dialog: this.value,
            loading: false,
            orderObj: new Order(this.order || {}),
            currencyMask: createNumberMask({
                prefix: '$',
                allowDecimal: true,
                includeThousandsSeparator: true,
                allowNegative: false,
            }),
            urlDisabled: this.order && this.order.no_matter_where,
        }
    },
    computed: {
        waitingTo(){
            return this.waiting.find(i => i.value === this.orderObj.values.waiting_time);
        },
        priceInt(){
            return this.orderObj.values.price? this.orderObj.values.price.replace('.00', '').replace(/[^0-9 ]/g, ''): null;
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
        }
    },
    watch: {
        dialog(){
            this.$emit('input', this.dialog);
            if (this.dialog){
                this.orderObj = new Order(this.order || {});
                this.urlDisabled = this.order && this.order.no_matter_where;
                this.$validator.reset();
            }
        },
        value(){
            this.dialog = this.value;
        },
        tab(){
            this.orderObj.values.round_order = this.tab? 1: 0;
        }
    },
    methods: {
        save(){

            this.$validator.validateAll().then(valid => {
                if (valid){
                   fbq('init', '185425124483639');
                   fbq('track', 'PageView');

                    this.loading = true;
                    const method = this.order?
                        this.orderObj.update(this.$store.state.path+'orders/save/'+this.orderObj.values.id):
                        this.orderObj.create(this.$store.state.path+'orders/save');
                    method.then(response => {
                        this.loading = false;
                        this.dialog = false;
                        this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                        this.$emit('saved');
                    })
                        .catch(error => {
                            this.loading = false;
                            this.__errorResponse(error);
                        })


                }
            })
        },
        toggleUrl(val){
            this.orderObj.values.url = '';
            this.urlDisabled = !!val;
            this.$validator.reset();
        }
    }
}
</script>
