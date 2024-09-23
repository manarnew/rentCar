<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContractsController;
use App\Http\Controllers\Admin\CustomerController;
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

Route::get('/', function () {
    return redirect()->route('admin.login');
});
Route::post('/signature_image/create_signature_image', [ContractsController::class, 'create_signature_image'])->name('admin.signature_image.create_signature_image');
Route::post('/signature_image/store_signature_image', [ContractsController::class, 'store_signature_image'])->name('admin.signature_image.store_signature_image');
Route::get('/customer/ajax_search_genral/{id}', [CustomerController::class, 'ajax_search_genral_get'])->name('admin.customer.ajax_search_genral_get');
Route::get('/customer/send/{id}', [CustomerController::class, 'send'])->name('admin.customer.send');
