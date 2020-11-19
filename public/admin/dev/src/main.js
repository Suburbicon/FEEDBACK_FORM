import 'core-js/es6/promise'
import 'core-js/es6/string'
import 'core-js/es7/array'

import Vue from 'vue'
import VeeValidate from 'vee-validate';
import BootstrapVue from 'bootstrap-vue'
import App from './App'
import router from './router'
import store from './storage'
import {ListSelect, ModelListSelect, MultiSelect} from 'vue-search-select';
// import axios from 'axios'

Vue.use(BootstrapVue)
Vue.use(VeeValidate, {
  inject: true,
  fieldsBagName: 'veeFields',
  errorBagName: 'veeErrors'
})
Vue.component('list-select', ListSelect);
Vue.component('model-list-select', ModelListSelect);
Vue.component('multi-select', MultiSelect);

new Vue({
  el: '#app',
  store,
  router,
  template: '<App/>',
  components: {
    App
  },
  created() {
    // TODO обновлять только если залогинен
    this.$store.dispatch('config/setConfig')
    // axios.interceptors.response.use(undefined, function (err) {
    //   return new Promise(function (resolve, reject) {
    //     if (err.response.status === 401 || err.response.status === 403) {
    //       router.push('/login')
    //     }
    //     throw err
    //   })
    // })
  }
})
