<template>
    <b-card-group>
        <b-card header="Статусы">
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
                :items="items"
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

                <b-col sm="3">
                    <div class="text-right">{{recordsDisplayed}}</div>
                </b-col>
            </b-row>
        </b-card>
    </b-card-group>
</template>

<script>
  import { mapGetters } from 'vuex';

  export default {
    name: 'Statuses',
    data: () => {
      return {
        action: '',
        member_selected: undefined,
        button_hidden: true,

        currentPage: 1,
        totalRows: this.items.length,
        perPage: 10,
        fields: [
          {key: 'id', label: '#', sortable: true},
          {key: 'status', label: 'Статус', sortable: true},
          {key: 'created_at', label: 'Создан', sortable: true},
          {key: 'updated_at', label: 'Обновлен', sortable: true}
        ]
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
      refresh() {
        this.$store.dispatch('members/getMembersDataInStorage').catch(error => { console.log(error) })
      }
    },
    computed: {
      ...mapGetters({
        items: 'members/getMembers'
      }),
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
      this.$store.dispatch('members/getMembersDataInStorage').catch(error => { console.log(error) })
    }
  }
</script>
<style scoped>
    .mar-top {
        margin-bottom: 1em;
    }
</style>
