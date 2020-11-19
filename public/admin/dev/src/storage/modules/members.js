import axios from 'axios'

export default {
    namespaced: true,
    state: {
        items: []
    },
    actions: {
        getMembersDataInStorage({commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/members/get/')
                .then(response => {
                    commit('setMemberData', response.data)
                    resolve(response.data)
                })
                .catch(error => {
                    reject(error)
                })
            })
        },
    },
    mutations: {
        setMemberData(state, items) {
            state.items = items
        }
    },
    getters: {
        getMembers: state => { return state.items }
    }
}
