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
            <v-text-field variant="outlined" color="#310740" v-model="formInertia.nomeLivro" :rules="nomeLivroRules" label="Nome Livro">
            </v-text-field>
            <v-text-field variant="outlined" color="#310740" v-model="formInertia.autorLivro" :rules="autorLivroRules" label="Autor"></v-text-field>
            <v-text-field variant="outlined" color="#310740" v-model="formInertia.categoriaLivro" :rules="categoriaLivroRules"
                label="Categoria"></v-text-field>
            <v-file-input variant="outlined" color="#310740" @input="formInertia.capaLivro = $event.target.files[0]" label="Anexo capa livro"
                :rules="capaLivroRules"></v-file-input>
            <v-textarea variant="outlined" color="#310740" label="Descrição" v-model="formInertia.descricaoLivro"
                :rules="descricaoLivroRules"></v-textarea>
            <v-btn variant="flat" class="mt-4 mr-1" type="submit" @click="validate($refs.form)" color="#310740">
                Salvar
            </v-btn>
            <v-btn class="mt-4" color="#310740" @click="reset($refs.form)">
                Limpar dados
            </v-btn>
        </v-form>
    </v-sheet>
</template>


<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue'
import Alert from '@/Components/Alert.vue';

const formInertia = useForm({
    id:null,
    nomeLivro: '',
    categoriaLivro: '',
    autorLivro: '',
    descricaoLivro: '',
    capaLivro: null
});

const props = defineProps({

    dadosLivroEditar: {

        type: Object

    },

    errors: {

        type: Object
    }

})

const mensagem = ref({ status: '', message: '', exibir: false });

const submit = (form) => {

    if (formInertia.id == null) {

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
    } else {

        formInertia.put(route('editar_livro',formInertia.id), {

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

                mensagem.value = { status: 'error', message: `Ocorreu um erro ao alterar um livro ${errors}`, exibir: true, title: 'Cadastro' }

                console.log(errors);

            }

        });
    }




}


const nomeLivroRules = [
    value => {
        if (value?.length >= 3 && value?.length <= 30) return true

        return 'O quantidade de caracteres do campo deve ser maior ou igual a 3 e menor igual a 30'
    },
];

const categoriaLivroRules = [
    value => {
        if (value?.length >= 3 && value?.length <= 30) return true

        return 'O quantidade de caracteres do campo deve ser maior ou igual a 3 e menor igual a 30'
    },
];

const autorLivroRules = [
    value => {
        if (value?.length >= 3 && value?.length <= 30) return true

        return 'O quantidade de caracteres do campo deve ser maior ou igual a 3 e menor igual a 30'
    },
];

const descricaoLivroRules = [
    value => {
        if (value?.length >= 3) return true

        return 'O campo descrição precisa ser maior que 3 caracteres'
    },
];

const capaLivroRules = [
    value => {

        let invalido = 0;

        value.forEach((file) => {

            if (file.type.split("/")[0] !== "image") invalido = invalido + 1;

        })

        if (invalido == 0) return true

        return 'O anexo precisa ser uma imagem !'
    },
];

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

//Ao contrário do watch, watchEffect monitoria todas as dependencias passadas na props, independente se o componente foi reconstruido ou não...
watchEffect(() => {


    if (props.dadosLivroEditar) {
        
        console.log("ss")
        formInertia.nomeLivro = props.dadosLivroEditar.nome;
        formInertia.autorLivro = props.dadosLivroEditar.autor;
        formInertia.categoriaLivro = props.dadosLivroEditar.categoria;
        formInertia.descricaoLivro = props.dadosLivroEditar.descricao;
        //formInertia.capaLivro = props.dadosLivroEditar.nme_img_cap_lvro;
        formInertia.id = props.dadosLivroEditar.id;

    }

});


</script>