import { ref } from 'vue'
import {getMatches} from "src/composables/useMatch";

const matchTable = ref()
const columns = [
  { name: 'id', align: 'left', label: 'ID', field: 'id' },
  { name: 'when', align: 'left', label: 'Quando', field: 'when' },
  { name: 'where',align:'left', label: 'Onde', field: 'where' }
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

function getMatchTableRows(page, perPage) {
  matchTableLoading.value = true
  page = page || 1
  perPage = perPage || 5
  getMatches(page, perPage).then( response => {
    rows.value = response.data.data
    pagination.value.rowsNumber = response.data.meta.total
    pagination.value.rowsPerPage = response.data.meta.per_page
    pagination.value.page = response.data.meta.current_page
    matchTableLoading.value = false
  });
}

function onRequest( props ) {
  const { page, rowsPerPage } = props.pagination
  getMatchTableRows( page, rowsPerPage )
}

export { matchTable, columns, matchTableLoading, rows, pagination, getMatchTableRows, onRequest }
