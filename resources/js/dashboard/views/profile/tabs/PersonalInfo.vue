<template>
    <div>
        <v-row>
            <v-col cols="12" md="4">
                <v-text-field
                    :label="$store.state.texts.register_name"
                    outlined
                    class="rounded-0 mb-2 mt-0 pt-0"
                    color="secondary"
                    :name="$store.state.texts.register_name"
                    v-model="profileObj.values.name"
                    v-validate="profileObj.rules.name"
                    :error-messages="errors.collect('name')"
                    data-vv-as="Name"
                ></v-text-field>
                <v-text-field
                    :label="$store.state.texts.label_mail"
                    outlined
                    class="rounded-0 mb-2"
                    color="secondary"
                    :value="$store.state.user.email"
                    name="gender"
                    v-model="profileObj.values.email"
                    v-validate="profileObj.rules.email"
                    :error-messages="errors.collect('email')"
                    data-vv-as="Email"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <select-phone
                    class="rounded-0 mt-0 pt-0"
                    :label="$store.state.texts.mobile_phone"
                    color="secondary"
                    :outlined="true"
                    :countries="countries"
                    name="phone"
                    v-model="profileObj.values.phone"
                    v-validate="profileObj.rules.phone"
                    :error-messages="errors.collect('phone')"
                    data-vv-as="Phone"
                >
                    <template slot="append">
                        <v-icon color="success">mdi-checkbox-marked-circle-outline</v-icon>
                    </template>
                </select-phone>
                <v-autocomplete
                    :dark="$vuetify.theme.dark"
                    :label="$store.state.texts.country"
                    outlined
                    class="rounded-0 mb-2"
                    color="secondary"
                    :items="countries"
                    item-text="name"
                    item-value="id"
                    name="country_id"
                    v-model="profileObj.values.country_id"
                    v-validate="profileObj.rules.country_id"
                    :error-messages="errors.collect('country_id')"
                    data-vv-as="Country"
                >
                    <template v-slot:selection="{ item }">
                        <div class="d-flex align-center">
                            <avatar :elevation="true" size="1.5rem" :object="item" :offset-right="true"></avatar>
                            <span>{{ item.name }}</span>
                        </div>
                    </template>
                    <template v-slot:item="{ item }">
                        <div class="d-flex align-center">
                            <avatar :elevation="true" size="1.5rem" :object="item" :offset-right="true"></avatar>
                            <span>{{ item.name }}</span>
                        </div>
                    </template>
                </v-autocomplete>
                <v-text-field
                    :label="$store.state.texts.address"
                    outlined
                    class="rounded-0 mb-2"
                    color="secondary"
                    name="address"
                    v-model="profileObj.values.address"
                    v-validate="profileObj.rules.address"
                    :error-messages="errors.collect('address')"
                    data-vv-as="Address"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="4">
                <v-btn :loading="loading" @click="validate()" block color="secondary" tile height="3.5rem" :outlined="$vuetify.theme.dark">
                   {{$store.state.texts.save_changes}}
                </v-btn>
            </v-col>
        </v-row>
    </div>
</template>
<script>
import Avatar from "../../../../components/Avatar";
import SelectPhone from "../../../../components/form/SelectPhone";
import Profile from "../../../models/Profile";
import Helpers from "../../../../mixins/Helpers";
export default {
    name: 'PersonalInfo',
    mixins: [Helpers],
    components: {SelectPhone, Avatar},
    props: {
        countries: {
            required: true,
            type: Array
        },
        genders: {
            required: true,
            type: Array
        }
    },
    data(){
        return {
            profileObj: new Profile(this.$store.state.user),
            dateMenu: false,
            loading: false,
            date: new Date()
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
            this.profileObj.update(this.$store.state.path+'profile/update-info')
                .then(response => {
                    this.loading = false;
                    const data = {key: 'user', value: response.data.info};
                    this.$store.commit('updateData', data);
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
