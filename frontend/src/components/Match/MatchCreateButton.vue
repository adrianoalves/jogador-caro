<template>
  <q-page-sticky position="bottom" :offset="[18, 18]">
    <q-btn fab push glossy icon="sports_soccer" color="teal-5" @click="openCreateForm" />
  </q-page-sticky>
</template>

<script setup>
import {openCreateForm} from "src/composables/useMatchCreate"
</script>

<style scoped>

</style>
