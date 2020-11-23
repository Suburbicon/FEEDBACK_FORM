<template>
    <b-modal id="member-form" size="lg" hide-footer :title="titleForm[action]">
        <b-form @submit.stop.prevent="onSubmitModal">
            <b-col sm="4">
                <b-form-group label-for="name" label="Наивенование города">
                    <b-form-input type="text"
                                  id="name"
                                  name="name"
                                  placeholder="Введите название"
                                  v-model="items.name"
                                  v-validate="{ required: true, min: 2, max: 20 }"
                                  :state="validateState('name')">
                    </b-form-input>
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
    name: "City",

    props: {
        action: String,
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
                    this.url = `/city/${this.action}?name=${this.items.name}`;
                } else if (this.action === 'edit') {
                    this.url = `/city/${this.action}?id=${this.items.id}&name=${this.items.name}`;
                }

                axios.post(this.url)
                    .then(response => {
                        console.log(response);

                        this.items = defaultField()
                        this.$bvModal.hide('member-form')
                        this.$store.dispatch('citys/getCitysDataInStorage')
                            .catch(error => {
                                console.log(error)
                            })
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
