<template>
  <div class="q-qa-md" v-if="match">
    {{match.observations}}
  </div>
  <div v-if="squads" class="q-pa-sm">
    <q-table
      v-for="(squad,i) in squads" :key="i"
      flat bordered
      :title="`Time ${i+1}`"
      :rows="squad.players"
      :columns="columns"
      row-key="name"
      hide-pagination
      class="q-mb-sm"
    >
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td key="name" :props="props">
            {{ props.row.user.name }}
          </q-td>
          <q-td key="primary_position" :props="props">
            <q-badge color="teal-7" class="text-bold">
              {{ props.row.card.primary_position }}
            </q-badge>
          </q-td>
          <q-td key="secondary_position" :props="props">
            <q-badge color="purple" class="text-bold">
              {{ props.row.card.secondary_position }}
            </q-badge>
          </q-td>
          <q-td key="overall" :props="props">
            <q-badge color="blue-grey-9" class="text-bold">
              {{ props.row.card.overall }}
            </q-badge>
          </q-td>
          <q-td key="pass" :props="props">
            <q-badge color="primary">
              {{ props.row.card.pass }}
            </q-badge>
          </q-td>
          <q-td key="speed" :props="props">
            <q-badge color="teal">
              {{ props.row.card.speed }}
            </q-badge>
          </q-td>
          <q-td key="stamina" :props="props">
            <q-badge color="accent">
              {{ props.row.card.stamina }}
            </q-badge>
          </q-td>
          <q-td key="dribble" :props="props">
            <q-badge color="deep-purple">
              {{ props.row.card.dribble }}
            </q-badge>
          </q-td>
          <q-td key="shoot" :props="props">
            <q-badge color="indigo">
              {{ props.row.card.shoot }}
            </q-badge>
          </q-td>

        </q-tr>
      </template>
    </q-table>
  </div>
</template>

<script setup>
 import { squads } from "src/composables/Squad/useSquad"
 import { match } from "src/composables/useMatch"

 const columns = [
   {
     name: 'name',
     label: 'Jogador',
     align: 'left'
   },
   {
     name: 'primary_position',
     label: 'Posição 1',
     align: 'left'
   },
   {
     name: 'secondary_position',
     label: 'Posição 2',
     align: 'left'
   },
   {
     name: 'overall',
     label: 'Nível Geral',
     align: 'left'
   },
   {
     name: 'pass',
     label: 'Passe',
     align: 'left'
   },
   {
     name: 'speed',
     label: 'Agilidade',
     align: 'left'
   },
   {
     name: 'stamina',
     label: 'Resistência',
     align: 'left'
   },
   {
     name: 'dribble',
     label: 'Habilidade',
     align: 'left'
   },
   {
     name: 'shoot',
     label: 'Chute',
     align: 'left'
   },

 ]
</script>

<style scoped>

</style>
