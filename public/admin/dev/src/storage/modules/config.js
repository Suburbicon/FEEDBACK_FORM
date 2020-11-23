import axios from 'axios'

export default {
  namespaced: true,
  state: {
    services: [],
    statuses: [],
  },
  actions: {
    setConfig({commit}) {
      axios
      .post('/config/get')
      .then(response => {
        if (response.data['services'] || response.data['statuses']) {
          commit('setConfig', response.data)
        } else {
          console.log("Настройки не установлены!!!")
        }
      })
      .catch(error => {
        console.log(error.response.data.message)
      })
    }
  },
  mutations: {
    setConfig(state, params) {
      for (let field in state) {
        if (params[field]) {
          state[field] = params[field]
        }
      }
    }
  },
  getters: {
    getServices: state => { return state.services },
    getStatuses: state => { return state.statuses }
  }
}
