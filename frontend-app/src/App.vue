<template>
  <v-app>
      <v-container fluid>
        <nav-menu/>        
      </v-container>
    <v-main>
      <v-container fluid>
        <router-view/>
      </v-container>
    </v-main>
  </v-app>
</template>

<script lang="ts">
import Vue from 'vue';
import NavMenu from './components/NavMenu.vue';
import { Component } from 'vue-property-decorator';

@Component
(
  {
    components: { NavMenu }
  }
)
export default class App extends Vue {
  text: string | null = '0';
}
</script>