<template>
    <v-card variant="tonal" class="mt-5">
        <v-img :width="200" :height="300" aspect-ratio="1/1" cover
            :src="'http://127.0.0.1:8000/storage/imagens/' + livro.nme_img_cap_lvro"></v-img>
        <v-card-title>{{ livro.nome }}</v-card-title>
        <v-card-subtitle>{{ livro.autor }}</v-card-subtitle>
        <v-card-text style="overflow-y: hidden; height: 100px;">{{ livro.descricao }}</v-card-text>
        <v-card-actions>
            <v-row class="justify-content-center">
                <slot></slot>
            </v-row>
        </v-card-actions>
    </v-card>
</template>
<script setup>


defineProps({

    livro:{
        type:Object
    }
})

</script>