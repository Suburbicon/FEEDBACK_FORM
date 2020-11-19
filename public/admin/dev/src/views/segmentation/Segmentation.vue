<template>
    <div class="animated fadeIn">
        <b-row sm="12">
            <b-col sm="8">
                <c-table :table-data="items" :per-page="perPage" :fields="fields" hover striped bordered small fixed caption="Клиенты"></c-table>
            </b-col>
            <b-col sm="4">
                <c-form></c-form>
            </b-col>
        </b-row>
    </div>
</template>

<script>
  import cTable from './Table'
  import cForm from './Form'

  export default {
    name: 'Segmentation',
    components: {cTable, cForm},
    data: () => {
      return {
        activeRow: null,
        perPage: 20,
        items: [{lastname: "vasya", firstname: "bulgakov", created_at: "2019-04-04"}],
        fields: [
          {key: 'lastname', label: 'Фамилия', sortable: true},
          {key: 'firstname', label: 'Имя', sortable: true},
          {key: 'created_at', label: 'Дата регистрации', sortable: true}
        ],
      }
    }
  }
</script>

<style scoped>

</style>
