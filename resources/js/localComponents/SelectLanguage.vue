<template>
    <v-select
        style="max-width: 4.875rem"
        class="pa-0 ma-0"
        :dark="$vuetify.theme.dark"
        color="secondary"
        :items="$store.state.languages"
        item-text="name"
        item-value="id"
        return-object
        :value="$store.state.language.id"
        hide-details
        @change="change"
    >
        <template v-slot:selection="{ item }">
            <div class="d-flex align-center">
                <avatar :elevation="true" size="1.3rem" :object="item.country" :offset-right="true"></avatar>
                <span>{{ item.code }}</span>
            </div>
        </template>
        <template v-slot:item="{ item }">
            <div class="d-flex align-center">
                <avatar :elevation="true" size="1.3rem" :object="item.country" :offset-right="true"></avatar>
                <span>{{ item.code }} ({{ item.name }})</span>
            </div>
        </template>
    </v-select>
</template>
<script>
import Avatar from "../components/Avatar";
import Helpers from "../mixins/Helpers";
export default {
    name: 'SelectLanguage',
    mixins: [Helpers],
    components: {Avatar},
    methods: {
        change(lang){
            this.$store.commit('loader', true);
            axios.get(this.$store.state.appUrl + 'lang/'+ lang.code)
                .then(response => {
                    this.$store.commit('setData', {key: 'texts', value: response.data});
					this.setCookie('lang', lang.code)
                    setTimeout(() => this.$store.commit('loader', false), 250);
                })
                .catch(response => {
                    this.$store.commit('setData', {key: 'texts', value: response.data});
                    setTimeout(() => this.$store.commit('loader', false), 250);
                })
        },
		setCookie(name, value, days) {
			const d = new Date();
			d.setTime(d.getTime() + (days*24*60*60*1000));
			let expires = "expires="+ d.toUTCString();
			document.cookie = name + "=" + value + ";" + expires + ";path=/";
		}
    }
}
</script>
