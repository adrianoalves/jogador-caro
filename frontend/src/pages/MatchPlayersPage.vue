<template>
  <div v-if="squads.length">
    <SquadCards />
  </div>
  <div v-else>
    <MatchPlayerTable />
    <SquadBuilderForm />
    <SquadBuilderButton />
  </div>
</template>

<script setup>
import MatchPlayerTable from 'components/Match/MatchPlayerTable.vue'
import SquadBuilderButton from 'components/Squad/SquadBuilderButton.vue'
import SquadBuilderForm from 'components/Squad/SquadBuilderForm.vue'
import SquadCards from 'components/Squad/SquadCards.vue'
import {squads, getMatchSquads} from "src/composables/Squad/useSquad"
import {useQuasar} from "quasar"
import {useRoute} from "vue-router"

const $q = useQuasar()
const $r = useRoute()

getMatchSquads($r.params.match_id)
.then( res => {
  squads.value = res.data.data
})
</script>
