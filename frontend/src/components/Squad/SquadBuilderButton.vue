<template>
  <q-page-sticky position="bottom" :offset="[18, 18]">
    <q-btn fab push glossy icon="add_moderator" color="teal-5" @click="showForm = true" />
  </q-page-sticky>
</template>

<script setup>
 import { showForm } from "src/composables/Squad/useSquadBuilder"
</script>

<style scoped>

</style>
