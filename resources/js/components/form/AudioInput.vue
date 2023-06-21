<template>
    <div style="position: relative" class="mb-8">
        <p v-if="name" class="mb-1 subtitle-2">{{ name }}</p>
        <div v-if="src" class="d-flex align-center">
            <audio ref="player" controls class="w-100 mr-2" style="height: 30px;">
                <source :src="src" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
            <v-btn @click="$refs.input.click()" icon small color="primary">
                <v-icon color="primary">mdi-refresh</v-icon>
            </v-btn>
            <v-btn @click="clear()" small icon color="red">
                <v-icon color="red">mdi-close</v-icon>
            </v-btn>
        </div>
        <v-btn v-else block @click="$refs.input.click()" color="primary">
            <v-icon small class="mr-2">mdi-music-circle-outline</v-icon>
            <span>Choose audio file</span>
        </v-btn>
        <input
            ref="input"
            @change="setFile"
            type="file"
            hidden
        >

        <!--Errors-->
        <error-message :messages="errorMessages"></error-message>
    </div>
</template>
<script>
import ErrorMessage from "./ErrorMessage";

export default {
    name: 'AudioInput',
    components: {ErrorMessage},
    props: {
        value: {
            default: null
        },
        preview: {
            default: null
        },
        errorMessages: {
            type: Array,
            default: () => []
        }
    },
    data(){
        return {
            val: this.val,
            previewFile: this.preview
        }
    },
    watch: {
        val(){
            this.$emit('input', this.val);
        },
        value(){
            this.val = this.value;
        },
        preview(){
            this.previewFile = this.preview;
        },
    },
    computed: {
        name(){
            return this.val? this.val.name: this.previewFile? this.previewFile.name: null;
        },
        src() {
            return this.val? URL.createObjectURL(this.val): this.previewFile? this.previewFile.uri: null;
        }
    },
    methods: {
        setFile(e){
            this.val = e.target.files[0];
            if (this.$refs.player)
            this.$refs.player.load()
        },
        clear(){
            this.$emit('clear')
            this.val = null;
            this.$refs.input.value = null;
            this.previewFile = null;
        },
    }
}
</script>
