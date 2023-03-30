import {api} from "boot/axios"

const getMatches = async function(page, perPage) {
  return api.get(`match?page=${page}&per_page=${perPage}`)
}

const getMatch = async function(id) {
  return api.get(`match/${id}`)
}

const createMatch = async function(data) {
  return api.post('match', data)
}

export { getMatches, getMatch, createMatch }
