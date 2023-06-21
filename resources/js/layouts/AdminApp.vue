<template>
    <v-main v-resize="__setWindow" style="background-color: #eaeef2;">
        <v-app-bar fixed color="white" style="z-index: 2">
            <a :href="$store.state.path">
                <v-avatar size="3rem">
                    <v-img :src="$store.state.imagePath+'logo.png'"></v-img>
                </v-avatar>
            </a>

            <div class="d-flex align-center mx-16 font-weight-medium">
                <a><span class="px-4 color-black fs-15">About Us</span></a>
                <a><span class="px-4 color-black fs-15">FAQ</span></a>
                <a><span class="px-4 color-black fs-15">Community</span></a>
            </div>

            <v-spacer></v-spacer>
            <form action="/logout" method="POST">
                <input type="hidden" name="_token" :value="$csrf">
                <v-btn type="submit" small icon color="black">
                    <v-icon color="black">mdi-logout</v-icon>
                </v-btn>
            </form>
        </v-app-bar>
        <div class="d-flex h-100">

            <navigation></navigation>
            <v-container class="h-100" style="max-width: 1450px; padding-top: 70px">
                <slot name="content"></slot>
            </v-container>
        </div>

        <!--Snackbar-->
        <v-snackbar
            :color="alert.type"
            v-model="alert.value"
            left
            shaped
            bottom
        >
            <div class="d-flex justify-space-between align-center">
                <span>{{ alert.message }}</span>
                <v-btn icon small @click="$store.commit('closeAlert')">
                    <v-icon small>mdi-close</v-icon>
                </v-btn>
            </div>
        </v-snackbar>

        <!--Quick Confirm-->
        <confirm
            v-if="$store.state.confirm.callback"
            v-model="$store.state.confirm.value"
            :btn-text="$store.state.confirm.btnText"
            @confirmed="$store.state.confirm.callback($store.state.confirm.args)"
        ></confirm>
    </v-main>
</template>
<script>
import _ from "lodash";
import Navigation from "../admin/components/Navigation";
import Confirm from "../components/Confirm";
import Screen from "../mixins/Screen";

export default {
    name: 'AdminApp',
    mixins: [Screen],
    components: {Confirm, Navigation},
    props: {
        defaultData: {
            default(){
                return {}
            }
        }
    },
    data() {
        return {}
    },
    computed: {
        alert() {
            return this.$store.state.alert
        },
    },
    mounted() {
        this.__setWindow()
    },
    created(){
        for (const [objKey, objValue] of Object.entries(this.defaultData)) {
            let val = objValue && typeof objValue === 'object' && !Array.isArray(objValue)?
                {...objValue}: objValue;
            this.$store.commit("setData", {key: _.camelCase(objKey), value: val})
        }
    }
}
</script>
