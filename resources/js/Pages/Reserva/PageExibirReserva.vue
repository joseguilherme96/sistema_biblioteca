<template>
    <AuthenticatedLayout>

        <DadosReserva :reserva="reserva" v-for="(reserva, index) in reservas">
        </DadosReserva>

        <v-table>
            <thead>
                <tr>
                    <th class="text-left">
                        ID Item
                    </th>
                    <th class="text-left">
                        Livro
                    </th>
                    <th class="text-left">
                        Quantidade Solicitada
                    </th>
                    <th class="text-left">
                        Quantidade Separada
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in itens" :key="item.name">
                    <td>{{ item.livro_id }}</td>
                    <td>{{ item.nome }}</td>
                    <td>{{ item.quantidade_reservada }}</td>
                    <td>0</td>
                </tr>
            </tbody>
        </v-table>
        <v-card-actions class="d-flex justify-end pt-3">
            <Button :nome="'SEPARAR'" @click="abrirModalRegistraSaidaEstoque()"></Button>
        </v-card-actions>
    </AuthenticatedLayout>

</template>
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Button from '@/Components/Button.vue';
import DadosReserva from './Partials/DadosReserva.vue';

defineProps({

    reservas: {

        type: Object,
        required: true
    },
    itens: {
        type: Object,
        required: true
    }
})

const abrirModalRegistraSaidaEstoque = ()=>{

    //Função que será desenvolvida posteriormente para dar baixa no estoque dos livros separados
}


</script>