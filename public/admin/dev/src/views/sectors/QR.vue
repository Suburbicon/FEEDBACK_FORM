<template>
    <b-modal id="qr-form" size="lg" hide-footer :title="'Распечатывание QR кода'">
        <img :src="items.path_to_qr" alt="qr">
        <button @click="print" class="">COPY</button>
    </b-modal>
</template>

<script>
import axios from 'axios'

export default {
    name: "QR",

    props: {
        items: {
            type: Object,
            default: {
                id: null,
                name: '',
                id_department: 1
            }
        }
    },

    data() {
        return {
            url: null,
        }
    },

    computed: {
        departments () {
            return this.$store.getters['departments/getDepartments']
        },
    },

    methods: {
        print () {
            let win = window.open();
            win.document.write(`<img src="${this.items.path_to_qr}">`);
            win.print();
            win.close()
        },

        onSubmitModal() {
            this.$validator.validateAll().then((result) => {
                if (!result) {
                    return
                }

                console.log('this.items.id_department: ', this.items.id_department)
                let currentDepartment = this.departments.filter(item => item.id === +this.items.id_department);
                console.log('asdasa: ', currentDepartment)

                if (this.action === 'add') {
                    this.url = `/sectors/${this.action}?id_department=${this.items.id_department}&id_city=${currentDepartment[0].id_city}&name=${this.items.name}`;
                } else if (this.action === 'edit') {
                    this.url = `/sectors/${this.action}?id=${this.items.id}&id_department=${this.items.id_department}&id_city=${currentDepartment[0].id_city}&name=${this.items.name}`;
                }

                console.log(this.url);

                axios.post(this.url)
                    .then(response => {
                        console.log(response);

                        this.items = defaultField()
                        this.$bvModal.hide('member-form')
                        this.$store.dispatch('sectors/getSectorsData')
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
