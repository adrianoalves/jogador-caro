<template>
  <q-layout view="lHh Lpr lFf" class="bg-blue-grey-1">
    <q-header class="bg-teal-8" reveal reveal-offset="100">
      <q-toolbar>
        <q-btn
          flat
          round
          icon="local_police"
          aria-label="Icon"
          :to="{path: '/match'}"
        />

        <q-toolbar-title>
          Jogador Caro
        </q-toolbar-title>

      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'MainLayout',

  setup () {

    return {
    }
  }
})
</script>
