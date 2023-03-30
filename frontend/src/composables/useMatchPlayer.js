import {api} from "boot/axios"

const getMatchPlayers = async function(matchId, page, perPage) {
  return api.get(`match-players/${matchId}?page=${page}&per_page=${perPage}`)
}

const getMatchPlayer = async function(userId) {
  return api.get(`user/${userId}`)
}

const togglePlayerConfirmation = async function(id) {
  return api.put('match-player/confirmation', {id})
}

export { getMatchPlayers, getMatchPlayer, togglePlayerConfirmation }
