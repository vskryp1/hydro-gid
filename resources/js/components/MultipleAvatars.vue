<template>
    <div class="d-flex align-center">
        <template v-for="(item, index) in items">
            <avatar
                v-if="index < max"
                :object="item"
                :size="size"
                :offset-right="false"
            ></avatar>
        </template>
        <span v-if="items.length > max" class="primary--text pl-2">+{{ items.length - max }}</span>
    </div>
</template>
<script>
import Avatar from "./Avatar";
export default {
    name: 'MultipleAvatars',
    components: {Avatar},
    props: {
        items: {
            default: () => []
        },
        size: {
            default: '1.5rem'
        },
        max: {
            default: 4
        }
    }
}
</script>
