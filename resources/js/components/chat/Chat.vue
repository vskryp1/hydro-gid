<template>
	<div>
		<component
			v-if="$store.state.user"
			:is="component"
			:fullscreen="mobileView"
			v-model="open"
			eager
			offset-y
			left
			max-width="100%"
			:close-on-content-click="false"
			content-class="chat-box"
		>
			<template v-slot:activator="{ attrs, on }">
				<v-badge
					overlap
					:value="chat? chat.new: false"
					color="red accent-2"
					:content="chat? chat.new: 0"
				>
					<v-btn v-on="on" v-bind="attrs" color="primary" fab x-small>
						<v-icon>mdi-chat</v-icon>
					</v-btn>
				</v-badge>
			</template>
			<v-card :width="cardWidth" :style="$vuetify.theme.dark? {'border': '1px solid rosybrown'}: ''">
				<div v-if="mobileView" class="d-flex align-center justify-end pa-1 elevation-4">
					<v-btn v-if="orderItem" @click="orderDialog = true" tile small text color="primary" class="mr-4">
						<v-icon class="mr-2">mdi-eye</v-icon>
						<span>View Order</span>
					</v-btn>
					<v-btn @click="open = false" icon small color="red">
						<v-icon color="red">mdi-close</v-icon>
					</v-btn>
				</div>
				<chat-content
					ref="ChatContent"
					v-model="activeChatId"
					:chat="chat"
					:mobile-view="mobileView"
					@orderUpdate="orderItem = $event"
					@chatUpdate="chat = $event"
				></chat-content>
			</v-card>
		</component>
		
		<v-dialog v-if="mobileView" v-model="orderDialog" fullscreen>
			<v-card>
				<div class="d-flex align-center justify-end pa-1 elevation-4">
					<v-btn @click="orderDialog = false" icon small color="red">
						<v-icon color="red">mdi-close</v-icon>
					</v-btn>
				</div>
				<order-view v-if="orderItem" :order="orderItem"></order-view>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
import Helpers from "../../mixins/Helpers";
import ChatContent from "./ChatContent";
import Screen from "../../mixins/Screen";
import OrderView from "./OrderView";
export default {
    name: 'Chat',
    components: {OrderView, ChatContent},
    mixins: [Helpers, Screen],
    data(){
        return {
            activeChatId: null,
            open: false,
            chat: this.$store.state.chat,
			
			orderItem: null,
			orderDialog: false
        }
    },
    computed: {
        cardWidth(){
            return this.activeChatId? '76rem': '19rem'
        },
		mobileView(){
			return this.__smallDesktop;
		},
		component(){
			return this.mobileView? 'v-dialog': 'v-menu';
		}
    },
    watch: {
        open(){
            if (!this.open){
                this.activeChatId = null;
				this.orderItem = null;
            }
        },
    },
}
</script>
