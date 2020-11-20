<script>
import {Line} from 'vue-chartjs'
import {CustomTooltips} from '@coreui/coreui-plugin-chartjs-custom-tooltips'
import {hexToRgba} from '@coreui/coreui/dist/js/coreui-utilities'

export default {
    components: {
        hexToRgba,
        CustomTooltips
    },
    extends: Line,
    mounted() {
        this.renderChart(
            {
                labels: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                datasets: [
                    {
                        label: 'В обработке',
                        backgroundColor: hexToRgba('#0086EB', 90),
                        data: [59, 22, 12, 78, 12, 13, 31, 8, 74, 21, 13, 43]
                    },
                    {
                        label: 'Не решенные обращения',
                        backgroundColor: hexToRgba('#F84040', 80),
                        data: [39, 80, 40, 35, 4, 23, 11, 5, 85, 10, 23, 15]
                    },
                    {
                        label: 'Решенные обращения',
                        backgroundColor: hexToRgba('#00D197', 90),
                        data: [319, 280, 140, 135, 224, 231, 111, 320, 232, 110, 243, 115]
                    },
                ]
            },
            {
                responsive: true,
                maintainAspectRatio: true,
                tooltips: {
                    enabled: false,
                    custom: CustomTooltips,
                    intersect: true,
                    mode: 'index',
                    position: 'nearest',
                    callbacks: {
                        labelColor: function (tooltipItem, chart) {
                            return {backgroundColor: chart.data.datasets[tooltipItem.datasetIndex].backgroundColor}
                        }
                    }
                }
            }
        )
    }
}
</script>
