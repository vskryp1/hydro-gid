<template>
    <div class="d-flex justify-center align-center">
        <v-card  class="d-flex mt-5" width="38rem">
            <v-card-text>
                <auth-form @logged="logged"></auth-form>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
import AuthForm from "../../components/auth/AuthForm";

export default {
    name: 'Login',
    components: {AuthForm},
    methods: {
        logged(){
            window.location.href = this.$store.state.mainPath;
        }
    }
}
</script>

