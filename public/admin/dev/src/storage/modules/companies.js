import axios from 'axios'

export default {
    namespaced: true,
    state: {
        items: [],
    },
    actions: {
        getCompaniesDataInStorage({commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/companies/get')
                .then(response => {
                    commit('setCompanyData', response.data)
                    resolve(response.data)
                })
                .catch(error => {
                    reject(error)
                })
            })
        },
    },
    mutations: {
        setCompanyData(state, items) {
            state.items = items
        }
    },
    getters: {
        getCompanies: state => {
            return state.items
        },
    }
}
