<?php

use App\Http\Controllers\AtendimentoItemReserva;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CarrinhoLivro;
use App\Http\Controllers\EntradaLivroEstoque;
use App\Http\Controllers\ListaLivroController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\MovimentacaoLivroEstoque;
use App\Http\Controllers\ReservaLivroController;
use App\Models\MovimentacaoEstoqueModel;

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
Route::get('/lista-reservas', [ReservaLivroController::class, 'selectReserva'])->middleware(['auth', 'verified'])->name('listar_reservas');
Route::post('/lista-reservas', [ReservaLivroController::class, 'pesquisar'])->middleware(['auth', 'verified'])->name('pesquisar_reserva');
Route::get('/exibir-reserva/{id}', [ReservaLivroController::class, 'exibirReserva'])->middleware(['auth', 'verified'])->name('exibir_reserva');
Route::post('/cadastrar_atendimento_item_reserva', [AtendimentoItemReserva::class, 'salvar'])->middleware(['auth', 'verified'])->name('cadastrar_atendimento_item_reserva');


Route::get('/movimentacao-livro-estoque',[MovimentacaoLivroEstoque::class, 'index'])->middleware(['auth', 'verified'])->name('movimentacao_livro_estoque');
Route::get('/impressao-movimentacao-livro-estoque',[MovimentacaoLivroEstoque::class, 'imprimiMovimentacao'])->middleware(['auth', 'verified'])->name('impressao_movimentacao_livro_estoque');
Route::post('/impressao-movimentacao-livro-estoque',[MovimentacaoLivroEstoque::class, 'imprimiMovimentacao'])->middleware(['auth', 'verified'])->name('impressao_movimentacao_livro_estoque');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
