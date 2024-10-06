<?php

namespace App\Http\Controllers;

use App\Models\EstoqueLivroModel;
use App\Models\LivroModel;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ListaLivroController extends Controller
{

    public function getSaldoLivroEstoque($livro_id)
    {

        $estoqueModel = new EstoqueLivroModel();

        $qtd_do_lvro_em_estqe  = $estoqueModel->getSaldoLivroEstoque(['livro_id' => $livro_id]);

        if (!empty($qtd_do_lvro_em_estqe)) {

            $quantidade = json_decode($qtd_do_lvro_em_estqe);

            if(isset($quantidade[0])){

                return $quantidade[0]->qtd_lvro_estqe;

            }else{

                return 0;

            }


        } else {

            return 0;
        }
    }

    public function index()
    {

        $livroModel = new LivroModel();

        $livros = $livroModel->pesquisar();

        //Busca quantidade para cada livro no estoque para cada livro e adiciona a quantidade disponivel encontrada para o livro pesquisado
        foreach ($livros as $livro) {

            $livro->qtd_lvro_estqe = $this->getSaldoLivroEstoque($livro->id);

        }


        return Inertia::render('Livro/ListaLivro', [
            'status' => session('status'),
            'livros' => $livros,
        ]);
    }

    public function pesquisar(Request $request)
    {

        $livroModel = new LivroModel();

        $livros = $livroModel->pesquisar(['valor_pesquisado' => $request['valorPesquisado']]);

        return Inertia::render('Livro/ListaLivro', [
            'status' => session('status'),
            'livros' =>  $livros,
        ]);
    }
}
