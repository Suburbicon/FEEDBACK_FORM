import axios from 'axios'

export default {
  namespaced: true,
  state: {
    items: [],

    entity: 0,
    members_list: [],
    selected_member: {},

    companies_list: [],
    selected_company: {},

    member_id: null,
  },
  actions: {
    getOrdersDataInStorage({commit}) {
      return new Promise((resolve, reject) => {
        axios.post('/orders/get/')
        .then(response => {
          commit('setOrdersData', response.data)
          resolve(response.data)
        })
        .catch(error => {
          reject(error)
        })
      })
    },

    getTypesList(context) {
      return new Promise((resolve, reject) => {
        axios.post('/companies/gettypeslist/')
        .then(response => {
          resolve(response.data)
        })
        .catch(error => {
          reject(error)
        })
      })
    },

    getActivitiesList(context) {
      return new Promise((resolve, reject) => {
        axios.post('/companies/getactivitieslist/')
        .then(response => {
          resolve(response.data)
        })
        .catch(error => {
          reject(error)
        })
      })
    },
    setActiveSelect({commit}, params) {
      commit('setActiveSelect', params)
    },
    setActiveSelectCompany({commit}, params) {
      commit('setActiveSelectCompany', params)
    },
    setMemberId({commit}, member_id) {
      commit('setMemberId', member_id)
    }
  },
  mutations: {
    setOrdersData(state, items) {
      state.items = items
    },
    setActiveSelect(state, items) {
      state.entity = items.entity
      state.members_list = items.members_list
      state.selected_member = items.selected_member
    },
    setActiveSelectCompany(state, items) {
      state.companies_list = items.companies_list
      state.selected_company = items.selected_company
    },
    setMemberId(state, member_id) {
      state.member_id = member_id
    }
  },
  getters: {
    getItemsTest: state => { return state.items },
    getMembersList: state => { return state.members_list },
    getSelectedMember: state => { return state.selected_member },
    getEntity: state => { return state.entity },
    getCompaniesList: state => { return state.companies_list },
    getSelectedCompany: state => { return state.selected_company },
    getMemberId: state => { return state.member_id },
  }
}
