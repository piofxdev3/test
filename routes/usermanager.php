<?php

use App\Http\Controllers\UserManagement\UserManagerController;

Route::get('/admin/user', [UserManagerController::class, 'index'])->middleware(['auth'])->name('User.index');
Route::get('/admin/user/create', [UserManagerController::class, 'create'])->middleware(['auth'])->name('User.create');
Route::post('/admin/user/create', [UserManagerController::class, 'store'])->middleware(['auth'])->name('User.store');
Route::get('/admin/user/edit/{id}', [UserManagerController::class, 'edit'])->middleware(['auth'])->name('User.edit');
Route::put('/admin/user/update/{id}', [UserManagerController::class, 'update'])->middleware(['auth'])->name('User.update');
Route::delete('/admin/user/delete/{id}', [UserManagerController::class, 'destroy'])->middleware(['auth'])->name('User.destroy');
Route::get('/admin/user/{id}', [UserManagerController::class, 'show'])->middleware(['auth'])->name('User.show');

