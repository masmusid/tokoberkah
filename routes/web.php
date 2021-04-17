<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("users", UserController::class);

Route::delete('/barang/{id}/delete-permanent', [BookController::class,'deletePermanent'])->name('barang.delete-permanent');
Route::post('/barang/{barang}/restore', [BarangController::class, 'restore'])->name('barang.restore');
Route::get('/barang/trash', [BarangController::class, 'trash'])->name('barang.trash');
Route::resource("barang", BarangController::class);

Route::resource('categories', CategoryController::class);
Route::get('/ajax/categories/search', [CategoryController::class, 'ajaxSearch']);

Route::resource('suppliers', SupplierController::class);
Route::get('/ajax/suppliers/search', [SupplierController::class, 'ajaxSearch']);