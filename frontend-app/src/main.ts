import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import vuetify from "./plugins/vuetify";
import axios from 'axios'

Vue.config.productionTip = false;
axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000/api';

axios
  .get('/sanctum/csrf-cookie', {
    baseURL: 'http://localhost:8000'
  }).then(() => {
    new Vue({
      router,
      vuetify,
      render: (h) => h(App),
    }).$mount("#app");
  })
