<template>
    <AuthenticatedLayout>
        <Alert :dialogVisible="mensagem"></Alert>
        <h1 class="text-center" style="font-weight: 100; color: #310740">Relatório de Movimentação Estoque</h1>
        <v-data-table :items="movimentacoes" :fixed-header="true" :hover="true" show-select
            item-value="id_movimentacao">
        </v-data-table>
        <div class="d-flex justify-content-end">
            <Button :nome="'Imprimir'" @click="imprimirListaDeMovimentacao"></Button>
        </div>
    </AuthenticatedLayout>

</template>
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted, ref } from 'vue';
import Button from '@/Components/Button.vue';
import Alert from '@/Components/Alert.vue';

const props = defineProps({


    movimentacoes: {

        type: Object,
        required: true
    }

})

const itensSelecionados = [];

const mensagem = ref({ message: 'Selecione ao menos um item para imprimir !', title: 'Impressão de Relatório de Movimentação', exibir: false, status: 'error' })

onMounted(() => {

    //Aplicando cor na quantidade, caso seja uma saida
    document.querySelectorAll('.v-data-table__tr').forEach((linha) => {

        let quantidade_movimentada = linha.children[6].innerHTML;

        if (quantidade_movimentada < 0) {

            linha.children[6].style.color = "red";

        } else {

            linha.children[6].style.color = "green";

        }

    })

    const alteraCorLinha = (checkbox, linha) => {

        if (checkbox.checked) {

            linha.style.backgroundColor = "lightgray";

        } else {

            linha.style.backgroundColor = "white";

        }
    }


    //Percorrendo as movimentaçãoes e aplicando valores
    props.movimentacoes.forEach((movimentacao, key) => {

        //Adiciona atributo data-id-movimentacao ao checkbox com o valor do id da movimentação
        document.querySelectorAll('[type="checkbox"]')[key + 1].setAttribute('data-id-movimentacao', movimentacao.id_movimentacao)

        //Adiciona evento onclick ao checkbox para mudar cor da linha toda
        document.querySelectorAll('[type="checkbox"]')[key + 1].addEventListener('click', (e) => {

            let checkbox = e.target;
            let linha = checkbox.parentElement.parentElement.parentElement.parentElement.parentElement;

            alteraCorLinha(checkbox, linha);

        })
    })

    //Adiciona evento ao checkbox para marcar todas a linhas caso selecionado
    document.querySelectorAll('[type="checkbox"]')[0].addEventListener('click', (e) => {

        let checkbox = e.target;

        document.querySelectorAll('.v-data-table__tr').forEach((linha) => {

            alteraCorLinha(checkbox, linha);

        })

    })

})

const verificaItensSelecionados = () => {

    ///Limpa array
    itensSelecionados.splice(0, itensSelecionados.length);

    document.querySelectorAll('[type="checkbox"]').forEach((checkbox, key) => {

        if (key > 0) {

            if (checkbox.checked) {

                itensSelecionados.push(checkbox.getAttribute('data-id-movimentacao'))

            }
        }

    })
}

const getToken = () => {

    return document.cookie.split(';').find((cookie) => {

        return cookie.includes('XSRF-TOKEN=')

    }).replace('XSRF-TOKEN=', '')

}


const imprimirListaDeMovimentacao = () => {

    verificaItensSelecionados();

    //Valida itens selecionados
    if (itensSelecionados.length == 0) {

        mensagem.value.exibir = true;

        return;

    }

    fetch('http://127.0.0.1:8000/impressao-movimentacao-livro-estoque',
        {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-XSRF-TOKEN': decodeURIComponent(getToken('XSRF-TOKEN'))
            },
            body: JSON.stringify({ itensSelecionados: itensSelecionados })
        }

    ).then((response) => {

        response.blob().then((blob) => {

            let url = window.URL.createObjectURL(blob);

            window.open(url, '_blank');

        })

    })
}

</script>