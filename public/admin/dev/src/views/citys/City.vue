<template>
    <b-modal id="member-form" size="lg" hide-footer :title="titleForm[action]">
        <b-form @submit.stop.prevent="onSubmitModal">
            <b-col sm="4">
                <b-form-group label-for="firstname" label="Наивенование города">
                    <b-form-input type="text"
                                  id="firstname"
                                  name="firstname"
                                  placeholder="Город"
                                  v-model="items.firstname"
                                  v-validate="{ required: true, min: 2, max: 20, alpha: true }"
                                  :state="validateState('firstname')">
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
        lastname: '',
        firstname: '',
        secondname: '',

        entity: null,
        email: '',

        phone_mobile: '',
        phone_landline: '',
        phone_landline_adt: '',

        adt_info: ''
    }
}

export default {
    name: "Member",
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
            entity_list: [
                {value: 0, text: 'Физическое лицо'},
                {value: 1, text: 'Юридическое лицо'}
            ]
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
            let member_fields = ["id", "lastname", "firstname", "secondname", "entity", "email", "phone_mobile", "phone_landline", "phone_landline_adt", "adt_info"]

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

                axios.post('/members/' + this.action + '/', this.deleteEmptyData(this.items))
                    .then(response => {
                        let params = {
                            entity: response.data['result'].entity,
                            selected_member: {
                                member_id: response.data['result'].member_id,
                                name: response.data['result'].name
                            },
                            members_list: [{
                                member_id: response.data['result'].member_id,
                                name: response.data['result'].name,
                                entity: response.data['result'].entity
                            }]
                        }

                        this.$store.dispatch('orders/setMemberId', response.data['result'].member_id).catch(error => {
                            console.log(error)
                        })
                        this.$store.dispatch('orders/setActiveSelect', params)

                        this.items = defaultField()
                        this.$bvModal.hide('member-form')
                        this.$store.dispatch('members/getMembersDataInStorage').catch(error => {
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
