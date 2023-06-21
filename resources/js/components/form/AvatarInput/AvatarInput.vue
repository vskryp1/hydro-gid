<template>
    <div class="position-relative" :style="{height: boxHeight, width: boxWidth}">

        <!--Input-->
        <label class="pointer">
            <span v-if="label" class="font-weight-medium secondary--text mb-1">
                {{ label }}
            </span>
            <div
                class="overflow-hidden"
                :class="[!borderRadius? 'rounded-0': null, elevation? 'elevation-4': '', bottomOffset? 'mb-4': '']"
                :style="{
                    height: boxHeight,
                    width: boxWidth,
                    outline: (!previewImage || multiple) && border? '1px dashed': null,
                    'border-radius': borderRadius,
                    'background-color': color,
                }">
                <v-hover>
                    <template v-slot:default="{ hover }">
                        <div :class="!multiple? 'position-relative': ''" class="h-100 w-100 d-flex justify-center align-center">
                            <v-fade-transition hide-on-leave>
                                <template v-if="previewImage && previewImage.length">
                                    <slot v-if="$slots.preview" name="preview"></slot>

                                    <template v-else>
                                        <template v-if="multiple">
                                            <div class="d-flex flex-wrap">
                                                <v-hover v-for="(item, index) in previewImage" :key="index">
                                                    <template v-slot:default="{ hover }">
                                                        <div
                                                            :style="{height: itemHeight, width: itemWidth}"
                                                            class="position-relative"
                                                        >
                                                            <v-img
                                                                :lazy-src="$store.state.logo"
                                                                :contain="previewContain"
                                                                :height="itemHeight"
                                                                :width="itemWidth"
                                                                :src="item.uri"
                                                            ></v-img>
                                                            <v-overlay opacity="0.8" absolute :value="hover">
                                                                <v-btn
                                                                    v-if="removable || previewImage.length > 1"
                                                                    @click.prevent="removeItem(item, index)"
                                                                    color="danger"
                                                                    icon
                                                                    small
                                                                >
                                                                    <v-icon>mdi-close-circle-outline</v-icon>
                                                                </v-btn>
                                                            </v-overlay>
                                                        </div>
                                                    </template>
                                                </v-hover>
                                                <div
                                                    v-for="index in emptiesCount"
                                                    :key="'empty-'+index"
                                                    :style="{height: itemHeight, width: itemWidth}"
                                                    class="d-flex justify-center align-center"
                                                >
                                                    <v-icon :size="emptyIconSize(itemHeight)">{{ icon }}</v-icon>
                                                </div>
                                            </div>
                                        </template>
                                        <v-img
                                            v-else
                                            :lazy-src="$store.state.logo"
                                            :contain="previewContain"
                                            :height="boxHeight"
                                            :width="boxWidth"
                                            :src="previewImage"
                                        ></v-img>
                                    </template>
                                </template>
                                <v-icon v-else :size="emptyIconSize(boxHeight)">{{ icon }}</v-icon>
                            </v-fade-transition>

                            <template v-if="previewImage && previewImage.length">
                                <div v-if="multiple" class="position-absolute pl-2" style="top: 0; right: 0; z-index: 9; transform: translateX(100%)">
                                    <v-slide-x-transition>
                                        <div v-if="hover">
                                            <avatar-input-buttons
                                                :column="true"
                                                :removable="removable"
                                                :multiple="multiple"
                                                @add="update(true)"
                                                @update="update()"
                                                @clear="clear()"
                                            ></avatar-input-buttons>
                                        </div>
                                    </v-slide-x-transition>
                                </div>
                                <v-fade-transition v-if="!multiple">
                                    <v-overlay
                                        v-if="hover && buttons"
                                        absolute
                                        color="black"
                                    >
                                        <avatar-input-buttons
                                            :removable="removable"
                                            :multiple="multiple"
                                            @add="update(true)"
                                            @update="update()"
                                            @clear="clear()"
                                        ></avatar-input-buttons>
                                    </v-overlay>
                                </v-fade-transition>
                            </template>

                        </div>
                    </template>
                </v-hover>
            </div>
            <input
                ref="input"
                @change="getFiles"
                :id="id"
                :multiple="multiple"
                type="file"
                hidden
            >
        </label>

        <!--Crop-->
        <v-dialog v-if="crop" v-model="cropDialog" :width="cropWidth + 50" persistent>
            <v-card style="padding: 10px 25px 20px 25px" class="d-flex justify-center">
                <div class="w-100">
                    <p class="secondary--text font-weight-medium mb-2">{{ cropHeight }}x{{ cropWidth }}</p>
                    <div
                        :style="{width: __getCurrentPixels(cropWidth)+'px', height: __getCurrentPixels(cropHeight)+'px', 'border-radius': cropRounded? '50%': 'none'}"
                        class="mb-4 mx-auto"
                        style="cursor: all-scroll; border: 1px dashed; overflow: hidden"
                    >
                        <croppa
                            :style="{height: cropHeight+'px'}"
                            v-model="cropped"
                            :width="__getCurrentPixels(cropWidth)"
                            :height="__getCurrentPixels(cropHeight)"
                            :disabled="false"
                            :prevent-white-space="true"
                            :show-remove-button="false"
                        >
                            <img crossOrigin="anonymous" :src="previewImage" slot="initial">
                        </croppa>
                    </div>
                    <ul class="mb-4">
                        <li class="secondary--text">mouse <v-icon>mdi-mouse</v-icon>: Drag image.</li>
                        <li class="secondary--text">mouse wheel <v-icon>mdi-magnify</v-icon>: Zoom image.</li>
                    </ul>
                    <div class="d-flex justify-end">
                        <v-btn class="mr-2" small text color="danger" @click="cancelCrop()">Cancel</v-btn>
                        <v-btn small @click="getCropped()">{{ cropText }}</v-btn>
                    </div>
                </div>
            </v-card>
        </v-dialog>

        <!--Errors-->
        <error-message :left="errLeft" :messages="errorMessages"></error-message>
    </div>
