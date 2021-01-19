<template>
    <div class="small">
        <bubble-chart :chart-data="datacollection" :options="options"></bubble-chart>
        <button @click="fillData">Randomize</button>
    </div>
</template>

<script>
    import BubbleChart from './BubbleChart.js'

    export default {
        components: {
            BubbleChart
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
        mounted () {
            this.fillData()
        },
        methods: {
            fillData () {
                this.datacollection = {
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
