<template>
    <v-main v-resize="__setWindow" :style="{opacity: viewContent? 1: 0, background: $vuetify.theme.currentTheme.bgMain}">
        <div>

            <!--App Bar-->
            <app-bar></app-bar>

            <!--Content-->
            <v-container fluid style="padding-top: 2rem; padding-bottom: 2rem; min-height: 43.75rem">
                <slot name="content"></slot>
            </v-container>

            <!--Footer-->
            <app-footer></app-footer>

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
        </div>

        <!--Loader-->
        <loader></loader>

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
import AppBar from "../dashboard/components/AppBar";
import AppFooter from "../dashboard/components/Footer";
import Loader from "../components/Loader";
import Confirm from "../components/Confirm";
import Screen from "../mixins/Screen";

export default {
    name: 'DashboardApp',
    mixins: [Screen],
    components: {Confirm, Loader, AppFooter, AppBar},
    props: {
        defaultData: {
            default(){
                return {}
            }
        }
    },
    data() {
        return {
            viewContent: false,
        }
    },
    computed: {
        alert() {
            return this.$store.state.alert
        },
        loader(){
            return this.$store.state.loader;
        }
    },
    watch: {
        loader(){
            this.viewContent = !this.loader;
        }
    },
    mounted() {
        this.__setWindow()
    },
    created(){
        this.viewContent = !this.$store.state.loader;
        for (const [objKey, objValue] of Object.entries(this.defaultData)) {
            let val = objValue && typeof objValue === 'object' && !Array.isArray(objValue)?
                {...objValue}: objValue;
            this.$store.commit("setData", {key: _.camelCase(objKey), value: val})
        }
    }
}
</script>
