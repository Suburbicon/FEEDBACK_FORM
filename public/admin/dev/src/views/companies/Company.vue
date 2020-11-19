<template>
    <b-modal id="company-form" size="lg" hide-footer :title="titleForm[action]">
        <b-form @submit.stop.prevent="onSubmitModal">
            <b-row>
                <b-col sm="4">
                    <b-form-group label-for="id_number" label="БИК/ИИН">
                        <b-form-input type="text"
                                      id="id_number"
                                      name="id_number"
                                      placeholder="..."
                                      v-model="items.id_number"
                                      v-validate="{ required: true, max: 12, regex:/^[0-9]+$/i }"
                                      :state="validateState('id_number')">
                        </b-form-input>
                    </b-form-group>
                </b-col>

                <b-col sm="4">
                    <b-form-group label-for="name" label="Название компании">
                        <b-form-input type="text"
                                      id="name"
                                      name="name"
                                      placeholder="..."
                                      v-model="items.name"
                                      v-validate="{ required: true, max: 255, alpha_dash: true }"
                                      :state="validateState('name')">
                        </b-form-input>
                    </b-form-group>
                </b-col>

                <b-col sm="4">
                    <b-form-group label-for="short_name" label="Короткое название">
                        <b-form-input id="short_name"
                                      name="short_name"
                                      placeholder="..."
                                      type="text"
                                      v-model="items.short_name"
                                      v-validate="{ required: true, max: 255, alpha_dash: true }"
                                      :state="validateState('short_name')">

                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="6">
                    <b-form-group label-for="type_id" label="Тип компании">
                        <model-list-select id="type_id"
                                           name="type_id"
                                           :list="type_list"
                                           option-value="id"
                                           option-text="name"
                                           v-model="items.type_id"
                                           placeholder="..."
                                           v-validate="{ required: true, min: 1 }"
                                           :state="validateState('type_id')">
                        </model-list-select>
                    </b-form-group>
                </b-col>
                <b-col sm="6">
                    <b-form-group label-for="activity_id" label="Вид деятельности">
                        <model-list-select id="activity_id"
                                           name="activity_id"
                                           :list="activity_list"
                                           option-value="id"
                                           option-text="name"
                                           v-model="items.activity_id"
                                           placeholder="..."
                                           v-validate="{ required: true, min: 1 }"
                                           :state="validateState('activity_id')">
                        </model-list-select>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="6">
                    <b-form-group label-for="email" label="Email компании">
                        <b-form-input id="email"
                                      name="email"
                                      placeholder="..."
                                      type="text"
                                      v-model="items.email"
                                      v-validate="{ required: true, max: 55, email: true }"
                                      :state="validateState('email')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col sm="6">
                    <b-form-group label-for="phone" label="Телефон компании">
                        <b-form-input id="phone"
                                      name="phone"
                                      placeholder="..."
                                      type="text"
                                      v-model="items.phone"
                                      v-validate="{ required: true, regex: /^(\+7[0-9]{10})$/ }"
                                      :state="validateState('phone')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="4">
                    <b-form-group label-for="address_legal" label="Юридический адрес">
                        <b-form-input id="address_legal"
                                      name="address_legal"
                                      placeholder="..."
                                      type="text"
                                      v-model="items.address_legal"
                                      v-validate="{ required: true, min: 2 }"
                                      :state="validateState('address_legal')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col sm="4">
                    <b-form-group label-for="address_mailing" label="Почтовый адрес">
                        <b-form-input id="address_mailing"
                                      name="address_mailing"
                                      placeholder="..."
                                      type="text"
                                      v-model="items.address_mailing"
                                      v-validate="{ required: false, min: 2 }"
                                      :state="validateState('address_mailing')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col sm="4">
                    <b-form-group label-for="address_actual" label="Фактический адрес">
                        <b-form-input id="address_actual"
                                      name="address_actual"
                                      placeholder="..."
                                      type="text"
                                      v-model="items.address_actual"
                                      v-validate="{ required: false, min: 2 }"
                                      :state="validateState('address_actual')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row>
                <b-col sm="4">
                    <b-form-group label-for="director_lastname" label="Фамилия Директора">
                        <b-form-input id="director_lastname"
                                      name="director_lastname"
                                      placeholder="Иванов"
                                      type="text"
                                      v-model="items.director_lastname"
                                      v-validate="{ required: true, max: 255, alpha_dash: true }"
                                      :state="validateState('director_lastname')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col sm="4">
                    <b-form-group label-for="director_firstname" label="Имя Директора">
                        <b-form-input id="director_firstname"
                                      name="director_firstname"
                                      placeholder="Иван"
                                      type="text"
                                      v-model="items.director_firstname"
                                      v-validate="{ required: true, max: 255, alpha_dash: true }"
                                      :state="validateState('director_firstname')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col sm="4">
                    <b-form-group label-for="director_secondname" label="Отчество Директора">
                        <b-form-input id="director_secondname"
                                      name="director_secondname"
                                      placeholder="Иванович"
                                      type="text"
                                      v-model="items.director_secondname"
                                      v-validate="{ required: true, max: 255, alpha_dash: true }"
                                      :state="validateState('director_secondname')">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-input-group class="list_pad">
                <b-form-select slot="prepend" v-model="currency" :options="currency_list"></b-form-select>
                <b-form-input type="text" placeholder="Счёт" name="iban" v-model="iban" v-validate="{ required: false, regex: /^[0-9A-z]{20}$/i }" :state="validateState('iban')"></b-form-input>
                <b-button slot="append" variant="outline-primary" @click="addCompanyAccounts">+</b-button>
            </b-input-group>

            <b-list-group class="list_pad">
                <b-list-group-item v-for="(bill, index) in items.bills">
                    <b-input-group>
                        <b-form-select slot="prepend" v-model="bill.currency" :options="currency_list"></b-form-select>
                        <b-form-input type="text" placeholder="Счёт" :name="'iban' + index" v-model="bill.iban" v-validate="{ required: true, regex: /^[0-9A-z]{20}$/i }" :state="validateState('iban' + index)"></b-form-input>
                        <b-button slot="append" variant="outline-primary" @click="deleteCompanyAccount(index, bill.id)">-</b-button>
                    </b-input-group>
                </b-list-group-item>
            </b-list-group>

            <b-form-group>
                <b-form-checkbox v-model="kbe" value="1" unchecked-value="0">kbe</b-form-checkbox>
            </b-form-group>

            <div slot="footer">
                <b-button type="submit" size="sm" variant="success" class="button-mar"><i class="fa fa-dot-circle-o"></i> {{textButton[action]}}</b-button>
                <b-button size="sm" variant="warning" @click="bvModal.hide('company-form')"><i class="fa fa-ban"></i> Отменить</b-button>
            </div>
        </b-form>
    </b-modal>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex';

  let defaultField = function () {
    return {
      id: null,
      id_number: '',
      name: '',
      short_name: '',

      type_id: null,

      activity_id: null,

      email: '',
      phone: '',

      address_legal: '',
      address_mailing: '',
      address_actual: '',

      director_lastname: '',
      director_firstname: '',
      director_secondname: '',

      bills: [],
      bills_deleted: [],

      kbe: 0
    }
  }

  export default {
    name: "CompanyForm",
    props: {
      action: String,
      items: {
        type: Object,
        default: defaultField
      },
    },
    data() {
      return {
        iban: '',
        type_list: [],
        activity_list: [],
        currency: 'kz',
        currency_list: [
          {text: 'KZ', value: 'kz'},
          {text: 'RU', value: 'ru'}
        ],
        titleForm: {
          "addCompany": "Добавление новой компании",
          "add": "Добавление новой компании",
          "edit": "Редактирование компании",
        },
        textButton: {
          "addCompany": "Добавить",
          "add": "Добавить",
          "edit": "Сохранить"
        },
      }
    },
    methods: {
      refresh() {
        this.$store.dispatch('companies/getCompaniesDataInStorage').catch(error => { console.log(error) })
      },

      deleteEmptyData(data) {
        let company_fields = ["id", "id_number", "bills_deleted", "name", "short_name", "type_id", "activity_id", "email", "phone", "address_legal", "address_mailing", "address_actual", "director_lastname", "director_firstname", "director_secondname", "bills", "kbe"]

        let result = {}
        for (let field in data) {
          if (company_fields.indexOf(field) !== -1 && data[field] !== null && data[field] !== "") {
            result[field] = data[field]
          }
        }

        return result
      },
      validateState(ref) {
        if (this.veeFields[ref] && (this.veeFields[ref].dirty || this.veeFields[ref].validated) && !(this.veeFields[ref].required === false && this[ref] === '')) {
          return !this.veeErrors.has(ref)
        }
        return null
      },
      onSubmitModal() {
        this.$validator.validateAll().then((result) => {
          if (!result) {
            return
          }

          let params = this.deleteEmptyData(this.items)
          let url = '/companies/' + this.action + '/'

          if (this.action === "addCompany") {
            params.member_id = this.member_id
            url = '/orders/addcompany/'
          }

          axios.post(url, params)
          .then(response => {
            this.$store.dispatch('orders/setActiveSelectCompany', { companies_list: [response.data['result']], selected_company: {...response.data['result']} })
            this.items = defaultField()
            this.$bvModal.hide('company-form')
            this.refresh()
          })
          .catch(error => {
            console.log(error)
          })
        })
      },
      addCompanyAccounts() {
        this.$validator.validate('iban').then(result =>  {
          if (!(result && this.iban.length > 0)) {
            return
          }

          this.items.bills.push({currency: this.currency, iban: this.iban})
          this.currency = 'kz'
          this.iban = ''
        })
      },
      deleteCompanyAccount(index, id_bill) {
        if (id_bill) {
          this.items.bills_deleted.push(id_bill)
        }
        this.items.bills.splice(index, 1);
      }
    },
    computed: {
      ...mapGetters({
        member_id: 'orders/getMemberId'
      })
    },
    mounted() {
      // TODO получать данные только по клику
      this.$store.dispatch('orders/getTypesList').then(items => {
        this.type_list = items
      }).catch(error => {
        console.log(error)
      })

      // TODO получать данные только по клику
      this.$store.dispatch('orders/getActivitiesList').then(items => {
        this.activity_list = items
      }).catch(error => {
        console.log(error);
      })
    }
  }
</script>

<style scoped>
    .button-mar {
        margin-right: 5px;
    }
    .list_pad {
        padding-bottom: 1rem;
    }
</style>
