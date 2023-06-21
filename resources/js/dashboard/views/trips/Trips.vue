<template>
    <v-row>
        <v-col cols="12" :md="selected && !__smallDesktop? 8: 12">
            <v-card class="h-100 d-flex flex-column" style="min-height: 83vh;">
                <v-card-title class="py-2 elevation-4 mb-4" style="z-index: 1">
                    <h2 class="mr-4 fs-24 font-weight-regular">Trips</h2>
                    <v-spacer></v-spacer>
                    <v-text-field
                        class="mt-0 pt-0 mb-1 mr-6"
                        @input="__getPaginate({search: $event})"
                        :value="$data.__paginateQuery.search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                        clearable
                        style="max-width: 15rem"
                    ></v-text-field>
                    <v-btn @click="showForm()" :class="__smallDesktop? 'mt-4': ''" tile small color="primary">+ Add new trip</v-btn>
                </v-card-title>
                <v-card-text class="py-0">
                    <v-data-table
                        v-if="$data.__paginate"
                        :headers="headers"
                        :items="$data.__paginate.data"
                        hide-default-footer
                        :loading="$data.__paginateLoading"
                        loader-height="1"
                        disable-sort
                        disable-pagination
                    >
                        <template v-slot:item.from="{ item }">
                            <div class="d-flex align-center">
                                <avatar :object="item.from_location.country" :offset-right="true" size="1.5rem"></avatar>
                                <span class="em-small-text secondary--text">{{ item.from_location.address }}</span>
                            </div>
                        </template>

                        <template v-slot:item.to="{ item }">
                            <div class="d-flex align-center">
                                <avatar :object="item.to_location.country" :offset-right="true" size="1.5rem"></avatar>
                                <span class="em-small-text secondary--text">{{ item.to_location.address }}</span>
                            </div>
                        </template>

                        <template v-slot:item.available="{ item }">
                            <div class="d-flex align-center" style="margin-left: -1rem;">

                                <button @click="toggleSelectTrip(item)" v-ripple v-if="item.available_orders.length" class="d-flex align-center pa-3">
                                    <v-icon color="primary" class="mr-2">mdi-eye-outline</v-icon>
                                    <multiple-avatars
                                        :items="item.available_orders.map(o => o.user)"
                                    ></multiple-avatars>
                                </button>

                                <span v-else class="danger--text pa-3">
                            <v-icon color="danger">mdi-emoticon-sad-outline</v-icon> No order available
                        </span>
                            </div>
                        </template>

                        <template v-slot:item.actions="{ item }">
                            <div class="d-flex align-center">
                                <v-btn @click="showForm(item)" icon small color="primary">
                                    <v-icon small color="primary">mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn
                                    @click="$store.commit('confirm', {callback: destroy, args: item.id, btnText: 'Delete'})"
                                    :loading="destroyId === item.id"
                                    icon
                                    small
                                    color="red"
                                >
                                    <v-icon small color="red">mdi-close</v-icon>
                                </v-btn>
                            </div>
                        </template>
                    </v-data-table>
                </v-card-text>
                <v-spacer></v-spacer>
                <v-card-actions class="justify-center">

                    <v-pagination
                        v-if="$data.__paginate"
                        @input="__getPaginate({page: $event})"
                        :value="$data.__paginate.current_page"
                        :length="Math.ceil($data.__paginate.total/$data.__paginate.per_page)"
                        total-visible="10"
                    ></v-pagination>
                </v-card-actions>

                <!--Trip Form-->
                <trip-form v-model="formDialog" :trip="formItem" @saved="__getPaginate()"></trip-form>
            </v-card>
        </v-col>


        <!--Crossing Orders-->
        <template v-if="__smallDesktop">
            <v-dialog persistent v-model="selectedDialog">
                <trip-available
                    v-if="selected"
                    :trip="selected"
                    @close="toggleSelectTrip()"
                    @getData="[__getPaginate(), toggleSelectTrip()]"
                ></trip-available>
            </v-dialog>
        </template>
        <template v-else>
            <v-slide-y-transition>
                <v-col v-if="selected" cols="12" md="4">
                    <trip-available
                        :trip="selected"
                        @close="toggleSelectTrip()"
                        @getData="[__getPaginate(), toggleSelectTrip()]"
                    ></trip-available>
                </v-col>
            </v-slide-y-transition>
        </template>
    </v-row>
</template>
<script>
import Helpers from "../../../mixins/Helpers";
import Avatar from "../../../components/Avatar";
import TripForm from "./components/TripForm";
import MultipleAvatars from "../../../components/MultipleAvatars";
import TripAvailable from "./components/TripAvailable";
import Screen from "../../../mixins/Screen";

export default {
    name: 'Trips',
    components: {TripAvailable, MultipleAvatars, TripForm, Avatar},
    mixins: [Helpers, Screen],
    data(){
        return {
            headers: [
                { text: 'From', value: 'from' },
                { text: 'To', value: 'to' },
                { text: 'Date', value: 'date_formatted' },
                { text: 'Orders Available', value: 'available' },
                { text: 'Actions', value: 'actions'},
            ],
            formItem: null,
            formDialog: false,

            destroyId: null,

            selected: null,
            selectedDialog: false
        }
    },
    methods: {

        showForm(item = null) {
            this.formItem = item;
            this.formDialog = true;
        },

        toggleSelectTrip(item = null){
            this.selected = item;
            this.selectedDialog = !!item;
        },

        destroy(id){
            this.destroyId = id
            axios.delete(this.$store.state.path+'trips/destroy/'+id)
                .then(response => {
                    this.destroyId = null;
                    this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                    this.__getPaginate();
                })
                .catch(error => {
                    this.destroyId = null;
                    this.__errorResponse(error);
                })
        }
    },
    created() {
        this.$data.__dataRoute = 'trips/data';
        this.$data.__paginateRoute = 'trips/paginate';

        this.__getData({loader: true, locals: ['paginate']});
    }
}
</script>
