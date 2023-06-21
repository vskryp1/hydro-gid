<template>
    <section class="w-100">
        <div class="pt-16">

            <h2 :class="__smallDesktop? 'display-1': 'display-3 mb-8'" class="text-center secondary--text">{{ texts.deliver_9 }}</h2>

            <v-slide-group show-arrows>
<!--              :href="$store.state.path+'search?to='+item.id"-->
                <v-slide-item v-for="(item, index) in destinations" :key="index">
                    <v-card
                        href=""
                        class="mx-auto ml-2 mr-2"
                        :class="__smallDesktop? 'my-12': ''"
                        width="20rem"
                    >

                        <v-img height="15rem" :src="item.image"></v-img>

                        <v-card-title>{{ item.name }}</v-card-title>

<!--                        <v-card-text>-->
<!--                            <div class="text-subtitle-1">-->
<!--                                Заказов {{ item.locality }}-->
<!--                            </div>-->
<!--                            <div class="text-subtitle-1">-->
<!--                                Предложений {{ item.address }}-->
<!--                            </div>-->
<!--                        </v-card-text>-->

                    </v-card>
                </v-slide-item>

            </v-slide-group>
        </div>
    </section>
</template>

<script>
import Helpers from "../../../mixins/Helpers";
import Screen from "../../../mixins/Screen";

export default {
    name: "PopularDestinations",
    mixins: [Helpers, Screen],
    data(){
        return {
        }
    },
    computed: {
        destinations(){
            return this.$store.state.destinations;
        },
        texts(){
            return this.$store.state.texts;
        }
    },
}
</script>
