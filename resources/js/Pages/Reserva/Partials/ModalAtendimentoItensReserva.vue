<template>
    <Alert :dialogVisible="mensagem"></Alert>
    <v-dialog v-model="exibirCalendario" max-width="340">
        <template v-slot:default="{ isActive }">
            <v-card>
                <v-date-picker v-model="data_devolucao" color="#310740" label="Data Devolução"
                    class="ml-2"></v-date-picker>
                <div class="d-flex justify-end">
                    <v-btn variant="flat" color="#310740" text="Fechar" @click="exibirCalendario = false"
                        width="100"></v-btn>
                </div>
            </v-card>
        </template>
    </v-dialog>
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
                                        <th class="text-left">
                                            Data Devolução
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in modalVisible.itens_reservados" :key="item.name">
                                        <td>
                                            <Checkbox v-model:checked="item.checked"></Checkbox>
                                        </td>
                                        <td>{{ item.livro_id }}</td>
                                        <td>{{ item.nome }}</td>
                                        <td>{{ item.quantidade_reservada }}</td>
                                        <td><v-text-field variant="outlined" color="#310740" label="Quantidade"
                                                type="number" v-model="item.quantidade_para_baixa"></v-text-field></td>
                                        <td>
                                            <v-btn color="#310740" @click="abrirSelecaoDataDevolucao(index)"
                                                v-show="!item.data_devolucao">Selecionar</v-btn>

                                            <span v-show="item.data_devolucao">{{ item.data_devolucao }}<v-icon left
                                                    small color="#310740" @click="abrirSelecaoDataDevolucao(index)">mdi
                                                    mdi-calendar-edit</v-icon></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </v-table>
                            <template v-slot:actions>
                                <v-btn variant="flat" color="#310740" text="CADASTRAR BAIXA"
                                    @click="cadastrarBaixa"></v-btn>
                                <v-btn variant="flat" color="#310740" text="Fechar"
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
import { ref, watch } from 'vue';

const props = defineProps({

    modalVisible: {

        type: Object

    }


})


const exibirCalendario = ref(false)

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

        //Valida data devolução

        itens_invalidos = itens_selecionados.every((linha) => linha.data_devolucao == null)

        if (itens_invalidos) {

            mensagem.value = { status: 'error', message: "Selecione a data de devolução !", exibir: true, title: 'Atendimento' }

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

const tempIndexAtualSelecionado = ref(null);

const abrirSelecaoDataDevolucao = (index) => {

    exibirCalendario.value = true;

    tempIndexAtualSelecionado.value = index;

}

const data_devolucao = ref(null);

watch(() => exibirCalendario.value, (newValue) => {

    let dataSelecionada = new Date(data_devolucao.value);
    let dataAtual = new Date();

    //Operação executada quando modal de seleção de data fechar
    if (newValue == false) {

        if (dataSelecionada < dataAtual) {

            //Exibirá o calendario até o usuário seleciona uma data valida
            exibirCalendario.value = true;

            mensagem.value.status = 'error';
            mensagem.value.message = "Selecione uma data valida !";
            mensagem.value.title = 'Atendimento';
            mensagem.value.exibir = true;

            return;

        }

        //Adiciona data de devolução ao objeto itens_reservados
        props.modalVisible.itens_reservados[tempIndexAtualSelecionado.value].data_devolucao = dataSelecionada.toLocaleDateString();
        props.modalVisible.itens_reservados[tempIndexAtualSelecionado.value].data_devolucao_utc = dataSelecionada.toLocaleDateString('en-CA');

    }


})

</script>