<template>
	<header :style="{background: $vuetify.theme.currentTheme.bgHeader}" class="pa-0" style="z-index: 1;">
    <div v-if="__smallDesktop">
      <a v-ripple="{ class: 'secondary--text' }" :href="$store.state.mainPath">
        <button style="margin: 0 auto" class="d-flex align-center pl-4 pr-6">
          <v-img width="25rem" :src="$store.state.logo"></v-img>
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
		<div v-else :class="__smallDesktop? 'px-1 flex-column': 'px-10'" class="d-flex align-center">
			<a v-ripple="{ class: 'secondary--text' }" :href="$store.state.mainPath">
				<button class="d-flex align-center pl-4 pr-6 py-3">
          <img style="width: 30rem"  :src="$store.state.logo" alt="">
<!--					<v-avatar class="mr-2" size="2.5rem">-->
<!--						<v-img :src="$store.state.logo"></v-img>-->
<!--					</v-avatar>-->
<!--					<span v-if="!__smallDesktop" class="secondary&#45;&#45;text font-weight-bold fs-24">-->
<!--                        {{ $store.state.appName }}-->
<!--                    </span>-->
				</button>
			</a>

			<v-divider vertical></v-divider>
            <chat style="margin-left: 20px"></chat>
			<template v-for="item in items" v-if="!__smallDesktop">
				<a :href="$store.state.path + item.route">
					<button
						v-ripple="{ class: 'secondary--text' }"
						:class="item.active? 'active': ''"
						:style="item.active? {background: $vuetify.theme.currentTheme.disabled, borderBottom: '0.1875rem solid '+$vuetify.theme.currentTheme.secondary}: {}"
						class="d-flex align-center px-6 py-4"
					>
						<v-icon class="mr-2" color="#C4C4C4" size="1.5rem">mdi-checkbox-blank-circle</v-icon>
						<span class="fs-15 font-weight-medium secondary--text lh-initial">{{ item.title }}</span>
					</button>
				</a>
			</template>
			
			<v-spacer></v-spacer>
			<div class="d-flex align-center mr-10">
				<v-btn :dark="$vuetify.theme.dark" class="mx-4" color="primary" icon @click="darkToggle()">
					<v-icon size="1.5rem">{{ $vuetify.theme.dark ? 'mdi-white-balance-sunny' : 'mdi-weather-night' }}
					</v-icon>
				</v-btn>
				<select-language></select-language>
			</div>
			<v-divider vertical></v-divider>
			<v-menu v-if="!__smallDesktop" left max-width="7.5rem" offset-y>
				<template v-slot:activator="{ on, attrs }">
					<button v-ripple class="px-6" style="min-width: 7.8125rem;" v-on="on">
						<avatar :object="$store.state.user" size="3.125rem"></avatar>
					</button>
				</template>
				<v-card>
					<v-card-text class="pa-0">
						<v-btn :href="$store.state.path+'profile'" block color="secondary" text>
							<div class="d-flex justify-space-between align-center w-100">
								<span class="mr-2 text-capitalize secondary--text">Profile</span>
								<v-icon color="secondary" size="1.5rem">mdi-account-check-outline</v-icon>
							</div>
						</v-btn>
						<v-divider></v-divider>
						<form action="/logout" method="POST">
							<input :value="$csrf" name="_token" type="hidden">
							<v-btn block color="secondary" text type="submit">
								<div class="d-flex justify-space-between align-center w-100">
									<span class="mr-2 text-capitalize secondary--text">Logout</span>
									<v-icon color="secondary" size="1.5rem">mdi-logout</v-icon>
								</div>
							</v-btn>
						</form>
					</v-card-text>
				</v-card>
			</v-menu>
			<v-menu v-if="__smallDesktop" left max-width="7.5rem" offset-y>
				<template v-slot:activator="{ on, attrs }">
					<button v-ripple class="px-6" style="min-width: 3.5rem;" v-on="on">
						<avatar v-if="$store.state.user" :object="$store.state.user" size="3.125rem"></avatar>
						<v-icon v-else>mdi-dots-vertical</v-icon>
					</button>
				</template>
				<v-card>
					<v-card-text class="pa-0">
						<v-btn block color="secondary" href="profile" text>
							<div class="d-flex justify-space-between align-center w-100">
                                <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                    Profile
                                </span>
								<v-icon color="secondary" size="1.5rem">mdi-account-check-outline</v-icon>
							</div>
						</v-btn>
						<v-btn
							v-for="item in items"
							:key="item.value"
							:href="$store.state.path + item.route"
							block
							color="secondary"
							text
						>
							<div class="d-flex justify-space-between align-center w-100">
                                <span :class="__smallDesktop? 'fs-18': ''" class="mr-2 text-capitalize secondary--text">
                                    {{ item.title }}
                                </span>
								<v-icon color="secondary" size="1.5rem">{{ item.icon }}</v-icon>
							</div>
						</v-btn>
						<v-divider></v-divider>
						<form v-if="$store.state.user" action="/logout" method="POST">
							<input :value="$csrf" name="_token" type="hidden">
							<v-btn block color="secondary" text type="submit">
								<div class="d-flex justify-space-between align-center w-100">
                                    <span :class="__smallDesktop? 'fs-18': ''"
										  class="mr-2 text-capitalize secondary--text">
                                        Logout
                                    </span>
									<v-icon color="secondary" size="1.5rem">mdi-logout</v-icon>
								</div>
							</v-btn>
						</form>
					</v-card-text>
				</v-card>
			</v-menu>
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
	components: {SelectLanguage, Avatar, Chat},
	mixins: [Screen],
	data() {
		return {
      texts: {},
			items: [
				{
					title: 'Orders',
					value: 'orders',
					route: 'orders',
					activateRoutes: ['orders'],
					active: false,
					icon: 'mdi-cash'
				},
				{
					title: 'Trips',
					value: 'trips',
					route: 'trips',
					activateRoutes: ['trips'],
					active: false,
					icon: 'mdi-airplane'
				},
			]
		}
	},
	methods: {
		setActive() {
			let route = window.location.href.split('/').at(-1);
			this.items.map(item => item.active = item.activateRoutes.includes(route))
		},
		darkToggle() {
			this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
			this.$store.commit('dark', this.$vuetify.theme.dark);
			localStorage.setItem('theme', JSON.stringify({dark: this.$vuetify.theme.dark}));
		}
	},
	created() {
		this.setActive()
	}
}
</script>
