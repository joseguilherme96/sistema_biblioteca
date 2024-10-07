<template>

    <v-card>
        <div class="d-flex flex-no-wrap">
            <v-avatar class="ma-3" rounded="0" size="125">
                <v-img :src="item.linkImagemCapaLivro"></v-img>
            </v-avatar>
            <div>
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
            </div>
        </div>
    </v-card>

</template>
<script setup>


import Minus from '@/Components/Minus.vue';
import Plus from '@/Components/Plus.vue';

const props = defineProps({

    item: {

        type: Object,
        required: true
    }

})


// Aumenta a quantidade de um livro
const aumentaQuantidade = () => {
    props.item.quantidade++;
};

// Diminui a quantidade de um livro
const diminuiQuantidade = (index) => {
    if (props.item.quantidade > 1) {
        props.item.quantidade--;
    }
};


</script>