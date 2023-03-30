<template>
  <div class="q-pa-sm">
    <q-table
      grid
      title="Eventos"
      ref="tableRef"
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

              <q-badge :color="props.row.status === 'active' ? 'green-7' : 'red-7'" floating rounded style="top: -15px" align="bottom" />

              <q-item-section>
                <q-item-label lines="1">{{formatDate(props.row.when)}}</q-item-label>
                <q-item-label class="text-weight-light" lines="1">
                  <span class="text-weight-bolder">
                    {{props.row.where}}
                  </span>
                </q-item-label>
                <q-item-label lines="2" caption>
                  <span class="text-weight-bolder">
                    {{props.row.observations}}
                  </span>
                </q-item-label>

              </q-item-section>

              <q-item-section top side>

                <div class="text-grey-8 q-gutter-xs" :class="props.row.status === 'active' ? '' : ['disabled']">
                  <q-btn
                    flat dense unelevated round color="blue-7" icon="groups"
                    @click="router.push({name:'match_players', params: { match_id: props.row.id }})"
                  >
                    <q-tooltip class="bg-light-blue-9">Jogadores</q-tooltip>
                  </q-btn>
<!--                  <q-btn flat dense unelevated round color="red-7" icon="cancel">
                    <q-tooltip class="bg-light-blue-9">Cancelar</q-tooltip>
                  </q-btn>-->
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
  import { onMounted } from "vue"
  import {formatDate} from "src/composables/useTimeFormatters"
  import { matchTableLoading, columns, rows, pagination, matchTable, getMatchTableRows, onRequest } from "src/composables/useMatchTable"
  import { useRouter} from "vue-router"

  const router = useRouter()
  onMounted( () => getMatchTableRows() )

</script>

<style scoped>

</style>
