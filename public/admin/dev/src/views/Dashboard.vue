<template>
  <div class="animated fadeIn">
    <b-card-group columns class="card-columns">

      <b-card header="Рост заявок">
        <div class="chart-wrapper">
          <line-example chartId="chart-line-01"/>
        </div>
      </b-card>

      <b-card header="Статусы заявок">
        <div class="chart-wrapper">
          <doughnut-example chartId="chart-doughnut-01"/>
        </div>
      </b-card>

      <b-card header="Виды услуг">
        <div class="chart-wrapper">
          <pie-example chartId="chart-pie-01"/>
        </div>
      </b-card>

    </b-card-group>
  </div>
</template>
<script>
  import LineExample from './charts/LineExample'
  import DoughnutExample from './charts/DoughnutExample'
  import PieExample from './charts/PieExample'

  export default {
    name: 'charts',
    components: {
      LineExample,
      DoughnutExample,
      PieExample
    }
  }
</script>
