<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\ManagementAnggotaController;
use App\Http\Controllers\ManagementPengurusController;
use App\Http\Controllers\ManagementMasyarakatController;
use App\Http\Controllers\ProgramKerjaController;

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

Route::controller(AuthenController::class)->group(function(){
    Route::get('/login','loginView')->middleware('guest')->name('login');
    Route::post('/login','loginAction')->middleware('guest')->name('auth.login.action');
    Route::get('/register','registerView')->middleware('guest')->name('auth.register.view');
    Route::post('/register','registerAction')->middleware('guest')->name('auth.register.action');
    Route::post('/logout','logout')->middleware('auth')->name('auth.logout');
});
Route::get('/',[HomeController::class,'index'])->middleware('auth')->name('home');
Route::controller(ManagementAnggotaController::class)->middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/management-anggota','index')->name('admin.management.anggota.index');
});
Route::controller(ManagementPengurusController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/management-pengurus', 'index')->name('admin.management.pengurus.index');
});
Route::controller(ManagementMasyarakatController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/management-masyarakat', 'index')->name('admin.management.masyarakat.index');
});
Route::controller(ProgramKerjaController::class)->middleware(['auth','role:pengurus'])->group(function(){
    Route::get('/pengurus/program-kerja/index','index')->name('pengurus.programKerja.index');
});