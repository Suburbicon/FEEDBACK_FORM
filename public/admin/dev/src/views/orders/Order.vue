<template>
    <b-card-group>
        <b-card>
            <div slot="header">
                <strong>Информация о заявке</strong>
            </div>

            <b-form id="formOrder" @submit.stop.prevent="onSubmit('add')">

                <b-form-group label="Клиент" label-for="member">
                    <b-row>
                        <b-col>
                            <list-select :list="members_list"
                                         option-value="member_id"
                                         option-text="name"
                                         :selectedItem="selected_member"
                                         placeholder="Введите клиента"
                                         id="member"
                                         :isDisabled="disabled"
                                         @select="onSelect"
                                         @searchchange="searchMember">
                            </list-select>
                        </b-col>
                        <b-col lg="2" class="text-right">
                            <b-button v-b-modal.member-form :disabled="disabled" style="height: 35px; width: 55px;" variant="outline-primary">+</b-button>
                        </b-col>
                    </b-row>
                </b-form-group>

                <b-form-group label-for="company" label="Компания" :hidden="!entity">
                    <b-row>
                        <b-col>
                            <list-select :list="companies_list"
                                         option-value="company_id"
                                         option-text="name"
                                         :selectedItem="selected_company"
                                         placeholder="Введите компанию"
                                         id="company"
                                         :isDisabled="disabled"
                                         @select="onSelectCompany">
                            </list-select>
                        </b-col>
                        <b-col lg="2" class="text-right">
                            <b-button v-b-modal.company-form :disabled="disabled" style="height: 35px; width: 55px;" variant="outline-primary">+</b-button>
                        </b-col>
                    </b-row>
                </b-form-group>

                <b-form-group label-for="service" label="Услуга">
                    <multi-select :options="services_list"
                                  :selected-options="services_ids"
                                  placeholder="Введите услугу"
                                  @select="onMultiSelect">
                    </multi-select>
                </b-form-group>

                <b-form-group label-for="status" label="Статус">
                    <model-list-select :list="statuses_list"
                                       option-value="value"
                                       option-text="text"
                                       v-model="status_id"
                                       placeholder="Выберите статус"
                                       id="status">
                    </model-list-select>
                </b-form-group>

                <b-form-group label-for="comment" label="Комментарий">
                    <b-form-textarea type="text" id="comment" placeholder="" v-model="comment"></b-form-textarea>
                </b-form-group>

                <div slot="footer">
                    <b-button type="submit" :hidden="disabled" size="sm" variant="success" class="button-mar"><i class="fa fa-dot-circle-o"></i> Добавить</b-button>
                    <b-button type="edit" :hidden="!disabled" size="sm" variant="warning" class="button-mar" @click.prevent="onSubmit('edit')"><i class="fa fa-ban"></i> Редактировать</b-button>
                    <b-button type="reset" size="sm" variant="secondary" class="button-mar" @click.prevent="onReset"><i class="fa fa-ban"></i> Очистить поля</b-button>
                </div>
            </b-form>
        </b-card>


        <member-form action="add"></member-form>
        <company-form action="addCompany"></company-form>

    </b-card-group>
</template>

<script>
  import axios from 'axios'
  import _ from 'lodash'
  import memberForm from '../members/Member'
  import companyForm from "../companies/Company";
  import { mapGetters } from 'vuex';

  export default {
    name: "Order",
    components: {memberForm, companyForm},
    props: {
      disabled: Boolean,
      services_ids: Array,
      status_id: Number,
      order_id: Number,
      comment: String
    },
    data() {
      return {
        services_list: this.getOptions('config/getServices'),
        statuses_list: this.getOptions('config/getStatuses')
      }
    },
    methods: {
      getOptions(path) {
        let result = []
        let servicesData = {...this.$store.getters[path]}

        for (let i in servicesData) {
          result.push({value: servicesData[i]['id'], text: servicesData[i]['name']})
        }

        return result
      },
      onSelect(record) {
        this.$store.dispatch('orders/setActiveSelect', { entity: Boolean(record['entity']), selected_member: {...record}, members_list: this.members_list })
        this.$store.dispatch('orders/setMemberId', record['member_id']).catch(error => { console.log(error) })

        axios.post('/companies/searchbyid/', {member_id: record['member_id'], limit: 10})
        .then(response => {
          let params = { companies_list: response.data, selected_company: {} }
          if (response.data.length === 1) {
            params.selected_company = {...response.data[0]}
          }

          this.$store.dispatch('orders/setActiveSelectCompany', params)
        })
        .catch(error => {
          console.log(error.response)
        })
      },
      onSelectCompany(record) {
        this.$store.dispatch('orders/setActiveSelectCompany', { companies_list: this.companies_list, selected_company: {...record} })
      },
      onMultiSelect(items, lastSelectItem) {
        this.services_ids = items
      },
      searchMember: _.debounce(function(searchText) {
        if (searchText.length > 1) {
          axios.post('/members/search/', {needle: searchText, limit: 10})
          .then(response => {
            this.$store.dispatch('orders/setActiveSelect', { entity: 0, selected_member: {}, members_list: response.data })
          })
          .catch(error => {
            console.log(error.response)
          })
        }
      }, 500),
      onSubmit(func) {
        let ids = []
        for (let key in this.services_ids) {
          ids.push(this.services_ids[key].value)
        }

        const {company_id} = this.selected_company
        let params = {member_id: this.selected_member['member_id'], company_id: company_id, status_id: this.status_id, services_ids: ids, comment: this.comment}
        if (this.order_id) {
          params.order_id = this.order_id
        }

        axios
        .post('/orders/'+func+'/', params)
        .then(response => {
          // TODO response проверка
          this.onReset()
          this.$store.dispatch('orders/getOrdersDataInStorage').catch(error => { console.log(error) })
        })
        .catch(error => {
          console.log(error)
        })
      },
      onReset() {
        this.$store.dispatch('orders/setActiveSelect', { entity: 0, selected_member: {}, members_list: [] })
        this.$store.dispatch('orders/setActiveSelectCompany', { selected_company: {}, companies_list: [] })
        this.services_ids = []
        this.status_id = null
        this.comment = ''
      }
    },
    computed: {
      ...mapGetters({
        entity: 'orders/getEntity',
        members_list: 'orders/getMembersList',
        selected_member: 'orders/getSelectedMember',
        companies_list: 'orders/getCompaniesList',
        selected_company: 'orders/getSelectedCompany'
      }),
      filtered () {
        const filtered = this.items.filter(item => {
          return Object.keys(this.filters).every(key =>
            String(item[key]).includes(this.filters[key]))
        })

        this.totalRows = filtered.length
        this.currentPage = 1

        return filtered.length > 0 ? filtered : []
      }
    },
  }
</script>


<style scoped>
    .button-mar {
        margin-right: 5px;
    }
</style>
