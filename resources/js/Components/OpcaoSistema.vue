<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    data: {
        type: Object
    },
});
</script>

<template>
    <div class="d-flex justify-content-center align-items-center">
        <Link :href="route(`${data.route}`)" style="text-decoration: none; color: white;">
        <div v-show="data.exibir" class="text-center">
            <div class="icon-wrapper mb-2 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" :class="data.icone"
                    viewBox="0 0 16 16">
                    <path :d="data.d" />
                </svg>
            </div>
            <h2>{{ data.name }}</h2>
        </div>
        </Link>
    </div>
</template>
<style>
.icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: white;
    /* Cor de fundo do círculo */
    box-shadow: 0 0 0 3px #f0f0f0;
    /* Cor da borda do círculo */
    margin-bottom: 10px;
}

.icon-wrapper svg {
    color: #310740;
    /* Cor do ícone */
}
</style>