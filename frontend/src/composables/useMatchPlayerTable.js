import { ref } from 'vue'
import {getMatchPlayers, togglePlayerConfirmation} from "src/composables/useMatchPlayer";

const matchPlayerTable = ref()
const columns = [
  { name: 'id', align: 'left', label: 'id', field: 'id' },
  { name: 'confirmed',align:'left', label: 'Confirmou', field: 'confirmed' },
  { name: 'user',align:'left', label: 'Jogador', field: 'user' },
]
const matchTableLoading = ref(false)
const rows = ref([])
const pagination = ref({
  page: 1,
  rowsPerPage: 10,
  rowsNumber: null,
  sortBy: 'desc',
  descending: false
})

function getMatchPlayersTableRows(matchId, page, perPage) {
  matchTableLoading.value = true
  page = page || 1
  perPage = perPage || 50
  return getMatchPlayers(matchId, page, perPage).then( response => {
    rows.value = response.data.data
    pagination.value.rowsNumber = response.data.meta.total
    pagination.value.rowsPerPage = response.data.meta.per_page
    pagination.value.page = response.data.meta.current_page
    matchTableLoading.value = false
  });
}
function toggleConfirmation(id) {
  return togglePlayerConfirmation(id)
}

function onRequest( props ) {
  const { page, rowsPerPage } = props.pagination
  getMatchPlayersTableRows( page, rowsPerPage )
}

export { matchPlayerTable, columns, matchTableLoading, rows, pagination, getMatchPlayersTableRows, onRequest, toggleConfirmation }
