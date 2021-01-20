<template>
    <div class="small">
        <pie-chart :chart-data="datacollection" :options="options"></pie-chart>
    </div>
</template>

<script>
    import PieChart from './PieChart.js'

    export default {
        components: {
            PieChart
        },
        props: ['appealsquiz','appealsreview'],
        data () {
            return {
                stars: [0,0,0,0,0],
                datacollection: null,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            }

        },
        async created () {
            await this.starsRating()
            await this.fillData()
        },
        methods: {
            starsRating(){
               this.appealsquiz.forEach(item => {
                  if(item['rating'] === '1'){
                      this.stars[0] = this.stars[0] + 1
                  }
                  else if(item['rating'] === '2'){
                      this.stars[1] = this.stars[1] + 1
                  }
                  else if(item['rating'] === '3'){
                      this.stars[2] = this.stars[2] + 1
                  }
                  else if(item['rating'] === '4'){
                      this.stars[3] = this.stars[3] + 1
                  }
                  else if(item['rating'] === '5'){
                      this.stars[4] = this.stars[4] + 1
                  }
              })
            },

            fillData () {
                this.datacollection = {
                    labels: ['Одна звезда','Две звезды','Три звезды','Четыре звезды','Пять звезд'],
                    datasets: [
                        {
                            label: ['Одна звезда','Две звезды','Три звезды','Четыре звезды','Пять звезд'],
                            backgroundColor: [
                                'rgba(3, 172, 191, 1)',
                                'rgba(3, 191, 191, 1)',
                                'rgba(1, 89, 89, 1)',
                                'rgba(160, 165, 3, 1)',
                                'rgba(242, 223, 201, 1)'
                            ],
                            data: this.stars,
                            borderWidth: 1
                        },
                    ]
                }
            },

        }
    }
</script>

<style>
    .small {
        /*max-width: 350px;*/
        /*margin:  150px auto;*/
    }
</style>
