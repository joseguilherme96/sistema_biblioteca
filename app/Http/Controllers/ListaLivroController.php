<?php

namespace App\Http\Controllers;

use App\Models\LivroModel;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ListaLivroController extends Controller
{

    public function index()
    {

        $livroModel = new LivroModel();

        $livros = $livroModel->pesquisar();

        return Inertia::render('Livro/ListaLivro', [
            'status' => session('status'),
            'livros' => $livros,
        ]);
    }

    public function pesquisar(Request $request){

        $livroModel = new LivroModel();

        $livros = $livroModel->pesquisar(['valor_pesquisado'=>$request['valorPesquisado']]);

        return Inertia::render('Livro/ListaLivro', [
            'status' => session('status'),
            'livros' =>  $livros,
        ]);

    }
}
