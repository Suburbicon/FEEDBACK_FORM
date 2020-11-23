<template>
    <b-card-group>
        <b-card header="Список секторов">
            <b-button size="sm" class="mar-top" :hidden="!button_hidden" variant="success" @click="showModal('add')"><i
                class="fa fa-plus"></i> Добавить
            </b-button>
            <b-button size="sm" class="mar-top" :hidden="button_hidden" variant="warning" @click="showModal('edit')"><i
                class="fa fa-edit"></i> Редактировать
            </b-button>
            <b-button size="sm" class="mar-top ml-2" :hidden="button_hidden" variant="success" @click="QRCodeGenerate">Сгенерировать QR код</b-button>
            <b-button size="sm" class="mar-top ml-2" :hidden="button_hidden" variant="primary" @click="$bvModal.show('qr-form')">Показать QR код</b-button>

            <keep-alive>
                <b-table
                    selectable
                    select-mode="single"
                    selectedVariant="success"
                    @row-selected="rowSelected"

                    show-empty
                    empty-text="Нет записей для показа"

                    :current-page="currentPage"
                    :per-page="perPage"

                    hover
                    small
                    :fixed="true"
                    :bordered="true"
                    :items="filtered"
                    :fields="fields">
                </b-table>
            </keep-alive>

            <b-row>
                <b-col>
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        class="my-0"
                    >
                    </b-pagination>
                </b-col>

                <b-col sm="1">
                    <b-button variant="outline-primary" @click="refresh"><i class="icon-refresh"></i></b-button>
                </b-col>

                <b-col>
                    <b-form-select v-model="perPage" :options="[10, 15, 20, 50]"></b-form-select>
                </b-col>

                <b-col>
                    <b-button variant="outline-primary" @click="clearFilter">Снять фильтры</b-button>
                </b-col>

                <b-col sm="3">
                    <div class="text-right">{{ recordsDisplayed }}</div>
                </b-col>
            </b-row>
        </b-card>
        <member-form :items="member_selected" :action="action"></member-form>
        <qr-form :items="member_selected"></qr-form>
    </b-card-group>
</template>

<script>
import memberForm from './Sector'
import qrForm from './QR'
import axios from "axios";

export default {
    name: 'Sectors',

    components: {memberForm, qrForm},

    data: () => {
        return {
            action: '',
            member_selected: undefined,
            button_hidden: true,

            currentPage: 1,
            totalRows: 0,
            perPage: 10,
            fields: [
                {key: 'name', label: 'Наименование сектора', sortable: true},
                {key: 'city_name', label: 'Наименование города', sortable: true},
                {key: 'department_name', label: 'Наименование ЦОНа', sortable: true},
            ],
            filters: {
                department_name: '',
                city_name: '',
                name: '',
            }
        }
    },
    methods: {
        showModal(action) {
            this.action = action
            this.$bvModal.show('member-form')
        },

        QRCodeGenerate () {
            axios.post(`/sectors/get_qr?id=${this.member_selected.id}&id_city=${this.member_selected.id_city}&id_department=${this.member_selected.id_department}`)
                .then(response => {
                    console.log(response);
                    this.$store.dispatch('sectors/getSectorsData')
                })
                .catch(error => {
                    console.log(error)
                })
        },

        rowSelected(items) {
            let member_selected = undefined

            if (items.length > 0) {
                member_selected = {...items[0]}
            }

            this.button_hidden = items.length === 0
            this.member_selected = member_selected
        },

        clearFilter() {
            for (let key in this.filters) {
                this.filters[key] = ''
            }
        },

        refresh() {
            this.$store.dispatch('citys/getCitysDataInStorage').catch(error => {
                console.log(error)
            })
        }
    },
    computed: {
        sectors () {
            return this.$store.getters['sectors/getSectors']
        },

        departments () {
            return this.$store.getters['departments/getDepartments']
        },

        cities () {
            return this.$store.getters['citys/getCitys']
        },

        fullDataSectors () {
            let sectors = this.sectors;

            for (let i = 0; i < sectors.length; i++) {

                for (let y = 0; y < this.cities.length; y++) {
                    if (this.cities[y].id === +sectors[i].id_city) {
                        sectors[i].city_name = this.cities[y].name;
                    }
                }

                for (let y = 0; y < this.departments.length; y++) {
                    if (this.departments[y].id === +sectors[i].id_department) {
                        sectors[i].department_name = this.departments[y].name;
                    }
                }

            }

            return sectors;
        },

        filtered() {
            const filtered = this.fullDataSectors.filter(item => {
                return Object.keys(this.filters).every(key =>
                    String(item[key]).includes(this.filters[key]))
            })

            this.totalRows = filtered.length
            this.currentPage = 1

            return filtered.length > 0 ? filtered : []
        },

        recordsDisplayed() {
            let how_much = this.perPage * this.currentPage - this.perPage + 1
            let how_many = this.perPage * this.currentPage
            let str = how_much + ' - ' + how_many

            if (this.totalRows === 0) {
                str = '0'
            } else if (how_many < this.totalRows || how_many > this.totalRows) {
                str = how_much + ' - ' + this.totalRows
            }

            return 'Отображено ' + str + ' из ' + this.totalRows
        }
    },

    mounted() {
        this.$store.dispatch('sectors/getSectorsData');
        this.$store.dispatch('departments/getDepartments');
        this.$store.dispatch('citys/getCitysDataInStorage');
    }
}
</script>
<style scoped>
.mar-top {
    margin-bottom: 1em;
}
</style>
