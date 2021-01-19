<template>
    <div class="small">
        <bar-chart :chart-data="datacollection" :options="options"></bar-chart>
        <button @click="fillData">Randomize</button>
    </div>
</template>

<script>
    import BarChart from './BarChart.js'

    export default {
        components: {
            BarChart
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
                options:  {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true,
                        mode: 'single',
                        callbacks: {
                            label: function(tooltipItems, data) {
                                return tooltipItems.yLabel;
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    height: 200
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
