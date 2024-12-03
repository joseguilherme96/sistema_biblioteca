<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    data: {
        type: Object
    },
});
</script>

<template>
    <v-card variant="text" class="mt-5 rounded" v-if="data.exibir"
        style="border: #310740 solid 1px; background-color: #310740; width: 400px; height: 300px; overflow: hidden;">
    <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100%;">
        <Link :href="route(`${data.route}`)" style="text-decoration: none; color: white;">
            <div  class="text-center">
                <div class="icon-wrapper mb-5 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#310740"
                        :class="data.icone" viewBox="0 0 16 16">
                        <path :d="data.d" />
                    </svg>
                </div>
                <h2 style="color: white;">{{ data.name }}</h2>
            </div>
        </Link>
    </div>
</v-card>

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