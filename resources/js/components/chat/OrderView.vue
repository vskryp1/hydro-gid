<template>
    <div style="overflow-y: auto" :style="{height: heightPx+'px'}">
        <div v-if="byAdmin">
            <div class="d-flex align-center justify-space-between pa-4">
                <div class="d-flex align-center">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                @click="makeOrFindChat('order_request')"
                                :disabled="requestDisabled"
                                v-on="on"
                                fab
                                small
                                color="primary"
                                class="mr-2"
                            >
                                <v-icon>mdi-account-question-outline</v-icon>
                            </v-btn>
                        </template>
                        <span>Open order request chat</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                @click="makeOrFindChat('order_approving')"
                                :disabled="approvingDisabled"
                                v-on="on"
                                fab
                                small
                                color="primary"
                                class="mr-2"
                            >
                                <v-icon>mdi-account-check-outline</v-icon>
                            </v-btn>
                        </template>
                        <span>Open order approving chat</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                @click="makeOrFindChat('order_connecting')"
                                :disabled="connectingDisabled"
                                v-on="on"
                                fab
                                small
                                color="primary"
                                class="mr-2"
                            >
                                <v-icon>mdi-account-group-outline</v-icon>
                            </v-btn>
                        </template>
                        <span>Open order discussion chat</span>
                    </v-tooltip>
                </div>
                <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            @click="availableChat()"
                            :loading="loading === 'available'"
                            :disabled="loading && loading !== 'available'"
                            v-on="on"
                            fab
                            small
                            :color="chat.open? 'danger': 'success'"
                        >
                            <v-icon color="white">
                                {{chat.open? 'mdi-lock': 'mdi-lock-open-outline' }}
                            </v-icon>
                        </v-btn>
                    </template>
                    <span>{{chat.open? 'Close chat': 'Open chat' }}</span>
                </v-tooltip>
            </div>
            <div class="mb-4">
                <v-list-item-group v-model="userId">
                    <v-list-item v-for="item in order.requested_users" :key="item.id" :value="item.id">
                        <template v-slot:default="{ active }">
                            <v-list-item-action class="mr-2">
                                <avatar
                                    :object="item"
                                    size="2.5rem"
                                ></avatar>
                            </v-list-item-action>

                            <v-list-item-content>
                                <v-list-item-title>{{ item.name }}</v-list-item-title>
                                <v-list-item-subtitle>{{ item.email }}</v-list-item-subtitle>
                            </v-list-item-content>
                        </template>
                    </v-list-item>
                </v-list-item-group>
            </div>
            <div class="d-flex justify-center mb-4">
                <v-menu tile offset-y :close-on-content-click="false">
                    <template v-slot:activator="{on}">
                        <v-chip v-on="on" small label :color="statusColor(order.status)">
                            <span class="text-capitalize white--text text-center" style="width: 4rem">{{ __valToText(order.status) }}</span>
                        </v-chip>
                    </template>
                    <v-card class="px-4 py-2">
                        <v-radio-group
                            @change="updateStatus(order.id, $event)"
                            :value="order.status"
                            column
                            dense
                            hide-details
                            class="mt-0"
                        >
                            <v-radio
                                v-for="status in statuses"
                                :key="status"
                                :label="status"
                                :color="statusColor(status)"
                                :value="status"
                            >
                                <template slot="label">
                                <span :class="status === order.status? `${statusColor(status)}--text`: 'black--text'" class="text-capitalize">
                                    {{ __valToText(status) }}
                                </span>
                                </template>
                            </v-radio>
                        </v-radio-group>
                    </v-card>
                </v-menu>
            </div>
        </div>

        <v-carousel
            hide-delimiter-background
            show-arrows-on-hover
            hide-delimiters
            progress
            progress-color="primary"
            height="15rem"
            class="mb-4"
        >
            <v-carousel-item v-for="(image, i) in order.images" :key="'image'+i">
                <v-img contain class="grey lighten-3" height="15rem" :src="image.uri"></v-img>
            </v-carousel-item>
        </v-carousel>
        <div class="px-2">
            <div class="d-flex align-center mb-2">
                <avatar
                    v-if="order.from_location.country"
                    :object="order.from_location.country"
                    size="2rem"
                    :offset-right="true"
                ></avatar>
                <p class="em-small-text subtitle--text mb-0">
                    {{ order.from_location.address }}
                </p>
                <v-icon class="mx-2" small color="primary">mdi-arrow-right</v-icon>
                <avatar
                    v-if="order.to_location.country"
                    :object="order.to_location.country"
                    size="2rem"
                    :offset-right="true"
                ></avatar>
                <p class="em-small-text subtitle--text mb-0">
                    {{ order.to_location.address }}
                </p>
            </div>
            <v-divider class="mb-2"></v-divider>
            <div class="mb-2">
                <div class="d-flex align-center">
                    <avatar
                        :object="order.user"
                        size="2rem"
                        :offset-right="true"
                    ></avatar>
                    <p class="em-small-text subtitle--text mb-0">
                        {{ order.user.name }}
                    </p>
                </div>
            </div>
            <div class="d-flex align-center mb-4">
                <span class="em-small-text font-weight-bold secondary--text mb-0">
                    Not later {{ order.wait_to }}
                </span>
            </div>
            <v-divider class="mb-4"></v-divider>
            <div class="d-flex align-center justify-space-between mb-2">
                <span class="em-small-text subtitle--text">
                    Quantity
                </span>
                <span class="em-small-text font-weight-bold secondary--text">
                    x{{ order.quantity }}
                </span>
            </div>
            <div class="d-flex align-center justify-space-between mb-2">
                <span class="em-small-text subtitle--text">
                    Price
                </span>
                <span class="em-small-text font-weight-bold secondary--text">
                    {{ __formatAmount(order.price) }}
                </span>
            </div>
            <div class="d-flex align-center justify-space-between mb-2">
                <span class="em-small-text subtitle--text">
                    Total Price
                </span>
                <span class="em-small-text font-weight-bold secondary--text">
                    {{ __formatAmount(order.total_price) }}
                </span>
            </div>
            <div class="d-flex align-center justify-space-between mb-4">
                <span class="em-small-text subtitle--text">
                    Reward
                </span>
                <span class="em-small-text font-weight-bold secondary--text">
                    {{ $store.state.texts.contract_price }}
                </span>
            </div>
            <v-divider class="mb-4"></v-divider>
            <span class="subtitle--text fs-11">Description</span>
            <p class="em-small-text overflow-y-auto" style="max-height: 7.8rem;">
                {{ order.description }}
            </p>
        </div>
    </div>
