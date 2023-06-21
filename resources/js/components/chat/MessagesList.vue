<template>
    <loader-box v-model="loading">
        <div
            v-scroll.self="onScroll"
            ref="Box"
            :class="loading? 'overflow-hidden': 'overflow-y-auto'"
            :style="{height: height}"
        >
            <div ref="Messages" class="d-flex flex-column justify-end" style="min-height: 100%">
                <div
                    v-for="item in messages"
                    :key="item.id"
                    class="d-flex w-100 px-4 py-1"
                    :class="[item.my? 'justify-end': item.new? 'grey lighten-4': '']"
                >
                    <div class="d-flex">
                        <avatar v-if="!item.my" :offset-right="true" size="2.5rem" color="primary" :object="item.sender"></avatar>
                        <div
                            class="pa-2 fs-11 rounded elevation-1"
                            style="max-width: 17rem; min-width: 7rem"
                            :class="item.my? 'primary white--text': 'bgSecondary'"
                        >
                            <p class="mb-1">{{ item.text }}</p>
                            <small :class="item.my? 'mr-auto': ''" class="text-no-wrap float-end">
                                {{ item.date }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 position-relative">
            <div
                v-observe-visibility="calcHeight"
                ref="MessageBox"
                @input="text = $event.target.innerText"
                @keyup.enter.exact="sendMessage()"
                @keydown.enter.shift.exact="newLine()"
                :contenteditable="canChat? 'true': undefined"
                class="fs-13 pl-2 pt-2 pb-2 rounded w-100"
                :class="canChat? 'elevation-10 pr-8': 'd-flex align-center justify-center pr-2'"
                style="height: 5rem; outline: 1px solid #C8C8C8; overflow-y: auto;"
            >
                <span v-if="!canChat" class="danger--text d-flex align-center">
                    <v-icon class="mr-2" color="danger">mdi-alert-outline</v-icon> This chat closed by admin
                </span>
            </div>
            <v-btn
                @click="sendMessage()"
                :loading="sendLoading"
                icon
                color="primary"
                style="position: absolute; top: 0.5rem; right: 0.5rem"
            >
                <v-icon color="primary">mdi-send</v-icon>
            </v-btn>
        </div>
    </loader-box>
</template>
<script>
import Avatar from "../Avatar";
import LoaderBox from "../LoaderBox";
export default {
    name: 'MessagesList',
    components: {LoaderBox, Avatar},
    props: {
        activeChatId: {
            default: null
        },
        total: {
            default: 0
        },
        open: {
            default: 0
        },
        path: {
            required: true,
            type: String
        },
        byAdmin: {
            default: false
        },
        heightPx: {
            default: null
        },
		mobileView: {
			type: Boolean,
			default: false
		},
    },
    data(){
        return {
            messages: [],
            text: null,
            loading: false,
            sendLoading: false,

            oldScroll: 0,
            messageBoxHeight: 0
        }
    },
    computed: {
        isEmpty(){
            return !this.messages.length
        },
        height(){
            return this.mobileView? '81vh':
				this.heightPx && this.messageBoxHeight?
                `${this.heightPx - this.messageBoxHeight}px`: '34rem'
        },
        canChat(){
            return this.byAdmin || this.open;
        }
    },
    watch: {
        activeChatId(){
            if (this.activeChatId){
                this.messages = [];
                this.oldScroll = 0;
                this.text = null;
                this.getData();
            }
        },
    },
    methods: {
        calcHeight(){
            this.messageBoxHeight = this.$refs.MessageBox.clientHeight;
        },
        onScroll(e) {
            if (
                !this.isEmpty &&
                !this.loading &&
                this.messages.length >= 20 &&
                this.messages.length < this.total &&
                e.target.scrollTop <= 20 &&
                this.oldScroll > e.target.scrollTop

            ){
                this.getData(this.messages.length);
            }
            this.oldScroll = e.target.scrollTop;
        },
        toBottom(){
            setTimeout(() => {
                this.$refs.Box.scroll({top:  this.$refs.Messages.clientHeight, behavior: 'smooth'});
            }, 50)
        },
        stayOnAdd(oldHeight){
            setTimeout(() => {
                this.$refs.Box.scroll({top: this.$refs.Messages.clientHeight - oldHeight, behavior: 'smooth'});
            }, 50)
        },
        newLine(){
            this.$refs.MessageBox.innerHTML = `${this.text}\n`;
        },
        setMessages(messages){
            messages.forEach(m => {
                const index = this.messages.findIndex(i => i.id === m.id);
                ~index? this.messages.splice(index, 1, m): this.addMessage(m);
            });
        },
        addMessage(message){
            this.messages.push(message);
            this.toBottom();
        },
        getData(offset = 0){
            if (this.activeChatId){
                const url = this.path+'chat/messages/'+this.activeChatId;
                this.loading = true;
                axios.get(url, {params: {offset: offset}})
                    .then(response => {
                        const oldHeight = this.$refs.Messages.clientHeight;
                        this.loading = false;
                        const messages = response.data;
                        this.messages = offset? messages.concat(this.messages): messages;
                        offset? this.stayOnAdd(oldHeight): this.toBottom();
                    })
                    .catch(error => {
                        this.loading = false;
                        this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                    })
            }
        },
        sendMessage(){
            if (this.text && this.text.trim()){
                const url = this.path+'chat/messages/'+this.activeChatId;
                this.sendLoading = true;
                axios.post(url, {text: this.text.trim()})
                    .then(response => {
                        this.sendLoading = false;
                        this.messages = response.data.messages;
                        this.$emit('sent', response.data.chat);
                        this.$refs.MessageBox.innerHTML = '';
                        this.toBottom();
                    })
                    .catch(error => {
                        this.sendLoading = false;
                        this.$store.commit("setAlert", {type: 'error', message: error.response.data.message});
                    })
            }
        }
    },
    mounted() {
        this.getData()
    }
}
</script>
