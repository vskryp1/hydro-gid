<template>
    <v-dialog transition="fade-transition" :value="$store.state.loader" fullscreen>
        <v-card class="d-flex justify-center align-center">
            <v-progress-circular
                indeterminate
                color="secondary"
                :width="__getCurrentPixels(2)"
                :size="__getCurrentPixels(250)"
            >
                <v-avatar size="12.5rem">
                    <v-img :src="$store.state.imagePath+'logos.png'"></v-img>
                </v-avatar>
            </v-progress-circular>
        </v-card>
    </v-dialog>
</template>
<script>
import Screen from "../mixins/Screen";

export default {
    name: 'Loader',
    mixins: [Screen],
}
</script>
