import axios from 'axios'

export default {
  namespaced: true,
  state: {},
  actions: {
    isAuthenticated({commit, dispatch}) {
      return new Promise((resolve, reject) => {
        axios({url: '/isauthenticated', method: 'POST'})
        .then(response => {
          resolve(response.data.isAuthenticated);
        })
        .catch(error => {
          reject(error)
        })
      })
    },

    login({commit, dispatch}, user) {
      return new Promise((resolve, reject) => {
        const formData = new FormData();
        formData.append('login', user.login);
        formData.append('password', user.password);
        formData.append('remember', user.remember);

        axios.post('/login', formData)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          reject(error.response)
        })
      })
    },

    logout({commit, dispatch}, token) {
      return new Promise((resolve, reject) => {
        axios.post('/logout')
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          reject(error.response)
        })
      })
    }
  },
  mutations: {},
  getters: {}
}
