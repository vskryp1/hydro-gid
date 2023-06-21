<template>
    <div class="pa-4">
        <h2 v-if="title" class="display-1 text-center mb-6">{{ title }}</h2>
        <div class="d-flex justify-center align-center mb-6">
            <v-img max-width="25rem" max-height="15.625rem" :src="$store.state.logo"></v-img>
        </div>
        <div class="d-flex justify-center">
            <slot name="actions"></slot>
        </div>
    </div>
</template>
<script>
export default {
    name: 'AlertBox',
    props: {
        title: {
            default: null
        }
    }
}
</script>
