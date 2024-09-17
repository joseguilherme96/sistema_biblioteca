<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import IconePerfil from '@/Components/IconePerfil.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
</script>

<template>

    <Head title="Home" />
    <div class="container text-end">
        <div class="row justify-content-end">
            <div class="col-2 text-center">
                <IconePerfil></IconePerfil>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-2 text-center">
                <Dropdown>
                    <template #trigger>
                        <button class="btn btn-outline-secondary dropdown-toggle">
                            {{ $page.props.auth.user.name }}
                        </button>
                    </template>

                    <template #content>
                        <div>
                            <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </div>
                    </template>
                </Dropdown>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="row justify-content-center">
                    <h3 class="text-center" style="font-weight: 100;">Cadastro de livro</h3>
                    <img src="https://images.tcdn.com.br/img/img_prod/848802/o_fabuloso_livro_verde_ilustrado_capa_dura_5_1_20200903140242.jpg" width="10%" >
                    <div class="col-8 col-lg-6 text-start">
                        <InputLabel :value="'Nome Livro'"></InputLabel>
                        <TextInput style="border: #310740 solid 1px;"></TextInput>
                    </div>
                    <div class="col-8 col-lg-6 text-start">
                        <InputLabel :value="'Descrição'"></InputLabel>
                        <TextInput style="border: #310740 solid 1px;"></TextInput>
                    </div>
                    <div class="col-8 col-lg-8 text-start">
                        <InputLabel :value="'Autor'"></InputLabel>
                        <TextInput style="border: #310740 solid 1px;"></TextInput>
                    </div>
                    <div class="col-8 col-lg-4 text-start">
                        <InputLabel :value="'Categoria'"></InputLabel>
                        <TextInput style="border: #310740 solid 1px;"></TextInput>
                    </div>
                    <button style="background-color: #310740; color: white;" class="btn m-5">Cadastrar</button>
                </div>
            </div>
        </div>


    </div>

</template>
