<template>
    <div class="animated fadeIn">
        <b-card-group columns class="card-columns">

            <b-card v-if="appealsQuiz" header="Статистика обращений">
                <PieChart :appealsquiz="appealsQuiz" :appealsreview="appealsReview"/>

<!--                <div class="chart-wrapper">-->
<!--                    <canvas ref="canvas"></canvas>-->
<!--                </div>-->
<!--                <PieChart :getappealsQuiz="appealsQuiz" :getappealsReview="appealsReview"/>-->
<!--                <b-card-footer>-->
<!--                    <div-->
<!--                        class="btn-group"-->
<!--                        role="group"-->
<!--                        aria-label="Basic example"-->
<!--                    >-->
<!--&lt;!&ndash;                        <button type="button" class="btn btn-primary">&ndash;&gt;-->
<!--&lt;!&ndash;                            Скачать отчет&ndash;&gt;-->
<!--&lt;!&ndash;                        </button>&ndash;&gt;-->
<!--&lt;!&ndash;                        <button type="button" class="btn btn-info">&ndash;&gt;-->
<!--&lt;!&ndash;                            Просмотреть отчет&ndash;&gt;-->
<!--&lt;!&ndash;                        </button>&ndash;&gt;-->
<!--&lt;!&ndash;                        <button type="button" class="btn btn-warning">&ndash;&gt;-->
<!--&lt;!&ndash;                            Коректировать отчет&ndash;&gt;-->
<!--&lt;!&ndash;                        </button>&ndash;&gt;-->
<!--                    </div>-->
<!--                </b-card-footer>-->
            </b-card>
            <h2 v-else>No data!</h2>

            <b-card header="Статистика обращений">
                <div v-if="appealsQuiz" class="chart-wrapper">
                    <bar-chart :appealsquiz="appealsQuiz" :appealsreview="appealsReview"/>
                </div>
                <h2 v-else>No Data!</h2>
            </b-card>

            <b-card-group>
                <b-card header="Статистика обращений">
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений(опросы)</small
                                ><br />
                                <strong class="h4">{{appealsQuiz.length}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений(отзывы)</small
                                ><br />
                                <strong class="h4">{{appealsReview.length}}</strong>
                            </div>
                        </div>
<!--                        <div class="col">-->
<!--                            <div class="callout callout-success">-->
<!--                                <small class="text-muted"-->
<!--                                    >Обработанно обращений</small-->
<!--                                ><br />-->
<!--                                <strong class="h4">6,568</strong>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col">-->
<!--                            <div class="callout callout-success">-->
<!--                                <small class="text-muted"-->
<!--                                    >Обработанно обращений</small-->
<!--                                ><br />-->
<!--                                <strong class="h4">6,568</strong>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </b-card>

<!--                <b-card header="Статистика обращений">-->
<!--                    <div class="row">-->
<!--                        <div class="col">-->
<!--                            <div class="callout callout-primary">-->
<!--                                <small class="text-muted"-->
<!--                                    >Количество обращений</small-->
<!--                                ><br />-->
<!--                                <strong class="h4">8,123</strong>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col">-->
<!--                            <div class="callout callout-success">-->
<!--                                <small class="text-muted"-->
<!--                                    >Обработанно обращений</small-->
<!--                                ><br />-->
<!--                                <strong class="h4">6,568</strong>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row">-->
<!--                        <div class="col">-->
<!--                            <div class="callout callout-primary">-->
<!--                                <small class="text-muted"-->
<!--                                    >Количество обращений</small-->
<!--                                ><br />-->
<!--                                <strong class="h4">8,123</strong>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col">-->
<!--                            <div class="callout callout-success">-->
<!--                                <small class="text-muted"-->
<!--                                    >Обработанно обращений</small-->
<!--                                ><br />-->
<!--                                <strong class="h4">6,568</strong>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </b-card>-->
            </b-card-group>

        </b-card-group>
        <b-card-group columns class="card-columns">
            <b-card header="Рейтинг">
                <div v-if="appealsQuiz" class="chart-wrapper">
                    <b-card-text
                        >Данная статистика отображает информацию по оценки рекомендации ЦОНа как оперативный центр для получения государственных услуг</b-card-text
                    >

                    <pie-chart-three :appealsquiz="appealsQuiz" :appealsreview="appealsReview"/>
                </div>
                <h2 v-else>No Data!</h2>
            </b-card>
            <b-card header="Оценка">
                <div v-if="appealsQuiz" class="chart-wrapper">
                    <b-card-text
                        >Данная статистика отображает информацию по оценке удовлетворенности качеством оказания государственных услуг в ООНе</b-card-text
                    >

                    <pie-chart-two :appealsquiz="appealsQuiz" :appealsreview="appealsReview"/>
                </div>
                <h2 v-else>No Data!</h2>
            </b-card>

<!--            <b-card-group header="Статистика обращений">-->
<!--                <b-card>-->
<!--&lt;!&ndash;                    <div class="row">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-primary">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Количество обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">8,123</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-success">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Обработанно обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">6,568</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="row">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-primary">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Количество обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">8,123</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-success">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Обработанно обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">6,568</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-success">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Обработанно обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">6,568</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--                </b-card>-->

<!--&lt;!&ndash;                <b-card>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="row">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-primary">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Количество обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">8,123</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-success">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Обработанно обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">6,568</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="row">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-primary">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Количество обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">8,123</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="col">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="callout callout-success">&ndash;&gt;-->
<!--&lt;!&ndash;                                <small class="text-muted"&ndash;&gt;-->
<!--&lt;!&ndash;                                    >Обработанно обращений</small&ndash;&gt;-->
<!--&lt;!&ndash;                                ><br />&ndash;&gt;-->
<!--&lt;!&ndash;                                <strong class="h4">6,568</strong>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                </b-card>&ndash;&gt;-->
<!--            </b-card-group>-->


        </b-card-group>
    </div>
</template>
<script>

import {mapGetters} from "vuex";

import Pie from 'vue-chartjs'


import BarChart from "./charts/BarChart.vue";
import PieChart from "./charts/PieChart.vue";
import PieChartTwo from "./charts/PieChartTwo.vue";
import PieChartThree from "./charts/PieChartThree.vue";

export default {
    extends: Pie,
    name: "charts",
    components: {
        PieChart,
        BarChart,
        PieChartTwo,
        PieChartThree
    },

    data(){
        return {
            dataCollection: {},
            appealsReview: null,
            appealsQuiz: null,
            positiveComment: null,
            negativeComment: null,
            globalRating: null,
            startRating: null,
        }
    },

    async mounted() {
        this.appealsQuiz = await this.$store.dispatch('appeals/getAppealsQuizDataInStorage').catch(err => console.log(err))
        this.appealsReview = await this.$store.dispatch('appeals/getAppealsReviewDataInStorage').catch(err => console.log(err))

        console.log(this.appealsQuiz)
        console.log(this.appealsReview)


    }


};
</script>
