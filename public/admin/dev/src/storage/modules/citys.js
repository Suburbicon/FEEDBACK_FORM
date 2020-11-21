import axios from 'axios'

export default {
    namespaced: true,

    state: {
        items: []
    },

    actions: {
        getCitysDataInStorage({commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/city/get/')
                .then(response => {
                    commit('setCityData', response.data)
                    resolve(response.data)
                })
                .catch(error => {
                    reject(error)
                })
            })
        },
    },

    mutations: {
        setCityData(state, items) {
            state.items = items
        }
    },

    getters: {
        getCitys: state => { return state.items }
    }
}
