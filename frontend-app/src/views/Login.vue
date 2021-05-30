<template>
  <div>
      <v-card
      class="w-50 mx-auto"
      max-width="500"
      >
        <v-card-title>
          Личный кабинет (для сотрудника)
        </v-card-title>
        <v-card-text>
          Раз это тренировочный проект на гите, входить можно всем!
        </v-card-text>
        <v-container fluid>
          <v-text-field
          class="mx-auto my-auto"
          label="Логин"
          v-model="enter.login">
          </v-text-field>
          <v-text-field
          class="mx-auto my-auto"
          label="Пароль"
          v-model="enter.password">
          </v-text-field>
          <v-row
          class="mx-auto my-auto">
            <v-btn
            class="mx-auto"
            @click="login()">
            Войти
            </v-btn>
          </v-row>
        </v-container>
      </v-card>
  </div>
</template>

<script lang="ts">
import axios from "axios";
import Vue from 'vue'
import Component from "vue-class-component";

@Component({})
export default class Registration extends Vue {
  enter = {
    login: "admin",
    password: "admin"
  } 

  login() {
    axios.post('/login', {
      login: this.enter.login,
      password: this.enter.password
    })
    .then(() => {
      this.$store.commit('loginUser')
      this.$router.push({ name: 'Admin' })
    })
    .catch(error => console.log(error))
  }
}
</script>