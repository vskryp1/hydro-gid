<template>
    <div class="d-flex flex-column w-100 justify-center align-center">
        <support-carousel></support-carousel>
        <accordion></accordion>
    </div>
</template>
<script>
import Helpers from "../../../mixins/Helpers";
import Accordion from "../../components/sections/Accordion";
import SupportCarousel from "../../components/sections/SupportCarousel";
export default {
    name: 'Support',
    components: {SupportCarousel, Accordion},
    mixins: [Helpers],
    data(){
        return {

        }
    },
    computed: {

    },
    methods: {

    },
    created() {

    }
}
</script>
