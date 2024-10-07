<template>

    <AuthenticatedLayout>
        <v-row v-for="(livro, index) in livrosCarrinho">
            <v-col cols="12">
                <ItemCarrinho :item="livro"></ItemCarrinho>
            </v-col>
        </v-row>
        <v-row v-show="livrosCarrinho == null">
            <v-col cols="12">
                Não há livros adicionados ao carrinho
            </v-col>
        </v-row>
        <v-card-actions>
            <v-btn class="mt-4" color="#310740" @click="finalizarReserva">
                Finalizar reserva
            </v-btn>
            <v-btn class="mt-4" color="#310740" @click="limparCarrinho">
                Limpar Carrinho
            </v-btn>
        </v-card-actions>

    </AuthenticatedLayout>


</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref, watch } from 'vue'
import ItemCarrinho from './Partials/ItemCarrinho.vue';

const livrosCarrinho = ref(null);

onMounted(() => {

    const livrosSalvos = localStorage.getItem('livrosCarrinho');

    if (livrosSalvos) {

        livrosCarrinho.value = JSON.parse(livrosSalvos)

    }

})

const finalizarReserva = () => {

    //Próximo passo é criar a função que finalize a reserva
    alert("ss");

}


const limparCarrinho = () => {

    //Próximo passo é criar a função de limpar carrinho
    localStorage.removeItem("livrosCarrinho");
    livrosCarrinho.value = null;
    

}





</script>