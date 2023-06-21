<template>
    <section :class="__smallDesktop? 'px-6': ''" class="d-flex flex-column w-100 justify-center align-center">
        <div class="mb-16 pt-16 d-flex flex-column align-center" style="max-width: 65rem">
            <h2 :class="__smallDesktop? 'display-2': 'display-3'" class="text-center mb-8 secondary--text">
                {{ texts.how_works }}
            </h2>

            <div class="w-100">
                <v-tabs v-model="tab" centered background-color="transparent">
                    <v-tab>{{ texts.to_customers }}</v-tab>
                    <v-tab>{{ texts.to_travelers }}</v-tab>
                </v-tabs>
                <v-divider></v-divider>
                <v-tabs-items v-model="tab" class="transparent">
                    <v-tab-item>
                        <div class="py-10 d-flex flex-column align-center">
                            <p class="em-paragraph subtitle--text text-center" style="max-width: 35rem">{{ texts.to_customers_description }}</p>
                            <v-timeline dense clipped>
                                <v-timeline-item
                                    v-for="i in toCustomersSteps"
                                    :key="i"
                                    fill-dot
                                    class="white--text mb-6"
                                    color="primary"
                                    large
                                >
                                    <template v-slot:icon>
                                        <span>{{ i }}</span>
                                    </template>
                                    <v-card>
                                        <v-card-title>{{ texts[`to_customers_${i}_title`] }}</v-card-title>
                                        <v-card-text>{{ texts[`to_customers_${i}`] }}</v-card-text>
                                    </v-card>
                                </v-timeline-item>
                            </v-timeline>
                        </div>
                    </v-tab-item>
                    <v-tab-item>
                        <div class="pa-10 d-flex flex-column align-center">
                            <p class="em-paragraph subtitle--text text-center" style="max-width: 35rem">{{ texts.to_travelers_description }}</p>
                            <v-timeline dense clipped>
                                <v-timeline-item
                                    v-for="i in toTravelersSteps"
                                    :key="i"
                                    fill-dot
                                    class="white--text mb-6"
                                    color="primary"
                                    large
                                >
                                    <template v-slot:icon>
                                        <span>{{ i }}</span>
                                    </template>
                                    <v-card>
                                        <v-card-title>{{ texts[`to_travelers_${i}_title`] }}</v-card-title>
                                        <v-card-text>{{ texts[`to_travelers_${i}`] }}</v-card-text>
                                    </v-card>
                                </v-timeline-item>
                            </v-timeline>
                        </div>
                    </v-tab-item>
                </v-tabs-items>
            </div>
            <div class="d-flex" >
                <img style="width: 50px" v-for="card in cards" :src="card" alt="">
            </div>
            <v-btn style="margin-top: 3%" :href="$store.state.path+'order'" color="primary" class="mb-2">
                {{ texts.place_order }}
            </v-btn>
            <a style="text-decoration: underline">{{ texts.order_more_info }}</a>

        </div>
    </section>
</template>
<script>
import Screen from "../../../mixins/Screen";

export default {
    name: 'HowToWorks',
    mixins: [Screen],
    data(){
        return {
            tab: 0,
            toCustomersSteps: 4,
            toTravelersSteps: 4,

            cards: [
                this.$store.state.imagePath+'макет_7.png',
                this.$store.state.imagePath+'макет_5.png',
                this.$store.state.imagePath+'макет_БИТ.png',
                this.$store.state.imagePath+'макет_6.png'
               ,
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
