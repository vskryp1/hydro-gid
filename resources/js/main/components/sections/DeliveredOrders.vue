<template>
    <section class="d-flex flex-column w-100 justify-center align-center">
        <v-container class="mb-16 d-flex flex-column align-center">
            <h2 :class="__smallDesktop? 'display-2': 'display-3'" class="text-center mb-2 secondary--text">{{ texts.delivered_orders }}</h2>
            <p class="text-center mb-6 subtitle--text">{{ texts.delivered_orders_description }}</p>
            <v-row class="mb-8">
<!--                <v-col v-for="(item, index) in delivered" :key="index" cols="12" md="4">-->
<!--                    <v-card-->
<!--                        class="mx-auto"-->
<!--                        max-width="344"-->
<!--                    >-->
<!--                        <v-img :src="item.image" height="15.5rem" class="mb-2"></v-img>-->

<!--                        <v-card-text class="d-flex justify-space-between">-->
<!--                            <div class="d-flex flex-column align-center">-->
<!--                                <v-badge overlap>-->
<!--                                    <template slot="badge">-->
<!--                                        <v-icon style="transform: rotate(45deg)">mdi-airplane</v-icon>-->
<!--                                    </template>-->
<!--                                    <avatar size="5rem" class="mb-4" :object="item.carrier"></avatar>-->
<!--                                </v-badge>-->
<!--                                <v-chip class="mb-4" outlined label color="primary" small>-->
<!--                                    {{ texts.earned }} {{ item.carrier.amount }}-->
<!--                                </v-chip>-->
<!--                                <p class="mb-2 em-medium-text-2 secondary&#45;&#45;text">{{ item.carrier.name }}</p>-->
<!--                                <p class="em-small-text mb-0 subtitle&#45;&#45;text">-->
<!--                                    <v-icon x-small>mdi-map-marker-outline</v-icon>-->
<!--                                    {{ item.carrier.address }}-->
<!--                                </p>-->
<!--                            </div>-->
<!--                            <v-divider vertical></v-divider>-->
<!--                            <div class="d-flex flex-column align-center">-->
<!--                                <v-badge overlap left>-->
<!--                                    <template slot="badge">-->
<!--                                        <v-icon style="transform: rotate(135deg)">mdi-airplane</v-icon>-->
<!--                                    </template>-->
<!--                                    <avatar size="5rem" class="mb-4" :object="item.customer"></avatar>-->
<!--                                </v-badge>-->
<!--                                <v-chip class="mb-4" outlined label color="primary" small>-->
<!--                                    {{ texts.saved }} {{ item.customer.amount }}-->
<!--                                </v-chip>-->
<!--                                <p class="mb-2 em-medium-text-2 secondary&#45;&#45;text">{{ item.customer.name }}</p>-->
<!--                                <p class="em-small-text mb-0 subtitle&#45;&#45;text">-->
<!--                                    <v-icon x-small>mdi-map-marker-outline</v-icon>-->
<!--                                    {{ item.customer.address }}-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </v-card-text>-->
<!--                    </v-card>-->
<!--                </v-col>-->
                <v-col v-for="(item, index) in delivered" :key="index" cols="12" md="4">
                    <v-card
                        class="mx-auto"
                        :width="__smallDesktop ? '20rem' : '29rem'"
                    >
                        <v-img :src="item.image" :height="__smallDesktop ? '12rem' : '18rem'" class="mb-2"></v-img>
                    </v-card>
                </v-col>
            </v-row>
<!--            <v-btn color="primary" class="mx-auto">-->
<!--                {{ texts.how_others_using }}-->
<!--            </v-btn>-->
        </v-container>
    </section>
</template>
<script>
import Avatar from "../../../components/Avatar";
import Screen from "../../../mixins/Screen";
export default {
    name: 'DeliveredOrders',
    components: {Avatar},
    mixins: [Screen],
    data(){
        return {
            delivered: [
                {
                    image: this.$store.state.appUrl+'images/макет_1.png',
                    customer: {
                        name: 'John Doe',
                        avatar: this.$store.state.appUrl+'seeder/images/activities/htmlimage (5).jpg',
                        address: 'Нью-Йорк, NY, US',
                        amount: '$28',
                    },
                    carrier: {
                        name: 'Larisa',
                        avatar: this.$store.state.appUrl+'seeder/images/activities/174-1741244_super-cool-wallpapers-man-wearing-jeans-black-hoodie.jpg',
                        address: 'Екатеринбург, RU',
                        amount: '$8',
                    },
                },
                {
                    image: this.$store.state.appUrl+'images/макет_2.png',
                    customer: {
                        name: 'Mr. Smith',
                        avatar: this.$store.state.appUrl+'seeder/images/activities/b250e4e460d1ceb754b229a74476256b.jpg',
                        address: 'Нью-Йорк, NY, US',
                        amount: '$75',
                    },
                    carrier: {
                        name: 'Raphael',
                        avatar: this.$store.state.appUrl+'seeder/images/activities/8. Божья коровка.jpg',
                        address: 'Екатеринбург, RU',
                        amount: '$4',
                    },
                },
                {
                    image: this.$store.state.appUrl+'images/макет_3.png',
                    customer: {
                        name: 'Julia',
                        avatar: this.$store.state.appUrl+'seeder/images/activities/htmlimage (6).jpg',
                        address: 'Нью-Йорк, NY, US',
                        amount: '$10',
                    },
                    carrier: {
                        name: 'Erika',
                        avatar: this.$store.state.appUrl+'seeder/images/activities/htmlimage (1).png',
                        address: 'Екатеринбург, RU',
                        amount: '$9',
                    },
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
