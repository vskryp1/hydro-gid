<template>
    <v-card class="h-100 d-flex flex-column" style="min-height: 78vh;">
        <v-tabs
            v-model="activeTab"
            :slider-size="2"
            background-color="transparent"
            color="secondary"
            class="w-100"
        >
            <v-tab v-for="tab in tabs" class="px-10 text-capitalize" :key="tab.value">
                {{ tab.title }}
            </v-tab>
        </v-tabs>
        <v-card-text class="py-0">
        <v-tabs-items :value="activeTab" class="transparent overflow-inherit">
            <v-tab-item>
                <orders-active
                    :headers="headers"
                    :orders="orders"
                    :countries="countries"
                    :statuses="statuses"
                ></orders-active>
            </v-tab-item>
            <v-tab-item>
                <orders-archive
                    :headers="headers"
                    :orders="orders"
                    :countries="countries"
                    :statuses="statuses"
                ></orders-archive>
            </v-tab-item>
        </v-tabs-items>

        </v-card-text>
    </v-card>
</template>
<script>
import OrdersActive from './OrdersActive'
import OrdersArchive from './OrdersArchive'

export default {
    name: 'Orders',
    components: { OrdersActive, OrdersArchive},
    props: {
        orders: {
            required: true,
            type: Object
        },
        countries: {
            required: true,
            type: Array
        },
        statuses: {
            required: true,
            type: Array
        },
    },
    data(){
        return {
            activeTab: 0,
            tabs: [
                {title: 'Active', value: 'active'},
                {title: 'Archived', value: 'archived'},
            ],
            headers: [
                { text: 'User', value: 'user' },
                { text: 'From', value: 'from' },
                { text: 'To', value: 'to' },
                { text: 'Name', value: 'name' },
                { text: 'Quantity', value: 'quantity' },
                { text: 'Price', value: 'price' },
                { text: 'Total Price', value: 'total_price' },
                { text: 'Status', value: 'status' },
                { text: 'Actions', value: 'actions'},
            ],
        }
    },
}
</script>
