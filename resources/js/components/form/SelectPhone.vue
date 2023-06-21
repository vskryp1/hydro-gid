<template>
    <v-text-field
        @focus="active = true"
        @focusout="active = false"
        :dense="dense"
        :label="label"
        :outlined="outlined"
        :color="color"
        v-model="number"
        class="position-relative input-phone"
        :class="[!outlined && (number || active)? 'input-active': '', !dense? 'mb-2': '']"
        :error-messages="errorMessages"
    >
        <template slot="prepend-inner">
            <v-menu v-model="searchMenu" offset-y right :nudge-bottom="__getCurrentPixels(20)" :nudge-left="__getCurrentPixels(12)" :close-on-content-click="false">
                <template v-slot:activator="{ on, attrs }">
                    <button
                        v-ripple
                        v-on="on"
                        class="pl-0 d-flex font-weight-medium align-center"
                        :class="outlined? 'justify-end': ''"
                        :style="outlined?
                        {'border-bottom': '0.0625rem solid '+$vuetify.theme.currentTheme.secondary, 'padding-bottom': '0.1875rem'}:
                        {'margin-top': '0.0625rem'}"
                        style="width: 4.5rem;"
                    >
                        <template v-if="selected">
                            <div class="d-flex align-center">
                                <avatar :object="selected" size="1.375rem" :elevation="true" class="mr-1"></avatar>
                                <span>{{ selected.dial_code }}</span>
                            </div>
                        </template>
                    </button>
                </template>
                <v-card style="max-height: 15.625rem; overflow-y: auto">
                    <v-list dense>
                        <v-list-item>
                            <input
                                @input="searchText = $event.target.value"
                                placeholder="Search dial code"
                                class="w-100 secondary--text"
                                :style="{'border-bottom': '0.0625rem solid '+$vuetify.theme.currentTheme.secondary}"
                            >
                        </v-list-item>
                        <v-list-item-group v-model="code" @change="searchMenu = false">
                            <v-list-item
                                v-for="(item, index) in items"
                                :key="index"
                                :value="item.dial_code"
                                style="min-height: 1.5625rem;"
                                class="em-small-text"
                                v-show="selectableItems.includes(item)"
                                :disabled="!selectableItems.includes(item)"
                            >
                                <avatar :object="item" size="1.25rem" :offset-right="true"></avatar>
                                <span>{{ item.name }} {{ item.dial_code }}</span>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </v-menu>
        </template>
        <template v-if="$slots.append" slot="append">
            <slot name="append"></slot>
        </template>
    </v-text-field>
</template>
<script>
import Avatar from "../Avatar";
import Screen from "../../mixins/Screen";
export default {
    name: 'SelectPhone',
    mixins: [Screen],
    components: {Avatar},
    props: {
        label: {
            default: null
        },
        color: {
            default: null
        },
        outlined: {
            default: false
        },
        dense: {
            default: false
        },
        value: {
            default: null
        },
        countryCode: {
            default: null
        },
        countries: {
            default: null
        },
        errorMessages: {
            default: () => []
        }
    },
    data(){
        return {
            items: this.countries || [],
            searchText: null,
            searchMenu: false,
            code: null,
            number: null,
            active: false
        }
    },
    computed:{
        val(){
            return `${this.code || ''}${this.number}`
        },
        selectableItems(){
            let text = this.searchText? this.searchText.replace('+', '').toLowerCase(): null;
            return text? this.items.filter(item => ~item.name.toLowerCase().search(text) || ~item.dial_code.search(text)): this.items;
        },
        selected(){
            return this.items.find(item => item.dial_code === this.code);
        }
    },
    watch: {
        val(){
            this.$emit('input', this.val && this.val[0] !== '+'? '+'+this.val: this.val);
            this.$emit('code', this.code);
        },
        countryCode() {
            const find = this.items.find(item => item.code === this.countryCode);
            this.code = find? find.dial_code: this.code;
        },
        value(){
            let value = this.value? this.value.replace("+", ""): null;
            let val = this.val? this.val.replace("+", ""): null;
            if (value !== val){
                this.setCodeAndNumber();
            }
            if (!this.value){
                this.number = null;
            }
        },
        countries(){
            this.items = this.countries || [];
            this.setCodeAndNumber();
        }
    },
    methods: {
        setCodeAndNumber(){
            if (this.value && this.items.length){
                this.code = null;
                this.number = this.value.replace(/[^0-9,.]+/g, "");
                let val = this.value.replace("+", "")
                let find = this.items.find(item =>
                    val.substring(0, 4) === item.dial_code.replace("+", "")||
                    val.substring(0, 3) === item.dial_code.replace("+", "") ||
                    val.substring(0, 2) === item.dial_code.replace("+", "") ||
                    val.substring(0, 1) === item.dial_code.replace("+", "")
                )
                if (find){
                    this.code = find.dial_code;
                    this.number = val.substring(find.dial_code.length - 1, val.length).replace(/[^0-9,.]+/g, "");
                }else{
                    this.getLocation();
                }
            }else {
                this.getLocation();
            }
        },
        setCodeByLocation(location){
            if (location){
                let find = this.items.find(item => location.country === item.code)
                if (find){
                    // let val = this.value?  this.value.replace("+", "") : '';
                    this.code = find.dial_code
                    // this.number = val.substring(find.dial_code.length - 1, val.length);
                }else {
                    // this.number = this.value;
                }
            }
        },
        getLocation(){
            axios.get("https://ipinfo.io").then(response => {
                this.setCodeByLocation(response.data);
            });
        },
        getCountries(){}
    },
    created() {
        this.setCodeAndNumber();
        if (!this.countries)
        this.getCountries();
    }
}
</script>
<style>
.input-phone.input-active .v-text-field__slot{
  position: unset!important;
}
</style>
