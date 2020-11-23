import axios from 'axios'

export default {
    namespaced: true,

    state: {
        sectors: []
    },

    getters: {
        getSectors: state => {
            return state.sectors
        }
    },

    mutations: {
        setSectorsData(state, data) {
            state.sectors = data
        }
    },

    actions: {
        async getSectorsData({commit}) {
            const { data } = await axios.post('/sectors/get/')
            console.log(data)
            commit('setSectorsData', data)
        },
    },
}
