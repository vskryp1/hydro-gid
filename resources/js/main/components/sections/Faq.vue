<template>
    <section class="w-100">
        <v-card class=" d-flex justify-center mb-12 mt-12">
            <div class="pt-16 pr-4 pl-4" style="max-width: 75rem">
                <h2 :class="__smallDesktop? 'display-1': 'display-3'" class="text-center mb-8 secondary--text">{{$store.state.texts.faq}}</h2>
                <v-row no-gutters>
                    <v-col cols="12" lg="4" md="4" sm="4" class="d-flex flex-column align-center">
                        <h3 class="mt-2 text-center">

                          {{ texts.deliver_27 }}
                        </h3>
                        <p class="text-center mt-2">
                          {{ texts.deliver_28 }}

                        </p>
                    </v-col>
                    <v-col cols="12" lg="4" md="4" sm="4" class="d-flex flex-column align-center">
                        <h3 class="mt-2 text-center">
                          {{ texts.deliver_29 }}

                        </h3>
                        <p class="text-center mt-2">
                          {{ texts.deliver_30 }}

                        </p>
                    </v-col>
                    <v-col cols="12" lg="4" md="4" sm="4" class="d-flex flex-column align-center">
                        <h3 class="mt-2 text-center">
                          {{ texts.deliver_31 }}

                        </h3>
                        <p class="text-center mt-2">
                          {{ texts.deliver_32 }}
                        </p>
                    </v-col>

                </v-row>
                <div class="d-flex justify-center mt-8 mb-8">
                    <v-btn
                        :href="$store.state.path+'support'"
                        color="primary"
                    >
                        {{ texts.deliver_12 }}
                    </v-btn>
                </div>
            </div>
        </v-card>
    </section>
</template>

<script>
import Screen from "../../../mixins/Screen";

export default {
    name: "Faq",
    mixins: [Screen],
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    }
}
</script>
