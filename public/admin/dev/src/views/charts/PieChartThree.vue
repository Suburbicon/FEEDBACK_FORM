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
                marks: [0,0,0],
                datacollection: null,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            }

        },
        async created () {
            await this.globalRating()
            console.log(this.marks)
            await this.fillData()
        },
        methods: {
            globalRating(){
                this.appealsquiz.forEach(item => {
                    if(item['recomendation_rating'] > 0 && item['recomendation_rating'] < 4){
                        this.marks[0] = this.marks[0] + 1
                    }
                    if(item['recomendation_rating'] > 3 && item['recomendation_rating'] < 8){
                        this.marks[1] = this.marks[1] + 1
                    }
                    if(item['recomendation_rating'] > 7 && item['recomendation_rating'] < 11){
                        this.marks[2] = this.marks[2] + 1
                    }
                })
                this.appealsreview.forEach(item => {
                    if(item['recomendation_rating'] > 0 && item['recomendation_rating'] < 4){
                        this.marks[0] = this.marks[0] + 1
                    }
                    if(item['recomendation_rating'] > 3 && item['recomendation_rating'] < 8){
                        this.marks[1] = this.marks[1] + 1
                    }
                    if(item['recomendation_rating'] > 7 && item['recomendation_rating'] < 11){
                        this.marks[2] = this.marks[2] + 1
                    }
                })
            },

            fillData () {
                this.datacollection = {
                    labels: ['0-3','4-7','8-10'],
                    datasets: [
                        {
                            label: ['0-3','4-7','8-10'],
                            backgroundColor: [
                                'rgba(3, 172, 191, 1)',
                                'rgba(3, 191, 191, 1)',
                                'rgba(1, 89, 89, 1)',
                            ],
                            data: this.marks,
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
