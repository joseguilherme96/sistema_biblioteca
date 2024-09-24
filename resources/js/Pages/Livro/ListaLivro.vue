<template>
    <AuthenticatedLayout>
        <ModalEditarLivro :modalVisible="modal"></ModalEditarLivro>
        <v-sheet class="mx-auto m-5" width="900">
            <InputPesquisaNoBanco :route_dados="'pesquisar_livro'"></InputPesquisaNoBanco>
            <v-row class="justify-content-center">
                <v-col cols="12" md="4" lg="3" v-for="(livro, index) in livros" class="text-center">
                    <CardLivro :livro="livro">
                            <v-btn variant="flat" color="#310740" class="m-1" @click="reservar">Reservar</v-btn>
                            <v-btn variant="flat" color="#310740" class="m-1" @click="abrirModalEditarLivro(index)">Editar</v-btn>
                            <v-btn variant="flat" color="#310740" class="m-1" @click="deletarLivro">Deletar</v-btn>
                    </CardLivro>
                </v-col>
            </v-row>
        </v-sheet>
    </AuthenticatedLayout>
</template>
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CardLivro from './Partials/CardLivro.vue';
import InputPesquisaNoBanco from '@/Components/InputPesquisaNoBanco.vue';
import ModalEditarLivro from './Partials/ModalEditarLivro.vue';
import {ref} from 'vue'

const modal = ref({ data:null, exibir: false,title:'Editar'});

defineProps({

    livros: {

        type: Object
    }

})

const reservar = ()=>{

    //Função que será desenvolvida posteriormente para reserva de livro

}

const abrirModalEditarLivro = ()=>{

    ///Função que será desenvolvida para abrir modal para editar livro
    modal.value.exibir = true;

}

const deletarLivro = ()=>{
    //Função que será desenvolvida posteriormente para deletar o livro
}

</script>