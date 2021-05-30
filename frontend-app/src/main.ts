import Vue from "vue";
import Vuex from 'vuex'
import App from "./App.vue";
import router from "./router";
import vuetify from "./plugins/vuetify";
import axios from 'axios'

Vue.config.productionTip = false;
axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000/api';

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    user: false
  },
  mutations: {
    loginUser (state) {
      state.user = true
    },
    logoutUser (state) {
      state.user = false
    }
  }
})

axios
  .get('/sanctum/csrf-cookie', {
    baseURL: 'http://localhost:8000'
  }).then(() => {
    new Vue({
      router,
      vuetify,
      store,
      render: (h) => h(App),
    }).$mount("#app");
  })
