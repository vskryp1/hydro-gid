<template>
    <v-dialog v-model="dialog" persistent max-width="32rem" content-class="overflow-inherit">
        <v-card>
            <v-btn @click="dialog = false" absolute top right fab x-small color="danger" style="right: 0; transform: translateX(50%)">
                <v-icon color="white">mdi-close</v-icon>
            </v-btn>
            <v-card-text>
                <template v-if="!trip">
                    <v-tabs v-model="tab" centered background-color="transparent">
                        <v-tab :disabled="loading">В одну сторону</v-tab>
                        <v-tab :disabled="loading">Туда-обратно</v-tab>
                    </v-tabs>
                    <v-divider></v-divider>
                </template>
                <div class="px-8 pt-8">
                    <v-form class="mb-6">
                        <address-input
                            label="Откуда"
                            v-model="tripObj.values.from_address"
                            v-validate="tripObj.rules.from_address"
                            @placeChanged="tripObj.values.from_obj = $event"
                            name="from"
                            :error-messages="errors.collect('from')"
                            data-vv-as="From address"
                        ></address-input>
                        <address-input
                            label="Куда"
                            v-model="tripObj.values.to_address"
                            v-validate="tripObj.rules.to_address"
                            @placeChanged="tripObj.values.to_obj = $event"
                            name="from"
                            :error-messages="errors.collect('to')"
                            data-vv-as="To address"
                        ></address-input>
                        <v-menu
                            v-model="dateMenu"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    :label="tab? 'Даты поездок': 'Дата поездки'"
                                    append-icon="mdi-calendar"
                                    readonly
                                    v-on="on"
                                    :value="viewDates"
                                    :error-messages="errors.collect('date')"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                no-title
                                scrollable
                                :range="!!tab"
                                :value="tab? tripObj.values.dates: tripObj.values.date"
                                @input="tab? tripObj.values.dates = $event: tripObj.values.date = $event"
                                @change="dateMenu = false"
                                :min="new Date().toISOString()"
                                name="date"
                                v-validate="tab? tripObj.rules.dates: tripObj.rules.date"
                                data-vv-as="Date"
                            >
                            </v-date-picker>
                        </v-menu>
                    </v-form>
                </div>
                <div class="d-flex justify-center mb-2">
                    <v-btn
                        @click="save()"
                        :disabled="disabled"
                        :loading="loading"
                        color="primary"
                    >Save Trip</v-btn>
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>
import AddressInput from "../../../../components/form/AddressInput";
import Trip from "../../../models/Trip";
import Helpers from "../../../../mixins/Helpers";
export default {
    name: 'TripForm',
    mixins: [Helpers],
    components: {AddressInput},
    props: {
        value: {
            default: null
        },
        trip: {
            default: null
        }
    },
    data(){
        return {
            dialog: this.value,
            tab: 0,
            loading: false,
            tripObj: new Trip(this.trip || {}),
            dateMenu: false
        }
    },
    computed: {
        viewDates(){
            this.tripObj.values.dates.sort();
            return this.tab?
                this.tripObj.values.dates.join(' - '):
                this.tripObj.values.date;
        },
        disabled(){
            return !this.trip && (!this.tripObj.values.from_obj || !this.tripObj.values.to_obj);
        }
    },
    watch: {
        dialog(){
            this.$emit('input', this.dialog);
            if (this.dialog){
                this.tripObj = new Trip(this.trip || {});
                this.$validator.reset();
                this.tab = 0;
            }
        },
        value(){
            this.dialog = this.value;
        },
        tab(){
            this.tripObj.values.round_trip = this.tab? 1: 0;
        }
    },
    methods: {
        save(){
            this.$validator.validateAll().then(valid => {
                if (valid){
                    fbq('init', '185425124483639');
                    fbq('track', 'PageView');
                    this.loading = true;
                    const method = this.trip?
                        this.tripObj.update(this.$store.state.path+'trips/save/'+this.tripObj.values.id):
                        this.tripObj.create(this.$store.state.path+'trips/save');

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
        }
    }
}
</script>
