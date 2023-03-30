<template>
  <q-page-sticky position="bottom-left" :offset="[18, 18]">
    <q-btn fab glossy icon="add" color="light-green-9" @click="openCreateForm" />
  </q-page-sticky>
</template>

<script setup>
import {openCreateForm} from "src/composables/useMatchCreate"
</script>

<style scoped>

</style>
