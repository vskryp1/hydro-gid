<template>
    <v-row no-gutters>
        <v-col
            :cols="fullPage? mobileView? 2: 3: 12"
            :class="mobileView? 'elevation-4': 'elevation-4'"
            :style="mobileView? {height: '94vh'}: {background: '#F9F9F9', 'min-height': '10rem', width: '19rem'}"
        >
            <chats-list
				:by-admin="byAdmin"
                :loading="chatLoading"
                :chats="chatItems"
                :active-chat-id="activeChatId"
                :total="total"
                :height-px="heightPx"
                @activate="loadChat({ chatId: $event })"
                @getChat="getChat({offset: true})"
            ></chats-list>
        </v-col>

        <v-col v-if="fullPage && !activeChat" cols="9" class="d-flex align-center justify-center">
            <span class="display-1">Select chat for start messaging</span>
        </v-col>
        <template v-else>
            <v-slide-x-transition>
                <v-col
                    v-if="activeChatId && activeChat"
                    :cols="mobileView? 10: 6"
                    class="pa-1"
                >
                    <messages-list
                        ref="MessageList"
                        :active-chat-id="activeChatId"
						:mobile-view="mobileView"
                        :by-admin="byAdmin"
                        :total="activeChat? activeChat.total: 0"
                        :path="path"
                        :open="activeChat.open"
                        :height-px="heightPx"
                        @sent="updateChatItem"
                    ></messages-list>
                </v-col>
            </v-slide-x-transition>
            <v-slide-x-transition>
                <v-col
                    v-if="activeChatId && activeChat && !mobileView"
                    cols="3"
                    class="elevation-4"
                    style="background: #F9F9F9; min-height: 10rem"
                >
                    <order-view
                        v-if="order"
                        :order="order"
                        :chat="activeChat"
                        :by-admin="byAdmin"
                        :type="activeChat.type"
                        :height-px="heightPx"
                        @available="updateChatItem"
                        @loadChat="loadChat"
                        @statusUpdated="getChat({chatId: activeChatId})"
                    ></order-view>
                </v-col>
            </v-slide-x-transition>
        </template>
    </v-row>
</template>
<script>
import ChatsList from "./ChatsList";
import MessagesList from "./MessagesList";
import OrderView from "./OrderView";
import Helpers from "../../mixins/Helpers";
export default {
    name: 'ChatContent',
    mixins: [Helpers],
    components: {OrderView, MessagesList, ChatsList},
    props: {
        chat: {
            default: null
        },
        value: {
            default: null
        },
        byAdmin: {
			      type: Boolean,
            default: false
        },
		    mobileView: {
			    type: Boolean,
          default: false
        },
        heightPx: {
            default:  790
        },
        typeValue: {
            default: undefined
        }
    },
    data(){
        return {
            activeChatId: this.value,
            interval: null,
            order: null,
            chatLoading: false,

            path: this.byAdmin? this.$store.state.path: this.$store.state.mainPath
        }
    },
    computed: {
        total(){
            return this.chat? this.chat.total: 0;
        },
        chatItems(){
            return this.chat? this.chat.items: [];
        },
        activeChat(){
            return this.chatItems.find(c => c.id === this.activeChatId);
        },
        fullPage(){
            return this.activeChat || this.byAdmin
        }
    },
    watch: {
        value(){
            this.activeChatId = this.value;
        },
        activeChatId(){
            this.$emit('input', this.activeChatId)
        },
		order(){
			this.$emit('orderUpdate', this.order);
		}
    },
    methods: {
      loadChat(params = {}){
        this.clearInterval();
        this.order = null;
        if (this.$store.state.user){
          this.getChat(params);
          this.setInterval();
        }
      },

        getChat(loadParams = {}){
            if (loadParams.offset || loadParams.type){
                this.chatLoading = true;
            }

            if (loadParams.chatId){
                this.activeChatId = loadParams.chatId;
            }

            if (loadParams.type){
                this.$emit('typeUpdate', loadParams.type);
            }

            const url = `${this.path}chat${this.activeChatId? '/'+this.activeChatId: ''}`;

            const params = {
                offset: loadParams.offset? this.chatItems.length: undefined,
                order: loadParams.chatId || undefined,
                updates: loadParams.type || loadParams.offset? undefined: this.chatItems.map(c => c.id),
                type: loadParams.type? loadParams.type: this.typeValue
            }

            axios.get(url, {params: params})
                .then(response => {
                    this.chatLoading = false;
                    this.chatResponse(response.data.chat, loadParams);

                    this.order = loadParams.chatId? response.data.order: this.order;
                    if (this.$refs.MessageList && response.data.messages.length){
                        this.$refs.MessageList.setMessages(response.data.messages);
                    }
                })
                .catch(error => this.commit("setAlert", {type: 'error', message: error.response.data.message}));
        },

        chatResponse(chat, loadParams){
            if (this.chat && !loadParams.type){

                const localChat = this.__copyObject(this.chat) || {};

                localChat.new = chat.new;
                localChat.new_by_type = chat.new_by_type;


              localChat.items = loadParams.offset?
                localChat.items.concat(chat.items):
                this.updateChat(localChat.items, chat.items);


                this.$emit('chatUpdate', localChat);

            }else{
                this.$emit('chatUpdate', chat);
            }
        },

        updateChat(localChatItems, items){
            items.forEach(c => {
                const index = localChatItems.findIndex(sc => sc.id === c.id);
                ~index? localChatItems.splice(index, 1, c): localChatItems.push(c);
            });

            return localChatItems.sort((a,b) => b.active_time - a.active_time);
        },

        updateChatItem(chatItem){
            const localChat = this.__copyObject(this.chat) || {};
            localChat.items = this.updateChat(localChat.items, [chatItem]);
            this.$emit('chatUpdate', localChat);
        },

        getSpecialChat(){

        },

        setInterval(){
            this.interval = setInterval(() => this.getChat(), 5000);
        },
        clearInterval(){
            if (this.interval){
                clearInterval(this.interval)
            }
        }
    },
    created() {
        this.chat? this.setInterval(): this.loadChat();
    },
    beforeDestroy(){
        this.clearInterval();
    }
}
</script>
<style>
/* width */
::-webkit-scrollbar {
    width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px #F9F9F9;
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #651fff;
    border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #651fff;
}
</style>
