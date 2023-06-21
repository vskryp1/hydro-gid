<template>
    <section id="deliverCarousel" class="d-flex flex-column w-100 justify-center align-center">
        <div class="position-relative w-100">
            <v-overlay absolute>
                <v-row no-gutters class="d-flex justify-center align-center">
                    <v-col cols="10" lg="6" md="6" sm="6">
                        <h1 class="text-center mb-6 pa-2">
                            {{ $store.state.texts.main_text }}
                        </h1>
                        <h4 class="text-center mb-6 pa-2">
                            {{ texts.deliver_1 }}
                        </h4>
                    </v-col>
                    <v-col cols="10" lg="6" md="6" sm="6">
                        <v-card :light="!$vuetify.theme.dark">
                            <v-card-text>
                                <v-tabs v-model="tab" centered background-color="transparent">
                                    <v-tab :disabled="loading">{{ texts.deliver_2 }}</v-tab>
                                    <v-tab :disabled="loading">{{ texts.deliver_3 }}</v-tab>
                                </v-tabs>
                                <v-divider></v-divider>
                                <div class="px-8 pt-8">
                                    <v-form class="mb-6">
                                        <address-input
                                            :label="texts.deliver_4"
                                            v-model="tripObj.values.from_address"
                                            v-validate="tripObj.rules.from_address"
                                            name="from"
                                            :error-messages="errors.collect('from')"
                                            data-vv-as="From address"
                                            @placeChanged="tripObj.values.from_obj = $event"
                                        ></address-input>
                                        <address-input
                                            :label="texts.deliver_5"
                                            v-model="tripObj.values.to_address"
                                            v-validate="tripObj.rules.to_address"
                                            name="from"
                                            :error-messages="errors.collect('to')"
                                            data-vv-as="To address"
                                            @placeChanged="tripObj.values.to_obj = $event"
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
                                                    :label="tab? texts.deliver_6: texts.deliver_7"
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
                                        @click="__middlewareAuth(save)"
                                        :disabled="!tripObj.values.from_obj || !tripObj.values.to_obj"
                                        :loading="loading"
                                        color="primary"
                                    >{{ texts.deliver_8 }}</v-btn>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-overlay>
            <v-carousel
                cycle
                height="45rem"
                hide-delimiter-background
                show-arrows-on-hover
                hide-delimiters
                progress
                progress-color="primary"
            >
                <v-carousel-item v-for="(slide, i) in slides" :key="i">
                    <v-img height="45rem" cover :lazy-src="sliderLazy" :src="slide"></v-img>
                </v-carousel-item>
            </v-carousel>
        </div>
    </section>
</template>
<script>
import AddressInput from "../../../components/form/AddressInput";
import Trip from "../../models/Trip";
import Helpers from "../../../mixins/Helpers";
export default {
    name: 'DeliverCarousel',
    components: {AddressInput},
    mixins: [Helpers],
    data(){
        return {
            sliderLazy: this.$store.state.appUrl+'seeder/images/activities/17. Мост.jpg',
            slides: [
                this.$store.state.appUrl+'seeder/images/activities/baby-groot-4k-hd-superheroes-wallpaper-preview.jpg',
                this.$store.state.appUrl+'seeder/images/activities/1. Черный кот с рыбкой.jpg',
                this.$store.state.appUrl+'seeder/images/activities/17. Мост.jpg',
                this.$store.state.appUrl+'seeder/images/activities/137239.jpg',
                this.$store.state.appUrl+'seeder/images/activities/271963.jpg',
                this.$store.state.appUrl+'seeder/images/activities/16. Город.jpg',
                this.$store.state.appUrl+'seeder/images/activities/bb1bd6_d587ed272e8247bea3f3dba575707903_mv2.png',
            ],

            tab: 0,
            loading: false,

            tripObj: new Trip(),
            dateMenu: false
        }
    },
    watch: {
        tab(){
            this.tripObj.values.round_trip = this.tab? 1: 0;
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        },
        viewDates(){
            this.tripObj.values.dates.sort();
            return this.tab?
                this.tripObj.values.dates.join(' - '):
                this.tripObj.values.date
        }
    },
    methods: {
        cons(e){
            console.log(e)
        },
        save(){
            this.$validator.validateAll().then(valid => {
                if (valid){
                    this.loading = true;
                    this.tripObj.create(this.$store.state.path+'deliver/save')
                        .then(response => {
                            this.loading = false;
                            this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                            window.location.href = this.$store.state.dashboardPath+'trips';
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
