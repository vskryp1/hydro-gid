<template>
    <section id="deliverCarousel" class="d-flex flex-column w-100 justify-center align-center">
        <div class="position-relative w-100">
            <v-overlay absolute>
                <v-row no-gutters class="d-flex justify-center align-center">
                    <v-col cols="12">
                        <h1 class="text-center mb-6 pa-2">
                            Обратитесь в поддержку
                        </h1>
                    </v-col>
                    <v-col cols="12">
                        <v-card :light="!$vuetify.theme.dark">
                            <v-card-text>
                                <v-form class="mb-6">
                                    <v-text-field
                                        label="Имя"
                                        name="name"
                                    ></v-text-field>
                                    <v-text-field
                                        label="Электронная почта"
                                        name="email"
                                    ></v-text-field>
                                    <v-textarea
                                        dense
                                        label="Вопрос"
                                        name="question"
                                    ></v-textarea>
                                </v-form>
                                <div class="d-flex justify-center mb-2">
                                    <v-btn :loading="loading" color="primary">Отправить</v-btn>
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
export default {
    name: 'SupportCarousel',
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
            loading: false,
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    }
}
</script>
