<template>
    <div
        :class="bottomOffset? 'mb-4': ''"
        :style="{height: __smallDesktop? 'auto': 'height: 22rem'}"
        class="position-relative"
    >
        <v-card
            tile
            :class="!__smallDesktop && zoom? 'zoom-card position-absolute t-0 r-0': ''"
            style="max-width: unset;"
        >
            <v-card-text class="d-flex" :class="profile ? 'flex-column align-center' : ''">
                <div v-if="images" style="width: 22rem; height: 20rem" class="mr-4">
                    <v-carousel
                        height="20rem"
                        hide-delimiter-background
                        show-arrows-on-hover
                        hide-delimiters
                        progress
                        progress-color="secondary"
                    >
                        <v-carousel-item v-for="(image, i) in item.images" :key="'image'+i">
                            <v-img width="22rem" height="20rem" :src="image.uri"></v-img>
                        </v-carousel-item>
                    </v-carousel>
                </div>
                <div class="w-100 d-flex flex-column">
                    <div>
                        <h2
                            :class="__smallDesktop? '': 'em-cut-text'"
                            :style="{width: __smallDesktop? 'auto': '22rem'}"
                            class="font-weight-medium fs-24 secondary--text mb-4"
                        >
                            {{ item.name }}
                        </h2>
                        <div :class="__smallDesktop? 'flex-column': ''" class="d-flex align-center mb-2">
                            <div :class="__smallDesktop? 'mb-2': ''" class="d-flex align-center">
                                <avatar
                                    v-if="item.from_location.country"
                                    :object="item.from_location.country"
                                    size="1rem"
                                    :offset-right="true"
                                ></avatar>
                                <p class="em-small-text subtitle--text mb-0">
                                    {{ item.from_location.address }}
                                </p>
                            </div>
                            <v-icon class="mx-2" small color="primary">mdi-arrow-right</v-icon>
                            <div :class="__smallDesktop? 'mb-2': ''" class="d-flex align-center">
                                <avatar
                                    v-if="item.to_location.country"
                                    :object="item.to_location.country"
                                    size="1rem"
                                    :offset-right="true"
                                ></avatar>
                                <p class="em-small-text subtitle--text mb-0">
                                    {{ item.to_location.address }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-center mb-4">
                            <span class="em-small-text font-weight-bold secondary--text mb-0">
                                Not later {{ item.wait_to }}
                            </span>
                        </div>
                        <div class="d-flex align-center justify-space-between mb-4">
                            <v-chip outlined color="primary" class="pl-0 mr-4">
                                <div class="d-flex align-center">
                                    <avatar
                                        :object="item.user"
                                        size="2.5rem"
                                        :offset-right="true"
                                    ></avatar>
                                    <p class="em-small-text primary--text mb-0">
                                        {{ item.user.name }}
                                    </p>
                                </div>
                            </v-chip>
                            <div v-if="item.url">
                                <a :href="item.url" target="_blank" class="primary--text">
                                    <v-icon color="primary">mdi-eye</v-icon>
                                    <span>View on site</span>
                                </a>
                            </div>
                        </div>
                        <v-divider class="mb-4"></v-divider>
                        <div class="d-flex align-center justify-space-between mb-2">
                                    <span class="em-small-text subtitle--text">
                                        Quantity
                                    </span>
                            <span class="em-small-text font-weight-bold secondary--text">
                                        x{{ item.quantity }}
                                    </span>
                        </div>
                        <div class="d-flex align-center justify-space-between mb-2">
                                    <span class="em-small-text subtitle--text">
                                        Price
                                    </span>
                            <span class="em-small-text font-weight-bold secondary--text">
                                        {{ __formatAmount(item.price) }}
                                    </span>
                        </div>
                        <div class="d-flex align-center justify-space-between mb-2">
                                    <span class="em-small-text subtitle--text">
                                        Total Price
                                    </span>
                            <span class="em-small-text font-weight-bold secondary--text">
                                        {{ __formatAmount(item.total_price) }}
                                    </span>
                        </div>
                        <div class="d-flex align-center justify-space-between mb-6">
                                    <span class="em-small-text subtitle--text">
                                        Reward
                                    </span>
                            <span class="em-small-text font-weight-bold secondary--text">
                                        {{ $store.state.texts.contract_price }}
                                    </span>
                        </div>
                    </div>
                    <v-spacer></v-spacer>
                    <div>
                        <v-btn
                            :disabled="user && !item.can_suggest"
                            @click="user? showSuggest(item): __middlewareAuth($emit('getData'))"
                            height="2.5rem"
                            block
                            color="primary"
                        >
                            Suggest delivery
                        </v-btn>
                    </div>
                </div>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
import Avatar from "../Avatar";
import Screen from "../../mixins/Screen";
import Helpers from "../../mixins/Helpers";
export default {
    name: 'orderCard',
    mixins: [Screen, Helpers],
    components: {Avatar},
    props: {
        item: {
            required: true,
            type: Object
        },
        zoom: {
            default: false
        },
        images: {
            default: true
        },
        profile: {
            default: false
        },
        bottomOffset: {
            default: true
        },
    },
    computed: {
        user(){
            return this.$store.state.user;
        }
    },
    methods: {
        showSuggest(item){
            this.$emit('showSuggest', item)
        },
    }
}
</script>
