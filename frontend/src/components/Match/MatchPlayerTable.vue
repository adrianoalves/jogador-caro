<template>
  <div class="text-h6 text-center q-mt-md text-teal-9" v-if="match">
    {{match.where}}
  </div>
  <div class="text-body2 text-bold text-center text-grey-14" v-if="match">
    {{formatDate(match.when)}}
  </div>

  <div class="q-pa-sm">
    <q-table
      grid
      title="Lista de Jogadores"
      ref="matchPlayerTable"
      :loading="matchTableLoading"
      :columns="columns"
      :rows="rows"
      row-key="id"
      v-model:pagination="pagination"
      @request="onRequest"
      flat
      bordered
    >
      <template v-slot:item="props">
        <q-card bordered flat class="full-width q-mb-md">
          <q-list bordered padding class="rounded-borders">
            <q-item>

              <q-item-section>
                <q-item-label lines="1">{{props.row.user.name}}</q-item-label>
                <q-item-label class="text-weight-light" lines="1">
                  <span class="text-weight-bolder">
                    Principal Posição: {{props.row.user.card.primary_position}}
                  </span>
                </q-item-label>
                <q-item-label lines="2" caption>
                  <span class="text-weight-bolder">
                    Nível Geral: {{props.row.user.card.overall}}
                  </span>
                </q-item-label>

              </q-item-section>

              <q-item-section top side>

                <div class="text-grey-8 q-gutter-xs">
                  <q-toggle
                    v-model="props.row.confirmed"
                    checked-icon="thumb_up"
                    color="teal"
                    :true-value="1"
                    :false-value="0"
                    size="lg"
                    unchecked-icon="thumb_down"
                    @update:model-value="confirmed(props.row)"
                  />
                </div>

              </q-item-section>

            </q-item>
          </q-list>
        </q-card>
      </template>
    </q-table>
  </div>
</template>

<script setup>
  import { onMounted, ref } from "vue"
  import { useRoute } from "vue-router"
  import {QSpinnerHourglass, useQuasar} from "quasar"
  import {getMatch} from "src/composables/useMatch"
  import {formatDate} from "src/composables/useTimeFormatters"
  import { matchTableLoading, columns, rows, pagination, matchPlayerTable, getMatchPlayersTableRows, toggleConfirmation, onRequest } from "src/composables/useMatchPlayerTable"

  const route = useRoute()
  const $q = useQuasar()
  const match = ref(null)
  const matchId = ref(route.params.match_id)

  function confirmed(row) {
    $q.loading.show({ message: 'Modificando Confirmação', spinner: QSpinnerHourglass})
    toggleConfirmation(row.id)
      .then( res => {
        let message = row.confirmed ? 'Jogador confirmado!' : 'Jogador Retirado da Lista de Confirmados'
        let type = row.confirmed ? 'positive' : 'info'

        $q.notify({
          type, message, html: true, delay: 7000, position: 'top'
        })
      })
      .catch( error => {
        $q.notify({
          type: 'negative', message: 'Houve um erro ao tentar modificar Confirmação', html: true, delay: 7000, position: 'top'
        })
      })
      .finally( () => $q.loading.hide() )
  }
  onMounted( () => {
    $q.loading.show({ message: 'Buscando Informações...', spinner: QSpinnerHourglass})
    Promise.all([
        getMatchPlayersTableRows(matchId.value),
        getMatch(matchId.value).then( res => {
          match.value = res.data.data
        })
    ])
    .finally( () => $q.loading.hide() )
  })
</script>

<style scoped>

</style>
