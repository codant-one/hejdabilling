<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\InvoiceController;
use Barryvdh\DomPDF\Facade as PDF;
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

Route::get('/',  [MainController::class, 'index'])->name('index');
Route::get('/secretadmin',  [AdminController::class, 'index'])->name('admin.index');
//Route::post('/adminlogin',[AdminController::class, 'login'])->name('admin.login');
Route::post('/adminlogin', [AdminController::class, 'authenticate'])->name('admin.authenticate');
//RUTAS PASSWORD
Route::get('/forgot-adminpassword',  [PasswordController::class, 'forgot_adminpassword'])->name('admin.forgotpassword');
Route::post('/admin/reset-confirm', [PasswordController::class, 'email_adminconfirmation'])->name('admin.confirm');
Route::get('/admin/reset-password', [PasswordController::class, 'reset_adminpassword'])->name('admin.reset.password');
Route::get('password/find/{token}', [PasswordController::class, 'find'])->name("admin.passwordfind");
Route::post('/admin/change', [PasswordController::class, 'admin_change'])->name("admin.change");
Route::get('/admin/2fa', [AdminController::class, 'two_steps'])->name("admin.twosteps");
//FIN RUTAS PASSWORD
Route::middleware(['auth'])->group(function () 
{
    Route::get('/dashboard',  [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile',  [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/profile/edit',  [AdminController::class, 'profile_edit'])->name('admin.profile.edit');
    Route::post('/profile/update',  [AdminController::class, 'profile_update'])->name('admin.profile.update');
    Route::get('add-invoice/{id}', [InvoiceController::class, 'create_invoice'])->name('invoice.create');
    Route::get('/list-clients', [InvoiceController::class, 'list_client'])->name('invoice.client');
    Route::post('/register-clients', [InvoiceController::class, 'add_client'])->name('invoice.add.client');
    Route::post('/generate-invoice/{id}', [InvoiceController::class, 'generate_invoice'])->name('invoice.generate');
    Route::get('/preview/{id}', [InvoiceController::class, 'preview'])->name('invoice.preview');
    Route::get('/edit_client/{id}',[InvoiceController::class, 'edit_client'])->name('invoice.edit.client');
    Route::post('/client/update/{id}',[InvoiceController::class, 'update_client'])->name('invoice.client.update');
    Route::get('/client/invoices/{id}',[InvoiceController::class, 'invoice_client'])->name('invoice.history.client');
    Route::get('/show/invoice/{id}',[InvoiceController::class, 'show_invoice'])->name('invoice.show.client');
    Route::get('/history/inovices',[InvoiceController::class, 'history_inovices'])->name('invoice.history.user');
    Route::get('/new-inovices',[InvoiceController::class, 'new_invoice'])->name('invoice.new');
    Route::get('/get-client/{id}',[InvoiceController::class, 'get_client'])->name('invoice.get_client');
    Route::get('/plantilla/invoice',[InvoiceController::class, 'plantilla_invoice'])->name('invoice.plantilla');
    Route::post('/new/invoice',[InvoiceController::class, 'store_invoice'])->name('invoice.store');
    Route::get('/duplicate/invoice/{id}',[InvoiceController::class, 'duplicate_invoice'])->name('invoice.duplicate');
    Route::get('/send/invoice/{id}',[InvoiceController::class, 'plantilla_invoice'])->name('invoice.send');


    ///MANAGE USERS

    Route::get('/admin/users',[AdminController::class, 'show_users'])->name('admin.show.users');
    Route::post('/admin/add-user',[AdminController::class, 'store_user'])->name('admin.add.user');
    Route::get('/admin/invoices/user/{id}',[AdminController::class, 'invoices_user'])->name('admin.invoices.user');
});

Route::name('auth.')->middleware(['auth'])->group(function () {
    Route::get('/admin/2fa', [AdminController::class, 'double_factor_auth'])->name('2fa');
    Route::get('/admin/2fa/generar', [AdminController::class, 'generate_double_factor_auth'])->name('2fa.generate');
    Route::post('/admin/2fa/validate', [AdminController::class, 'validate_double_factor_auth'])->name('2fa.validate');
});