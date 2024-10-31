<template>

    <AuthenticatedLayout>
        <Alert :dialogVisible="mensagem"></Alert>
        <v-row v-for="(livro, index) in livrosCarrinho">
            <v-col cols="12">
                <ItemCarrinho :item="livro"></ItemCarrinho>
            </v-col>
        </v-row>
        <v-row v-show="!livrosCarrinho.length > 0">
            <v-col cols="12">
                Não há livros adicionados ao carrinho
            </v-col>
        </v-row>
        <v-card-actions class="justify-content-end">
            <Button :nome="'Finalizar reserva'" @click="finalizarReserva"></Button>
            <Button :nome="'Limpar Carrinho'" @click="limparCarrinho"></Button>
        </v-card-actions>

    </AuthenticatedLayout>


</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref, watch } from 'vue'
import ItemCarrinho from './Partials/ItemCarrinho.vue';
import Button from '@/Components/Button.vue';
import { useForm } from '@inertiajs/vue3';
import Alert from '@/Components/Alert.vue';

const livrosCarrinho = ref([]);
const mensagem = ref({ status: '', message: '', exibir: false });


const props = defineProps({

    auth: {
        type: Object,
        required: true
    }

})

const form = useForm({
    livrosReserva: [{}],
    id_user: props.auth.user.id
});

onMounted(() => {

    const livrosSalvos = localStorage.getItem('livrosCarrinho');

    if (livrosSalvos) {

        livrosCarrinho.value = JSON.parse(livrosSalvos)

    }

})

const separaDadosParaFinalizarReserva = () => {

    //Pega apenas o id_livro e a quantidade selecionada para reserva

    if (livrosCarrinho.value.length > 0) {
        const livros = livrosCarrinho.value.map((livro) => {
            return { id_livro: livro.id, quantidade: livro.quantidade };
        });

        form.livrosReserva = livros;

    } else {

        mensagem.value.status = "error";
        mensagem.value.message = `A reserva não pode ser finalizada pois o carrinho ainda está vazio !`;
        mensagem.value.title = "Aviso";
        mensagem.value.exibir = true;

    }
}

const submit = () => {

    form.post(route('cadastrar_reserva'), {

        //Callbacks
        onSuccess: (page) => {

            if (page.props.flash.success) {
                mensagem.value = { status: 'success', message: page.props.flash.success, exibir: true, title: 'Cadastro' }

                form.reset();
                localStorage.clear();
                livrosCarrinho.value = [];


            } else if (page.props.flash.error) {

                mensagem.value = { status: 'error', message: page.props.flash.error, exibir: true, title: 'Cadastro' }

            }

        },

        onError: (errors) => {

            mensagem.value = { status: 'error', message: 'Ocorreu um erro ao cadastrar uma reserva', exibir: true, title: 'Cadastro' }

        }

    });

}

const finalizarReserva = () => {

    separaDadosParaFinalizarReserva();

    submit();

}


const limparCarrinho = () => {

    //Limpa carrinho
    localStorage.removeItem("livrosCarrinho");
    livrosCarrinho.value = null;

    //Atualiza pagina
    window.location.href = '';


}





</script>