<template>
    <AuthenticatedLayout :auth="auth" @permissoes="(value)=>setPermissoes(value)">
        <ModalEditarLivro :modalVisible="modal"></ModalEditarLivro>
        <Alert :dialogVisible="mensagem"></Alert>
        <v-sheet class="mx-auto m-5" width="900">
            <InputPesquisaNoBanco :route_dados="'pesquisar_livro'"></InputPesquisaNoBanco>
            <v-row class="justify-content-center">
                <v-col cols="12" md="4" lg="3" v-for="(livro, index) in livros" class="text-center">
                    <CardLivro :livro="livro">
                        <v-btn variant="flat" color="#310740" class="m-1" @click="reservar(livro)"
                            v-show="livro.qtd_lvro_estqe > 0">Reservar</v-btn>
                        <v-chip color="red" text-color="white" v-show="livro.qtd_lvro_estqe == 0"
                            rounded="1">Indisponível</v-chip>
                        <v-btn variant="flat" color="#310740" class="m-1"
                            @click="abrirModalEditarLivro(livro)" v-show="permissoes.livros.editar">Editar</v-btn>
                        <v-btn variant="flat" color="#310740" class="m-1" @click="deletarLivro" v-show="permissoes.livros.deletar">Deletar</v-btn>
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
import { onMounted, ref, watch } from 'vue'
import Alert from '@/Components/Alert.vue';

const modal = ref({ data: null, exibir: false, title: 'Editar', livro: null });
const livrosCarrinho = ref([])
const mensagem = ref({message:'O livro foi adicionado ao carrinho com sucesso !',title:'Mensagem',exibir:false})

defineProps({

    livros: {

        type: Object
        
    },
    auth: {

        type: Object
    }

})

const reservar = (livro) => {

    livro.quantidade = 1;
    livrosCarrinho.value.push(livro)
    localStorage.setItem('livrosCarrinho', JSON.stringify(livrosCarrinho.value))

    mensagem.value.status = "success";
    mensagem.value.exibir = true;


}

const abrirModalEditarLivro = (livro) => {

    modal.value.livro = livro;
    modal.value.exibir = true;

}

const permissoes = ref({});

const deletarLivro = () => {
    //Função que será desenvolvida posteriormente para deletar o livro
}

onMounted(() => {

    const dadosSalvos = localStorage.getItem('livrosCarrinho');
    if (dadosSalvos) {
        livrosCarrinho.value = JSON.parse(dadosSalvos);
    }


})

const setPermissoes = (value)=>{

    permissoes.value = value;

}


</script>