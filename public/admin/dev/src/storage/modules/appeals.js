import axios from 'axios'

export default {
    namespaced: true,

    state: {
        appealsQuiz: [],
        appealsReview: []
    },

    actions: {
        getAppealsReviewDataInStorage({commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/appeals_review/get')
                .then(response => {
                    console.log(response);
                    commit('setAppealReviewData', response.data)
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
                    commit('setAppealQuizData', response.data)
                    resolve(response.data)
                })
                .catch(error => {
                    reject(error)
                })
            })
        },
    },

    mutations: {
        setAppealReviewData(state, items) {
            state.appealsReview = items
        },
        setAppealQuizData(state, items) {
            state.appealsQuiz = items
        }
    },

    getters: {
        getAppealsReview: state => { return state.appealsReview },
        getAppealsQuiz: state => { return state.appealsQuiz },
    }
}
