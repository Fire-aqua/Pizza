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
      <span v-if="isLoggedIn"> 
        <v-btn     
        link
        class="mx-auto my-auto"
        small
        >
        <router-link :to="'/admin'">
          Сотруднику 
        </router-link>
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
import { Component } from 'vue-property-decorator';

@Component
export default class NavMenu extends Vue {  
}
</script>