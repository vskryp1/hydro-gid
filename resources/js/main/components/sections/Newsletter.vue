<template>
    <section class="w-100">
        <div class="pt-16">
            <h2 class="display-3 text-center mb-8 secondary--text">{{ texts.news }}</h2>
            <v-row no-gutters>
                <v-col v-for="(item, index) in news" :key="index" cols="6" md="3">
                    <v-hover>
                        <template v-slot:default="{ hover }">
                            <v-card flat tile>
                                <v-img height="22.5rem" :src="item.image"></v-img>
                                <v-slide-x-transition>
                                    <v-overlay :value="hover" opacity="0.8" absolute>
                                        <div class="pa-4">
                                            <p class="display-1 font-weight-light white--text">{{ item.title }}</p>
                                            <div class="d-flex align-center justify-space-between mb-4">
<!--                                                <div class="d-flex align-center mr-4">-->
<!--                                                    <avatar-->
<!--                                                        size="2.5rem"-->
<!--                                                        :offset-right="true"-->
<!--                                                        class="primary"-->
<!--                                                        :avatar="$store.state.appUrl+'seeder/images/activities/b250e4e460d1ceb754b229a74476256b.jpg'"-->
<!--                                                        style="border: 1px solid"-->
<!--                                                    ></avatar>-->
<!--                                                    <span class="white&#45;&#45;text title" :style="{'border-bottom': '1px solid '+$vuetify.theme.currentTheme.primary }">John Doe</span>-->
<!--                                                </div>-->
<!--                                                <div class="d-flex align-center">-->
<!--                                                    <div class="d-flex align-center mr-2">-->
<!--                                                        <v-icon class="mr-1" color="white">mdi-eye</v-icon>-->
<!--                                                        <span class="em-small-text white&#45;&#45;text font-weight-bold lh-initial">17</span>-->
<!--                                                    </div>-->
<!--                                                    <div class="d-flex align-center mr-2">-->
<!--                                                        <v-icon class="mr-1" color="white">mdi-forum</v-icon>-->
<!--                                                        <span class="em-small-text white&#45;&#45;text font-weight-bold lh-initial">3</span>-->
<!--                                                    </div>-->
<!--                                                    <div class="d-flex align-center">-->
<!--                                                        <v-icon class="mr-1" color="pink">mdi-heart</v-icon>-->
<!--                                                        <span class="em-small-text pink&#45;&#45;text font-weight-black lh-initial">5</span>-->
<!--                                                    </div>-->
<!--                                                </div>-->
                                            </div>
                                            <p class="white--text">{{ item.description }}</p>
                                            <v-btn small color="primary" tile>See more</v-btn>
                                        </div>
                                    </v-overlay>
                                </v-slide-x-transition>
                            </v-card>
                        </template>
                    </v-hover>
                </v-col>
            </v-row>
        </div>
    </section>
</template>
<script>
import Avatar from "../../../components/Avatar";
export default {
    name: 'Newsletter',
    components: {Avatar},
    data(){
        return {
            news: [
                {
                    title: 'Lorem ipsum dolor sit amet',
                    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.`,
                    text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                         voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                         Excepteur sint occaecat cupidatat non proident,
                         sunt in culpa qui officia deserunt mollit anim id est laborum.`,
                    image: this.$store.state.appUrl+'seeder/images/activities/experience-yerevan-armenia-erik-148fadf055400a1d191367d4e7c92f37.jpg',
                },
                {
                    title: 'Lorem ipsum dolor sit amet',
                    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.`,
                    text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                         voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                         Excepteur sint occaecat cupidatat non proident,
                         sunt in culpa qui officia deserunt mollit anim id est laborum.`,
                    image: this.$store.state.appUrl+'seeder/images/activities/2. Хаски.jpg',
                },
                {
                    title: 'Lorem ipsum dolor sit amet',
                    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.`,
                    text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                         voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                         Excepteur sint occaecat cupidatat non proident,
                         sunt in culpa qui officia deserunt mollit anim id est laborum.`,
                    image: this.$store.state.appUrl+'seeder/images/activities/air-jordan-hoodie-worn-by-man-wearing-purge-mask-with-neon-lights-super-cool-wallpapers-holding-pink-smoke-bomb.jpg',
                },
                {
                    title: 'Lorem ipsum dolor sit amet',
                    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.`,
                    text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                         voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                         Excepteur sint occaecat cupidatat non proident,
                         sunt in culpa qui officia deserunt mollit anim id est laborum.`,
                    image: this.$store.state.appUrl+'seeder/images/activities/95-951350_cute-nature-dp.jpg',
                },
                {
                    title: 'Lorem ipsum dolor sit amet',
                    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.`,
                    text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                         voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                         Excepteur sint occaecat cupidatat non proident,
                         sunt in culpa qui officia deserunt mollit anim id est laborum.`,
                    image: this.$store.state.appUrl+'seeder/images/activities/121-1211155_big.jpg',
                },
                {
                    title: 'Lorem ipsum dolor sit amet',
                    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.`,
                    text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                         voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                         Excepteur sint occaecat cupidatat non proident,
                         sunt in culpa qui officia deserunt mollit anim id est laborum.`,
                    image: this.$store.state.appUrl+'seeder/images/activities/4. Кот с наушниками.jpg',
                },
                {
                    title: 'Lorem ipsum dolor sit amet',
                    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.`,
                    text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                         voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                         Excepteur sint occaecat cupidatat non proident,
                         sunt in culpa qui officia deserunt mollit anim id est laborum.`,
                    image: this.$store.state.appUrl+'seeder/images/activities/17. Мост.jpg',
                },
                {
                    title: 'Lorem ipsum dolor sit amet',
                    description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut aliquip ex ea commodo consequat.`,
                    text: `Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                         Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                         voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                         Excepteur sint occaecat cupidatat non proident,
                         sunt in culpa qui officia deserunt mollit anim id est laborum.`,
                    image: this.$store.state.appUrl+'seeder/images/activities/5aa10ca0d877e618008b4678.png',
                }
            ]
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    }
}
</script>
