<template>
    <b-modal id="qr-form" size="lg" hide-footer :title='`QR код сектора: "${items.name}"`'>
        <b-form @submit.stop.prevent="">
            <b-col sm="4" v-if="items.path_to_qr">
                <img style="max-width: 100%;" :src="items.path_to_qr" alt="qr">
            </b-col>
            <p v-else>QR код не сгенерирован</p>
            <div slot="footer" class="mt-3">
                <b-button v-if="items.path_to_qr" type="button" @click="print" size="sm" variant="success" class="button-mar">
                    <i class="fa fa-dot-circle-o"></i> Распечатать
                </b-button>
                <b-button size="sm" variant="warning" @click="$bvModal.hide('qr-form')" class="button-cancel">
                    <i class="fa fa-ban"></i> Отменить
                </b-button>
                <a download :href="items.path_to_qr" size="sm" id="download" class="button-mar">
                    <i class="fa fa-download"></i> Скачать
                </a>
            </div>
        </b-form>
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
                id_department: 1,
                path_to_qr: null,
            }
        }
    },

    data() {
    },

    methods: {
        print() {
            // let win = window.open();
            window.document.write('<img src='+this.items.path_to_qr+'>');
            window.print();
            window.close();
        },
    }
}
</script>

<style scoped>
.button-mar {
    margin-right: 5px;
}
    .button-cancel{
        margin-right: 5px;
    }
</style>
