<template>
  <q-dialog v-model="showForm">
    <q-card round flat bordered>
      <q-card-section class="">
        <h2 class="text-h6 text-center text-teal-8 q-my-xs">Montar Times para a Match</h2>
      </q-card-section>

      <q-card-section>
        <q-form class="q-px-sm q-pt-sm">

          <q-input
            outlined
            clearable
            v-model="players_per_squad"
            type="number"
            label="Jogadores por Time"
            class="q-mb-md"
          >
            <template v-slot:prepend>
              <q-icon name="group_add" />
            </template>
          </q-input>

        </q-form>
      </q-card-section>

      <q-card-actions class="q-px-lg q-pb-lg">
        <q-btn
          push
          size="lg"
          color="teal-7"
          icon="add_moderator"
          @click="submit"
          class="full-width text-white"
          label="montar times"
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script setup>
import { ref } from 'vue'
import { useQuasar, QSpinnerHourglass } from 'quasar'
import { useRoute } from "vue-router"
import { showForm } from "src/composables/Squad/useSquadBuilder"
import { mountSquads, squads } from "src/composables/Squad/useSquad"

const $q = useQuasar()
const route = useRoute()
const players_per_squad = ref(5)

function submit() {

  let data = {
    match_id: route.params.match_id,
    players_per_squad: players_per_squad.value
  }

  $q.loading.show({ message: 'Montando Times...', spinner: QSpinnerHourglass })

  setTimeout( () => {
    mountSquads(data)
      .then( res => {
        showForm.value = false
        squads.value = res.data.data

        $q.notify({
          type: 'positive', message: 'Times para a Match Montados', html: true, delay: 7000, position: 'top'
        })

      })
      .catch( error => {
        $q.notify({
          type: 'negative', message: error.response.data.message, html: true, delay: 7000
        })
      })
      .finally( res => $q.loading.hide() )
  }, 1000)

}
</script>

<style scoped>

</style>
