import {api} from "boot/axios"

const getSquads = async function(match_id) {
  return api.get(`squads/${match_id}`)
}

const mountSquads = async function(id) {
  return api.post(`squad-mount`, {id})
}

export { getSquads, mountSquads }
