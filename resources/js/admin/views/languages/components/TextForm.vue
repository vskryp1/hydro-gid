<template>
    <v-dialog
        v-model="dialog"
        persistent
        max-width="28.125rem"
    >
        <v-card>
            <v-card-title class="justify-space-between">
                <span class="text-h5">{{ text? 'Update text': 'Add new text' }}</span>
                <v-btn icon x-small color="danger" @click="dialog = false">
                    <v-icon color="red">mdi-close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <p v-if="text" class="display-1 secondary--text mb-4">{ {{ text.key }} }</p>
                <v-text-field
                    v-else
                    label="KEY *"
                    v-model="textObj.values.key"
                    name="key"
                    v-validate="textObj.rules.key"
                    :error-messages="errors.collect('key')"
                    data-vv-as="KEY"
                ></v-text-field>
                <v-text-field
                    v-for="t in textObj.values.texts"
                    autocomplete="off"
                    :key="t.language_id"
                    :label="`Text in ${findLang(t.language_id).code} (${findLang(t.language_id).name}) *`"
                    v-model="t.text"
                    :name="`text-${t.language_id}`"
                    v-validate="textObj.rules.text"
                    :error-messages="errors.collect(`text-${t.language_id}`)"
                    data-vv-as="Text"
                >
                    <template slot="prepend">
                        <avatar
                            :elevation="true"
                            size="1.5rem"
                            :object="findLang(t.language_id).country"
                            :offset-right="true"
                        ></avatar>
                    </template>
                </v-text-field>
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
import Text from "../../../models/Text";
import Avatar from "../../../../components/Avatar";
import Helpers from "../../../../mixins/Helpers";

export default {
    name: 'TextForm',
    mixins: [Helpers],
    components: {Avatar},
    props: {
        value: {
            default: false
        },
        text: {
            default: null
        },
        languages: {
            required: true,
            type: Array
        }
    },
    data(){
        return {
            dialog: this.value,
            loading: false,
            textObj: new Text(this.text || {}, this.languages)
        }
    },
    watch: {
        value(){
            this.dialog = this.value;
            if (this.value){
                this.textObj = new Text(this.text || {}, this.languages);
                this.errors.clear();
                this.$validator.reset();
            }
        },
        dialog(){
            this.$emit('input', this.dialog)
        }
    },
    methods: {
        findLang(id){
            return this.languages.find(i => id === i.id) || {}
        },
        validate(){
            this.$validator.validateAll().then(valid => {
                if (valid){
                    this.$store.commit('confirm', this.save)
                }
            })
        },
        save(){
            this.loading = true;
            const request = this.text?
                this.textObj.update(this.$store.state.path+'languages/text/update/'+this.textObj.values.id):
                this.textObj.create(this.$store.state.path+'languages/text/store');

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
