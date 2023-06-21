<template>
    <div>
        <v-row class="pa-4">
            <v-col cols="12" md="6">
                <v-text-field
                    label="Payment system commission %"
                    v-model="settingObj.values.payment_system_commission"
                    name="payment_system_commission"
                    v-validate="settingObj.rules.payment_system_commission"
                    :error-messages="errors.collect('payment_system_commission')"
                    data-vv-as="Payment system commission"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Escobar Logistic commission %"
                    v-model="settingObj.values.esco_commission"
                    name="esco_commission"
                    v-validate="settingObj.rules.esco_commission"
                    :error-messages="errors.collect('esco_commission')"
                    data-vv-as="Escobar Logistic commission"
                ></v-text-field>
            </v-col>
        </v-row>
        <v-btn class="ma-2"  :loading="loading" color="primary"  @click="validate()">
            Save
        </v-btn>
    </div>
</template>
<script>
import Text from "../../../models/Text";
import Avatar from "../../../../components/Avatar";
import Helpers from "../../../../mixins/Helpers";
import Setting from "../../../models/Setting";

export default {
    name: 'SettingForm',
    mixins: [Helpers],
    components: {Avatar},
    props: {
        settings: {
            required: true,
            type: Object
        }
    },
    data(){
        return {
            dialog: this.value,
            loading: false,
            settingObj: new Setting(this.settings || {})
        }
    },
    watch: {
        value(){
            // this.dialog = this.value;
            // if (this.value){
            //     this.textObj = new Text(this.text || {}, this.languages);
            //     this.errors.clear();
            //     this.$validator.reset();
            // }
        },
        dialog(){
            // this.$emit('input', this.dialog)
        }
    },
    methods: {
        validate(){
            this.$validator.validateAll().then(valid => {
                if (valid){
                    this.$store.commit('confirm', this.save);
                }
            })
        },
        save(){
            this.loading = true;
            const request = this.settingObj.update(this.$store.state.path+'settings/update');

            request.then(response => {
                // this.$emit('saved')
                this.loading = false;
                this.dialog = false;
                this.$store.commit("setAlert", {type: 'info', message: response.data.message});
            })
                .catch(error => {
                    this.loading = false;
                    this.__errorResponse(error);
                })
        }
    }
}
</script>
