<template>
    <div class="small">
        <bar-chart :chart-data="datacollection" :options="options"></bar-chart>
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
                datacollection: null,
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
        async created () {
            await this.fillData()
        },
        methods: {
            fillData () {
                this.datacollection = {
                    labels: ['Обращения(опросы)','Обращения(отзывы)'],
                    datasets: [
                        {
                            label: 'Обращения(опросы)',
                            backgroundColor: '#04ADBF',
                            data: [this.appealsquiz.length],
                            borderWidth: 1
                        },
                        {
                            label: 'Обращения(отзывы)',
                            backgroundColor: '#F2E0C9',
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
