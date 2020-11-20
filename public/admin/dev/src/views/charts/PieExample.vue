<script>
import { Pie } from 'vue-chartjs'

export default {
  extends: Pie,
  mounted () {
    this.renderChart({
      labels: ['Сервисы', 'Банк', 'Документация', 'Справки'],
      datasets: [
        {
          backgroundColor: [
              '#00D197',
              '#FFA062',
              '#0086EB',
              '#F84040'
          ],
          data: [40, 20, 80, 10]
        }
      ]
    }, {responsive: true, maintainAspectRatio: true})
  }
}
</script>
