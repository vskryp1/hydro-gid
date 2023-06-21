<template>
    <div class="h-100">
        <div class="position-relative">
            <v-progress-linear :color="color" style="position: absolute; z-index: 9" indeterminate height="2" :active="loading"></v-progress-linear>
        </div>
        <div class="position-relative h-100 d-flex flex-column">
            <v-overlay
                absolute
                color="secondaryReverse"
                :value="loading"
            >
            </v-overlay>
            <slot name="default"></slot>
        </div>
    </div>
</template>
<script>
export default {
    name: 'LoaderBox',
    props: {
        value: {
            default: false
        },
        color: {
            default: 'primary'
        }
    },
    data(){
        return {
            loading: this.value
        }
    },
    watch: {
        value(){
            this.loading = this.value;
        },
        loading(){
            this.$emit('input', this.loading)
        }
    }
}
</script>
