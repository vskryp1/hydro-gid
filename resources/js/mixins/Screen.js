export default {
    data(){
        return {
            __defaultFontSize: 16,
        }
    },
    watch: {
        __width(){
            this.__getCurrentFontSize()
        }
    },
    computed: {
        __smallDesktop(){
            return this.$store.state.window.width <= 768
        },
        __mediumDesktop(){
            return this.$store.state.window.width < 1264 && this.$store.state.window.width > 768
        },
        __largeDesktop(){
            return this.$store.state.window.width < 1904 && this.$store.state.window.width >= 1264
        },
        __xLargeDesktop(){
            return this.$store.state.window.width > 1904
        },
        __width(){
            return this.$store.state.window.width
        },
        __height(){
            return this.$store.state.window.height
        }
    },
    methods: {
        __setWindow(){
            if (window){
                const w = {
                    width: window.innerWidth,
                    height: window.innerHeight
                }

                this.$store.commit('setData', {key: 'window', value: w});
            }
        },

        __getCurrentFontSize(){
            return parseFloat(window.getComputedStyle(document.getElementById("app"), null).getPropertyValue('font-size'));
        },
        __pixelsToRem(pixels){
            return pixels/this.$data.__defaultFontSize;
        },
        __getCurrentPixels(pixels){
            return pixels * (this.__getCurrentFontSize() / this.$data.__defaultFontSize)
        }
    }
}
