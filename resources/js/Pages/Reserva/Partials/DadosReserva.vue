<template>

    <v-card color="#FFFAF0" class="mt-5 mb-3" max-width="1300" outlined>
        <v-card-title class="d-flex justify-space-between">
            <span class="text-h6">Reserva Nº {{ reserva.id_reserva_livro }}</span>
            <v-chip v-if="reserva.status" color="#006400" label small class="ml-2" style="color: white;">
                {{ reserva.status }}
            </v-chip>
        </v-card-title>

        <v-card-subtitle class="text-subtitle-1 mb-2">
            Solicitante: <strong >{{ reserva.name }}</strong>
        </v-card-subtitle>
        <v-card-subtitle class="text-subtitle-1 mb-2">
            Tipo Usuário: <strong>{{ reserva.nome_nivel_acesso }}</strong>
        </v-card-subtitle>
        <v-card-text class="text-body-2" style="height: 100px; overflow-y: hidden;">
            <v-row>
                <v-icon left small color="grey darken-1">mdi-calendar-clock</v-icon>
                <strong>Data/Hora Solicitada : </strong> {{ reserva.created_at }}
            </v-row>
        </v-card-text>
        <slot></slot>
    </v-card>
</template>
<script setup>

defineProps({

    reserva: {
        type: Object,
        required: true
    }

})

</script>