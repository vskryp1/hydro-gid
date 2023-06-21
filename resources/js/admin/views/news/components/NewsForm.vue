<template>
    <v-dialog
        v-model="dialog"
        persistent
        max-width="35.125rem"
    >
        <v-card>
            <v-card-title class="justify-space-between">
                <span class="text-h5">{{ news? 'Update news': 'Add new news' }}</span>
                <v-btn icon x-small color="red" @click="dialog = false">
                    <v-icon color="red">mdi-close</v-icon>
                </v-btn>
            </v-card-title>
            <v-tabs v-model="tab" centered background-color="transparent">
                <v-tab v-for="item in $store.state.languages" :key="item.id" :disabled="loading">
                    <avatar size="2.5rem" :object="item.country" :offset-right="true"></avatar>
                </v-tab>
            </v-tabs>
            <v-divider></v-divider>
            <div class="px-8 pt-8">
                <v-tabs-items v-model="tab" class="transparent">

                    <!--Login Form-->
                    <v-tab-item v-for="item in $store.state.languages" :key="item.id">
                        <v-form @submit="" data-vv-scope="login" class="mb-6">
<!--                            <v-text-field-->
<!--                                label="Title *"-->
<!--                                v-model="newsObj.values.langs"-->
<!--                                name="title"-->
<!--                            ></v-text-field>-->
                        </v-form>
                        <div class="d-flex justify-end mb-2">
                            <v-btn @click="" :loading="loading" color="primary">{{ item.code }}</v-btn>
                        </div>
                    </v-tab-item>
                </v-tabs-items>
            </div>
            <v-card-actions>
                <small>*indicates required field</small>
                <v-spacer></v-spacer>
                <v-btn :loading="loading" color="primary" text @click="">
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>

import News from "../../../models/News";
import Avatar from "../../../../components/Avatar";
export default {
    name: 'NewsForm',
    components: {Avatar},
    mixins: [],
    props: {
        value: {
            default: false,
            type: Boolean
        },
        news: {
            default: null
        },
    },
    data(){
        return {
            loading: false,
            dialog: this.dialog,
            newsObj: new News(this.news || {}),
            resetLoading: false,
            date: new Date(),
            dateMenu: false,
            tab: 0,

        }
    },
    watch: {
        value(){
            this.dialog = this.value;
            if (this.value){
                this.newsObj = new News(this.news || {})
            }
        },
        dialog(){
            this.$emit('input', this.dialog);
            this.$validator.reset();
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
            const request = this.news?
                this.newsObj.update(this.$store.state.path+'news/update/'+this.studentObj.values.id):
                this.newsObj.create(this.$store.state.path+'news/store');

            request.then(response => {
                this.$emit('saved');
                this.loading = false;
                this.dialog = false;
                this.$store.commit("setAlert", {type: 'info', message: response.data.message});
            })
                .catch(error => {
                    this.loading = false;
                    this.__errorResponse(error);
                })
        },
    }
}
</script>

