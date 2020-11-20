<template>
    <b-card-group>
        <b-card header="Список городов">
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
                :fixed="true"
                :bordered="true"
                :items="filtered"
                :fields="fields">

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
        <member-form :items="member_selected" :action="action"></member-form>
    </b-card-group>
</template>

<script>
  import { mapGetters } from 'vuex';
  import memberForm from './City'

  export default {
    name: 'Citys',
    components: {memberForm},
    data: () => {
      return {
        action: '',
        member_selected: undefined,
        button_hidden: true,

        currentPage: 1,
        totalRows: 0,
        perPage: 10,
        fields: [
          {key: 'name', label: 'Наименование города', sortable: true},
        ],
        filters: {
          name: '',
        }
      }
    },
    methods: {
      showModal(action) {
        this.action = action
        this.$bvModal.show('member-form')
      },
      rowSelected(items) {
        let member_selected = undefined
        if (items.length > 0) {
          member_selected = {...items[0]}
        }

        this.button_hidden = items.length === 0
        this.member_selected = member_selected
      },
      clearFilter() {
        for (let key in this.filters) {
          this.filters[key] = ''
        }
      },
      refresh() {
        this.$store.dispatch('citys/getCitysDataInStorage').catch(error => { console.log(error) })
      }
    },
    computed: {
      ...mapGetters({
        items: 'citys/getCitys'
      }),
      filtered () {
        const filtered = this.items.filter(item => {
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
      this.$store.dispatch('citys/getCitysDataInStorage').catch(error => { console.log(error) })
    }
  }
</script>
<style scoped>
    .mar-top {
        margin-bottom: 1em;
    }
</style>
