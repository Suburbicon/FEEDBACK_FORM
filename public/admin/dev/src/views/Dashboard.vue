<template>
    <div class="animated fadeIn">
        <b-card-group columns class="card-columns">
            <b-card header="Статистика обращений">
                <div class="chart-wrapper">
                    <LineExample />
                    <b-card-footer>
                        <button type="button" class="btn btn-primary">
                            <span class="cui-contrast"></span>Скачать отчет
                        </button>
                    </b-card-footer>
                </div>
            </b-card>

            <b-card header="Статусы обращений">
                <div class="chart-wrapper">
                    <!-- <doughnut-example chartId="chart-doughnut-01"/> -->
                    <HorizontalBar />
                </div>
                <b-card-footer>
                    <div
                        class="btn-group"
                        role="group"
                        aria-label="Basic example"
                    >
                        <button type="button" class="btn btn-primary">
                            Скачать отчет
                        </button>
                        <button type="button" class="btn btn-info">
                            Просмотреть отчет
                        </button>
                        <button type="button" class="btn btn-warning">
                            Коректировать отчет
                        </button>
                    </div>
                </b-card-footer>
            </b-card>

            <b-card-group>
                <b-card header="Статистика обращений">
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений</small
                                ><br />
                                <strong class="h4">8,123</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений</small
                                ><br />
                                <strong class="h4">8,123</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                    </div>
                </b-card>

                <b-card header="Статистика обращений">
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений</small
                                ><br />
                                <strong class="h4">8,123</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений</small
                                ><br />
                                <strong class="h4">8,123</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                    </div>
                </b-card>
            </b-card-group>
        </b-card-group>
        <b-card-group columns class="card-columns">
            <b-card header="Сектора">
                <div class="chart-wrapper">
                    <b-card-text
                        >Данная статистика отображает информацию по секторам
                        обращений</b-card-text
                    >
                    <DoughnutExample />
                </div>
            </b-card>

            <b-card-group header="Статистика обращений">
                <b-card>
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений</small
                                ><br />
                                <strong class="h4">8,123</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений</small
                                ><br />
                                <strong class="h4">8,123</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                    </div>
                </b-card>

                <b-card>
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений</small
                                ><br />
                                <strong class="h4">8,123</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="callout callout-primary">
                                <small class="text-muted"
                                    >Количество обращений</small
                                ><br />
                                <strong class="h4">8,123</strong>
                            </div>
                        </div>
                        <div class="col">
                            <div class="callout callout-success">
                                <small class="text-muted"
                                    >Обработанно обращений</small
                                ><br />
                                <strong class="h4">6,568</strong>
                            </div>
                        </div>
                    </div>
                </b-card>
            </b-card-group>

            <b-card header="Статистика обращений">
                <div class="chart-wrapper">
                    <PieExample />
                </div>
            </b-card>
        </b-card-group>
    </div>
</template>
<script>
import LineExample from "./charts/LineExample";
import DoughnutExample from "./charts/DoughnutExample";
import PieExample from "./charts/PieExample";
import HorizontalBar from "./charts/HorizontalBarExample";

export default {
    name: "charts",
    components: {
        LineExample,
        DoughnutExample,
        PieExample,
        HorizontalBar
    }
};
</script>
