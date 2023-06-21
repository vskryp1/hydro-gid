<template>
    <div class="d-flex flex-column w-100 justify-center align-center">

        <!-- Main Slider -->
        <main-carousel></main-carousel>

        <!-- Delivered Orders -->
        <delivered-orders></delivered-orders>

        <!-- How Working -->
        <how-to-works></how-to-works>

<!--        &lt;!&ndash; News &ndash;&gt;-->
<!--        <newsletter></newsletter>-->
    </div>
</template>
<script>
import HowToWorks from "../../components/sections/HowTheWorks";
import MainCarousel from "../../components/sections/MainCarousel";
import Newsletter from "../../components/sections/Newsletter";
import DeliveredOrders from "../../components/sections/DeliveredOrders";
export default {
    name: 'Home',
    components: {DeliveredOrders, Newsletter, MainCarousel, HowToWorks},
    data(){
        return {}
    }
}
</script>
