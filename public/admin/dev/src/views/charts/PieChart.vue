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
                datacollection: null,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            }

        },
        async created () {
            await this.fillData()
        },
        methods: {
            fillData () {
                this.datacollection = {
                    labels: ['Обращения(отзывы)','Обращения(опросы)'],
                    datasets: [
                        {
                            label: ['Обращения(отзывы)','Обращения(опросы)'],
                            backgroundColor: [
                                'rgba(3, 191, 191, 1)',
                                'rgba(1, 89, 89, 1)',
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
        /*max-width: 350px;*/
        /*margin:  150px auto;*/
    }
</style>
