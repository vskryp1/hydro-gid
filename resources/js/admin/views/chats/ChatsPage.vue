<template>
    <v-card class="h-100 d-flex flex-column overflow-hidden">
        <v-tabs
            v-model="activeType"
            :slider-size="3"
            background-color="transparent"
            color="secondary"
            class="elevation-4 position-relative flex-grow-0"
            style="z-index: 9"
        >
            <v-tab
                v-for="type in types"
                @click="loadChatByType(type.value)"
                class="px-10 text-capitalize"
                :key="type.value"
            >
                {{ type.name }}
            </v-tab>
        </v-tabs>
        <v-card-text
            v-observe-visibility="calcHeight"
            ref="Content"
            class="pa-0 h-100"
        >
            <chat-content
                ref="ChatContent"
                v-model="activeChatId"
                :by-admin="true"
                :chat="chat"
                :type-value="type"
                :height-px="height"
                @typeUpdate="setType"
                @chatUpdate="chat = $event"
            ></chat-content>
        </v-card-text>
    </v-card>
</template>
<script>
import ChatContent from "../../../components/chat/ChatContent";
export default {
    name: 'ChatsPage',
    components: {ChatContent},
    props: {
        types: {
            required: true,
            type: Array
        }
    },
    data(){
        return {
            activeType: 0,
            chat: null,
            activeChatId: null,
            height: 0,
        }
    },
  computed: {
    type(){
      return this.types[this.activeType]? this.types[this.activeType].value: 'order_request'
    },
  },
  methods: {
    calcHeight() {
      this.height = this.$refs.Content.clientHeight
    },
    setType(type){
      this.activeType = this.types.findIndex(t => t.value === type);
    },
    loadChatByType(type){
      this.activeChatId = null;
      this.$refs.ChatContent.loadChat({type: type})
    }
  }
}
</script>
