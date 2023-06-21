<template>
    <loader-box v-model="loading">
		<template v-if="!__smallDesktop">
			<div v-observe-visibility="calcHeight" ref="SearchBox" class="px-2">
				<v-text-field prepend-inner-icon="mdi-magnify" color="primary"></v-text-field>
				<v-divider></v-divider>
			</div>
		</template>
        <div v-scroll.self="onScroll" style="overflow-y: auto" :style="{height: height}">
            <div ref="Content">
                <template v-for="item in chats">
                    <div
                        v-ripple
                        @click="$emit('activate', item.id)"
                        class="d-flex px-2 py-2 pointer"
                        :class="[activeChatId && activeChatId === item.id? 'elevation-4 white': '', maximized? ' justify-center': '']"
                    >
                        <v-badge
                            :value="!item.open"
                            color="error"
                            icon="mdi-lock"
                            overlap
                        >
                            <avatar size="2.875rem" :object="item" :offset-right="maximized"></avatar>
                        </v-badge>
                        <div v-if="maximized" class="w-100">
                            <v-row no-gutters>
                                <v-col cols="9" class="d-flex align-baseline">
                                    <p class="fs-13 font-weight-medium primary--text em-cut-text mb-0" style="max-width: 11rem;">
                                        {{ item.name }}
                                    </p>
                                </v-col>
                                <v-col cols="3" class="d-flex align-baseline justify-end">
                                    <span v-if="item.message" class="fs-11 black--text text-no-wrap">
                                        {{ item.active_date }}
                                    </span>
                                </v-col>
                            </v-row>
                            <v-row v-if="item.message" no-gutters>
                                <v-col cols="11" class="d-flex align-baseline">
                                    <p class="fs-11 subtitle--text mb-0 pr-2 em-cut-text" style="max-width: 13rem">
                                        {{ __cutText(item.message, 75) }}
                                    </p>
                                </v-col>
                                <v-col cols="1" class="d-flex align-baseline justify-end">
                                    <v-fab-transition>
                                        <v-avatar
                                            v-if="item.new_count"
                                            size="1rem"
                                            color="red accent-2"
                                            class="white--text fs-11"
                                        >
                                            {{ item.new_count }}
                                        </v-avatar>
                                    </v-fab-transition>
                                        <v-btn
                                            icon
                                            color="red"
                                            v-if="byAdmin"
                                            @click="showDelete(item)"
                                        >
                                            <v-icon color="red">mdi-close</v-icon>
                                        </v-btn>
                                </v-col>
                            </v-row>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        <!--Confirm Delete-->
        <confirm
            v-if="deleteItem"
            v-model="deleteDialog"
            :loading="deleteLoading"
            @confirmed="destroy()"
        ></confirm>
    </loader-box>
</template>
<script>
import Avatar from "../Avatar";
import Helpers from "../../mixins/Helpers";
import LoaderBox from "../LoaderBox";
import Screen from "../../mixins/Screen";
import Confirm from "../../components/Confirm";

export default {
    name: 'ChatsList',
    components: {LoaderBox, Avatar, Confirm},
    mixins: [Helpers, Screen],
    props: {
        chats: {
            default: () => []
        },
        total: {
            default: 0,
        },
        loading: {
            default: false
        },
        activeChatId: {
            default: null
        },
        heightPx: {
            default: null
        },
		byAdmin: {
			type: Boolean,
			default: false
		},
	},
    data(){
        return {
            searchHeight: 0,
            deleteItem: {},
            deleteDialog: false,
            deleteLoading:false
        }
    },
    computed: {
        isEmpty(){
            return !this.chats.length
        },
        height(){
            return this.heightPx && this.searchHeight?
                `${this.heightPx - this.searchHeight}px`: '35rem'
        },
		maximized(){
			return this.byAdmin || !this.__smallDesktop || !this.activeChatId;
		}
    },
    methods: {
        showDelete(item = null) {
            this.deleteItem = item;
            this.deleteDialog = true;
        },
        destroy(){
            this.deleteLoading = true;
            // this.$emit('getChat', {offset: false});

            axios.delete(this.$store.state.path+'chats/delete/chat/'+this.deleteItem.id)
                .then(response => {
                    this.deleteLoading = false;
                    this.deleteDialog = false;
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                    this.$emit('getChat', {offset: false});
                })
                .catch(error => {
                    this.deleteLoading = false;
                    this.__errorResponse(error);
                })
        },
        calcHeight(){
            this.searchHeight = this.$refs.SearchBox.clientHeight;
        },
        onScroll(e) {
            if (
                !this.isEmpty &&
                !this.loading &&
                this.chats.length >= 10 &&
                this.chats.length < this.total &&
                e.target.scrollTop +
                e.target.clientHeight >= this.$refs.Content.clientHeight - 20
            ){
              this.$emit('getChat');
            }
        },
    }
}
</script>
