<?php

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('dashboard.index');
});

// pengguna
Route::get('pengguna/reset','PenggunaController@reset')->name('pengguna.reset');
Route::get('pengguna/konfirmasi','PenggunaController@konfirmasi')->name('pengguna.konfirmasi');

// kuisioner
Route::get('kuisioner','KuisionerController@index')->name('kuisioner.index');
Route::post('kuisioner/store','KuisionerController@store');
Route::get('kuisioner/info','KuisionerController@info');
Route::get('kuisioner/table-satu/{kondisi}', 'KuisionerController@tableSatu');

// kunci
Route::get('kunci','KunciController@index')->name('kunci.index');
Route::get('kunci/detail','KunciController@detail')->name('kunci.detail');
Route::get('kunci/simpan','KunciController@simpan')->name('kunci.simpan');

// dashboard
Route::get('dashboard', 'DashboardController@index')->name('dashboard.index')->middleware('auth');
Route::get('dashboard/persen','DashboardController@persen')->name('dashboard.persen');
Route::get('dashboard/pencapaian/vue','DashboardController@pencapaian');

//kebutuhan vue
Route::get('sekolah/vue','SekolahController@baca');
Route::get('kecamatan/vue','KecamatanController@index');
Route::get('pendidikan/vue','PendidikanController@index');

// resource :
Route::resource('sekolah','SekolahController');
Route::resource('pengguna','PenggunaController');

//import dari excel
Route::get('import','import@run');

//auth laravel
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('kecamatan', 'KecamatanController@kecamatan');
