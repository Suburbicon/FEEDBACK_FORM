import axios from 'axios'

export default {
    namespaced: true,

    state: {
        items: []
    },

    actions: {
        getAppealsReviewDataInStorage({commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/appeals_review/get')
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
        getAppealsQuizDataInStorage({commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/appeals_quiz/get')
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
