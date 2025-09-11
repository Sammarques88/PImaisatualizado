<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LaudoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', fn () => view('home'))->name('home');

// Cadastro de Usuário
Route::get('/cadastro', [CadastroController::class, 'create'])->name('cadastro.create');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');

// Cadastro de Médico
Route::get('/cadastromedico', [MedicoController::class, 'create'])->name('cadastromedico.create');
Route::post('/cadastromedico', [MedicoController::class, 'store'])->name('cadastromedico.store');

// Autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Recuperação de senha
Route::get('/recuperacao', fn () => view('recuperacao'))->name('recuperacao');
Route::get('/redefinicao', fn () => view('redefinicao'))->name('redefinicao');

// Páginas estáticas
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/termos-de-servico', 'termos-de-servico')->name('termos');
Route::view('/escolha', 'escolha')->name('escolha');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Área do usuário
    Route::get('/area-usuario', fn () => view('area-user'))->name('area.usuario');
    Route::get('/area', fn () => redirect()->route('area.usuario'))->name('area-user');

    // Perfil
    Route::get('/perfil', fn () => view('perfil'))->name('perfil');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('perfil.update');

    // Escolha da sala e início do chat
    Route::get('/sala', [SalaController::class, 'index'])->name('sala.index');
    Route::post('/sala/iniciar', [SalaController::class, 'iniciar'])->name('sala.iniciar');

    // Chat com tema selecionado
    Route::get('/chat/{tema?}', [App\Http\Controllers\ChatController::class, 'index'])
    ->name('chat.index');



    // Laudos
    Route::get('/cadastrolaudo', fn () => view('cadastrolaudo'))->name('cadastrolaudo');
    Route::post('/laudo', [LaudoController::class, 'store'])->name('laudo.store');

});

// Médicos
Route::middleware(['auth', 'auth.medicos'])->group(function () {
    Route::get('/perfil-medico', fn () => view('perfil-medico'))->name('perfil.medico');
});
