<template>
    <b-modal id="member-form" size="lg" hide-footer :title="titleForm[action]">
        <b-form @submit.stop.prevent="onSubmitModal">
            <b-col sm="4">
                <b-form-group label-for="name" label="Наивенование города">
                    <b-form-input type="text"
                                  id="name"
                                  name="name"
                                  placeholder="Город"
                                  v-model="items.firstname"
                                  v-validate="{ required: true, min: 2, max: 20, alpha: true }"
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
        items: {
            type: Object,
            default: defaultField
        }
    },
    data() {
        return {
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

                axios.post('/city/' + this.action + '/', this.deleteEmptyData(this.items))
                    .then(response => {
                        let params = {
                            entity: response.data['result'].entity,
                            selected_member: {
                                member_id: response.data['result'].member_id,
                                name: response.data['result'].name
                            },
                            members_list: [{
                                member_id: response.data['result'].member_id,
                                name: response.data['result'].name
                            }]
                        }

                        // this.$store.dispatch('orders/setMemberId', response.data['result'].member_id).catch(error => {
                        //     console.log(error)
                        // })
                        // this.$store.dispatch('orders/setActiveSelect', params)

                        this.items = defaultField()
                        this.$bvModal.hide('member-form')
                        this.$store.dispatch('citys/getCitysDataInStorage').catch(error => {
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
