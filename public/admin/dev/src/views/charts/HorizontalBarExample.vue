
<script>

import { HorizontalBar } from "vue-chartjs";
import {mapGetters} from "vuex";

export default {
    extends: HorizontalBar,

    data() {
        return {
            dataCollection: null
        }
    },

    computed: {
        ...mapGetters({
            appealsQuiz: 'appeals/getAppealsQuiz'
        }),
        ...mapGetters({
            appealsReview: 'appeals/getAppealsReview'
        }),
        dataAppealsQuiz(){
            console.log(this.appealsQuiz)
            return this.appealsQuiz.length
        },

        dataAppealsReview(){
            console.log(this.appealsReview)
            return this.appealsReview.length
        }
    },

    methods: {
    },

    mounted() {
        this.renderChart(
            {
                labels: ["Обращения(отзывы)", "Обращения(опросы)"],
                datasets: [
                    {
                        label: "Обращения(отзывы)",
                        backgroundColor: "#555197",
                        data:  this.dataAppealsQuiz
                    },
                    {
                        label: "Обращения(отзывы)",
                        backgroundColor: "#ccc262",
                        data:  this.dataAppealsReview
                    }
                ]
            },
            { responsive: true, maintainAspectRatio: true }
        );

        this.$store.dispatch('appeals/getAppealsReviewDataInStorage')
        this.$store.dispatch('appeals/getAppealsQuizDataInStorage')
    }
};
</script>
