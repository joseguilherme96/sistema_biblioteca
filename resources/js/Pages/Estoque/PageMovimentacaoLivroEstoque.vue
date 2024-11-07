
<template>

    <AuthenticatedLayout>
        <h1 class="text-center" style="font-weight: 100; color: #310740">Movimentação Estoque</h1>
        <v-data-table :items="movimentacoes" :fixed-header="true" :hover="true"></v-data-table>
    </AuthenticatedLayout>

</template>
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted } from 'vue';
defineProps({


    movimentacoes: {

        type: Object,
        required: true
    }

})


onMounted(() => {

    //Aplicando cor na quantidade, caso seja uma saida
    document.querySelectorAll('.v-data-table__tr').forEach((linha) => {

        let quantidade_movimentada = linha.children[5].innerHTML;

        if (quantidade_movimentada < 0) {

            linha.children[5].style.color = "red";

        } else {

            linha.children[5].style.color = "green";

        }

    })

})


</script>