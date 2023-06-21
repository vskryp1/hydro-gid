<template>
    <div>
        <div :style="disabled? {opacity: 0.5}: {}">
            <div v-if="$slots.label">
                <slot name="label"></slot>
            </div>
            <div class="d-flex align-center">
                <span class="headline black--text mr-2">{{ label }}:</span>
                <span class="display-1 primary--text">{{ val }}</span>
            </div>
        </div>
        <v-slider
            :disabled="!max || disabled"
            v-model="val"
            color="primary"
            track-color="grey"
            always-dirty
            :min="0"
            :max="max || 100"
            hide-details
        >
            <template v-slot:prepend>
                <v-icon @click="val --" color="primary">
                    mdi-minus
                </v-icon>
            </template>
            <template v-slot:append>
                <v-icon @click="val ++" color="primary">
                    mdi-plus
                </v-icon>
            </template>
        </v-slider>
        <error-message :messages="errorMessages"></error-message>
    </div>
</template>
<script>
import ErrorMessage from "./ErrorMessage";
export default {
    name: 'ScoreInput',
    components: {ErrorMessage},
    props: {
        label: {
            default: 'Score'
        },
        value: {
            default: null
        },
        max: {
            default: 100
        },
        disabled: {
            default: false
        },
        errorMessages: {
            type: Array,
            default() {
                return []
            }
        }
    },
    data(){
        return {
            val: this.value,
        }
    },
    watch: {
        value(){
            this.val = this.value;
        },
        val(){
            this.$emit('input', this.val)
        }
    }
}
</script>
