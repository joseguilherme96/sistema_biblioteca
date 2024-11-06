<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentacaoEstoqueModel;
use Inertia\Inertia;

class MovimentacaoLivroEstoque extends Controller
{
    public function index(){

        $movimentacaoEstoqueModel = new MovimentacaoEstoqueModel();

        $movimentacao = $movimentacaoEstoqueModel->selectMovimentacaoEstoque();

        return Inertia::render('Estoque/PageMovimentacaoLivroEstoque', [
            
            'status' => session('status'),
            'movimentacoes' => $movimentacao

        ]);


    }
}
