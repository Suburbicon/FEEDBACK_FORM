<template>
    <b-card-group>
        <b-card header="Компании">
            <b-button size="sm" class="mar-top" :hidden="!button_hidden" variant="success" @click="showModal('add')"><i class="fa fa-plus"></i> Добавить</b-button>
            <b-button size="sm" class="mar-top" :hidden="button_hidden" variant="warning" @click="showModal('edit')"><i class="fa fa-edit"></i> Редактировать</b-button>
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
                fixed
                bordered
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
        <company-form :items="company_selected" :action="action"></company-form>
    </b-card-group>
</template>

<script>
  import { mapGetters } from 'vuex';
  import companyForm from './Company'

  export default {
    name: 'Companies',
    components: {companyForm},
    data: () => {
      return {
        action: '',
        company_selected: undefined,
        button_hidden: true,

        currentPage: 1,
        totalRows: 0,
        perPage: 10,
        fields: [
          {key: 'name', label: 'Название', sortable: true},
          {key: 'short_name', label: 'Сокрашение', sortable: true},
          {key: 'email', label: 'Почта', sortable: true},
          {key: 'phone', label: 'Телефон', sortable: true},
          {key: 'address_actual', label: 'Адрес', sortable: true},
          {key: 'director_name', label: 'Директор', sortable: true}
        ],
        filters: {
          name: '',
          short_name: '',
          email: '',
          phone: '',
          address_actual: '',
          director_name: ''
        }
      }
    },
    methods: {
      showModal(action) {
        this.action = action
        this.$bvModal.show('company-form')
      },
      rowSelected(items) {
        let company_selected = undefined
        if (items.length > 0) {
          items[0].bills_deleted = []
          company_selected = {...items[0]}
        }

        this.button_hidden = items.length === 0
        this.company_selected = company_selected
      },
      clearFilter() {
        for (let key in this.filters) {
          this.filters[key] = ''
        }
      },
      refresh() {
        this.$store.dispatch('companies/getCompaniesDataInStorage').catch(error => { console.log(error) })
      }
    },
    computed: {
      ...mapGetters({
        items: 'companies/getCompanies'
      }),
      filtered () {
        const filtered = this.items.filter(item => {
          item.director_name = (item.director_lastname + " " + item.director_firstname + " " + item.director_secondname).trim()
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
      this.$store.dispatch('companies/getCompaniesDataInStorage').catch(error => { console.log(error) })
    }
  }
</script>
<style scoped>
    .mar-top {
        margin-bottom: 1em;
    }
</style>
