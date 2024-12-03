<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import IconePerfil from '@/Components/IconePerfil.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { useForm } from '@inertiajs/vue3';
import FormLivro from './Partials/FormLivro.vue';

defineProps({

    auth: {

        type: Object
    }

})

</script>

<template>
    <AuthenticatedLayout :auth="auth">

        <Head title="Home" />
        <div class="container text-end">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="row justify-content-center">
                        <FormLivro></FormLivro>
                    </div>
                </div>
            </div>


        </div>
    </AuthenticatedLayout>

</template>