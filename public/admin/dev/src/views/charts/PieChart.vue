<template>
    <div class="small">
        <pie-chart :chart-data="datacollection" :options="options"></pie-chart>
    <button @click="fillData">Randomize</button>
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
                datacollection: {
                    labels: ['Обращения(отзывы)','Обращения(опросы)'],
                    datasets: [
                        {
                            label: 'Обращения(отзывы)',
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            data: [this.appealsquiz.length],
                            borderWidth: 1
                        },
                        {
                            label: 'Обращения(опросы)',
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                            ],
                            data: [this.appealsreview.length],
                            borderWidth: 1
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            }

        },
        created () {
            this.fillData()
        },
        methods: {
            fillData () {
                this.datacollection = {
                    labels: ['Обращения(отзывы)','Обращения(опросы)'],
                    datasets: [
                        {
                            label: ['Обращения(отзывы)','Обращения(опросы)'],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 1)'
                            ],
                            data: [this.appealsquiz.length,this.appealsreview.length],
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
        /*max-width: 600px;*/
        /*margin:  150px auto;*/
    }
</style>
