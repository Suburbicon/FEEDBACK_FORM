import Vue from 'vue'
import Vuex from 'vuex'

import auth from './modules/auth'
import config from './modules/config'
import orders from './modules/orders'
import members from './modules/members'
import companies from './modules/companies'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    config,
    orders,
    members,
    companies
  }
})
