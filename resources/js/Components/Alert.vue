<template>

    <v-container>
        <v-row class="text-center">
            <v-col cols="12" md="6">
                <v-dialog v-model="dialogVisible.exibir" max-width="340">

                    <template v-slot:default="{ isActive }">
                        <v-card>
                            <Toolbar
                                :data="{
                                    title: dialogVisible.title,
                                    color: dialogVisible.status == 'success' ? '#006400' : 
                                    dialogVisible.status == 'error' ? '#FF6347' : 
                                    dialogVisible.status == 'warning' ? '#FFD700' : ''
                                    }">
                            </Toolbar>

                            <v-row class="justify-center mt-5">
                                <v-icon color="#FF6347" icon="mdi-alert" size="x-large"
                                    v-show="dialogVisible.status == 'error'"></v-icon>
                                <v-icon color="#006400" icon="mdi-check-circle" size="x-large"
                                    v-show="dialogVisible.status == 'success'"></v-icon>
                            </v-row>
                            <v-card-text class="text-h6 pa-12 text-center">
                                {{ dialogVisible.message }}
                            </v-card-text>
                            <template v-slot:actions>
                                <v-btn variant="flat"
                                    :color="dialogVisible.status == 'success' ? '#006400' :
                                            dialogVisible.status == 'error' ? '#FF6347' : 
                                            dialogVisible.status == 'warning' ? '#FFD700' : '#310740'"
                                    class="ml-auto" text="Fechar" @click="dialogVisible.exibir = false"
                                    style="color: white;"></v-btn>
                            </template>
                        </v-card>
                    </template>
                </v-dialog>
            </v-col>
        </v-row>
    </v-container>

</template>
<script setup>

import { ref, watch } from 'vue'
import Toolbar from './Toolbar.vue';

const props = defineProps({

    dialogVisible: {

        type: Object

    }


})

const dialogVisible = ref(props.dialogVisible)

watch(() => props.dialogVisible, (newvalue) => {

    dialogVisible.value = newvalue;

}, { deep: true });

</script>