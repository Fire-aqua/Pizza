<template>
  <div>   
    <v-app-bar
      color="orange"
      light
      dense
    >
      <v-btn     
      link
      class="mx-auto my-auto"
      small      
      >
        <router-link :to="'/'">
          Заказ пиццы
        </router-link>        
      </v-btn>
        <span v-if="$store.state.user"> 
        <v-btn     
        link
        class="mx-auto my-auto"
        small
        >
        <router-link :to="'/admin'">
          Управление заказами
        </router-link>
        </v-btn>     
        <v-btn     
        link
        class="mx-3"
        small
        @click="logout()"
        >
          Разлогиниться 
        </v-btn>     
      </span>
      <span v-else>
        <v-btn     
        link
        class="mx-auto my-auto"
        small
        >
        <router-link :to="'/login'">
          Войти        
        </router-link>
        </v-btn>     
      </span>
    </v-app-bar>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import axios from 'axios'
import { Component } from 'vue-property-decorator';

@Component
export default class NavMenu extends Vue {  

  logout() {
    axios.post('/logout')
    .then(() => {
      this.$store.commit('logoutUser')
      window.location.href = '/';
    })
    .catch(error => console.log(error))
  }
}
</script>