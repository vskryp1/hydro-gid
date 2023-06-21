export default {
    methods: {
        __checkRole(val){
            return Array.isArray(val)? val.includes(this.$store.state.role.value): val === this.$store.state.role.value;
        }
    }
}
