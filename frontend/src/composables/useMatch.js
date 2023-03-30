import {api} from "boot/axios"
import {ref} from 'vue'

const match = ref(null)

const getMatches = async function(page, perPage) {
  return api.get(`match?page=${page}&per_page=${perPage}`)
}

const getMatch = async function(id) {
  return api.get(`match/${id}`)
}

const createMatch = async function(data) {
  return api.post('match', data)
}

export { match, getMatches, getMatch, createMatch }
