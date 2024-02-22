<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;


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
    return view('index');
});

// Route::get('/etudiant', function () {
//     return view('etudiants/etudiants');
// });
Route::resource('etudiants', EtudiantController::class)->names('etudiant');
Route::post('/etudiants/upload', [EtudiantController::class, 'upload'])->name('etudiants.upload');


