<template>
    <section class="d-flex flex-column w-100 justify-center align-center">
        <div class="position-relative w-100 mb-16">
            <v-overlay absolute opacity="0.7">
                <h1 :class="__smallDesktop? 'display-2': 'display-3'" class=" text-center mb-6" style="max-width: 75rem">
                    {{ $store.state.texts.main_text }}
                </h1>
                <div class="d-flex align-center justify-center" :class="__smallDesktop? 'flex-column': ''">
                    <v-btn :href="$store.state.path+'order'"  :class="__smallDesktop? 'mb-2': 'mr-2'" color="white" large class=" primary--text"
                           v-if="!__smallDesktop"
                    >
                        {{ texts.order_button }}
                    </v-btn>
                    <v-btn :href="$store.state.path+'deliver'" color="primary" large
                           v-if="!__smallDesktop"
                    >
                        {{ texts.deliver_button }}
                    </v-btn>





                    <v-btn :href="$store.state.path+'order'"  :class="__smallDesktop? 'mb-2': 'mr-2'" color="white" large class=" primary--text"
                      v-if="__smallDesktop"        style="overflow: hidden;
                                    text-overflow: ellipsis;
                                    width: 61%;
                                    white-space: nowrap;
                                 "
                    >
                        {{ texts.order_button }}
                    </v-btn>
                    <v-btn :href="$store.state.path+'deliver'" color="primary" large

                           v-if="__smallDesktop"      style="overflow: hidden;
                                    text-overflow: ellipsis;
                                    width: 61%;
                                    white-space: nowrap;
                                 "
                    >
                        {{ texts.deliver_button }}
                    </v-btn>
                </div>
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
import Screen from "../../../mixins/Screen";

export default {
    name: 'MainCarousel',
    mixins: [Screen],
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
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    }
}
</script>
