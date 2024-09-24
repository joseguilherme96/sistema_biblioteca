<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ListaLivroController;
use App\Http\Controllers\LivroController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cadastro-livro', function () {
    return Inertia::render('Livro/CadastroLivro');
})->middleware(['auth', 'verified'])->name('cadastro-livro');

Route::post('cadastrar_livro', [LivroController::class, 'salvar'])
    ->name('cadastrar_livro');

Route::get('/lista-livro', [ListaLivroController::class, 'index'])->middleware(['auth', 'verified'])->name('lista_livro');

Route::post('/lista-livro', [ListaLivroController::class, 'pesquisar'])->middleware(['auth', 'verified'])->name('pesquisar_livro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
