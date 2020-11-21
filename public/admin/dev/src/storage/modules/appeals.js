import axios from 'axios'

export default {
    namespaced: true,

    state: {
        items: []
    },

    actions: {
        getAppealsDataInStorage({commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/appeals/get/')
                .then(response => {
                    console.log(response);
                    commit('setAppealData', response.data)
                    resolve(response.data)
                })
                .catch(error => {
                    reject(error)
                })
            })
        },
    },

    mutations: {
        setAppealData(state, items) {
            state.items = items
        }
    },

    getters: {
        getAppeals: state => { return state.items }
    }
}
