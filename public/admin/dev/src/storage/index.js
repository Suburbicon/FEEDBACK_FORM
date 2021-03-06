import Vue from 'vue'
import Vuex from 'vuex'

import auth from './modules/auth'
import config from './modules/config'
import orders from './modules/orders'
import members from './modules/members'
import citys from './modules/citys'
import appeals from './modules/appeals'
import companies from './modules/companies'
import departments from './modules/departments'
import sectors from './modules/sectors'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        config,
        orders,
        members,
        citys,
        appeals,
        departments,
        sectors,
        companies
    }
})
