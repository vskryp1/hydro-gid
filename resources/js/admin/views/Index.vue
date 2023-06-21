<template>
    <div class="d-flex flex-column">
        <v-alert color="primary" type="info">{{title}}</v-alert>
    </div>
</template>
<script>

export default {
    name: 'Index',
    data(){
        return {
            title: 'Admin dashboard',
        }
    },
}
</script>
