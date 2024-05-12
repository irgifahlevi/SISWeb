<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\BiayaPendaftaranController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\EkstrakurikulerController;
use App\Http\Controllers\Admin\InfoPendaftaranController;
use App\Http\Controllers\Admin\JenisKelaminController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\ProfileSiswaController;
use App\Http\Controllers\Admin\RegistrasiAccountController;
use App\Http\Controllers\WaliCalonSiswa\ProfileWaliController;
use App\Http\Controllers\WaliCalonSiswa\WaliCalonSiswaController;

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
/*
 Default route
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*
 For role admin
*/

Route::get('jenis-kelamin', [JenisKelaminController::class, 'getKelamin'])->name('data.jenis.kelamin');
Route::get('data-kelas', [KelasController::class, 'dataKelas'])->name('data.kelas');
Route::get('info-gelombang', [InfoPendaftaranController::class, 'getInfo'])->name('info.gelombang.pendaftaran');

Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('beranda', [AdminController::class, 'index'])->name('admin.index');
    Route::get('pendaftar_account', [RegistrasiAccountController::class, 'index'])->name('registrasi.index');
    Route::put('update_status/{id}/{status}', [RegistrasiAccountController::class, 'updateStatus'])->name('update.status');

    // Prndaftaran akun siswa
    Route::get('account_siswa', [RegistrasiAccountController::class, 'accountSiswa'])->name('account_siswa.index');
    Route::post('save_register', [RegistrasiAccountController::class, 'saveRegister'])->name('store.register');
    Route::get('show_account/{id}', [RegistrasiAccountController::class, 'accountShow'])->name('account.show');
    Route::post('update_account', [RegistrasiAccountController::class, 'updateAccount'])->name('update.account');
    Route::put('update_status_account/{id}/{status}', [RegistrasiAccountController::class, 'updateStatusAccount'])->name('update.status.account');

    // Menu slider use resource
    Route::resource('/slider-content', SliderController::class);

    // Menu ekskul use resource
    Route::resource('/ekskul-content', EkstrakurikulerController::class);

    // Menu biaya pendaftaran
    Route::resource('biaya-pendaftaran', BiayaPendaftaranController::class);

    // Menu info pendaftaran
    Route::resource('info-pendaftaran', InfoPendaftaranController::class);


    Route::resource('config-pendaftaran', ConfigController::class);

    // Menu berita konten
    Route::resource('konten-berita', BeritaController::class);

    // Mantainance kelas siswa
    Route::resource('kelas-siswa', KelasController::class);

    // Profile siswa
    Route::resource('profile-siswa', ProfileSiswaController::class);
});


/*
 For role wali calon siswa
*/
Route::prefix('wali_calon')->middleware(['auth', 'auth.wali_calon'])->group(function () {
    Route::get('beranda', [WaliCalonSiswaController::class, 'index'])->name('wali.index');

    // Profile wali
    Route::resource('wali-profile', ProfileWaliController::class);

    // Update password
    Route::put('update_password_wali/{id}', [WaliCalonSiswaController::class, 'updatePassword'])->name('wali.update.passwords');
});


/*
 For role siswa
*/
Route::prefix('siswa')->middleware(['auth', 'auth.siswa'])->group(function () {
    Route::get('beranda', [SiswaController::class, 'index'])->name('siswa.index');
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
