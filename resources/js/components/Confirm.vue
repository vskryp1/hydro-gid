<template>
    <v-dialog v-model="dialog" max-width="18.125rem">
        <v-card :style="$vuetify.theme.dark? {'border': '1px solid rosybrown'}: ''">
            <v-card-title class="text-center d-block">
                <span>{{ title }}</span>
            </v-card-title>

            <v-card-text v-if="$slots.default">
                <slot name="default"></slot>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn small text @click="dialog = false">
                    cancel
                </v-btn>
                <v-btn small dark :loading="loading" color="red" @click="confirmed()">
                    {{ btnText }}
                </v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    name: 'Confirm',
    props: {
        loading: {
            default: false
        },
        title: {
            default: 'Are you sure?'
        },
        btnText: {
            default: 'Delete'
        },
        value: {
            default: false
        }
    },
    data(){
        return {
            dialog: this.value
        }
    },
    watch: {
        value(){
            this.dialog = this.value;
        },
        dialog(){
            this.$emit('input', this.dialog);
        }
    },
    methods: {
        confirmed(){
            this.dialog = false;
            this.$emit('confirmed');
        }
    }
}
</script>
