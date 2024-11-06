<template>

    <AuthenticatedLayout>
        <h1 class="text-center" style="font-weight: 100; color: #310740">Movimentação Estoque</h1>
        <v-data-table :items="movimentacoes"></v-data-table>
    </AuthenticatedLayout>

</template>
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({


    movimentacoes: {

        type: Object,
        required: true
    }

})


</script>