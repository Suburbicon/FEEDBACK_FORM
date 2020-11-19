<template>
    <b-modal id="member-form" size="lg" hide-footer :title="titleForm[action]">
        <b-form @submit.stop.prevent="onSubmitModal">
            <b-row>
                <b-col sm="4">
                    <b-form-group label-for="lastname" label="Фамилия">
                        <b-form-input type="text"
                                      id="lastname"
                                      name="lastname"
                                      placeholder="Иванов"
                                      v-model="items.lastname"
                                      v-validate="{ required: true, min: 2, max: 20, alpha: true }"
                                      :state="validateState('lastname')"
                                      aria-describedby="input-1-live-feedback">
                        </b-form-input>

                        <b-form-invalid-feedback id="input-1-live-feedback">
                            Введите Имя по формату.
                        </b-form-invalid-feedback>
                    </b-form-group>
                </b-col>

                <b-col sm="4">
                    <b-form-group label-for="firstname" label="Имя">
                        <b-form-input type="text"
                                      id="firstname"
                                      name="firstname"
                                      placeholder="Иван"
                                      v-model="items.firstname"
                                      v-validate="{ required: true, min: 2, max: 20, alpha: true }"
                                      :state="validateState('firstname')">
                        </b-form-input>
                    </b-form-group>
                </b-col>

                <b-col sm="4">
                    <b-form-group label-for="secondname" label="Отчетство">
                        <b-form-input type="text"
                                      id="secondname"
                                      name="secondname"
                                      placeholder="Иванович"
                                      v-model="items.secondname"
                                      v-validate="{ required: false, min: 2, max: 20, alpha: true }"
                                      :state="validateState('secondname')">

                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="6">
                    <b-form-group label-for="entity" label="Субъект">
                        <b-form-radio-group
                                id="entity"
                                name="entity"
                                v-model="items.entity"
                                :options="entity_list"
                        ></b-form-radio-group>
                    </b-form-group>
                </b-col>

                <b-col sm="6">
                    <b-form-group label-for="email" label="Электронный адрес">
                        <b-form-input type="text"
                                      id="email"
                                      name="email"
                                      placeholder="info@gobig.kz"
                                      v-model="items.email"
                                      v-validate="{ required: true, max: 25, email: true }"
                                      :state="validateState('email')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="5">
                    <b-form-group label-for="phone_mobile" label="Мобильный телефон">
                        <b-form-input type="text"
                                      id="phone_mobile"
                                      name="phone_mobile"
                                      placeholder="+77752314647"
                                      v-model="items.phone_mobile"
                                      v-validate="{ required: true, regex: /^(\+7[0-9]{10})$/}"
                                      :state="validateState('phone_mobile')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col sm="5">
                    <b-form-group label-for="phone_landline" label="Стационарный телефон">
                        <b-form-input type="text"
                                      id="phone_landline"
                                      name="phone_landline"
                                      placeholder="+77751234567"
                                      v-model="items.phone_landline"
                                      v-validate="{ required: false, regex: /^(\+7[0-9]{10})$/}"
                                      :state="validateState('phone_landline')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col sm="2">
                    <b-form-group label-for="phone_landline_adt" label="Доб. номер">
                        <b-form-input type="text"
                                      id="phone_landline_adt"
                                      name="phone_landline_adt"
                                      placeholder="12345"
                                      v-model="items.phone_landline_adt"
                                      v-validate="{ required: false, numeric: true}"
                                      :state="validateState('phone_landline_adt')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-form-group label-for="adt_info" label="Дополнительная информация">
                <b-form-textarea type="text"
                                 id="adt_info"
                                 name="adt_info"
                                 placeholder=""
                                 v-model="items.adt_info"
                                 v-validate="{ required: false }"
                                 :state="validateState('adt_info')">
                </b-form-textarea>
            </b-form-group>

            <div slot="footer">
                <b-button type="submit" size="sm" variant="success" class="button-mar"><i class="fa fa-dot-circle-o"></i> {{textButton[action]}}</b-button>
                <b-button size="sm" variant="warning" @click="$bvModal.hide('member-form')"><i class="fa fa-ban"></i> Отменить</b-button>
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
          "add": "Добавление нового клиента",
          "edit": "Редактирование клиента",
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
              selected_member: {member_id: response.data['result'].member_id, name: response.data['result'].name},
              members_list: [{member_id: response.data['result'].member_id, name: response.data['result'].name, entity: response.data['result'].entity}]
            }

            this.$store.dispatch('orders/setMemberId', response.data['result'].member_id).catch(error => { console.log(error) })
            this.$store.dispatch('orders/setActiveSelect', params)

            this.items = defaultField()
            this.$bvModal.hide('member-form')
            this.$store.dispatch('members/getMembersDataInStorage').catch(error => { console.log(error) })
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
