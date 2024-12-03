<template>
    <div class="col-8 col-md-8 col-lg-3 mt-3">
        <input class="form-control" placeholder="Pesquisa" v-model="input_pesquisa" @keyup="pequisarIconeSistema()" style="border: #310740 solid 3px;">
    </div>
    <div class="col-8 col-md-8 col-lg-1 text-center mt-3">
        <button class="btn btn-default" style="background-color: #310740; color: white;">PESQUISAR</button>
    </div>
</template>

<script setup>

import { ref } from 'vue'


const input_pesquisa = ref()

const props = defineProps({
    dadosPagina: {
        type: Object
    },
});

const pequisarIconeSistema = () => {

    props.dadosPagina.forEach((icone, index) => {

        props.dadosPagina[index].exibir = false;

        let encontrado = icone.name.toLowerCase().includes(input_pesquisa.value.toLowerCase());

        if (encontrado) {
            
            props.dadosPagina[index].exibir = true;

        }

    })

}

</script>