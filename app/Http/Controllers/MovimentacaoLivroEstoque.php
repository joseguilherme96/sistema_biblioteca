<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentacaoEstoqueModel;
use Elibyy\TCPDF\Facades\TCPDF;
use Inertia\Inertia;

class MovimentacaoLivroEstoque extends Controller
{
    public function index()
    {

        $movimentacaoEstoqueModel = new MovimentacaoEstoqueModel();

        $movimentacao = $movimentacaoEstoqueModel->selectMovimentacaoEstoque();

        return Inertia::render('Estoque/PageMovimentacaoLivroEstoque', [

            'status' => session('status'),
            'movimentacoes' => $movimentacao

        ]);
    }

    public function imprimiMovimentacao(Request $request)
    {

        TCPDF::AddPage($orientation = 'L', $format = 'A4', $keepmargins = false, $tocpage = false);
        TCPDF::SetAutoPageBreak(TRUE);
        TCPDF::Write(0, 'Relatório de Movimentação Estoque', '', 0, 'L', true, 0, false, false, 0);
        TCPDF::SetFont('helvetica', '', 8);

        $tbl = <<<EOD

        <table cellpadding="2" cellspacing="2" align="center">
            <tr>
                <th width="7%" align="center">ID Estoque</th>
                <th width="10%" align="center">ID Movimentação</th>
                <th width="10%" align="center">Motivo</th>
                <th width="20%" align="center">Livro</th>
                <th width="10%" align="center">Endereço</th>
                <th width="10%" align="center">Qtde. Anterior</th>
                <th width="10%" align="center">Qtde. Movimentada</th>
                <th width="10%" align="center">Qtde. Atual</th>
                <th width="8%" align="center">Data da Movimentação</th>
            </tr>
        </table>

        <hr>

        EOD;

        TCPDF::writeHTML($tbl, true, false, false, false, '');

        $ids_movimentacoes = $request->all()['itensSelecionados'];

        $movimentacaoEstoqueModel = new MovimentacaoEstoqueModel();
        $movimentacoes = $movimentacaoEstoqueModel->selectMovimentacaoEstoque(['ids_movimentacao' => $ids_movimentacoes]);

        $movimentacoesToArray = [];

        foreach ($movimentacoes as $movimentacao) {

            array_push($movimentacoesToArray, array_values((array) $movimentacao));
        }

        foreach ($movimentacoesToArray as $movimentacao) {

            $tbl = '

            <table cellpadding="2" cellspacing="2" align="center">
                <tr>
                    <td width="7%" align="center">' . $movimentacao[0] . '</td>
                    <td width="10%" align="center">' . $movimentacao[1] . '</td>
                    <td width="10%" align="center">' . $movimentacao[2] . '</td>
                    <td width="20%" align="center">' . $movimentacao[3] . '</td>
                    <td width="10%" align="center">' . $movimentacao[4] . '</td>
                    <td width="10%" align="center">' . $movimentacao[5] . '</td>
                    <td width="10%" align="center">' . $movimentacao[6] . '</td>
                    <td width="10%" align="center">' . $movimentacao[7] . '</td>
                    <td width="8%" align="center">' . date("d/m/Y h:i:s",strtotime($movimentacao[8])) . '</td>
                </tr>
            </table>

            <hr>

            ';

            TCPDF::writeHTML($tbl, true, false, false, false, '');
        }

        TCPDF::Output('hello_world.pdf');
    }
}
