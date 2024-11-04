<template>
    <AuthenticatedLayout>
        <ModalAtendimentoItensReserva :modalVisible="modal"></ModalAtendimentoItensReserva>
        <DadosReserva :reserva="reserva" v-for="(reserva, index) in reservas">
        </DadosReserva>

        <v-table>
            <thead>
                <tr style="color: #310740;">
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
                    <td>{{ item.quantidade_separada ? item.quantidade_separada : 0 }}</td>
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
import ModalAtendimentoItensReserva from './Partials/ModalAtendimentoItensReserva.vue';
import { ref } from 'vue'

const modal = ref({ data: null, exibir: false, title: 'Atendimento Reserva', itens_reservados: null });

const props = defineProps({

    reservas: {

        type: Object,
        required: true
    },
    itens: {
        type: Object,
        required: true
    },
    auth: {
        type: Object,
        required: true
    }
})

const abrirModalRegistraSaidaEstoque = () => {

    modal.value.itens_reservados = props.itens;

    //Adiciona atributo checked a cada item da lista de separação
    //Adiciona id_usuario que está realizando a baixa
    modal.value.itens_reservados.forEach((linha) => {

        linha.checked = false;
        linha.id_usuario = props.auth.user.id

    })

    modal.value.exibir = true;
}



</script>