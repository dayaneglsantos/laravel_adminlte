<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Formulário de criação de usuário
    Route::post('/users/create', [UserController::class, 'store'])->name('users.store'); // Rota de criação de usuário
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::put('users/{id}/profile', [UserController::class, 'updateProfile'])->name('users.updateProfile');
    Route::put('users/{id}/interests', [UserController::class, 'updateInterests'])->name('users.updateInterests');
    Route::put('users/{id}/roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');
});
