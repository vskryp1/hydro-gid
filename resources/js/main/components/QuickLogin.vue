<template>
    <v-dialog v-model="dialog" persistent max-width="32rem" content-class="overflow-inherit">
        <v-card>
            <v-btn @click="dialog = false" absolute top right fab x-small color="danger" style="right: 0; transform: translateX(50%)">
                <v-icon color="white">mdi-close</v-icon>
            </v-btn>
            <v-card-text>
                <auth-form v-if="dialog" @logged="$emit('logged')"></auth-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>
import Login from "../models/Login";
import Register from "../models/Register";
import Avatar from "../../components/Avatar";
import SelectPhone from "../../components/form/SelectPhone";
import Helpers from "../../mixins/Helpers";
import AuthForm from "./auth/AuthForm";

export default {
    name: 'QuickLogin',
    components: {AuthForm},
    props: {
        value: {
            default: false
        }
    },
    data(){
        return {
            dialog: this.value,
        }
    },
    watch: {
        value(){
            this.dialog = this.value;
        },
        dialog(){
            this.$emit('input', this.dialog)
        }
    }
}
</script>
