<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import OpcaoSistema from '@/Components/OpcaoSistema.vue';
import { ref } from 'vue'
import InputPesquisaNaPagina from '@/Components/InputPesquisaNaPagina.vue';
import IconePerfil from '@/Components/IconePerfil.vue';
</script>

<template>

    <Head title="Home" />
    <div class="container text-end" style="background-color: #310740; color: white;">
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
                        <div style="background-color: #310740; color: white;">
                            <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button"
                                style="background-color: #310740; color: white;">
                                Log Out
                            </DropdownLink>
                        </div>
                    </template>
                </Dropdown>
            </div>
        </div>
        <div class="row justify-content-center">

            <InputPesquisaNaPagina :dadosPagina="opcoesSistema"></InputPesquisaNaPagina>

        </div>
        <div class="row">

            <div class="col-12 col-md-6 col-lg-6 d-flex flex-column align-items-center p-5"
                v-for="opcao in opcoesSistema">

                <OpcaoSistema :data="opcao">
                </OpcaoSistema>
            </div>
        </div>
    </div>

</template>
<script>

const opcoesSistema = ref([
    {
        name: 'Cadastro de livro',
        icone: 'bi bi-book',
        d: 'M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783',
        exibir: true,
        route:'cadastro-livro'
    },
    {
        name: 'Consulta livro',
        icone: 'bi bi-search',
        d: 'M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0',
        exibir: true,
        route:'lista_livro'
    },
    {
        name: 'Cadastro de alunos',
        icone: '"bi bi-people',
        d: 'M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4',
        exibir: true,
        route:'cadastro-livro'
    },
    {
        name: 'Consulta de alunos',
        icone: 'bi bi-search',
        d: 'M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0',
        exibir: true,
        route:'cadastro-livro'
    },
    {
        name: 'Relatórios',
        icone: 'bi bi-people',
        d: 'M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0',
        exibir: true,
        route:'cadastro-livro'
    },
    {
        name: 'Configurações',
        icone: 'bi bi-people',
        d: 'M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4',
        exibir: true,
        route:'cadastro-livro'
    }

]);


</script>
