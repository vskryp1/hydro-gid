<template>
    <div>
        <div class="d-flex align-center mb-4 px-9 pt-4" style="height:50px">
            <v-btn
                v-for="item in $store.state.authSocials"
                :key="item.value"
                class="mr-2"
                :color="item.color"
                :href="$store.state.socialAuthPath+item.value"
                small
                outlined
                   style="height: 35px"  >
                <v-img   height="29"
                         width="30"

                         :src="$store.state.imagePath+'google.jpg'"  style="margin-right: 11%;" alt="Image description"></v-img>
                 {{ $store.state.texts.login_via_google }}
            </v-btn>
        </div>
        <v-tabs v-model="tab" centered background-color="transparent">
            <v-tab :disabled="loading">{{ $store.state.texts.login_tab }}</v-tab>
            <v-tab :disabled="loading">{{ $store.state.texts.registration }}</v-tab>
        </v-tabs>
        <v-divider></v-divider>
        <div class="px-8 pt-8">
            <v-tabs-items v-model="tab" class="transparent">

                <!--Login Form-->
                <v-tab-item>
                    <v-form @submit="login()" data-vv-scope="login" class="mb-6">
                        <v-text-field

                            :label="$store.state.texts.label_mail"
                            :placeholder="$store.state.texts.placeholder_mail"
                            v-model="loginObj.values.email"
                            name="email"
                            v-validate="loginObj.rules.email"
                            :error-messages="errors.collect('login.email')"
                            data-vv-as="имя"
                        ></v-text-field
                            >
                        <v-text-field
                            dense
                            :type="showPass? 'text': 'password'"
                            ref="password"
                            :label="$store.state.texts.password"
                            v-model="loginObj.values.password"
                            name="password"
                            v-validate="loginObj.rules.password"
                            :error-messages="errors.collect('login.password')"
                            data-vv-as="Password"
                            :append-icon="showPass? 'mdi-eye-off-outline': 'mdi-eye-outline'"
                            @click:append="showPass = !showPass"
                        ></v-text-field>
                    </v-form>
                    <div class="d-flex justify-end mb-2">
                        <v-btn @click="login()" :loading="loading" color="primary">{{$store.state.texts.login_button}}</v-btn>
                    </div>
                </v-tab-item>

                <!--Register Form-->
                <v-tab-item>
                    <v-form data-vv-scope="register" class="mb-6">
                        <v-text-field
                            autocomplete="off"
                            :label="$store.state.texts.register_name"
                            :placeholder="$store.state.texts.register_plaicholder_name"
                            v-model="registerObj.values.name"
                            name="name"
                            v-validate="registerObj.rules.name"
                            :error-messages="errors.collect('register.name')"
                            data-vv-as="name"
                        ></v-text-field>
                        <v-text-field
                            autocomplete="off"
                            :label="$store.state.texts.label_mail"
                            :placeholder="$store.state.texts.placeholder_mail"
                            v-model="registerObj.values.email"
                            name="email"
                            v-validate="registerObj.rules.email"
                            :error-messages="errors.collect('register.email')"
                            data-vv-as="email"
                        ></v-text-field>
                        <div class="d-flex w-100">
                            <v-tooltip color="black" left>
                                <template v-slot:activator="{on}">
                                    <v-btn @click="generatePassword()" v-on="on" fab small color="primary" class="mr-3 mt-3">
                                        <v-icon :style="{transform: `rotate(${generateDeg}deg)`}" class="mr-1">lock_reset</v-icon>
                                    </v-btn>
                                </template>
                                <span>Generate</span>
                            </v-tooltip>
                            <v-text-field
                                autocomplete="off"
                                dense
                                :type="showPass? 'text': 'password'"
                                ref="password"
                                :label="$store.state.texts.password"
                                v-model="registerObj.values.password"
                                name="password"
                                v-validate="registerObj.rules.password"
                                :error-messages="errors.collect('register.password')"
                                data-vv-as="Password"
                                :append-icon="showPass? 'mdi-eye-off-outline': 'mdi-eye-outline'"
                                @click:append="showPass = !showPass"
                            ></v-text-field>
                        </div>
                        <v-text-field
                            dense
                            autocomplete="off"
                            type="password"
                            :label="$store.state.texts.confirm_password"
                            v-model="registerObj.values.password_confirmation"
                            name="password_confirmation"
                            v-validate="registerObj.rules.password_confirmation"
                            :error-messages="errors.collect('register.password_confirmation')"
                            data-vv-as="Confirm Password"
                        ></v-text-field>
                    </v-form>
                    <div class="d-flex justify-end mb-2">
                        <v-btn @click="register()" :loading="loading" color="primary">{{$store.state.texts.register}}</v-btn>
                    </div>
                </v-tab-item>
            </v-tabs-items>
        </div>
    </div>
</template>
<script>
import Login from "../../models/Login";
import Register from "../../models/Register";
import SelectPhone from "../../../components/form/SelectPhone";
import Avatar from "../../../components/Avatar";
import Helpers from "../../../mixins/Helpers";

export default {
    name: 'AuthForm',
    mixins: [Helpers],
    components: {SelectPhone, Avatar},
    data(){
        return {
            tab: 0,
            loginObj: new Login(),
            registerObj: new Register(),
            loading: false,
            showPass: false,
            generateDeg: 0,
        }
    },
    computed: {
        countries(){
            return this.$store.state.countries;
        },
    },
    watch: {
        tab(){
            this.showPass = false;
        }
    },
    methods: {
        generatePassword(){
            let pass = Math.random().toString(36).slice(-8);
            this.registerObj.values.password = pass;
            this.registerObj.values.password_confirmation = pass;
            this.generateDeg = this.generateDeg? 0: 360;
            this.showPass = true;
        },
        register(){
            this.$validator.validateAll('register').then(valid => {
                if (valid){
                    this.loading = true;
                    this.registerObj.create(this.$store.state.path+'main/register')
                        .then(response => this.callback(response))
                        .catch(error => {
                            this.loading = false;
                            this.__errorResponse(error);
                        })
                }
            })
        },
        login(){
            this.$validator.validateAll('login').then(valid => {
                if (valid){
                    this.loading = true;
                    this.loginObj.create(this.$store.state.path+'main/login')
                        .then(response => this.callback(response))
                        .catch(error => {
                            this.loading = false;
                            this.__errorResponse(error);
                        })
                }
            })
        },
        callback(response){
            this.loading = false;
            this.dialog = false;
            this.$store.commit("setAlert", {type: 'info', message: response.data.message});
            this.$store.commit('setData', {key: 'user', value: response.data.user});
            this.$emit('logged');
        }
    },
    mounted() {
        this.loginObj = new Login();
        this.registerObj = new Register();
        this.errors.clear();
        this.$validator.reset();
    }
}
</script>
