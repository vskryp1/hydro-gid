<template>
    <footer class="w-100" style="position: fixed; bottom: 0; z-index: 9" :style="{background: $vuetify.theme.currentTheme.bgSecondary}">
        <div class="w-100 d-flex justify-center elevation-4">
            <v-btn @click="sheet = !sheet" color="bgHeader" height="2.5rem" block>
                <span class="mr-2">{{ $store.state.texts.more_info }}</span>
                <v-icon color="primary">mdi-chevron-double-up</v-icon>
            </v-btn>
        </div>
        <v-bottom-sheet v-model="sheet">
            <v-sheet>
                <v-container style="padding-top: 4.5rem; padding-bottom: 4.5rem; max-width: 67.75rem; min-height: 27.75rem">
                    <v-row>
                        <v-col cols="6" md="4">
                            <p class="fs-15 mb-6 subtitle--text">About Us</p>
                            <p class="fs-15 font-weight-bold secondary--text mb-4">About Us</p>
                            <p class="fs-15 font-weight-bold secondary--text mb-4">Community</p>
                            <p class="fs-15 font-weight-bold secondary--text mb-4">For Partners</p>
                            <p class="fs-15 font-weight-bold secondary--text mb-8">Vacancies</p>
                        </v-col>
                        <v-col cols="6" md="4">
                            <p class="fs-15 mb-6 subtitle--text">Help and support</p>
                            <p class="fs-15 font-weight-bold secondary--text mb-4">Contact support</p>
                            <p class="fs-15 font-weight-bold secondary--text mb-4">FAQ</p>
                            <a target="_blank" href="https://www.gov.il/he/departments/topics/customs_israel_tax_authority/govil-landing-page"  class="fs-15 font-weight-bold secondary--text mb-4">{{ $store.state.texts.rules }}</a>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="6" md="4">
                            <h3 class="fs-24 font-weight-bold mb-4 secondary--text">{{ $store.state.appName }}</h3>
                            <p class="fs-15 secondary--text">2021 copyright ©. all right reserved.</p>
                            <div class="d-flex">
                              <img style="width: 50px" v-for="card in cards" :src="card" alt="">
                            </div>
                        </v-col>
                        <v-col cols="6" md="8">
                            <p class="ma-0 secondary--text fs-14">
                                The information on the site is not a public offer, is for informational purposes only and can be changed at the discretion of the company. The images of goods in the photographs presented in the catalog on the site may differ from the originals. The use of materials from this site without the permission of the copyright holder is prohibited.
                            </p>
                        </v-col>
                    </v-row>
                </v-container>
            </v-sheet>
        </v-bottom-sheet>
    </footer>
</template>
<script>
export default {
    name: 'AppFooter',
    data(){
        return {
            sheet: false,
            socials: [
                {
                    image: this.$store.state.imagePath+'vk.png',
                    url: 'https://vk.com/'
                },
                {
                    image: this.$store.state.imagePath+'youtube.png',
                    url: 'https://www.youtube.com/'
                },
                {
                    image: this.$store.state.imagePath+'instagram.png',
                    url: 'https://www.instagram.com/'
                }
            ],
            cards: [
                this.$store.state.imagePath+'макет_5.png',
                this.$store.state.imagePath+'макет_6.png',
                this.$store.state.imagePath+'макет_7.png',
            ]
        }
    },
}
</script>
