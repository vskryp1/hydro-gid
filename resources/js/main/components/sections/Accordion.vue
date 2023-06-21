<template>
    <section class="w-100 d-flex justify-center">
        <div class="w-100" style="padding: 15px">
            <h2 class="display-3 text-center mb-8 secondary--text">Часто задаваемые вопросы</h2>
            <v-expansion-panels>
                <v-expansion-panel
                    v-for="(item,i) in 10"
                    :key="i"
                >
                    <v-expansion-panel-header>
                        Item
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </div>
    </section>
</template>

<script>
export default {
    name: "Accordion"
}
</script>

<style scoped>

</style>
