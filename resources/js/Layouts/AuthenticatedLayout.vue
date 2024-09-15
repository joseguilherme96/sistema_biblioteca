<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-vh-100 bg-light">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container">
                    <!-- Logo -->
                    <Link :href="route('dashboard')" class="navbar-brand">
                        <ApplicationLogo class="h-9 w-auto text-muted" />
                    </Link>

                    <!-- Hamburger button for mobile -->
                    <button
                        class="navbar-toggler"
                        type="button"
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navigation Links -->
                    <div class="collapse navbar-collapse" :class="{ show: showingNavigationDropdown }">
                        <ul class="navbar-nav me-auto">
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="nav-link">
                                Dashboard
                            </NavLink>
                        </ul>

                        <!-- Settings Dropdown -->
                        <div class="d-flex align-items-center">
                            <Dropdown align="right">
                                <template #trigger>
                                    <button class="btn btn-outline-secondary dropdown-toggle">
                                        {{ $page.props.auth.user.name }}
                                    </button>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </nav>

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

                        <ResponsiveNavLink :href="route('profile.edit')">Profile</ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
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
