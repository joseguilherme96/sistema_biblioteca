<?php

namespace App\Http\Controllers;

use App\Models\EnderecoLivroModel;
use Illuminate\Http\Request;
use App\Models\LivroModel;
use Inertia\Inertia;
use App\Http\Requests\EntradaLivroRequest;
use App\Models\EstoqueLivroModel;
use App\Models\MovimentacaoEstoqueModel;
use Exception;

class EntradaLivroEstoque extends Controller
{
    public function index()
    {

        $livroModel = new LivroModel();
        $livros = $livroModel->pesquisar();

        $enderecoModel = new EnderecoLivroModel();
        $enderecos = $enderecoModel->pesquisar();

        return Inertia::render('Estoque/CadastroEntradaLivro', [
            'status' => session('status'),
            'livros' => $livros,
            'enderecos' => $enderecos,
        ]);
    }

    public function salvar(EntradaLivroRequest $request)
    {

        
        try {
            
            $validated = $request->validated();

            $estoqueLivroModel = new EstoqueLivroModel();

            $estoqueLivroModel->livro_id = $validated['idLivro'];
            $estoqueLivroModel->endereco_id = $validated['idEndereco'];
            $estoqueLivroModel->quantidade = $validated['quantidade'];
            $estoqueLivroModel->save();

            $id_estoque = $estoqueLivroModel->id;

            //Salva na tabela de movimentação
            $movimentacaoModel = new MovimentacaoEstoqueModel();

            $movimentacaoModel->insert(
                [
                    'motvo_mov_id' => 6,
                    'estoque_id'=>$id_estoque,
                    'quantidade_anterior' => 0,
                    'quantidade_atual' => $estoqueLivroModel->quantidade,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            return redirect()->back()->with('success', 'O livro foi cadastrado com sucesso no estoque !');
            
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Falha ao cadastrar o livro no estoque !');
        }
    }
}
