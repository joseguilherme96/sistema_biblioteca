<template>
    <Alert :dialogVisible="mensagem"></Alert>
    <v-container>
        <v-row class="text-center">
            <v-col cols="12" md="6">
                <v-dialog v-model="modalVisible.exibir" max-width="900">
                    <template v-slot:default="{ isActive }">
                        <v-card>
                            <Toolbar :data="{ title: modalVisible.title }"></Toolbar>

                            <v-table>
                                <thead>
                                    <tr>
                                        <th>
                                            Selecionar
                                        </th>
                                        <th class="text-left">
                                            ID Item
                                        </th>
                                        <th class="text-left">
                                            Livro
                                        </th>
                                        <th class="text-left">
                                            Quantidade Solicitada
                                        </th>
                                        <th class="text-left">
                                            Quantidade Separada
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in modalVisible.itens_reservados" :key="item.name">
                                        <td>
                                            <Checkbox v-model:checked="item.checked"></Checkbox>
                                        </td>
                                        <td>{{ item.livro_id }}</td>
                                        <td>{{ item.nome }}</td>
                                        <td>{{ item.quantidade_reservada }}</td>
                                        <td><v-text-field variant="outlined" color="#310740" label="Quantidade" type="number"
                                                v-model="item.quantidade_para_baixa"></v-text-field></td>
                                    </tr>
                                </tbody>
                            </v-table>
                            <template v-slot:actions>
                                <v-btn variant="flat" color="#310740" text="CADASTRAR BAIXA"
                                    @click="cadastrarBaixa"></v-btn>
                                <v-btn variant="flat" color="#310740" text="Close"
                                    @click="modalVisible.exibir = false"></v-btn>
                            </template>
                        </v-card>
                    </template>
                </v-dialog>
            </v-col>
        </v-row>
    </v-container>

</template>
<script setup>

import Checkbox from '@/Components/Checkbox.vue';
import Toolbar from '@/Components/Toolbar.vue';
import { useForm } from '@inertiajs/vue3';
import Alert from '@/Components/Alert.vue';
import { ref} from 'vue';

const props = defineProps({

    modalVisible: {

        type: Object

    }


})



const form = useForm({ itens_para_baixa: [] });
const mensagem = ref({ status: '', message: '', exibir: false });

const submit = () => {

    form.post(route('cadastrar_atendimento_item_reserva'), {

        //Callbacks
        onSuccess: (page) => {

            if (page.props.flash.success) {
                mensagem.value = { status: 'success', message: page.props.flash.success, exibir: true, title: 'Atendimento' }

            } else if (page.props.flash.error) {

                mensagem.value = { status: 'error', message: page.props.flash.error, exibir: true, title: 'Atendimento' }

            }

        },

        onError: (errors) => {

            mensagem.value = { status: 'error', message: 'Ocorreu um erro ao cadastrar um livro', exibir: true, title: 'Cadastro' }

        }

    })

}


const cadastrarBaixa = () => {

    //Filtra apenas itens checados
    let itens_selecionados = props.modalVisible.itens_reservados.filter((linha) => linha.checked == true)

    if (itens_selecionados.length > 0) {

        //Valida se quantidade digitada é diferente da quantidade  reservada

        let itens_invalidos = itens_selecionados.filter((linha) => linha.quantidade_reservada == linha.quantidade_separada);

        if (itens_invalidos.length > 0) {

            mensagem.value = { status: 'error', message: "A quantidade solicitada já foi dado baixa !", exibir: true, title: 'Atendimento' }

            return;

        }

        itens_invalidos = itens_selecionados.filter((linha) => linha.quantidade_reservada !== parseInt(linha.quantidade_para_baixa));

        if (itens_invalidos.length > 0) {

            mensagem.value = { status: 'error', message: "A quantidade solicitada é diferente da quantidade para baixa !", exibir: true, title: 'Atendimento' }


        } else {

            form.itens_para_baixa = itens_selecionados;

            submit();

        }

    } else {

        mensagem.value = { status: 'error', message: "Selecione pelo menos um item para dar baixa !", exibir: true, title: 'Atendimento' }

    }


}

</script>