</template>
<script>
import Avatar from "../Avatar";
import Helpers from "../../mixins/Helpers";
export default {
    name: 'OrderView',
    mixins: [Helpers],
    components: {Avatar},
    props: {
        order: {
            required: true,
            type: Object
        },
        byAdmin: {
            default: false
        },
        type: {
            default: null
        },
        chat: {
			default: null
        },
        heightPx: {
            default: null
        }
    },
    data(){
        return {
            loading: null,
            userId: null,
            statuses: ['pending', 'in_progress', 'completed', 'rejected'],
        }
    },
    watch: {
        order(){
            this.setUserId();
        }
    },
    computed: {
        chatUserSelected(){
            return this.chat? this.chat.user_ids.includes(this.userId): false;
        },
        requestDisabled(){
            return !this.userId || (this.chatUserSelected && this.chat.type === 'order_request');
        },
        approvingDisabled(){
            return this.chat? this.chat.type === 'order_approving': null;
        },
        connectingDisabled(){
            return this.chat? (!this.userId || (this.chatUserSelected && this.chat.type === 'order_connecting')): null;
        },
    },
    methods: {
        statusColor(status){
            switch(status) {
                case 'completed':
                    return 'success';
                case 'pending':
                    return 'orange';
                case 'in_progress':
                    return 'blue';
                case 'rejected':
                    return 'danger';
            }
        },

        setUserId(){
            if (this.byAdmin){
                if (this.order){
                    const reqUser = this.order.requested_users.find(i => this.chat.user_ids.includes(i.id));
                    this.userId = reqUser? reqUser.id: null;
                }else {
                    this.userId = null;
                }
            }
        },

        makeOrFindChat(type){
            this.loading = type;
            const data = {
                order_id: this.order.id,
                type: type,
                user_id: this.userId
            }
            axios.post(this.$store.state.path+'chat/make', data)
                .then(response => {
                    this.loading = null;
                    this.$emit('loadChat', {chatId: response.data.id, type: response.data.type});
                })
                .catch(error => {
                    this.loading = null;
                    this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                })
        },

        availableChat(){
            this.loading = 'available';
            axios.delete(this.$store.state.path+'chat/available/'+this.chat.id)
                .then(response => {
                    this.loading = null;
                    this.$emit('available', response.data.chat);
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                })
                .catch(error => {
                    this.loading = null;
                    this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                })
        },

        updateStatus(id, status){
            axios.post(this.$store.state.path+'orders/update-status/'+id, {status: status})
                .then(response => {
                    this.$emit('statusUpdated');
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                })
                .catch(error => {
                    this.__errorResponse(error);
                })
        },
    },
    mounted() {
        this.setUserId();
    }
}
</script>