</template>
<script>
import ErrorMessage from "../ErrorMessage";
import Screen from "../../../mixins/Screen";
import AvatarInputButtons from "./AvatarInputButtons";
export default {
    name: 'AvatarInput',
    mixins: [Screen],
    components: {AvatarInputButtons, ErrorMessage},
    props: {
        color: {
            default: 'transparent',
        },
        border: {
            default: true
        },
        icon: {
            default: 'mdi-file-image-outline'
        },
        value: {
            default: null
        },
        label: {
            default: null
        },
        preview: {
            default: null
        },
        size: {
            default: 120
        },
        height: {
            default: null
        },
        width: {
            default: null
        },
        removable: {
            default: true
        },
        buttons: {
            default: true
        },
        bottomOffset: {
            default: true
        },
        crop: {
            default: false
        },
        id: {
            default: null
        },
        cropText: {
            default: 'Crop'
        },
        cropHeight: {
            default: 320
        },
        cropWidth: {
            default: 320
        },
        cropRounded: {
            default: false
        },
        cropResolution: {
            default: null
        },
        errLeft: {
            default: false
        },
        previewContain: {
            default: false
        },
        elevation: {
            default: true
        },
        borderRadius: {
            default: '50%'
        },
        multiple: {
            default: false
        },
        errorMessages: {
            type: Array,
            default() {
                return []
            }
        }
    },
    data(){
        return {
            val: this.value,
            previewImage: this.multiple? []: null,
            cropDialog: false,
            valCropped: false,
            cropped: {},
            addMode: false,
            deletes: []
        }
    },
    computed: {
        boxWidth(){
            return this.width? this.getSize(this.width): this.getSize(this.size);
        },
        boxHeight(){
            return this.height? this.getSize(this.height): this.getSize(this.size);
        },
        squareK(){
            if (!Array.isArray(this.previewImage) || this.previewImage.length <= 1){
                return 1;
            }
            let k = 1
            while (this.previewImage.length > Math.pow(k, 2)){
                k++;
                if (this.previewImage.length <= Math.pow(k, 2)){
                    return k;
                }
            }
        },
        emptiesCount(){
            return this.multiple? Math.pow(this.squareK, 2) -  this.previewImage.length: 0;
        },
        itemWidth(){
            let number = this.boxWidth.replace(/[^0-9]/g, '');
            let symbol = this.boxWidth.replace(/[0-9]/g, '');
            return (parseInt(number) / this.squareK)+symbol;
        },
        itemHeight(){
            let number = this.boxHeight.replace(/[^0-9]/g, '');
            let symbol = this.boxHeight.replace(/[0-9]/g, '');
            return (parseInt(number) / this.squareK)+symbol;
        },
    },
    watch: {
        val(){
            this.$emit('input', this.val);
        },
        value(){
            this.val = this.value;
        },
        preview(){
            this.previewImage = this.preview;
        },
    },
    methods: {
        getSize(val){
            return val && isNaN(val)? val: this.__getCurrentPixels(val)+'px'
        },
        emptyIconSize(size){
            let symbol = size.replace(/[0-9]/g, '').replace('.', '');
            return (parseFloat(size) / 2) + symbol;
        },
        getCropped(){
            this.cropped.generateBlob((blob) => {
                let url = URL.createObjectURL(blob)
                this.val = new File([blob], new Date().getTime() + ".jpeg", {
                    type: "jpeg",
                    lastModified: Date.now()
                })
                this.cropDialog = false;
                this.valCropped = true;
                this.previewImage = url;
                this.$emit('cropped', this.val);
                this.$emit('previewImage', this.previewImage);
            });
        },
        cancelCrop(){
            this.val = null;
            this.cropDialog = false;
        },

        clear(){
            this.$emit('clear');
            if (this.multiple){
                this.$emit('delete', this.previewImage.filter(i => i.id).map(i => i.id));
            }
            this.val = this.multiple? []: null;
            this.previewImage = this.multiple? []: null;
            this.$refs.input.value = null
        },
        update(add = false){
            this.addMode = add;
            this.$refs.input.click()
        },


        /*new*/
        // getDropFiles(e){
        //     e.preventDefault();
        //     if (e.dataTransfer.items) {
        //         for (let i=0; i<e.dataTransfer.items.length; i++){
        //             if (e.dataTransfer.items[i].kind === 'file') {
        //                 this.setFile(e.dataTransfer.items[i].getAsFile())
        //             }
        //         }
        //     }else {
        //         for (let i = 0; i < e.dataTransfer.files.length; i++) {
        //             this.setFile(e.dataTransfer.files[i])
        //         }
        //     }
        // },
        getFiles(e){
            /*Set default val*/
            if (this.multiple && !Array.isArray(this.val)){
                 this.val = []
            }
            if (this.multiple && !Array.isArray(this.previewImage)){
                this.previewImage = []
            }
            /*Clear val*/
            if (this.multiple && !this.addMode){
                this.val = [];
                this.previewImage = [];
            }
            /*Set new fails*/
            for (let i = 0; i<e.target.files.length; i ++){
                this.setFile(e.target.files[i])
            }
            /*Clear input*/
            e.target.value = null;
            this.addMode = false;
        },
        setFile(file){
            if (this.multiple){
                let index = this.val.length;
                this.val.push(file);
                this.previewImage.push({
                    index: index,
                    name: file.name,
                    uri: URL.createObjectURL(file)
                });
            }else{
                this.val = file;
                this.previewImage = URL.createObjectURL(file);
                if (this.crop && file && file['type'].split('/')[0] === 'image'){
                    this.cropDialog = true;
                }
            }
        },
        setPreview(){
            if (this.multiple && this.preview){
                this.preview.forEach(item => {
                    this.previewImage.push({
                        id: item.id,
                        name: item.name,
                        uri: item.uri
                    });
                })
            }else{
                this.previewImage = this.preview;
            }
        },
        removeItem(file, previewIndex){
            if (file.id){
                if (!this.deletes.includes(file.id)){
                    this.deletes.push(file.id)
                }
                this.previewImage.splice(previewIndex, 1);
                this.$emit('delete', this.deletes);
            }else{
                this.val.splice(file.index, 1)
                this.previewImage.splice(previewIndex, 1);
            }
        },
    },
    created() {
        this.setPreview();
    }
}
</script>
