<template>
    <div class="app flex-row align-items-center">
        <div class="container">
            <b-row class="justify-content-center">
                <b-col md="8">
                    <b-card-group>
                        <b-card no-body class="p-4">
                            <b-card-body>
                                <b-form @submit="onSubmit">
                                    <h1>Авторизоваться</h1>
                                    <p class="text-muted">Войдите в свой аккаунт</p>
                                    <b-input-group class="mb-3">
                                        <b-input-group-prepend>
                                            <b-input-group-text><i class="icon-user"></i></b-input-group-text>
                                        </b-input-group-prepend>
                                        <b-form-input v-model="login" type="text" class="form-control"
                                                      placeholder="Логин" autocomplete="username email"/>
                                    </b-input-group>
                                    <b-input-group class="mb-4">
                                        <b-input-group-prepend>
                                            <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                                        </b-input-group-prepend>
                                        <b-form-input v-model="password" type="password" class="form-control"
                                                      placeholder="Пароль" autocomplete="current-password"/>
                                    </b-input-group>
                                    <b-input-group class="mb-4">
                                        <b-form-checkbox v-model="remember"  type="remember">Запомнить меня</b-form-checkbox>
                                    </b-input-group>
                                    <b-row>
                                        <b-col cols="6">
                                            <b-button type="submit" variant="primary" class="px-4">Войти в систему
                                            </b-button>
                                        </b-col>
                                        <b-col cols="6" class="text-right">
                                            <b-button variant="link" class="px-0">Забыли пароль?</b-button>
                                        </b-col>
                                    </b-row>
                                </b-form>
                            </b-card-body>
                        </b-card>
                    </b-card-group>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'login',
    data() {
      return {
        login: '',
        password: '',
        remember: '',

        message: '',
        dismissSecs: 10000,
      }
    },
    computed: {},
    methods: {
      onSubmit(e) {
        e.preventDefault()
        const {login, password, remember} = this
        this.$store.dispatch('auth/login', {login, password, remember})
        .then(response => {
          if (response.data.success) {
            this.$store.dispatch('config/setConfig').then(() => { this.$router.push('/') })
          }
        }).catch(error => {
          this.makeToast(error.data.message, this.dismissSecs)
        })
      },
      makeToast(message, dismissSecs) {
        this.$bvToast.toast(`${message}`, {
          title: 'Внимание',
          autoHideDelay: dismissSecs,
          variant: 'danger',
          appendToast: false
        })
      }
    }
  }
</script>
