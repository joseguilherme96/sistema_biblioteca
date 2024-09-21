<template>
    <Alert :dialogVisible="mensagem"></Alert>
    <div class="row justify-content-center">
        <div class="col-3">
            <v-img :width="200" aspect-ratio="1/1" cover
                src="https://viverdeblog.com/wp-content/uploads/2017/04/como-escrever-um-livro-topo.png"></v-img>
        </div>
    </div>
    <h3 class="text-center" style="font-weight: 100;">Cadastro de livro</h3>

    <v-sheet class="mx-auto m-5" width="900">
        <v-form fast-fail @submit.prevent ref="form">
            <v-text-field v-model="formInertia.nomeLivro" :rules="nomeLivroRules" label="Nome Livro">
            </v-text-field>
            <v-text-field v-model="formInertia.descricaoLivro" :rules="descricaoLivroRules"
                label="Descrição"></v-text-field>
            <v-text-field v-model="formInertia.autorLivro" :rules="autorLivroRules" label="Autor"></v-text-field>
            <v-text-field v-model="formInertia.categoriaLivro" :rules="categoriaLivroRules"
                label="Categoria"></v-text-field>
            <v-btn variant="flat" class="mt-4 mr-1" type="submit" @click="validate($refs.form)" color="#310740">
                Cadastrar
            </v-btn>
            <v-btn class="mt-4" color="#310740" @click="reset($refs.form)">
                Limpar dados
            </v-btn>
        </v-form>
    </v-sheet>
</template>


<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
import Alert from '@/Components/Alert.vue';

const formInertia = useForm({
    nomeLivro: '',
    categoriaLivro: '',
    autorLivro: '',
    descricaoLivro: ''
});

const props = defineProps({

    errors: {

        type: Object
    }

})

const mensagem = ref({ status: '', message: '', exibir: false });

const submit = (form) => {

    formInertia.post(route('cadastrar_livro'), {

        //Callbacks
        onSuccess: (page) => {

            if (page.props.flash.success) {
                mensagem.value = { status: 'success', message: page.props.flash.success, exibir: true, title: 'Cadastro' }
                reset(form) // Reseta o formulário após o sucesso

            } else if (page.props.flash.error) {

                mensagem.value = { status: 'error', message: page.props.flash.error, exibir: true, title: 'Cadastro' }

            }

        },

        onError: (errors) => {

            mensagem.value = { status: 'error', message: 'Ocorreu um erro ao cadastrar um livro', exibir: true, title: 'Cadastro' }

        }

    });




}


const nomeLivroRules = [
    value => {
        if (value?.length >= 3) return true

        return 'O nome do livro precisa ser maior que 3 caracteres'
    },
];

const categoriaLivroRules = [
    value => {
        if (value?.length >= 3) return true

        return 'O campo categoria precisa ser maior que 3 caracteres'
    },
];

const autorLivroRules = [
    value => {
        if (value?.length >= 3) return true

        return 'O campo autor precisa ser maior que 3 caracteres'
    },
];

const descricaoLivroRules = [
    value => {
        if (value?.length >= 3) return true

        return 'O campo descrição precisa ser maior que 3 caracteres'
    },
];

const reset = (form) => {

    if (form) {
        form.reset();
        form.resetValidation();
    }


}

const validate = async (form) => {

    if (form) {
        const { valid } = await form.validate()

        if (valid) submit(form)

    }
}


</script>