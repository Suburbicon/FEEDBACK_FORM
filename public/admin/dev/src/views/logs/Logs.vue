<template>
    <div class="animated fadeIn">
        <b-row>
            <b-col sm="12">
                <c-table :table-data="itemsArray" :per-page=5 hover striped bordered small fixed caption="Логи"></c-table>
            </b-col>
        </b-row>
    </div>

</template>

<script>
  import cTable from '../Table.vue'

  const someData = () => [
    {username: 'Samppa Nori', registered: '2012/01/01', role: 'Member', status: 'Active', _rowVariant: 'success'},
    {username: 'Estavan Lykos', registered: '2012/02/01', role: 'Staff', status: 'Banned', _rowVariant: 'danger'},
    {username: 'Chetan Mohamed', registered: '2012/02/01', role: 'Admin', status: 'Inactive', _rowVariant: 'info'},
    {username: 'Derick Maximinus', registered: '2012/03/01', role: 'Member', status: 'Pending'},
    {username: 'Friderik Dávid', registered: '2012/01/21', role: 'Staff', status: 'Active'},
    {username: 'Yiorgos Avraamu', registered: '2012/01/01', role: 'Member', status: 'Active'},
    {username: 'Avram Tarasios', registered: '2012/02/01', role: 'Staff', status: 'Banned'},
    {username: 'Quintin Ed', registered: '2012/02/01', role: 'Admin', status: 'Inactive'},
    {username: 'Enéas Kwadwo', registered: '2012/03/01', role: 'Member', status: 'Pending'},
    {username: 'Agapetus Tadeáš', registered: '2012/01/21', role: 'Staff', status: 'Active'},
    {username: 'Carwyn Fachtna', registered: '2012/01/01', role: 'Member', status: 'Active'},
    {username: 'Nehemiah Tatius', registered: '2012/02/01', role: 'Staff', status: 'Banned'},
    {username: 'Ebbe Gemariah', registered: '2012/02/01', role: 'Admin', status: 'Inactive'},
    {username: 'Eustorgios Amulius', registered: '2012/03/01', role: 'Member', status: 'Pending'},
    {username: 'Leopold Gáspár', registered: '2012/01/21', role: 'Staff', status: 'Active'},
    {username: 'Pompeius René', registered: '2012/01/01', role: 'Member', status: 'Active'},
    {username: 'Paĉjo Jadon', registered: '2012/02/01', role: 'Staff', status: 'Banned'},
    {username: 'Micheal Mercurius', registered: '2012/02/01', role: 'Admin', status: 'Inactive'},
    {username: 'Ganesha Dubhghall', registered: '2012/03/01', role: 'Member', status: 'Pending'},
    {username: 'Hiroto Šimun', registered: '2012/01/21', role: 'Staff', status: 'Active'},
    {username: 'Vishnu Serghei', registered: '2012/01/01', role: 'Member', status: 'Active'},
    {username: 'Zbyněk Phoibos', registered: '2012/02/01', role: 'Staff', status: 'Banned'},
    {username: 'Einar Randall', registered: '2012/02/01', role: 'Admin', status: 'Inactive'},
    {username: 'Félix Troels', registered: '2012/03/21', role: 'Staff', status: 'Active'},
    {username: 'Aulus Agmundr', registered: '2012/01/01', role: 'Member', status: 'Pending'}
  ]

  export default {
    name: 'Logs',
    components: {cTable},
    data: () => {
      return {
        items: someData,
        itemsArray: someData(),
        fields: [
          {key: 'username', label: 'User', sortable: true},
          {key: 'registered'},
          {key: 'role'},
          {key: 'status', sortable: true}
        ],
      }
    }
  }
</script>
