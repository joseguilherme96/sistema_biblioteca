<template>
    <AuthenticatedLayout>

        <h1 class="text-center" style="font-weight: 100;">Fila de Reservas</h1>
        <InputPesquisaNoBanco :route_dados="'pesquisar_reserva'"
            placeholder="Pesquise por id da reserva, nome do solicitante"></InputPesquisaNoBanco>
        <v-card color="#FFFAFA" class="mt-5 mb-3" v-for="(reserva, index) in reservas" :key="index" max-width="1300"
            outlined>
            <v-card-title class="d-flex justify-space-between">
                <span class="text-h6">Reserva Nº {{ reserva.id_reserva_livro }}</span>
                <v-chip v-if="reserva.status" color="green" label small class="ml-2">
                    {{ reserva.status }}
                </v-chip>
            </v-card-title>

            <v-card-subtitle class="text-subtitle-1 mb-2">
                Solicitante: <strong>{{ reserva.name }}</strong>
            </v-card-subtitle>

            <v-card-text class="text-body-2" style="height: 100px; overflow-y: hidden;">
                <v-row>
                    <v-icon left small color="grey darken-1">mdi-calendar-clock</v-icon>
                    <strong>Data/Hora Solicitada : </strong>  {{ reserva.created_at }}
                </v-row>
            </v-card-text>

            <v-card-actions class="d-flex justify-center pt-3">
                <slot></slot>
            </v-card-actions>
        </v-card>


    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref, watch } from 'vue'
import InputPesquisaNoBanco from '@/Components/InputPesquisaNoBanco.vue';

defineProps({

    reservas: {

        type: Object,
        required: true
    }
})

</script>