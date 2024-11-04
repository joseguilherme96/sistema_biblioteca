<template>
    <Alert :dialogVisible="mensagem"></Alert>
    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-box-arrow-in-left"
        viewBox="0 0 16 16" color="#310740">
        <path fill-rule="evenodd"
            d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
        <path fill-rule="evenodd"
            d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
    </svg>
    <h3 class="text-center" style="font-weight: 100; color: #310740">Entrada livro</h3>
    <v-sheet class="mx-auto m-5" width="900">
        <v-form fast-fail @submit.prevent ref="form">
            <v-combobox variant="outlined" color="#310740" label="Nome do livro" :items="nomesLivros"
                v-model="formInertia.nomeLivro" @update:model-value="setIdLivro" :rules="nomeLivroRules"
                @keyup.delete="clearCampoSelecaoLivro"></v-combobox>
            <v-combobox variant="outlined" color="#310740" label="Endereço do livro" :items="enderecosLivro"
                v-model="formInertia.enderecoLivro" @update:model-value="setIdEnderecoLivro" :rules="enderecoLivroRules"
                @keyup.delete="clearCampoSelecaoEndereco"></v-combobox>
            <v-text-field variant="outlined" color="#310740" label="Quantidade" type="number"
                v-model="formInertia.quantidade" :rules="quantidadeRules"></v-text-field>
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
import { onMounted, ref, watch } from 'vue'
import Alert from '@/Components/Alert.vue';

const formInertia = useForm({
    idLivro: '',
    idEndereco: '',
    nomeLivro: '',
    enderecoLivro: '',
    quantidade: 0
});

const props = defineProps({

    errors: {

        type: Object
    },

    livros: {

        type: Object

    },
    enderecos: {

        type: Object
    }

})

const nomesLivros = ref([]);
const enderecosLivro = ref([]);

const mensagem = ref({ status: '', message: '', exibir: false });

const submit = (form) => {

    formInertia.post(route('cadastro-entrada-livro'), {

        //Callbacks
        onSuccess: (page) => {

            if (page.props.flash.success) {
                mensagem.value = { status: 'success', message: page.props.flash.success, exibir: true, title: 'Cadastro entrada livro' }
                reset(form) // Reseta o formulário após o sucesso

            } else if (page.props.flash.error) {

                mensagem.value = { status: 'error', message: page.props.flash.error, exibir: true, title: 'Cadastro entrada livro' }

            }

        },

        onError: (errors) => {

            mensagem.value = { status: 'error', message: 'Ocorreu um erro ao cadastrar um livro', exibir: true, title: 'Cadastro' }

        }

    });




}


const nomeLivroRules = [
    value => {
        if (value?.length >= 3 && value?.length <= 30) return true

        return 'O quantidade de caracteres do campo deve ser maior ou igual a 3 e menor igual a 30'
    },
    value => {
        if (formInertia.idLivro !== '') return true

        return 'O livro seleionado é inválido !'
    },
];

const enderecoLivroRules = [
    value => {
        if (value?.length >= 3 && value?.length <= 30) return true

        return 'O quantidade de caracteres do campo deve ser maior ou igual a 3 e menor igual a 30'
    },
    value => {
        if (formInertia.idEndereco !== '') return true

        return 'Endereço inválido !'
    },
];

const quantidadeRules = [

    value => {

        if (value > 0) return true

        return 'A quantidade deve ser maior que zero'

    }

]

const reset = (form) => {

    if (form) {
        form.reset();
        form.resetValidation();

        //Resetando o anexo, pois o form.reset() reseta todos os campos, exceto o campo do anexo.
        formInertia.capaLivro = null;
    }


}

const validate = async (form) => {

    if (form) {
        const { valid } = await form.validate()

        if (valid) submit(form)

    }
}

onMounted(() => {

    //Percorre a props livros pegando apenas o nome do livro
    nomesLivros.value = props.livros.map((linha) => linha.nome)
    enderecosLivro.value = props.enderecos.map((linha) => linha.descricao)

})

const setIdLivro = () => {

    let livro_selecionado = props.livros.find((linha) => linha.nome == formInertia.nomeLivro)

    if (livro_selecionado !== undefined) {

        formInertia.idLivro = livro_selecionado.id

    }

}

const setIdEnderecoLivro = () => {

    let endereco_selecionado = props.enderecos.find((linha) => linha.descricao == formInertia.enderecoLivro)

    if (endereco_selecionado !== undefined) {

        formInertia.idEndereco = endereco_selecionado.id_endereco

    }

}

const clearCampoSelecaoLivro = () => {

    formInertia.nomeLivro = ''
    formInertia.idLivro = ''
}

const clearCampoSelecaoEndereco = () => {

    formInertia.enderecoLivro = ''
    formInertia.idEndereco = ''

}



</script>
<style>
v-number-input {
    display: block;
    width: 100%;
    /* Ajuste conforme necessário */
    height: auto;
}
</style>