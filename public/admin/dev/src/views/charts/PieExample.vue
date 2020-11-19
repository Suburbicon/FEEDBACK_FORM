<script>
import { Pie } from 'vue-chartjs'

export default {
  extends: Pie,
  mounted () {
    this.renderChart({
      labels: ['Еда и напитки', 'Мода, Красота, Здоровье', 'Развлечения', 'Туризм и спорт'],
      datasets: [
        {
          backgroundColor: [
            '#41B883',
            '#E46651',
            '#00D8FF',
            '#DD1B16'
          ],
          data: [40, 20, 80, 10]
        }
      ]
    }, {responsive: true, maintainAspectRatio: true})
  }
}
</script>
