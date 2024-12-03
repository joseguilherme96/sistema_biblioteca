<template>
    <AuthenticatedLayout :auth="auth">

        <Head title="Entrada" />
        <div class="container text-end">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="row justify-content-center">
                        <FormCadastroEntradaLivro :livros="livros" :enderecos="enderecos" :errors="errors"></FormCadastroEntradaLivro>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormCadastroEntradaLivro from './Partials/FormCadastroEntradaLivro.vue';

const props = defineProps({

    livros: {

        type: Object

    },
    enderecos: {

        type: Object

    },
    errors: {

        type: Object
    },
    auth: {

        type: Object

    }

})

</script>