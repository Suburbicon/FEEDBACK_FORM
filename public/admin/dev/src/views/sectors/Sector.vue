<template>
    <b-modal id="member-form" size="lg" hide-footer :title="titleForm[action]">
        <b-form @submit.stop.prevent="onSubmitModal">
            <b-col sm="4">
                <b-form-group label-for="name" label="Наименование города">
                    <b-form-input type="text"
                                  id="name"
                                  name="name"
                                  placeholder="ЦОН"
                                  v-model="items.name"
                                  v-validate="{ required: true, min: 2, max: 40, alpha: true }"
                                  :state="validateState('name')">
                    </b-form-input>
                </b-form-group>
                <b-form-group label-for="city" label="Город">
                    <b-form-select v-model="items.id_city"
                                   :options="cities"
                                   value-field="id"
                                   text-field="name"
                    >
                    </b-form-select>
                </b-form-group>
            </b-col>
            <div slot="footer">
                <b-button type="submit" size="sm" variant="success" class="button-mar"><i
                    class="fa fa-dot-circle-o"></i> {{ textButton[action] }}
                </b-button>
                <b-button size="sm" variant="warning" @click="$bvModal.hide('member-form')"><i class="fa fa-ban"></i>
                    Отменить
                </b-button>
            </div>
        </b-form>
    </b-modal>
</template>

<script>
import axios from 'axios'

let defaultField = function () {
    return {
        id: null,
        name: '',
    }
}

export default {
    name: "Department",

    props: {
        action: String,
        citySelectValue: 1,
        cityName: {
            default: '',
            type: String,
        },
        id: Number,

        items: {
            type: Object,
            default: {
                id: null,
                name: '',
                id_city: 1
            }
        }
    },

    data() {
        return {
            url: null,

            defaultFields: null,

            titleForm: {
                "add": "Добавление города в административную панель",
                "edit": "Редактирование города",
            },

            textButton: {
                "add": "Добавить",
                "edit": "Сохранить"
            },
        }
    },

    computed: {
        cities () {
            console.log(this.$store.getters['citys/getCitys'])
            return this.$store.getters['citys/getCitys']
        },
    },

    methods: {
        validateState(ref) {
            if (this.veeFields[ref] && (this.veeFields[ref].dirty || this.veeFields[ref].validated) && !(this.veeFields[ref].required === false && this[ref] === '')) {
                return !this.veeErrors.has(ref)
            }
            return null
        },

        deleteEmptyData(data) {
            let result = {}
            let member_fields = ["id", "name"]

            for (let field in data) {
                if (member_fields.indexOf(field) !== -1 && data[field] !== null && data[field] !== "") {
                    result[field] = data[field]
                }
            }

            return result
        },

        onSubmitModal() {
            this.$validator.validateAll().then((result) => {
                if (!result) {
                    return
                }

                if (this.action === 'add') {
                    this.url = `/departments/${this.action}?id_city=${this.items.id_city}&name=${this.items.name}`;
                } else if (this.action === 'edit') {
                    this.url = `/departments/${this.action}?id=${this.items.id}&name=${this.items.name}&id_city=${this.items.id_city}`;
                }

                console.log(this.url);

                axios.post(this.url)
                    .then(response => {
                        console.log(response);

                        this.items = defaultField()
                        this.$bvModal.hide('member-form')
                        this.$store.dispatch('departments/getDepartments')
                    })
                    .catch(error => {
                        console.log(error)
                    })
            })
        }
    }
}
</script>

<style scoped>
.button-mar {
    margin-right: 5px;
}
</style>
