<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CarrinhoLivro;
use App\Http\Controllers\EntradaLivroEstoque;
use App\Http\Controllers\ListaLivroController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ReservaLivroController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cadastro-livro',[LivroController::class, 'index'])->middleware(['auth', 'verified'])->name('cadastro-livro');

Route::post('cadastrar_livro', [LivroController::class, 'salvar'])
    ->name('cadastrar_livro');

Route::put('editar_livro/{id}', [LivroController::class, 'atualizar'])
    ->name('editar_livro');

Route::get('/lista-livro', [ListaLivroController::class, 'index'])->middleware(['auth', 'verified'])->name('lista_livro');

Route::post('/lista-livro', [ListaLivroController::class, 'pesquisar'])->middleware(['auth', 'verified'])->name('pesquisar_livro');

Route::get('/livros-adicionados-para-reserva', [CarrinhoLivro::class, 'index'])->middleware(['auth', 'verified'])->name('carrinho_livro');


Route::get('/cadastro-entrada-livro',[EntradaLivroEstoque::class, 'index'])->middleware(['auth', 'verified'])->name('cadastro-entrada-livro');
Route::post('/cadastro-entrada-livro',[EntradaLivroEstoque::class, 'salvar'])->middleware(['auth', 'verified'])->name('cadastro-entrada-livro');

Route::post('/cadastrar_reserva',[ReservaLivroController::class, 'ReservaLivro'])->middleware(['auth', 'verified'])->name('cadastrar_reserva');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
