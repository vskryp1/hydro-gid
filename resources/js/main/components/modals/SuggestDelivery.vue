<template>
    <v-dialog v-model="dialog" persistent max-width="32rem" content-class="overflow-inherit">
        <v-card>
            <v-btn @click="dialog = false" absolute top right fab x-small color="danger" style="right: 0; transform: translateX(50%)">
                <v-icon color="white">mdi-close</v-icon>
            </v-btn>
            <v-card-title class="display-1">Suggest Delivery</v-card-title>
            <v-card-text>
                <h2 class="font-weight-medium fs-24 secondary--text mb-6">
                    {{ order.name }}
                </h2>
                <div class="d-flex justify-center align-center mb-6">
                    <avatar
                        v-if="order.from_location.country"
                        :object="order.from_location.country"
                        size="2rem"
                        :offset-right="true"
                    ></avatar>
                    <p class="em-small-text subtitle--text mb-0">
                        {{ order.from_location.address }}
                    </p>
                    <v-icon class="mx-2" small color="primary">mdi-arrow-right</v-icon>
                    <avatar
                        v-if="order.to_location.country"
                        :object="order.to_location.country"
                        size="2rem"
                        :offset-right="true"
                    ></avatar>
                    <p class="em-small-text subtitle--text mb-0">
                        {{ order.to_location.address }}
                    </p>
                </div>
                <div class="d-flex align-center mb-4">
                    <span class="em-small-text font-weight-bold secondary--text mb-0">
                        Not later {{ order.wait_to }}
                    </span>
                </div>
                <v-textarea
                    outlined
                    label="Suggest Message"
                    placeholder="Enter your sentence"
                    v-model="text"
                    name="text"
                    data-vv-as="Text"
                    v-validate="'required|min:10|max:1000'"
                    :error-messages="errors.collect('text')"
                ></v-textarea>
                <v-btn @click="submit()" :loading="loading" block color="primary">Submit</v-btn>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script>

import Avatar from "../../../components/Avatar";
import Helpers from "../../../mixins/Helpers";
export default {
    name: 'SuggestDelivery',
    mixins: [Helpers],
    components: {Avatar},
    props: {
        order: {
            required: true,
            type: Object
        },
        value: {
            default: false
        }
    },
    data(){
        return {
            dialog: this.value,
            text: null,
            loading: false
        }
    },
    watch: {
        value(){
            this.dialog = this.value;
            this.text = null;
            this.$validator.reset();
        },
        dialog(){
            this.$emit('input', this.dialog)
        }
    },
    methods: {
        submit(){
            this.$validator.validateAll().then(valid => {
                if (valid){
                    this.loading = true;
                    const data = {
                        order_id: this.order.id,
                        text: this.text
                    }
                    axios.post(this.$store.state.mainPath+'chat/make', data)
                        .then(response => {
                            this.loading = false;
                            this.dialog = false;
                            this.$emit('suggestSent');
                            this.$store.commit("setAlert", {type: 'info', message: response.data.message});
                        })
                        .catch(error => {
                            this.loading = false;
                            this.__errorResponse(error);
                        })
                }
            })
        }
    }
}
</script>
