<?php

namespace App\Http\Controllers;

use App\Models\EstoqueLivroModel;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservaLivroController extends Controller
{

    public function validacaoItensParaReserva($livrosAReservar)
    {
        $estoqueLivroModel = new \App\Models\EstoqueLivroModel();

        //Valida se na requiscao vem id_livro e quantidade
        foreach ($livrosAReservar['livrosReserva'] as $livro) {
            if (!isset($livro['id_livro']) || !isset($livro['quantidade'])) {
                return redirect()->back()->with('error', "Erro ao processar a requisição");
            }
        }

        //Valida se livro tem no estoque
        foreach ($livrosAReservar['livrosReserva'] as $livro) {

            $where['livro_id'] = $livro['id_livro'];

            $estoqueLivro = $estoqueLivroModel->getSaldoLivroEstoque($where);

            //Busca nome do livro
            $livroModel = new \App\Models\LivroModel();
            $whereLivro['id'] = $livro['id_livro'];
            $nome_livro = $livroModel->pesquisar($whereLivro);

            if (!empty($estoqueLivro[0])) {
                if ($estoqueLivro[0]->qtd_lvro_estqe < $livro['quantidade']) {
                    return redirect()->back()->with('error', "Quantidade insuficiente no estoque do livro selecionado " . $nome_livro[0]->nome . "");
                }
            } else {

                return redirect()->back()->with('error', "O livro " . $nome_livro[0]->nome . " adicionado está sem estoque");
            }
        }
    }

    public function criaReserva($livrosAReservar)
    {

        try {

            $reservaLivroModel = new \App\Models\ReservaLivroModel();

            $reservaLivroModel->user_id = $livrosAReservar['id_user'];
            $reservaLivroModel->status_id = 1;

            $reservaLivroModel->save();

            return  $reservaLivroModel->id;
        } catch (Exception $e) {

            return false;
        }
    }

    public function cadastrarItensReserva($livrosAReservar)
    {

        try {

            //Cria itens da reserva tabela reserva_livro_itens
            foreach ($livrosAReservar['livrosReserva'] as $livro) {

                $reservaLivroItensModel = new \App\Models\ReservaLivroItensModel();

                $reservaLivroItensModel->reserva_id = $livrosAReservar['id_reserva'];
                $reservaLivroItensModel->livro_id = $livro['id_livro'];
                $reservaLivroItensModel->quantidade_reservada = $livro['quantidade'];
                $reservaLivroItensModel->estoque_id = $livro['id_estoque'];

                $reservaLivroItensModel->save();
            }

            return true;
        } catch (Exception $e) {

            return false;
        }
    }

    public function baixaLivroEstoque($livrosAReservar)
    {
        $returns = [];

        try {

            foreach ($livrosAReservar['livrosReserva'] as &$livro) {

                $estoqueLivroModel = new EstoqueLivroModel();

                $where['livro_id'] = $livro['id_livro'];
                $id_motivo = 1; //Motivo da baixa reserva 1 = reserva
                $baixa_estoque = $estoqueLivroModel->baixaQuantidadeNoEstoque($where, $livro['quantidade'], $id_motivo);

                $livro['id_estoque'] = $baixa_estoque['id_estoque'];

                array_push($returns, $baixa_estoque);
            }
        } catch (Exception $e) {

            return ['status' => false, 'message' => 'Falha ao dar baixa no estoque !'];
        }

        //Verifica se algum retorno é falso
        foreach ($returns as $return) {

            if (!$return['status']) {

                return ['status' => false, 'message' => 'Falha ao dar baixa no estoque !'];
            }
        }

        return $livrosAReservar;
    }

    public function ReservaLivro(Request $request)
    {

        $livrosAReservar = $request->all();

        //Valida itens para reserva
        $this->validacaoItensParaReserva($livrosAReservar);

        //Baixa estoque
        $livrosAReservar = $this->baixaLivroEstoque($livrosAReservar);

        if (isset($livrosAReservar['status'])) {

            redirect()->back()->with('error', "Falha ao cadastrar baixa no estoque !");

        }

        //Cria reserva
        $id_reserva = $this->criaReserva($livrosAReservar);

        if (!$id_reserva) {

            redirect()->back()->with('error', 'Falha ao cadastrar reserva !');
        }

        //Cadastra itens reserva
        $livrosAReservar['id_reserva'] = $id_reserva;
        if (!$this->cadastrarItensReserva($livrosAReservar)) {

            redirect()->back()->with('error', 'Falha ao cadastrar itens reserva !');
        }


        redirect()->back()->with('success', "A reserva N° $id_reserva foi criada com sucesso !");
    }

    public function selectReserva()
    {

        $reservaLivroModel = new \App\Models\ReservaLivroModel();

        $reservas = $reservaLivroModel->pesquisarReserva();

        return Inertia::render('Reserva/PageListaReservas', [
            'status' => session('status'),
            'reservas' => $reservas
        ]);
    }

    public function pesquisar(Request $request)
    {

        $livroModel = new \App\Models\ReservaLivroModel();

        $reservas = $livroModel->pesquisarReserva(['valor_pesquisado' => $request['valorPesquisado']]);

        return Inertia::render('Reserva/PageListaReservas', [
            'status' => session('status'),
            'reservas' => $reservas
        ]);
    }

    public function exibirReserva(Request $reserva)
    {
        
        //Pega o id da url segment
        $id_reserva_livro = $reserva->segment(2);
        
        $reservaLivroModel = new \App\Models\ReservaLivroModel();
        $reservas = $reservaLivroModel->pesquisarReserva(['id_reserva_livro'=>$id_reserva_livro]);

        $reservaLivroItensModel = new \App\Models\ReservaLivroItensModel();
        $itens = $reservaLivroItensModel->pesquisarItensReservados(['reserva_id'=>$id_reserva_livro]);

        return Inertia::render('Reserva/PageExibirReserva', [
            'status' => session('status'),
            'reservas' => $reservas,
            'itens'=>$itens
        ]);
    }
}
