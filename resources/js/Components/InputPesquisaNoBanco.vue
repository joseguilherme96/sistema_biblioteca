<template>

    <v-text-field v-model="form.valorPesquisado" label="Search" prepend-inner-icon="mdi-magnify" variant="outlined"
        @input="buscarLivro" hide-details single-line
        placeholder="Pesquise pelo nome do livro, autor ou ainda descrição"></v-text-field>

</template>

<script setup>

import { useForm } from '@inertiajs/vue3';

const props = defineProps({

    route_dados: {

        type: String

    },

})

const form = useForm({

    valorPesquisado:''

});

const submit = ()=>{

    form.post(route(`${props.route_dados}`))

}

const buscarLivro = ()=>{

    submit();

}

</script>