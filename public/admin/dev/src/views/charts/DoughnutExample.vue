<script>
import { Doughnut, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins
export default {
  extends: Doughnut,
    mixins: [reactiveProp],
    props: ['appealsQuiz','appealsReview'],

    data(){
      return {
          dataCollection: {}
      }
    },

    methods:{
      fillData(){
          this.dataCollection = {
              labels: ['Обращения(отзывы)','Обращения(опросы)'],
              datasets: [{
                  label: '# of Votes',
                  data: [this.appealsQuiz.length, this.appealsReview.length],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                  ],
                  borderWidth: 1
              }]
          }
      }
    },
  mounted () {
      this.fillData()
      this.renderChart(this.dataCollection, {responsive: true, maintainAspectRatio: true})
  }
}
</script>
