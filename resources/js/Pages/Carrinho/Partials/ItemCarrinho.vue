<template>
    <Alert :dialogVisible="mensagem"></Alert>
    <v-card>
        <v-row>
            <v-col cols="12" md="4" lg="4">
                <v-avatar class="ma-3" rounded="0" size="300">
                    <v-img :src="LINK_PASTA + item.nme_img_cap_lvro"></v-img>
                </v-avatar>
            </v-col>
            <v-col cols="12" md="8" lg="8">
                <v-card-title class="text-h5">
                    {{ item.nome }}
                </v-card-title>
                <v-card-subtitle>{{ item.autor }}</v-card-subtitle>
                <v-card-text>
                    {{ item.descricao }}
                </v-card-text>
                <v-card-text>
                    Qtd : {{ item.quantidade }}
                </v-card-text>
                <v-card-actions>
                    <v-btn icon @click="diminuiQuantidade()">
                        <Minus></Minus>
                    </v-btn>
                    <v-btn icon @click="aumentaQuantidade()">
                        <Plus></Plus>
                    </v-btn>
                </v-card-actions>
            </v-col>
        </v-row>
    </v-card>

</template>
<script setup>


import Minus from '@/Components/Minus.vue';
import Plus from '@/Components/Plus.vue';
import Alert from '@/Components/Alert.vue';
import { ref } from 'vue';

const BASE_URL = import.meta.env.BASE_URL;
const CAMINHO_PASTA_IMAGENS_CAPA_LIVRO = import.meta.env.VITE_CAMINHO_PASTA_IMAGENS_CAPA_LIVRO;
const LINK_PASTA = BASE_URL + CAMINHO_PASTA_IMAGENS_CAPA_LIVRO;
const mensagem = ref({ status: '', message: '', exibir: false });

const props = defineProps({

    item: {

        type: Object,
        required: true
    }

})


// Aumenta a quantidade de um livro
const aumentaQuantidade = () => {

    if (props.item.quantidade < props.item.qtd_lvro_estqe) {

        props.item.quantidade++;

        atualizaQuantidadeLivroLocalStorage();
    } else {

        mensagem.value.status = "error";
        mensagem.value.message = `A quantidade que você tentou selecionar excede o limite do estoque, limite máximo disponível ${props.item.qtd_lvro_estqe}!`;
        mensagem.value.title = "Aviso";
        mensagem.value.exibir = true;

    }

};

// Diminui a quantidade de um livro
const diminuiQuantidade = () => {

    if (props.item.quantidade > 1) {

        props.item.quantidade--;

        atualizaQuantidadeLivroLocalStorage();
    }


};

const atualizaQuantidadeLivroLocalStorage = () => {

    const livrosCarrinhoString = localStorage.getItem('livrosCarrinho');
    const livrosCarrinhoTemp = JSON.parse(livrosCarrinhoString);

    //Percorre livros adicionados no local storage
    livrosCarrinhoTemp.forEach((livro,index)=>{
        
        if(livro.id == props.item.id){
            
            //Atualiza a quantidade livro
            livrosCarrinhoTemp[index].quantidade =  props.item.quantidade;

        }

    })

    //Após livro com quantidade alterada, salva novamente no local storage
    localStorage.setItem('livrosCarrinho', JSON.stringify(livrosCarrinhoTemp))


}


</script>