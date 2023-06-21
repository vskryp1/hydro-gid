<template>
    <header class="pa-0 w-100 elevation-4" style="z-index: 9; position: fixed" :style="{background: $vuetify.theme.currentTheme.bgHeader}">
      <div v-if="__smallDesktop">
        <a v-ripple="{ class: 'secondary--text' }" :href="$store.state.mainPath">
          <button style="margin: 0 auto" class="d-flex align-center pl-4 pr-6">
            <v-img width="20rem" :src="$store.state.logo"></v-img>
          </button>
        </a>
        <div class="d-flex align-center " :class="!__smallDesktop ? `px-10` : ''">
          <v-row no-gutters>
            <v-col  cols="3" class="d-flex align-center">
              <div class="ml-4">
                <chat></chat>
              </div>
            </v-col>
            <v-col  cols="3" class="d-flex align-center">
              <v-btn @click="darkToggle()" color="primary" icon class="mx-4" :dark="$vuetify.theme.dark">
                <v-icon size="1.5rem">{{ $vuetify.theme.dark? 'mdi-white-balance-sunny': 'mdi-weather-night' }}</v-icon>
              </v-btn>
            </v-col>
            <v-col  cols="3" class="d-flex align-center">
              <select-language></select-language>
            </v-col>
            <v-col  cols="3" class="d-flex align-center">
              <v-menu offset-y left max-width="17.5rem">
                <template v-slot:activator="{ on, attrs }">
                  <button v-on="on" v-ripple class="px-6" style="min-width: 3.5rem;">
                    <avatar v-if="$store.state.user" size="3.125rem" :object="$store.state.user"></avatar>
                    <v-icon v-else>mdi-dots-vertical</v-icon>
                  </button>
                </template>
                <v-card>
                  <v-card-text class="pa-0">
                    <v-btn v-if="$store.state.user" :href="$store.state.path+'dashboard/profile'" text block color="secondary">
                      <div class="d-flex justify-space-between align-center w-100">
                                        <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                            Profile
                                        </span>
                        <v-icon size="1.5rem" color="secondary">mdi-account-check-outline</v-icon>
                      </div>
                    </v-btn>
                    <v-btn v-if="!$store.state.user" :href="$store.state.path+'login'" text block color="secondary">
                      <div class="d-flex justify-space-between align-center w-100">
                                        <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                            Login
                                        </span>
                        <v-icon size="1.5rem" color="secondary">mdi-login-variant</v-icon>
                      </div>
                    </v-btn>
                    <v-btn :href="$store.state.path+'order'" text block color="secondary">
                      <div class="d-flex justify-space-between align-center w-100">
                                        <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                            Order
                                        </span>
                        <v-icon size="1.5rem" color="secondary">mdi-cash</v-icon>
                      </div>
                    </v-btn>
                    <v-btn :href="$store.state.path+'deliver'" text block color="secondary">
                      <div class="d-flex justify-space-between align-center w-100">
                                        <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                            Deliver
                                        </span>
                        <v-icon size="1.5rem" color="secondary">mdi-airplane</v-icon>
                      </div>
                    </v-btn>
                    <v-divider></v-divider>
                    <form v-if="$store.state.user" action="/logout" method="POST">
                      <input type="hidden" name="_token" :value="$csrf">
                      <v-btn type="submit" text block color="secondary">
                        <div class="d-flex justify-space-between align-center w-100">
                                            <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                                Logout
                                            </span>
                          <v-icon size="1.5rem" color="secondary">mdi-logout</v-icon>
                        </div>
                      </v-btn>
                    </form>
                    <div style="padding: 0 10px">
                      <p class="text-center">{{ texts.support }}</p>
                      <p class="text-center"> mail.eslog@gmail.com </p>
                        <a  href="https://wa.me/0533227355"><v-icon color="green" size="32">mdi-whatsapp</v-icon></a>
                    </div>
                  </v-card-text>
                </v-card>
              </v-menu>
            </v-col>
          </v-row>
        </div>
      </div>
      <div v-else class="d-flex align-center " :class="!__smallDesktop ? `px-10` : ''">
          <v-row no-gutters>
              <v-col  cols="4" class="d-flex align-center">
                  <a v-ripple="{ class: 'secondary--text' }" :href="$store.state.mainPath">
                      <button class="d-flex align-center pl-4 pr-6 py-3">
                        <img style="width: 30rem"  :src="$store.state.logo" alt="">
