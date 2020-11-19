<template>
    <b-card-group>
        <b-card>
            <div slot="header">
                <strong>Сегментация</strong>
            </div>

            <b-row>
                <b-col sm="12">
                    <label for="filter1">Фильтр 1</label>
                    <b-form-select type="text" id="filter1" placeholder=""
                                   :plain="true"
                                   :options="[
                                       {value: 'new', text: 'Новый'},
                                       {value: 'agreement', text: 'Заключение договора'},
                                       {value: 'work', text: 'В работе'},
                                       {value: 'closed', text: 'Выполненный'}
                                   ]"
                                   value="new">
                    </b-form-select>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="12">
                    <label for="filter2">Фильтр 1</label>
                    <b-form-select type="text" id="filter2" placeholder=""
                                   :plain="true"
                                   :options="[
                                       {value: 'new', text: 'Новый'},
                                       {value: 'agreement', text: 'Заключение договора'},
                                       {value: 'work', text: 'В работе'},
                                       {value: 'closed', text: 'Выполненный'}
                                   ]"
                                   value="agreement">
                    </b-form-select>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="12">
                    <label for="filter3">Фильтр 3</label>
                    <b-form-select type="text" id="filter3" placeholder=""
                                   :plain="true"
                                   :options="[
                                       {value: 'new', text: 'Новый'},
                                       {value: 'agreement', text: 'Заключение договора'},
                                       {value: 'work', text: 'В работе'},
                                       {value: 'closed', text: 'Выполненный'}
                                   ]"
                                   value="work">
                    </b-form-select>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="12">
                    <label for="filter4">Фильтр 4</label>
                    <b-form-select type="text" id="filter4" placeholder=""
                                   :plain="true"
                                   :options="[
                                       {value: 'new', text: 'Новый'},
                                       {value: 'agreement', text: 'Заключение договора'},
                                       {value: 'work', text: 'В работе'},
                                       {value: 'closed', text: 'Выполненный'}
                                   ]"
                                   value="closed">
                    </b-form-select>
                </b-col>
            </b-row>

            <div slot="footer">
                <b-button type="submit" size="sm" variant="success" class="button-mar"><i class="fa fa-dot-circle-o"></i> Экспорт</b-button>
            </div>
        </b-card>
    </b-card-group>
</template>

<script>
  export default {
    name: "Request"
  }
</script>

<style scoped>
    .button-mar {
        margin-right: 5px;
    }
</style>
