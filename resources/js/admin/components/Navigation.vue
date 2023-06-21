<template>
    <div style="z-index: 1; transition: 0.3s; width: 100%; position: relative" :style="{'max-width': mini? '90px': '260px'}">
        <v-btn
            @click="mini = !mini"
            style="top: 10px; right: 0; transform: translateX(50%); position: absolute; z-index: 9"
            color="#2962FF"
            dark
            fab
            x-small
        >
            <v-icon>{{ mini? 'mdi-arrow-right': 'mdi-arrow-left' }}</v-icon>
        </v-btn>
        <v-navigation-drawer
            width="260"
            :mini-variant="mini"
            mini-variant-width="90"
            fixed
            class="elevation-4"
            style="top: 65px"
        >
            <div class="pa-4 d-flex flex-column align-center">
                <div class="position-relative">
                    <avatar :size="mini? 50: 90" :object="$store.state.user"></avatar>
                    <v-btn @click="profileDialog = true" x-small fab absolute class="r-0" color="primary" dark>
                        <v-icon small>mdi-pencil</v-icon>
                    </v-btn>
                </div>
                <p v-if="!mini" class="headline lh-initial em-color-black font-weight-medium mb-0 mt-2">
                    {{ $store.state.user.name }}
                </p>
            </div>

            <v-list nav dense class="px-0">
                <v-list-item
                    v-for="item in items"
                    :key="item.value"
                    :href="$store.state.path+item.route"
                    class="rounded-0 mb-0 py-2"
                    style="min-height: 32px; border-bottom: 1px solid #BDBDBD"
                    dense
                >
                    <v-list-item-icon class="my-0 mr-2 align-self-center">
                        <v-icon size="20" color="secondary">{{ item.icon }}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title v-if="!mini" class="subtitle-1">
                        <span class="mr-1 secondary--text">{{ item.title }}</span>
                    </v-list-item-title>
                </v-list-item>
            </v-list>

        </v-navigation-drawer>

        <!--Teacher Form-->
        <admin-info-form v-model="profileDialog" :admin="$store.state.user" @updated="updateInfo"></admin-info-form>
    </div>
</template>
<script>
import Avatar from "../../components/Avatar";
import AdminHelpers from "../../mixins/AdminHelpers";
import AdminInfoForm from "./AdminInfoForm";
export default {
    name: 'Navigation',
    components: {AdminInfoForm, Avatar},
    mixins: [AdminHelpers],
    data(){
        return {
            mini: false,
            items: [
                {
                    title: 'Chats',
                    icon: 'mdi-forum-outline',
                    route: 'chats',
                    value: 'chats'
                },
                {
                    title: 'Users',
                    icon: 'mdi-account-supervisor',
                    route: 'users',
                    value: 'users'
                },
                {
                    title: 'Orders',
                    icon: 'mdi-package-variant-closed',
                    route: 'orders',
                    value: 'orders'
                },
                {
                    title: 'Languages And Texts',
                    icon: 'mdi-translate',
                    route: 'languages',
                    value: 'languages'
                },
                {
                    title: 'Settings',
                    icon: 'mdi-cog-outline',
                    route: 'settings',
                    value: 'settings'
                },
                {
                    title: 'News',
                    icon: 'mdi-newspaper',
                    route: 'news',
                    value: 'news'
                }
                // {
                //     title: 'Administration',
                //     icon: 'mdi-shield-account-outline',
                //     value: 'administration',
                //     route: 'administration',
                //     enable: this.__checkRole(['admin', 'admin_teacher']),
                //     children: [
                //         {
                //             title: 'Scenario',
                //             icon: 'mdi-graph-outline',
                //             value: 'scenario',
                //             route: 'scenario',
                //             enable: this.__checkRole(['admin', 'admin_teacher'])
                //         },
                //         {
                //             title: 'Materials',
                //             icon: 'mdi-note-multiple-outline',
                //             value: 'materials',
                //             route: 'materials',
                //             enable: this.__checkRole(['admin', 'admin_teacher'])
                //         },
                //     ]
                // },
                // {
                //     title: 'Teacher',
                //     icon: 'mdi-account-voice',
                //     value: 'teacher',
                //     route: 'teacher',
                //     enable: this.__checkRole(['admin', 'admin_teacher', 'teacher']),
                //     children: [
                //         {
                //             title: 'Lesson',
                //             icon: 'mdi-calendar-multiple-check',
                //             value: 'lesson',
                //             route: 'lesson',
                //             enable: this.__checkRole(['admin', 'admin_teacher', 'teacher'])
                //         },
                //     ]
                // },
                // {
                //     title: 'Settings',
                //     icon: 'mdi-cog-transfer-outline',
                //     value: 'settings',
                //     route: 'settings',
                //     enable: this.__checkRole(['admin', 'admin_teacher', 'teacher']),
                //     children: [
                //         {
                //             title: 'Teachers',
                //             icon: 'mdi-account-multiple-check-outline',
                //             value: 'teachers',
                //             route: 'teachers',
                //             enable: this.__checkRole(['admin', 'admin_teacher']),
                //         },
                //         {
                //             title: 'Students',
                //             icon: 'mdi-school',
                //             value: 'students',
                //             route: 'students',
                //             enable: this.__checkRole(['admin', 'admin_teacher', 'teacher']),
                //         },
                //     ]
                // },
            ],

            profileDialog: false
        }
    },
    methods: {
        updateInfo(info){
            this.$store.commit('updateData', {key: 'user', value: info});
        }
    }
}
</script>
