<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Authors
Route::get('/blog-author', [
    AuthorController::class, 'index',
])
    ->name('/blogAuthor.index');
    // ->can('Blog: Author - List');

Route::get('/blog-author/create', [
    AuthorController::class, 'create',
])
    ->name('/blogAuthor.create');
    // ->can('Blog: Author - Create');

Route::post('/blog-author', [
    AuthorController::class, 'store',
])
   ->name('/blogAuthor.store');
    // ->can('Blog: Author - Create');

Route::get('/blog-author/{id}/edit', [
    AuthorController::class, 'edit',
])
    ->name('/blogAuthor.edit');
    // ->can('Blog: Author - Edit');

Route::put('/blog-author/{id}', [
    AuthorController::class, 'update',
])
    ->name('/blogAuthor.update');
    // ->can('Blog: Author - Edit');

Route::delete('/blog-author/{id}', [
    AuthorController::class, 'destroy',
])
    ->name('/blogAuthor.destroy');
    // ->can('Blog: Author - Delete');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
