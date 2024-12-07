<template>
    <AuthenticatedLayout :auth="auth" @permissoes="(value) => setPermissoes(value)">
        <ModalEditarLivro :modalVisible="modal"></ModalEditarLivro>
        <Alert :dialogVisible="mensagem"></Alert>
        <v-sheet class="mx-auto m-5" width="900">
            <InputPesquisaNoBanco :route_dados="'pesquisar_livro'"></InputPesquisaNoBanco>
            <v-row class="justify-content-center">
                <v-col cols="12" md="4" lg="3" v-for="(livro, index) in livros" class="text-center">
                    <CardLivro :livro="livro">
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-6 p-2">
                                    <v-btn variant="flat" color="#310740" @click="reservar(livro)"
                                        v-show="livro.qtd_lvro_estqe > 0" class="ml-5">Reservar</v-btn>
                                    <v-chip color="red" text-color="white" v-show="livro.qtd_lvro_estqe == 0"
                                        rounded="1" class="ml-5">Indisponível</v-chip>
                                </div>
                                <div v-if="permissoes.livros.editar && permissoes.livros.deletar"
                                    class="d-inline col-2 mr-5">
                                    <v-icon left small color="#310740" @click="livro.exibirBotoesExtras = true"
                                        v-show="livro.exibirBotoesExtras != true">mdi-chevron-down</v-icon>
                                    <v-icon left small color="#310740" @click="livro.exibirBotoesExtras = false"
                                        v-show="livro.exibirBotoesExtras == true">mdi-chevron-up</v-icon>
                                </div>
                            </div>
                        </div>
                        <div class="d-block m-1">
                            <v-btn variant="flat" color="#310740" class="m-1" @click="abrirModalEditarLivro(livro)"
                                v-show="permissoes.livros.editar && livro.exibirBotoesExtras">Editar</v-btn>
                            <v-btn variant="flat" color="#310740" class="m-1" @click="deletarLivro"
                                v-show="permissoes.livros.deletar && livro.exibirBotoesExtras">Deletar</v-btn>
                        </div>
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
const mensagem = ref({ message: 'O livro foi adicionado ao carrinho com sucesso !', title: 'Mensagem', exibir: false })

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

const setPermissoes = (value) => {

    permissoes.value = value;

}


</script>