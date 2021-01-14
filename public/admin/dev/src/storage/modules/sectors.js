import axios from "axios";

export default {
    namespaced: true,

    state: {
        sectors: []
    },

    actions: {
        getSectorsData({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/sectors/get")
                    .then(response => {
                        console.log(response.data);
                        commit("setSectorsData", response.data);
                        resolve(response.data);
                    })
                    .catch(error => reject(error));
            });
        }
    },

    getters: {
        getSectors: state => {
            return state.sectors;
        }
    },

    mutations: {
        setSectorsData(state, data) {
            state.sectors = data;
        }
    }
};
