<template>
  <q-dialog v-model="showForm">
    <q-card round flat bordered>
      <q-card-section class="">
        <h2 class="text-h6 text-center text-blue-7 q-my-xs">Match</h2>
      </q-card-section>

      <q-card-section>
        <q-form class="q-px-sm q-pt-sm">
          <q-input
            outlined
            readonly
            v-model="when"
            class="q-mb-md"
            label="Quando"
          >
            <template v-slot:prepend>
              <q-icon name="calendar_month" class="cursor-pointer" color="blue-7">
                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                  <q-date
                    minimal
                    v-model="when"
                    :mask="whenMask"
                    :options="date => date > '2023/03/27' && date < '2024/03/27'"
                    :locale="datel10n.br"
                  >
                    <div class="row items-center justify-end">
                      <q-btn v-close-popup label="Close" color="primary" flat />
                    </div>
                  </q-date>
                </q-popup-proxy>
              </q-icon>
            </template>

            <template v-slot:append>
              <q-icon name="access_time" class="cursor-pointer" color="blue-7">
                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                  <q-time
                    v-model="when"
                    format24h
                    :mask="whenMask"
                    :locale="datel10n.br"
                  >
                    <div class="row items-center justify-end">
                      <q-btn v-close-popup label="Close" color="primary" flat />
                    </div>
                  </q-time>
                </q-popup-proxy>
              </q-icon>
            </template>
          </q-input>

          <q-input
            outlined
            clearable
            v-model="where"
            maxlength="50"
            type="text"
            label="Onde"
            class="q-mb-md"
          >
            <template v-slot:prepend>
              <q-icon name="location_on" />
            </template>
          </q-input>

          <q-input
            outlined
            clearable
            maxlength="100"
            v-model="observations"
            type="text"
            label="Observações">

            <template v-slot:prepend>
              <q-icon name="edit_note" />
            </template>
          </q-input>

        </q-form>
      </q-card-section>

      <q-card-actions class="q-px-lg q-pb-lg">
        <q-btn
          unelevated
          size="lg"
          color="blue-7"
          @click="submit"
          class="full-width text-white"
          label="criar evento"
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script setup>
import { ref } from 'vue'
import { useQuasar, QSpinnerBall } from 'quasar'
import { showForm } from "src/composables/useMatchCreate"
import { createMatch } from "src/composables/useMatch"
import { getMatchTableRows } from "src/composables/useMatchTable";
import { datel10n, toPersistenceFormat } from "src/composables/useTimeFormatters";

const $q = useQuasar()
const when = ref('')
const where = ref('')
const observations = ref('')

const whenMask = ref('dddd, DD/MM/YYYY HH:mm')

function submit() {

  let data = {
    when: toPersistenceFormat(when.value, whenMask.value),
    where: where.value,
    observations: observations.value
  }

  $q.loading.show({ message: 'Processando dados...', spinner: QSpinnerBall})

  setTimeout( () => {
    createMatch(data)
      .then( res => {
        getMatchTableRows()
        showForm.value = false
        $q.notify({
          type: 'positive', message: 'Novo Match criado e amigos convidados!', html: true, delay: 7000, position: 'top'
        })

      })
      .catch( error => {
        $q.notify({
          type: 'negative', message: error.response.data.message, html: true, delay: 7000
        })
      })
      .finally( res => $q.loading.hide() )
  }, 2000)

}
</script>

<style scoped>

</style>
