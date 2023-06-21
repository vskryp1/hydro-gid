<template>
    <v-dialog
        v-model="dialog"
        persistent
        max-width="450px"
    >
        <v-card>
            <v-card-title class="justify-space-between">
                <span class="text-h5">{{ admin? 'Update admin profile': 'Add new admin' }}</span>
                <v-btn icon x-small color="red" @click="dialog = false">
                    <v-icon color="red">mdi-close</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-row no-gutters justify="space-between">
                    <v-col cols="12" md="4">
                        <avatar-input
                            ref="avatarInput"
                            class="mb-6"
                            :preview="infoObj.values.avatar"
                            v-model="infoObj.values.upload_file"
                            name="avatar"
                            :error-messages="errors.collect('avatar')"
                            :size="135"
                            :crop="true"
                            :crop-rounded="true"
                            :crop-height="200"
                            :crop-width="200"
                            :crop-dialog-width="400"
                            @clear="infoObj.values.avatar = null"
                        ></avatar-input>
                    </v-col>
                    <v-col cols="12" md="7">
                        <v-text-field
                            label="Name *"
                            hint="name or nickname for displaying"
                            v-model="infoObj.values.name"
                            name="name"
                            v-validate="infoObj.rules.name"
                            :error-messages="errors.collect('name')"
                            data-vv-as="Name"
                        ></v-text-field>
                        <v-text-field
                            label="Email *"
                            hint="it will be used to login"
                            v-model="infoObj.values.email"
                            name="email"
                            v-validate="infoObj.rules.email"
                            :error-messages="errors.collect('email')"
                            data-vv-as="Email"
                        ></v-text-field>

                        <template v-if="!admin || admin.id !== $store.state.user.id">
                            <v-select
                                label="Role *"
                                item-color="blue accent-4"
                                v-model="infoObj.values.role_id"
                                :items="roles"
                                item-value="id"
                                item-text="name"
                                menu-props="auto"
                                name="role"
                                v-validate="infoObj.rules.role_id"
                                :error-messages="errors.collect('role')"
                                data-vv-as="Role"
                            ></v-select>
                        </template>

                        <div v-show="!admin">
                            <v-text-field
                                type="password"
                                ref="password"
                                label="Password *"
                                v-model="infoObj.values.password"
                                name="password"
                                v-validate="admin? '': infoObj.rules.password"
                                :error-messages="errors.collect('password')"
                                data-vv-as="Password"
                            ></v-text-field>
                            <v-text-field
                                type="password"
                                label="Confirm Password *"
                                v-model="infoObj.values.password_confirmation"
                                name="password_confirmation"
                                v-validate="admin? '': infoObj.rules.password_confirmation"
                                :error-messages="errors.collect('password_confirmation')"
                                data-vv-as="Confirm Password"
                            ></v-text-field>
                        </div>
                        <div v-if="admin">
                            <v-btn
                                @click="$store.commit('confirm', resetPassword)"
                                :loading="resetLoading"
                                dark tile block
                                color="danger"
                            >
                                <v-icon small class="mr-2">mdi-alert-outline</v-icon>
                                <span>Reset Password</span>
                            </v-btn>
                        </div>
                    </v-col>
                </v-row>
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
import AvatarInput from "../../components/form/AvatarInput/AvatarInput";
import Info from "../models/Info";
import Helpers from "../../mixins/Helpers";
export default {
    name: 'AdminInfoForm',
    components: {AvatarInput},
    mixins: [Helpers],
    props: {
        value: {
            default: false,
            type: Boolean
        },
        admin: {
            default: null
        },
        roles: {
            default: () => []
        }
    },
    data(){
        return {
            loading: false,
            dialog: this.dialog,
            infoObj: new Info(this.admin || {}),
            resetLoading: false
        }
    },
    watch: {
        value(){
            this.dialog = this.value;
            if (this.value){
                this.infoObj = new Info(this.admin || {})
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
            const request = this.admin?
                this.infoObj.update(this.$store.state.path+'update/'+this.infoObj.values.id):
                this.infoObj.create(this.$store.state.path+'store');

            request.then(response => {
                this.admin? this.$emit('updated', response.data.info): this.$emit('created');
                this.loading = false;
                this.dialog = false;
                this.$store.commit("setAlert", {type: 'info', message: response.data.message});
            })
                .catch(error => {
                    this.loading = false;
                    this.__errorResponse(error);
                })
        },
        resetPassword(){
            this.resetLoading = true;
            axios.get(this.$store.state.path+'reset-password/'+this.admin.id)
                .then(response => {
                    this.resetLoading = false;
                    this.dialog = false;
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                })
                .catch(error => {
                    this.resetLoading = false;
                    this.__errorResponse(error);
                })
        }
    }
}
</script>
