<template>
    <v-dialog
        v-model="dialog"
        persistent
        max-width="21rem"
    >
        <v-card>
            <v-card-title class="justify-space-between">
                <span class="language-h5">{{ language? 'Update language': 'Add new language' }}</span>
                <v-btn icon x-small color="danger" @click="dialog = false">
                    <v-icon color="red">mdi-close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-autocomplete
                    label="Country"
                    :items="countries"
                    item-text="name"
                    item-value="id"
                    name="country_id"
                    v-model="languageObj.values.country_id"
                    v-validate="languageObj.rules.country_id"
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
                <v-row>
                    <v-col cols="12" md="4">
                        <v-text-field
                            autocomplete="off"
                            label="Code *"
                            v-model="languageObj.values.code"
                            name="code"
                            v-mask="'AA'"
                            v-validate="languageObj.rules.code"
                            :error-messages="errors.collect('code')"
                            hint="ISO 639-1"
                            data-vv-as="Code"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="8">
                        <v-text-field
                            autocomplete="off"
                            label="Name *"
                            v-model="languageObj.values.name"
                            name="name"
                            v-validate="languageObj.rules.name"
                            :error-messages="errors.collect('name')"
                            data-vv-as="Name"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-checkbox
                    dense
                    hide-details
                    v-model="languageObj.values.default"
                >
                    <template slot="label">
                        <span class="em-small-text">Default Language</span>
                    </template>
                </v-checkbox>
                <v-checkbox
                    dense
                    hide-details
                    v-model="languageObj.values.right_direction"
                >
                    <template slot="label">
                        <span class="em-small-text">Right Directed Language</span>
                    </template>
                </v-checkbox>
            </v-card-text>
            <v-card-actions>
                <small>*indicates required field</small>
                <v-spacer></v-spacer>
                <v-btn :loading="loading" color="primary" text @click="validate()">
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import Avatar from "../../../../components/Avatar";
import Helpers from "../../../../mixins/Helpers";
import Language from "../../../models/Language";

export default {
    name: 'LanguageForm',
    mixins: [Helpers],
    components: {Avatar},
    props: {
        value: {
            default: false
        },
        language: {
            default: null
        },
        countries: {
            required: true,
            type: Array
        }
    },
    data(){
        return {
            dialog: this.value,
            loading: false,
            languageObj: new Language(this.language || {})
        }
    },
    watch: {
        value(){
            this.dialog = this.value;
            if (this.value){
                this.languageObj = new Language(this.language || {});
                this.errors.clear();
                this.$validator.reset();
            }
        },
        dialog(){
            this.$emit('input', this.dialog)
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
            const request = this.language?
                this.languageObj.update(this.$store.state.path+'languages/update/'+this.languageObj.values.id):
                this.languageObj.create(this.$store.state.path+'languages/store');

            request.then(response => {
                this.$emit('saved')
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
