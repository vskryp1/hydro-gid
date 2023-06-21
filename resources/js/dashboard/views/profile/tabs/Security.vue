<template>
    <div>
        <h5 class="em-heading-3 mb-8 secondary--text">{{$store.state.texts.change_password}}</h5>
        <v-row>
            <v-col cols="12" md="4">
                <v-text-field
                    type="password"
                    :label="$store.state.texts.old_password"
                    outlined
                    class="rounded-0"
                    color="secondary"
                    name="old_password"
                    v-model="securityObj.values.old_password"
                    v-validate="securityObj.rules.old_password"
                    :error-messages="errors.collect('old_password')"
                    data-vv-as="Old Password"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-text-field
                    ref="password"
                    type="password"
                    :label="$store.state.texts.new_one"
                    outlined
                    class="rounded-0"
                    color="secondary"
                    name="password"
                    v-model="securityObj.values.password"
                    v-validate="securityObj.rules.password"
                    :error-messages="errors.collect('password')"
                    data-vv-as="Password"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-btn @click="validate()" :loading="loading" block color="secondary" tile height="3.5rem" :outlined="$vuetify.theme.dark">
                    {{$store.state.texts.save_changes}}
                </v-btn>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" md="4">
                <v-text-field
                    type="password"
                    :label="$store.state.texts.repeat_password"
                    outlined
                    class="rounded-0"
                    color="secondary"
                    name="password_confirmation"
                    v-model="securityObj.values.password_confirmation"
                    v-validate="securityObj.rules.password_confirmation"
                    :error-messages="errors.collect('password_confirmation')"
                    data-vv-as="Password Confirmation"
                ></v-text-field>
            </v-col>
        </v-row>
    </div>
</template>
<script>
import Security from "../../../models/Security";
import Helpers from "../../../../mixins/Helpers";

export default {
    name: 'Security',
    mixins: [Helpers],
    data(){
        return {
            securityObj: new Security(),
            loading: false
        }
    },
    methods: {
        validate(){
            this.$validator.validateAll().then(valid => {
                if (valid){
                    this.$store.commit('confirm', this.save)
                }
            })
        },
        save(){
            this.loading = true;
            this.securityObj.update(this.$store.state.path+'profile/update-password')
                .then(response => {
                    this.loading = false;
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                })
                .catch(error => {
                    this.loading = false;
                    this.__errorResponse(error)
                })
        }
    }
}
</script>
