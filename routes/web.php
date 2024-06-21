<?php
use App\Http\Controllers\authController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('post.index');
    route::get('/create', [PostController::class, 'create'])->name('post.create');
    route::get('/show/{Post}', [PostController::class, 'show'])->name('post.show');
    route::get('/edit/{Post}', [PostController::class, 'edit'])->name('post.edit');
    route::post('/store', [PostController::class, 'store'])->name('post.store');
    route::put('/update/{Post}', [PostController::class, 'update'])->name('post.update');
    route::DELETE('/destroy/{Post}', [PostController::class, 'destroy'])->name('post.destroy');




    route::DELETE('/destroy2/{us}', [authController::class, 'destroy2'])->name('delet.user');

    route::get('/admin', [authController::class, 'admin'])->name('admin.user');

    route::post('/show/{idpost}', [TagController::class, 'show'])->name('tag.show');

    route::post('/store/{idpost}', [TagController::class, 'store'])->name('tag.create');

    Route::post('logout', [authController::class, 'logout'])->name('logout');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/',[authController::class, 'index']);

    Route::post('login', [authController::class, 'login'])->name('login');

    Route::get('reg', [authController::class, 'create'])->name('reg');
    Route::post('regester', [authController::class, 'store'])->name('regester');

});
