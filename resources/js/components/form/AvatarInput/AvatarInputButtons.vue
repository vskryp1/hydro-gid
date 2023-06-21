<template>
    <div class="d-flex" :class="column? 'flex-column': ''">
        <v-tooltip top v-if="multiple" color="secondary">
            <template v-slot:activator="{on}">
                <v-btn v-on="on" @click="$emit('add')" fab color="primary" x-small :class="column? 'mb-2': 'mr-2'">
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span class="secondaryReverse--text">Add more</span>
        </v-tooltip>

        <v-tooltip top color="secondary">
            <template v-slot:activator="{on}">
                <v-btn v-on="on" @click="$emit('update')" fab color="primary" x-small>
                    <v-icon>mdi-refresh</v-icon>
                </v-btn>
            </template>
            <span class="secondaryReverse--text">{{ multiple? 'Refresh all': 'Update' }}</span>
        </v-tooltip>

        <v-tooltip top v-if="removable" color="secondary">
            <template v-slot:activator="{on}">
                <v-btn v-on="on" @click.prevent="$emit('clear')" fab color="danger" dark x-small :class="column? 'mt-2': 'ml-2'">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </template>
            <span class="secondaryReverse--text">{{ multiple? 'Clear all': 'Clear' }}</span>
        </v-tooltip>
    </div>
</template>
<script>
export default {
    name: 'AvatarInputButtons',
    props: {
        multiple: {
            default: false
        },
        removable: {
            default: true
        },
        column: {
            default: false
        }
    }
}
</script>
