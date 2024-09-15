<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center bg-light pt-4">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 text-muted" />
            </Link>
        </div>

        <div class="w-100 mt-4 p-4 bg-white shadow-sm rounded-lg" style="max-width: 400px;">
            <slot />
        </div>
    </div>
</template>
