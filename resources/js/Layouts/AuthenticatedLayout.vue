<script setup>
import { ref, watch, watchEffect, onMounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const props = defineProps({
    auth: Object
})

const emits = defineEmits({

    permissoes: Object

})

let permissoes = ref({

    estoque: {
        entrada: false,
        movimentacao_estoque: false
    },
    livros: {
        cadastro: false,
        lista: false
    }


})

const verificaPermissoesDoUsuario = () => {

    permissoes = {
        estoque: {
            entrada: [1, 3].includes(props.auth.user.nivel_acesso_id),
            movimentacao_estoque: [1].includes(props.auth.user.nivel_acesso_id),
        },
        reserva: {
            lista_reservas: [1].includes(props.auth.user.nivel_acesso_id),
            cadastro_reservas: [1, 3].includes(props.auth.user.nivel_acesso_id),
        },
        livros: {
            cadastro: [1, 3].includes(props.auth.user.nivel_acesso_id),
            lista: [1, 2, 3].includes(props.auth.user.nivel_acesso_id),
            editar: [1, 3].includes(props.auth.user.nivel_acesso_id),
            deletar: [1, 3].includes(props.auth.user.nivel_acesso_id)
        },
        usuarios: {
            cadastro: [1].includes(props.auth.user.nivel_acesso_id),
            editar: [1].includes(props.auth.user.nivel_acesso_id)
        }
    }

    emits('permissoes', permissoes)

}

watchEffect(() => {
    verificaPermissoesDoUsuario();
})


</script>
<style>
.hover-usuario-carrinho:hover {

    background-color: #310740;
}
</style>

<template>
    <div>
        <div class="min-vh-100">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                    <!-- Logo -->
                    <Link :href="route('dashboard')" class="navbar-brand">
                    <ApplicationLogo class="h-9 w-auto text-muted" />
                    </Link>

                    <!-- Hamburger button for mobile -->
                    <button class="navbar-toggler" type="button"
                        @click="showingNavigationDropdown = !showingNavigationDropdown">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navigation Links -->
                    <div class="collapse navbar-collapse" :class="{ show: showingNavigationDropdown }">
                        <ul class="navbar-nav me-auto">
                            <li class="mr-5 mt-1">
                                <v-menu open-on-hover>
                                    <template v-slot:activator="{ props }">
                                        <v-btn color="#310740" v-bind="props">
                                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                                                class="nav-link" style="color: white;">
                                                Home
                                            </NavLink>
                                        </v-btn>
                                    </template>
                                </v-menu>
                            </li>
                            <li class="mr-5  mt-1" v-show="permissoes.livros.cadastro || permissoes.livros.lista">
                                <v-menu open-on-hover>
                                    <template v-slot:activator="{ props }">
                                        <v-btn color="#310740" v-bind="props">
                                            Livros
                                        </v-btn>
                                    </template>
                                    <v-list>
                                        <v-list-item :key="0" v-show="permissoes.livros.cadastro">
                                            <v-list-item-title>
                                                <NavLink :href="route('cadastro-livro')"
                                                    :active="route().current('dashboard')" class="nav-link">
                                                    Cadastro
                                                </NavLink>
                                            </v-list-item-title>
                                        </v-list-item>
                                        <v-list-item :key="1">
                                            <v-list-item-title>
                                                <NavLink :href="route('lista_livro')"
                                                    :active="route().current('dashboard')" class="nav-link"
                                                    v-show="permissoes.livros.lista">
                                                    Lista
                                                </NavLink>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </v-list>
                                </v-menu>
                            </li>
                            <li class="mr-5  mt-1">
                                <v-menu open-on-hover>
                                    <template v-slot:activator="{ props }">
                                        <v-btn color="#310740" v-bind="props" :disabled="!permissoes.estoque.entrada && !permissoes.estoque.movimentacao_estoque">
                                            Estoque
                                        </v-btn>
                                    </template>
                                    <v-list>
                                        <v-list-item :key="0" v-show="permissoes.estoque.entrada">
                                            <v-list-item-title>
                                                <NavLink :href="route('cadastro-entrada-livro')"
                                                    :active="route().current('dashboard')" class="nav-link">
                                                    Entrada
                                                </NavLink>
                                            </v-list-item-title>
                                        </v-list-item>
                                        <v-list-item :key="1" v-show="permissoes.estoque.movimentacao_estoque">
                                            <v-list-item-title>
                                                <NavLink :href="route('movimentacao_livro_estoque')"
                                                    :active="route().current('dashboard')" class="nav-link">
                                                    Movimentação Estoque
                                                </NavLink>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </v-list>
                                </v-menu>
                            </li>
                            <li class="mr-5  mt-1">
                                <v-menu open-on-hover>
                                    <template v-slot:activator="{ props }">
                                        <v-btn color="#310740" v-bind="props" :disabled="!permissoes.reserva.lista_reservas">
                                            Reserva
                                        </v-btn>
                                    </template>
                                    <v-list>
                                        <v-list-item :key="0" v-show="permissoes.reserva.lista_reservas">
                                            <v-list-item-title>
                                                <NavLink :href="route('listar_reservas')"
                                                    :active="route().current('dashboard')" class="nav-link">
                                                    Lista de reservas
                                                </NavLink>
                                            </v-list-item-title>
                                        </v-list-item>
                                    </v-list>
                                </v-menu>
                            </li>

                        </ul>

                        <!-- Settings Dropdown -->
                        <div class="d-flex align-items-center">
                            <Dropdown align="right">
                                <template #trigger>
                                    <button class="btn btn-outline-secondary dropdown-toggle hover-usuario-carrinho">
                                        {{ $page.props.auth.user.name }}
                                    </button>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">Perfil</DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Sair
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                        <button class="ml-2 btn btn-outline-secondary hover-usuario-carrinho">
                            <NavLink :href="route('carrinho_livro')" :active="route().current('dashboard')"
                                class="nav-link">
                                Carrinho
                            </NavLink>
                        </button>
                    </div>
                </nav>
            </div>

            <!-- Responsive Navigation Menu for small screens -->
            <div v-if="showingNavigationDropdown" class="bg-white border-top">
                <div class="container py-2">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </ResponsiveNavLink>

                    <!-- Responsive Settings Options -->
                    <div class="border-top mt-3 pt-3">
                        <div class="text-center mb-2">
                            <strong>{{ $page.props.auth.user.name }}</strong>
                            <p class="text-muted">{{ $page.props.auth.user.email }}</p>
                        </div>

                        <ResponsiveNavLink :href="route('profile.edit')">Perfil</ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">Sair</ResponsiveNavLink>
                    </div>
                </div>
            </div>

            <!-- Page Heading -->
            <header class="bg-white shadow-sm py-3" v-if="$slots.header">
                <div class="container">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="container my-4">
                <slot />
            </main>
        </div>
    </div>
</template>
