<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Invoice_archiveController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});
// Route::get('/', function () {
//     return view('icons');
// });

Auth::routes();





Route::middleware('auth')->group(
    function () {
        Route::resource('/invoices', InvoicesController::class);
        Route::get('/export', [InvoicesController::class, 'export']);
        Route::resource('sections', SectionsController::class);
        Route::resource('products', ProductsController::class);
        Route::resource('invoice_attachments', InvoiceAttachmentsController::class);


        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
        Route::get('/invoices_details/{id}', [InvoicesDetailsController::class, 'invoices_details']);
        Route::post('/viewfile', [InvoicesDetailsController::class, 'open_file']);
        Route::post('/downloadfile', [InvoicesDetailsController::class, 'download_file']);
        Route::post('/deletefile', [InvoicesDetailsController::class, 'delete_file']);

        Route::get('/invoices_paid', [InvoicesController::class, 'invoices_paid']);
        Route::get('/invoices_unpaid', [InvoicesController::class, 'invoices_unpaid']);
        Route::get('/invoices_partial', [InvoicesController::class, 'invoices_partial']);
        Route::get('/invoices_archive', [InvoicesController::class, 'invoices_archive']);
        Route::get('/print_invoice/{id}', [InvoicesController::class, 'print_invoice']);


        Route::get('/restorarchive_invoice/{id}', [Invoice_archiveController::class, 'update']);
        Route::post('/delete_invoice_archive/{id}', [Invoice_archiveController::class, 'destroy']);




        Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit']);
        Route::post('/delete_invoice/{id}', [InvoicesController::class, 'destroy']);
        Route::get('/change_status_invoice/{id}', [InvoicesController::class, 'change_status_invoice']);
        Route::post('invoices_change_status', [InvoicesController::class, 'store_status_invoice']);
        Route::post('/invoices/update', [InvoicesController::class, 'update']);

        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
    }
);










Route::get('/{page}', [AdminController::class , 'index']);

