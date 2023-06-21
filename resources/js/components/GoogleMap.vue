<template>
    <div :id="id" class="h-100"></div>
</template>
<script>
import Helpers from "../mixins/Helpers";

export default {
    name: 'GoogleMap',
    mixins: [Helpers],
    props: {
        fromCoords: {
            default: null,
        },
        toCoords: {
            default: null,
        }
    },
    data(){
        return {
            id: this.__makeId()
        }
    },
    methods: {
        init(){
            // The location of Uluru
            const uluru = { lat: -25.344, lng: 131.036 };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById(this.id),
                    {
                        zoom: 4,
                        center: uluru,
                    }
            );

            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    },
    mounted() {
        this.init();
    }
}
</script>
