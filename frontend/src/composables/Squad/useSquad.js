import {api} from "boot/axios"
import { ref } from 'vue'

const squads = ref(null)

const getMatchSquads = async function(match_id) {
  return api.get(`squads/${match_id}`)
}

const mountSquads = async function(id) {
  return api.post(`squad/mount`, id)
}

export { squads, getMatchSquads, mountSquads }
