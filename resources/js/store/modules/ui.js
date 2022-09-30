const state = {
  loading: false
}

const actions = {
  toggleLoading ({ commit }, payload) {
    commit('SET_LOADING', payload)
  }
}

const mutations = {
  SET_LOADING (state, payload) {
    state.loading = payload
  }
}

const getters = {
  isLoading: (state) => state.loading
}

export default {
  state,
  actions,
  mutations,
  getters,
  namespaced: true
}
