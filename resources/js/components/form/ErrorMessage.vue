<template>
    <div style="min-height: 1.125rem">
        <v-slide-x-transition>
            <div v-if="messages && messages.length" :style="left? {left: 0+'!important'}: center? {left: '50%!important', transform: 'translate(-50%, 100%)'}: null" class="danger--text lh-initial">
                <span :style="messageStyle" v-if="!multipleMessages && messages.length">{{ Array.isArray(messages)? messages[0]: messages }}</span>
                <span :style="messageStyle" v-else v-for="message in messages" :key="message">{{ message }}</span>
            </div>
        </v-slide-x-transition>
    </div>
</template>
<script>
export default {
    name: 'ErrorMessage',
    props: {
        messages: {
            default: null
        },
        left: {
            default: false
        },
        center: {
            default: false
        },
        multipleMessages: {
            default: false
        },
        messageStyle: {
            default: 'font-size: 0.75rem;'
        }
    }
}
</script>
