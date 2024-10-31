<template>
    <AuthenticatedLayout>

        <h1 class="text-center" style="font-weight: 100;">Fila de Reservas</h1>
        <InputPesquisaNoBanco :route_dados="'pesquisar_reserva'"
            placeholder="Pesquise por id da reserva, nome do solicitante"></InputPesquisaNoBanco>
        <DadosReserva :reserva="reserva" v-for="(reserva, index) in reservas">
            <v-card-actions class="d-flex justify-end pt-3">
                <slot></slot>
                <Button :nome="'VISUALIZAR SOLICITAÇÃO'" @click="visualizarReserva(reserva.id_reserva_livro)"></Button>
            </v-card-actions>
        </DadosReserva>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref, watch } from 'vue'
import InputPesquisaNoBanco from '@/Components/InputPesquisaNoBanco.vue';
import Button from '@/Components/Button.vue';
import { useForm } from '@inertiajs/vue3';
import DadosReserva from './Partials/DadosReserva.vue';

defineProps({

    reservas: {

        type: Object,
        required: true
    }
})

const form = useForm({});

const visualizarReserva = (id_reserva_livro) => {

    form.get(route(`exibir_reserva`, id_reserva_livro))

}


</script>