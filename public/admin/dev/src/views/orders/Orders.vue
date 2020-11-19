<template>
    <div class="animated fadeIn">
        <b-row>
            <b-col sm="8">
                <b-card-group>
                    <b-card header="Заявки">

                        <b-tabs active-nav-item-class="font-weight-bold" fill>
                            <b-tab v-for="status in statuses" :title=status.name @click="filters.status=status.name"></b-tab>
                        </b-tabs>

                        <b-table
                                selectable
                                select-mode="single"
                                selectedVariant="success"
                                @row-selected="rowSelected"

                                show-empty
                                empty-text="Нет записей для показа"

                                :current-page="currentPage"
                                :per-page="perPage"

                                hover
                                small
                                :fixed="true"
                                :bordered="true"
                                :items="filtered"
                                :fields="fields">

                            <template slot="top-row" slot-scope="{ fields }">
                                <td v-for="field in fields" :key="field.key">
                                    <b-form-input v-model="filters[field.key]" :placeholder="field.label"></b-form-input>
                                </td>
                            </template>

                        </b-table>

                        <b-row>
                            <b-col>
                                <b-pagination
                                        v-model="currentPage"
                                        :total-rows="totalRows"
                                        :per-page="perPage"
                                        class="my-0"
                                >
                                </b-pagination>
                            </b-col>

                            <b-col sm="1">
                                <b-button variant="outline-primary" @click="refresh"><i class="icon-refresh"></i></b-button>
                            </b-col>

                            <b-col>
                                <b-form-select v-model="perPage" :options="[10, 15, 20, 50]"></b-form-select>
                            </b-col>

                            <b-col>
                                <b-button variant="outline-primary" @click="clearFilter">Снять фильтры</b-button>
                            </b-col>

                            <b-col sm="3">
                                <div class="text-right">{{recordsDisplayed}}</div>
                            </b-col>
                        </b-row>
                    </b-card>
                </b-card-group>
            </b-col>
            <b-col sm="4">
                <c-form :disabled="disabled" :services_ids="services_ids" :status_id="status_id" :order_id="order_id" :comment="comment"></c-form>
            </b-col>
        </b-row>
    </div>
</template>

<script>
  import cForm from './Order'
  import { mapGetters } from 'vuex';

  export default {
    name: 'Orders',
    components: {cForm},
    data: () => {
      return {
        statuses: [],
        disabled: false,
        order_id: null,
        services_ids: [],
        status_id: null,
        comment: '',
        test: [
          "Новый", "Тестовый"
        ],

        currentPage: 1,
        totalRows: 0,
        perPage: 10,
        fields: [
          {key: 'order_id', label: 'Номер заявки', sortable: true},
          {key: 'member_name', label: 'Клиент', sortable: true},
          {key: 'company', label: 'Компания', sortable: true},
          {key: 'services', label: 'Услуги', sortable: true},
          {key: 'status', label: 'Статус', sortable: true}
        ],
        filters: {
          id: '',
          company: '',
          service: '',
          sum: '',
          status: ''
        }
      }
    },
    methods: {
      clearFilter() {
        for (let key in this.filters) {
          this.filters[key] = ''
        }
      },
      rowSelected(items) {
        let member_id = null;
        let order = {
          entity: 0,
          selected_member: {},
          members_list: [],
          selected_company: {},
          companies_list: [],
          services_ids: [],
          status_id: null,
          order_id: null,
          comment: ''
        }

        if (items) {
          let selected = {...items[0]}
          member_id = selected.member_id
          order.entity = Boolean(selected.entity)
          order.selected_member = { name: selected.member_name, member_id: selected.member_id }
          order.members_list = [order.selected_member]
          order.selected_company = { name: selected.company, company_id: selected.company_id }
          order.companies_list = [order.selected_company]
          order.status_id = selected.status_id
          order.order_id = selected.order_id
          order.comment = selected.comment

          if (selected.services_ids) {
            let configServices = this.$store.getters['config/getServices']
            let services_ids = selected.services_ids.split(',')
            for (let key in services_ids) {
              order.services_ids.push({ value: configServices[services_ids[key]].id, text: configServices[services_ids[key]].name })
            }
          }
        }

        this.services_ids = order.services_ids
        this.status_id = order.status_id
        this.order_id = order.order_id
        this.comment = order.comment
        this.disabled = items && items.length > 0

        this.$store.dispatch('orders/setMemberId', member_id).catch(error => { console.log(error) })
        this.$store.dispatch('orders/setActiveSelect', { entity: order.entity, selected_member: order.selected_member, members_list: order.members_list })
        this.$store.dispatch('orders/setActiveSelectCompany', { selected_company: order.selected_company, companies_list: order.companies_list })
      },
      parseServices(strItems, configServices) {
        let services = ''

        if (strItems) {
          let items = strItems.split(',')
          for (let key in items) {
            if (configServices[items[key]]) {
              services += configServices[items[key]].name + ", "
            }
          }

          services = services.slice(0, -2);
        }

        return services
      },
      refresh() {
        this.$store.dispatch('orders/getOrdersDataInStorage').catch(error => { console.log(error) })
      }
    },
    computed: {
      ...mapGetters({
        items: 'orders/getItemsTest'
      }),
      filtered () {
        let configServices = this.$store.getters['config/getServices']

        const filtered = this.items.filter(item => {
          if (item.status_id && this.statuses[item.status_id]) {
           item.status = this.statuses[item.status_id].name
          }
          if (item.services_ids) {
            item.services = this.parseServices(item.services_ids, configServices)
          }
          return Object.keys(this.filters).every(key =>
            String(item[key]).includes(this.filters[key]))
        })

        this.totalRows = filtered.length
        this.currentPage = 1

        return filtered.length > 0 ? filtered : []
      },
      recordsDisplayed() {
        let how_much = this.perPage * this.currentPage - this.perPage + 1
        let how_many = this.perPage * this.currentPage
        let str = how_much + ' - ' + how_many

        if (this.totalRows === 0) {
          str = '0'
        } else if (how_many < this.totalRows || how_many > this.totalRows) {
          str = how_much + ' - ' + this.totalRows
        }

        return 'Отображено '+ str + ' из ' + this.totalRows
      }
    },
    mounted() {
      this.statuses = this.$store.getters['config/getStatuses']
      for (let key in this.statuses) {
        this.filters.status = this.statuses[key].name
        break
      }
      this.$store.dispatch('orders/getOrdersDataInStorage').catch(error => { console.log(error) })
    }
  }
</script>
