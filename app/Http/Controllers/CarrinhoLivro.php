<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CarrinhoLivro extends Controller
{
    public function index(){

        return Inertia::render('Carrinho/PageCarrinhoLivro', [
            'status' => session('status')
        ]);
    }
}
