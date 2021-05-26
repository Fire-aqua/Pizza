<template>
  <div>
    <!-- <bar />     -->
    <list /> 
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import List from "../components/List.vue";
import Bar from "../components/Bar.vue";

@Component({
  components: { List, Bar },
})
export default class Home extends Vue {}
</script>
