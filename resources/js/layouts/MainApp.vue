<template>
    <v-main v-resize="__setWindow" :style="{opacity: viewContent? 1: 0, background: $vuetify.theme.currentTheme.bgMain}">
        <div>

            <!--App Bar-->
            <app-bar></app-bar>

            <!--Content-->
            <v-container fluid class="mx-0 px-0" :style="{paddingTop: __smallDesktop?  '6.75rem': '5.75rem'}" style="padding-bottom: 2.5rem; min-height: 43.75rem">
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

        <!--Quick Login-->
        <quick-login
            v-if="$store.state.login.callback"
            v-model="$store.state.login.value"
            @logged="$store.state.login.callback($store.state.confirm.args)"
        ></quick-login>
    </v-main>
</template>
<script>
import _ from "lodash";
import AppBar from "../main/components/AppBar";
import AppFooter from "../main/components/Footer";
import Loader from "../components/Loader";
import Confirm from "../components/Confirm";
import QuickLogin from "../main/components/QuickLogin";
import Screen from "../mixins/Screen";

export default {
    name: 'MainApp',
    mixins: [Screen],
    components: {QuickLogin, Confirm, Loader, AppFooter, AppBar},
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
