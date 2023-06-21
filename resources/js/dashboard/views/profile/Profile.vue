<template >

    <div>
        <div  class="d-flex justify-space-between mb-6">
<!--            <span>{{ item.code }} ({{ item.name }})</span>-->

            <div class="w-100">
                <h1 :class="__smallDesktop? 'fs-24': 'em-heading'" class="text-center mb-2 mb-6 secondary--text">
                    {{$store.state.texts.profile}}, {{ $store.state.user.name }}
                </h1>

                <div class="d-flex justify-space-between mb-6">
                    <v-btn  v-if="__smallDesktop "  style="margin-top: 3%;overflow: hidden;
                        text-overflow: ellipsis;
                        width: 30%;
                        white-space: nowrap;
                    "  href="/" color="primary" class="mb-2">
                        {{$store.state.texts.main_page}}
                    </v-btn>
                    <form v-if="$store.state.user && __smallDesktop"  style="margin-top: 3%;overflow: hidden;
                        text-overflow: ellipsis;
                        width: 30%;
                        white-space: nowrap;
                    "  action="/logout" method="POST">
                        <input type="hidden" name="_token" :value="$csrf">
                    <v-btn  v-if=""   type="submit"  block color="primary"  class="mb-2">
                        {{$store.state.texts.logout}}

                    </v-btn>
                    </form>
                </div>
                <div class="d-flex justify-space-between mb-6">
                <v-btn  v-if="__smallDesktop"  style="margin-top: 3%;overflow: hidden;
                        text-overflow: ellipsis;
                        width: 30%;
                        white-space: nowrap;
                    "  :href="$store.state.path +'orders'" color="primary" class="mb-2">
                    {{$store.state.texts.orders}}

                </v-btn>
                <v-btn  v-if="__smallDesktop "   style="margin-top: 3%;overflow: hidden;
                        text-overflow: ellipsis;
                        width: 30%;
                        white-space: nowrap;
                    " :href="$store.state.path +'trips'" color="primary" class="mb-2">
                    {{$store.state.texts.trips}}
                </v-btn>


                    </div>
                <div v-if="__smallDesktop" class="d-flex justify-center w-100 mb-8">
                    <avatar-input
                        ref="avatarInput"
                        :preview="$store.state.user.avatar"
                        size="7rem"
                        :bottom-offset="false"
                        :color="$vuetify.theme.currentTheme.bgCards"
                        icon="mdi-account-outline"
                        :crop="true"
                        crop-text="Save"
                        :crop-rounded="true"
                        :crop-height="200"
                        :crop-width="200"
                        :crop-dialog-width="400"
                        name="avatar"
                        v-validate="'image|size:2048'"
                        :error-messages="errors.collect('avatar')"
                        data-vv-as="Avatar"
                        @cropped="saveAvatar"
                        @clear="saveAvatar()"
                    ></avatar-input>

                </div>
                <div :class="__smallDesktop? 'mx-auto': ''" class="px-2 rounded bgCards w-fit">
                    <v-tabs
                        v-model="activeTab"
                        :slider-size="3"
                        background-color="transparent"
                        color="secondary"
                        class="w-100"
                    >
                        <v-tab v-for="tab in tabs" class="px-10 text-capitalize" :key="tab.value">
                            {{ tab.title }}
                        </v-tab>
                    </v-tabs>
                </div>
            </div>
            <div>
                <avatar-input
                    v-if="!__smallDesktop"
                    ref="avatarInput"
                    :preview="$store.state.user.avatar"
                    size="8.5rem"
                    :bottom-offset="false"
                    :color="$vuetify.theme.currentTheme.bgCards"
                    icon="mdi-account-outline"
                    :crop="true"
                    crop-text="Save"
                    :crop-rounded="true"
                    :crop-height="200"
                    :crop-width="200"
                    :crop-dialog-width="400"
                    name="avatar"
                    v-validate="'image|size:2048'"
                    :error-messages="errors.collect('avatar')"
                    data-vv-as="Avatar"
                    @cropped="saveAvatar"
                    @clear="saveAvatar()"
                ></avatar-input>
            </div>
        </div>
        <v-card class="em-card-p" style="min-height: 24rem">
            <v-tabs-items :value="activeTab" class="transparent overflow-inherit">
                <v-tab-item>
                    <personal-info :countries="countries" :genders="genders"></personal-info>
                </v-tab-item>
                <v-tab-item>
                    <security></security>
                </v-tab-item>
            </v-tabs-items>
        </v-card>
    </div>
</template>
<script>
import PersonalInfo from "./tabs/PersonalInfo";
import Security from "./tabs/Security";
import AvatarInput from "../../../components/form/AvatarInput/AvatarInput";
import Helpers from "../../../mixins/Helpers";
import {objectToForm} from "object-to-form";
import Screen from "../../../mixins/Screen";
export default {
    name: 'Profile',
    mixins: [Helpers, Screen],
    components: {AvatarInput, Security, PersonalInfo},
    data(){
        return {
            tabs: [
                {title: 'Personal info', value: 'personal'},
                {title: 'Security', value: 'security'},
            ],
            activeTab: 0,
            countries: [],
            genders: [],
        }
    },
    methods: {
        saveAvatar(file){
            this.$validator.validateAll().then(valid => {
                if (valid){
                    axios.post(this.$store.state.path+'profile/update-avatar', objectToForm({file: file}))
                        .then(response => {
                            const data = {key: 'user', value: {avatar: response.data.avatar}};
                            this.$store.commit('updateData', data);
                        })
                        .catch(error => this.__errorResponse(error))
                }
            })
        }
    },
    created() {
        this.$data.__dataRoute = 'profile/data';
        this.__getData({loader: true})
    }
}
</script>
