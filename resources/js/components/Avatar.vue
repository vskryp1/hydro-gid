<template>
    <v-avatar
        v-ripple="button"
        :rounded="rounded"
        :color="!avatarSrc? generateColor: null"
        :size="!width && !height? size: null"
        :width="width? width: height? '100%': null"
        :height="height? height: width? '100%': null"
        :class="[offsetRight? 'mr-2': null, elevation? 'elevation-4': null, button? 'pointer': '']"
        @click="button? $emit('click'): null"
    >
        <v-img :lazy-src="avatarSrc" :contain="contain" v-if="avatarSrc" @error="imgError = true" :src="avatarSrc"></v-img>
        <span v-else class="white--text text-uppercase" :style="{'font-size': fontSize}">{{ initials }}</span>
    </v-avatar>
</template>
<script>
export default {
    name: 'Avatar',
    props: {
        avatar: {
            default: null
        },
        name: {
            default: null
        },
        color: {
            default: null
        },
        elevation: {
            default: true
        },
        contain: {
            default: false
        },
        size: {
            default: 30
        },
        offsetRight: {
            default: false
        },
        rounded: {
            default: false
        },
        object: {
            default: null
        },
        width: {
            default: null
        },
        height: {
            default: null
        },
        button: {
            default: false
        }
    },
    data() {
        return {
            imgError: false,
            imgErrorSrc: this.$store.state.logo,
            defaultColor: '#7B68EE',
            colors: {
                a: '#154570',
                b:  '#FF7F50',
                c:  '#531f0d',
                d:  '#2F4F4F',
                e:  '#00BFFF',
                f:  '#228B22',
                g:  '#053705',
                h:  '#B22222',

                i: '#154570',
                j:  '#FF7F50',
                k:  '#531f0d',
                l:  '#2F4F4F',
                m:  '#00BFFF',
                n:  '#228B22',
                o:  '#042804',
                p:  '#B22222',

                q: '#154570',
                r:  '#FF7F50',
                s:  '#531f0d',
                t:  '#2F4F4F',
                u:  '#00BFFF',
                v:  '#228B22',
                w:  '#054e05',
                x:  '#B22222',

                y: "#aea89a",
                z: "#708090"
            }
        }
    },
    computed: {
        initials(){
            let string = null;
            if (this.object){
                string = this.object.nickname || this.object.name || this.object.email || this.object.title || null
            }else{
                string = this.name;
            }

            if (!string){
                string = 'Student';
            }

            let split = string.split(' ');
            return split.length > 1? split[0].charAt(0)+split[1].charAt(0): split[0].charAt(0)+split[0].charAt(1);
        },
        generateColor(){
            const key = this.initials && this.initials[0].toLowerCase() || false;
            if(key !== false) {
                return this.colors[key] || this.defaultColor;
            }
            return this.color || this.darkColor()
        },
        fontSize() {
            let size = !Number.isInteger(this.size) && ~this.size.search('rem')? parseInt(this.size) * 16: this.size;
            return Number(size > 100)? '-webkit-xxx-large': Number(size < 30)?'xx-small': null;
        },
        avatarSrc(){
            if (this.imgError){
                return this.imgErrorSrc;
            }
            if (this.object){
                return this.object.avatar || this.object.logo || this.object.flag || this.object.image || this.object.icon || null
            }else{
                return this.avatar
            }
        }
    },
    methods: {
        darkColor(){
            let hex = Math.floor(Math.random()*16777215).toString(16);
            if (hex.length < 6) {
                hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
            }
            let lum = 0;

            // convert to decimal and change luminosity
            let rgb = "#", c, i;
            for (i = 0; i < 3; i++) {
                c = parseInt(hex.substr(i*2,2), 16);
                c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                rgb += ("00"+c).substr(c.length);
            }

            return rgb;
        }
    }
}
</script>
