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
        <v-card-actions class="justify-content-end">
            <Button :nome="'Finalizar reserva'" @click="finalizarReserva"></Button>
            <Button :nome="'Limpar Carrinho'" @click="limparCarrinho"></Button>
        </v-card-actions>

    </AuthenticatedLayout>


</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref, watch } from 'vue'
import ItemCarrinho from './Partials/ItemCarrinho.vue';
import Button from '@/Components/Button.vue';

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