<?php

use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/posts', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::post('/posts/{post:slug}/comments', [PostCommentController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

// Refactored to Query Scope
// Route::get('/category/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'posts' => $category->posts->load(['category', 'author']),
//         'currentCategory' => $category,
//         'categories' => Category::all()
//     ]);
// });

// Refactored to Query Scope
// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts.index', [
//         'posts' => $author->posts->load(['category', 'author'])
//     ]);
// });
