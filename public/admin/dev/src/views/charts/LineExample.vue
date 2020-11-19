<script>
import { Line } from 'vue-chartjs'
import { CustomTooltips } from '@coreui/coreui-plugin-chartjs-custom-tooltips'
import { hexToRgba } from '@coreui/coreui/dist/js/coreui-utilities'

export default {
  components: {
    hexToRgba,
    CustomTooltips
  },
  extends: Line,
  mounted () {
    this.renderChart(
      {
        labels: ['Январь', 'Февраль', 'Март', 'Апрель', 'Июнь', 'Июль', 'Август'],
        datasets: [
          {
            label: 'Компания',
            backgroundColor: hexToRgba('#E46651', 90),
            data: [39, 80, 40, 35, 40, 20, 45]
          },
          {
            label: 'Офферы',
            backgroundColor: hexToRgba('#00D8FF', 90),
            data: [100, 80, 210, 142, 127, 311, 223]
          }
        ]
      },
      {
        responsive: true,
        maintainAspectRatio: true,
        tooltips: {
          enabled: false,
          custom: CustomTooltips,
          intersect: true,
          mode: 'index',
          position: 'nearest',
          callbacks: {
            labelColor: function (tooltipItem, chart) {
              return { backgroundColor: chart.data.datasets[tooltipItem.datasetIndex].backgroundColor }
            }
          }
        }
      }
    )
  }
}
</script>
