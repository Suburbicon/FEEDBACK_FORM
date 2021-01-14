<script>
import { HorizontalBar } from "vue-chartjs";

export default {
    extends: HorizontalBar,
    mounted() {
        this.renderChart(
            {
                labels: ["Новые", "В обработке", "В работе", "Отклоненные"],
                datasets: [
                    {
                        backgroundColor: [
                            "#555197",
                            "#ccc262",
                            "#0086EB",
                            "#F84040"
                        ],
                        data: [40, 20, 80, 10]
                    }
                ]
            },
            { responsive: true, maintainAspectRatio: true }
        );
    }
};
</script>