<!--                        <v-img width="16rem" :src="$store.state.logo"></v-img>-->
<!--                            <v-avatar size="2rem" class="mr-2">-->
<!--                                <v-img :src="$store.state.logo"></v-img>-->
<!--                            </v-avatar>-->
<!--                            <span v-if="!__smallDesktop" class="secondary&#45;&#45;text font-weight-bold fs-24">-->
<!--                                {{ $store.state.appName }}-->
<!--                            </span>-->
                      </button>
                  </a>
                  <v-divider vertical></v-divider>
                  <div class="ml-4">
                      <chat></chat>
                  </div>
              </v-col>

              <v-col v-if="!__smallDesktop" cols="4"  class="d-flex align-center justify-center">
                  <v-btn :href="$store.state.path+'order'" text color="primary" tile>{{ $store.state.texts.order }}</v-btn>
                  <v-btn :href="$store.state.path+'deliver'" text color="primary" tile>{{ $store.state.texts.deliver }}</v-btn>
              </v-col>

              <v-col v-if="!__smallDesktop" cols="4" class="d-flex align-center justify-end">
                  <v-divider vertical></v-divider>
                  <div style="padding: 0 10px">
                      <p class="text-center">{{ texts.support }}</p>
                       <p class="text-center"> mail.eslog@gmail.com </p>
                    <a href="https://wa.me/0533227355"><v-icon color="green" size="32">mdi-whatsapp</v-icon></a>
                  </div>
                  <v-divider vertical></v-divider>
                  <div class="d-flex align-center">
                      <div class="d-flex align-center mr-10">
                          <v-btn @click="darkToggle()" color="primary" icon class="mx-4" :dark="$vuetify.theme.dark">
                              <v-icon size="1.5rem">{{ $vuetify.theme.dark? 'mdi-white-balance-sunny': 'mdi-weather-night' }}</v-icon>
                          </v-btn>
                          <select-language></select-language>
                      </div>
                      <template v-if="$store.state.user">
                          <v-divider vertical></v-divider>
                          <v-menu offset-y left max-width="7.5rem">
                              <template v-slot:activator="{ on, attrs }">
                                  <button v-on="on" v-ripple class="px-6" style="min-width: 7.8125rem;">
                                      <avatar size="3.125rem" :object="$store.state.user"></avatar>
                                  </button>
                              </template>
                              <v-card>
                                  <v-card-text class="pa-0">
                                      <v-btn :href="$store.state.path+'dashboard/profile'" text block color="secondary">
                                          <div class="d-flex justify-space-between align-center w-100">
                                              <span class="mr-2 text-capitalize secondary--text">Profile</span>
                                              <v-icon size="1.5rem" color="secondary">mdi-account-check-outline</v-icon>
                                          </div>
                                      </v-btn>
                                      <v-divider></v-divider>
                                      <form action="/logout" method="POST">
                                          <input type="hidden" name="_token" :value="$csrf">
                                          <v-btn type="submit" text block color="secondary">
                                              <div class="d-flex justify-space-between align-center w-100">
                                                  <span class="mr-2 text-capitalize secondary--text">Logout</span>
                                                  <v-icon size="1.5rem" color="secondary">mdi-logout</v-icon>
                                              </div>
                                          </v-btn>
                                      </form>
                                  </v-card-text>
                              </v-card>
                          </v-menu>
                      </template>
                      <v-btn v-else :href="$store.state.path+'login'" color="primary" outlined tile>
                          {{ $store.state.texts.login_button }}
                      </v-btn>
                  </div>
              </v-col>

              <v-col v-if="__smallDesktop" cols="8" class="d-flex align-center justify-end">
                  <v-btn @click="darkToggle()" color="primary" icon class="mx-4" :dark="$vuetify.theme.dark">
                      <v-icon size="1.5rem">{{ $vuetify.theme.dark? 'mdi-white-balance-sunny': 'mdi-weather-night' }}</v-icon>
                  </v-btn>
                  <select-language></select-language>
                  <v-menu offset-y left max-width="17.5rem">
                      <template v-slot:activator="{ on, attrs }">
                          <button v-on="on" v-ripple class="px-6" style="min-width: 3.5rem;">
                              <avatar v-if="$store.state.user" size="3.125rem" :object="$store.state.user"></avatar>
                              <v-icon v-else>mdi-dots-vertical</v-icon>
                          </button>
                      </template>
                      <v-card>
                          <v-card-text class="pa-0">
                              <v-btn v-if="$store.state.user" :href="$store.state.path+'dashboard/profile'" text block color="secondary">
                                  <div class="d-flex justify-space-between align-center w-100">
                                      <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                          Profile
                                      </span>
                                      <v-icon size="1.5rem" color="secondary">mdi-account-check-outline</v-icon>
                                  </div>
                              </v-btn>
                              <v-btn v-if="!$store.state.user" :href="$store.state.path+'login'" text block color="secondary">
                                  <div class="d-flex justify-space-between align-center w-100">
                                      <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                          Login
                                      </span>
                                      <v-icon size="1.5rem" color="secondary">mdi-login-variant</v-icon>
                                  </div>
                              </v-btn>
                              <v-btn :href="$store.state.path+'order'" text block color="secondary">
                                  <div class="d-flex justify-space-between align-center w-100">
                                      <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                          Order
                                      </span>
                                      <v-icon size="1.5rem" color="secondary">mdi-cash</v-icon>
                                  </div>
                              </v-btn>
                              <v-btn :href="$store.state.path+'deliver'" text block color="secondary">
                                  <div class="d-flex justify-space-between align-center w-100">
                                      <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                          Deliver
                                      </span>
                                      <v-icon size="1.5rem" color="secondary">mdi-airplane</v-icon>
                                  </div>
                              </v-btn>
                              <v-divider></v-divider>
                              <form v-if="$store.state.user" action="/logout" method="POST">
                                  <input type="hidden" name="_token" :value="$csrf">
                                  <v-btn type="submit" text block color="secondary">
                                      <div class="d-flex justify-space-between align-center w-100">
                                          <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                              Logout
                                          </span>
                                          <v-icon size="1.5rem" color="secondary">mdi-logout</v-icon>
                                      </div>
                                  </v-btn>
                              </form>
                              <div style="padding: 0 10px">
                                  <p class="text-center">{{ texts.support }}</p>
                                  <p class="text-center"> mail.eslog@gmail.com </p>
                                <a  href="https://wa.me/0533227355"><v-icon color="green" size="32">mdi-whatsapp</v-icon></a>
                              </div>
                          </v-card-text>
                      </v-card>
                  </v-menu>
              </v-col>
          </v-row>
      </div>
    </header>
</template>
<script>
import Avatar from "../../components/Avatar";
import SelectLanguage from "../../localComponents/SelectLanguage";
import Screen from "../../mixins/Screen";
import Chat from "../../components/chat/Chat";
export default {
    name: 'AppBar',
    mixins: [Screen],
    components: {Chat, SelectLanguage, Avatar},
    data(){
        return {
            items: [
                { title: 'Click Me' },
                { title: 'Click Me' },
                { title: 'Click Me' },
                { title: 'Click Me 2' },
            ],
        }
    },
    computed: {
        texts(){
            return this.$store.state.texts;
        }
    },
    methods: {
        darkToggle(){
            this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
            this.$store.commit('dark', this.$vuetify.theme.dark);
            localStorage.setItem('theme', JSON.stringify({dark: this.$vuetify.theme.dark}));
        },
    },
}
</script>
