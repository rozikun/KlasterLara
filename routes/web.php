<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function (){
    return view('depan');
});

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/lihat', 'data\manajemenController@tampil')->middleware('cekLogin');

Route::get('/update/{id}', 'data\manajemenController@editGet');
Route::get('/delete/{id}', 'data\manajemenController@hapus');

Route::post('/input', 'data\manajemenController@olahkeun');
Route::post('/edit', 'data\manajemenController@editPost');


Route::get('/hitung', 'olah\perhitunganController@tampil');
Route::get('/menghitung', 'olah\perhitunganController@hitung');


Route::get('/hasil', 'olah\hasilController@lihat');
Route::get('/hasilD', 'olah\hasilController@bukadata');