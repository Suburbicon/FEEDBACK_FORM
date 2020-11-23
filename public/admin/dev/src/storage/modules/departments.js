import axios from 'axios'

export default {
    namespaced: true,

    state: {
        departments: []
    },

    actions: {
        async getDepartments({commit}) {
            const {data} = await axios.post('/departments/get')
            commit('setDepartmentsData', data)
        },
    },

    mutations: {
        setDepartmentsData(state, data) {
            state.departments = data;
        }
    },

    getters: {
        getDepartments: state => {
            return state.departments
        }
    }
}
