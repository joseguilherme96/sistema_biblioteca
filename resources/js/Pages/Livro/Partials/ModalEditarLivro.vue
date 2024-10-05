<template>

    <v-container>
        <v-row class="text-center">
            <v-col cols="12" md="6">
                <v-dialog v-model="modalVisible.exibir" max-width="900">
                    <template v-slot:default="{ isActive }">
                        <v-card>
                            <Toolbar :data="{ title: modalVisible.title }"></Toolbar>
                            <FormLivro :dadosLivroEditar="modalVisible.livro"></FormLivro>
                            <template v-slot:actions>
                                <v-btn variant="flat"  color="#310740" class="ml-auto" text="Close" @click="modalVisible.exibir = false"></v-btn>
                            </template>
                        </v-card>
                    </template>
                </v-dialog>
            </v-col>
        </v-row>
    </v-container>

</template>
<script setup>

import Toolbar from '@/Components/Toolbar.vue';
import {ref,watch} from 'vue'
import FormLivro from './FormLivro.vue';

const props = defineProps({

    modalVisible: {

        type: Object

    }


})

</script>