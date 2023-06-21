<template>
    <section class="w-100 d-flex justify-center">
        <div class="pt-16" style="max-width: 75rem">
            <h2 :class="__smallDesktop? 'display-1': 'display-3'" class="text-center mb-8 secondary--text">
                {{ texts.deliver_10 }}
            </h2>
            <v-row>
                <v-col cols="12" xs="12" lg="3" md="3" sm="6"  class="d-flex flex-column  align-center">
                    <v-avatar
                        size="10rem"
                    >
                        <v-icon size="10rem">mdi-numeric-1-circle-outline</v-icon>
                    </v-avatar>
                    <h2 class="mt-2">{{ texts.deliver_13 }}</h2>
                    <p class="text-center mt-2">{{ texts.deliver_14 }}</p>
                </v-col>
                <v-col cols="12" xs="12" lg="3" md="3" sm="6"  class="d-flex flex-column align-center">
                    <v-avatar
                        size="10rem"
                    >
                        <v-icon size="10rem">mdi-numeric-2-circle-outline</v-icon>
                    </v-avatar>
                  <h2 class="mt-2">{{ texts.deliver_15 }}</h2>
                  <p class="text-center mt-2">{{ texts.deliver_16 }}</p>
                </v-col>
                <v-col cols="12" xs="12" lg="3" md="3" sm="6"  class="d-flex flex-column align-center">
                    <v-avatar
                        size="10rem"
                    >
                        <v-icon size="10rem">mdi-numeric-3-circle-outline</v-icon>
                    </v-avatar>
                  <h2 class="mt-2">{{ texts.deliver_17 }}</h2>
                  <p class="text-center mt-2">{{ texts.deliver_18 }}</p>
                </v-col>
                <v-col cols="12" xs="12" lg="3" md="3" sm="6"  class="d-flex flex-column align-center">
                    <v-avatar
                        size="10rem"
                    >
                        <v-icon size="10rem">mdi-numeric-4-circle-outline</v-icon>
                    </v-avatar>
                  <h2 class="mt-2">{{ texts.deliver_19 }}</h2>
                  <p class="text-center mt-2">{{ texts.deliver_20 }}</p>
                </v-col>
            </v-row>
            <div class="d-flex justify-center mt-8">
                <v-btn
                    :href="'#deliverCarousel'"
                    color="primary"
                >
                    {{ texts.deliver_11 }}
                </v-btn>
            </div>
        </div>
    </section>
</template>

<script>
import Avatar from "../../../components/Avatar";
import Screen from "../../../mixins/Screen";
export default {
    name: "HowEarn",
    mixins: [Screen],
    components: {Avatar},
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    }
}
</script>
