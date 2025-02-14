<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\BayarKasController;
use App\Http\Controllers\DetailIuranController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LpjController;
use App\Http\Controllers\ManagementAnggotaController;
use App\Http\Controllers\ManagementPengurusController;
use App\Http\Controllers\ManagementMasyarakatController;
use App\Http\Controllers\PengumumanController;
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
// Route admin mulai
Route::controller(ManagementAnggotaController::class)->middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/management-anggota','index')->name('admin.management.anggota.index');
    Route::post('/admin/management-anggota/tambah','store')->name('admin.management.anggota.store');
    Route::patch('/admin/management-anggota/update','update')->name('admin.management.anggota.update');
    Route::delete('/admin/management-anggota/delete','delete')->name('admin.management.anggota.delete');
});
Route::controller(ManagementPengurusController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/management-pengurus', 'index')->name('admin.management.pengurus.index');
    Route::post('/admin/management-pengurus/tambah', 'store')->name('admin.management.pengurus.store');
});
Route::controller(ManagementMasyarakatController::class)->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/management-masyarakat', 'index')->name('admin.management.masyarakat.index');
    Route::post('/admin/management-masyarakat/tambah', 'store')->name('admin.management.masyarakat.store');

});
// Route admin berakhir
// Route pengurus mulai
Route::controller(ProgramKerjaController::class)->middleware(['auth','role:pengurus'])->group(function(){
    Route::get('/pengurus/program-kerja/index','index')->name('pengurus.programKerja.index');
    Route::post('/pengurus/program-kerja/tambah','store')->name('pengurus.programKerja.store');
    Route::patch('/pengurus/program-kerja/update','update')->name('pengurus.programKerja.update');
    Route::delete('/pengurus/program-kerja/delete','delete')->name('pengurus.programKerja.delete');
});
Route::controller(KeuanganController::class)->middleware(['auth','role:pengurus'])->group(function(){
    Route::get('/pengurus/keuangan/index','index')->name('pengurus.keuangan.index');
    Route::post('/pengurus/keuangan/tambah','store')->name('pengurus.keuangan.store');
    Route::patch('/pengurus/keuangan/update','update')->name('pengurus.keuangan.update');
    Route::delete('/pengurus/keuangan/delete','delete')->name('pengurus.keuangan.delete');
});
Route::controller(PengumumanController::class)->middleware(['auth','role:pengurus'])->group(function(){
    Route::get('/pengurus/pengumuman/index','index')->name('pengurus.pengumuman.index');
    Route::post('/pengurus/pengumuman/tambah','store')->name('pengurus.pengumuman.store');
    Route::patch('/pengurus/pengumuman/update','update')->name('pengurus.pengumuman.update');
    Route::delete('/pengurus/pengumuman/delete','delete')->name('pengurus.pengumuman.delete');
});
Route::controller(IuranController::class)->middleware(['auth','role:pengurus'])->group(function(){
    Route::get('/pengurus/iuran/index','index')->name('pengurus.iuran.index');
    Route::post('pengurus/iuran/tambah','store')->name('pengurus.iuran.store');
    Route::patch('pengurus/iuran/update','update')->name('pengurus.iuran.update');
    Route::delete('pengurus/iuran/delete','delete')->name('pengurus.iuran.delete');
});
Route::controller(DetailIuranController::class)->middleware(['auth','role:pengurus'])->group(function(){
    Route::get('pengurus/detail-iuran/index', 'index')->name('pengurus.iuran.detail.index');
    Route::post('pengurus/detail-iuran/setujui', 'setujui')->name('pengurus.iuran.detail.setujui');
});
Route::controller(LpjController::class)->middleware(['auth','role:pengurus'])->group(function(){
    Route::get('pengurus/Lpj/index','index')->name('pengurus.lpj.index');
    Route::post('pengurus/Lpj/tambah','store')->name('pengurus.lpj.store');
});
// Route pengurus selesai
// Route anggota mulai
Route::controller(ProgramKerjaController::class)->middleware(['auth','role:anggota'])->group(function(){
    Route::get('anggota/kegiatan/index','index')->name('anggota.kegiatan.index');
});
Route::controller(PengumumanController::class)->middleware(['auth','role:anggota'])->group(function(){
    Route::get('anggota/pengumuman/index','index')->name('anggota.pengumuman.index');
});
Route::controller(KeuanganController::class)->middleware(['auth','role:anggota'])->group(function(){
    Route::get('anggota/kas/index','index')->name('anggota.kas.index');
});
Route::controller(BayarKasController::class)->middleware(['auth','role:anggota'])->group(function(){
    Route::get('anggota/bayar-kas/index','index')->name('anggota.bayarkas.index');
    Route::post('anggota/bayar-kas/store','store')->name('anggota.bayarkas.store');
});
// Route anggota selesai
// Route masyarakat mulai
Route::controller(ProgramKerjaController::class)->middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('masyarakat/kegiatan/index', 'index')->name('masyarakat.kegiatan.index');
});
Route::controller(PengumumanController::class)->middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('masyarakat/pengumuman/index', 'index')->name('masyarakat.pengumuman.index');
});
Route::controller(KeuanganController::class)->middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('masyarakat/kas/index', 'index')->name('masyarakat.kas.index');
});
// Route masyarakat selesai
