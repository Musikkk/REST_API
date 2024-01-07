<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
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
    return view('welcome');
});
Route::get('musik/54344/people/all', [PeopleController::class, 'index']);
Route::get('musik/54344/people/{id}', [PeopleController::class, 'show']);
Route::delete('musik/54344/people/delete/{id}', [PeopleController::class, 'destroy']); 
// Route::get('musik/54344/people/{id}', [PeopleController::class, 'show']);
// Route::get('musik/54344/people/{id}', [PeopleController::class, 'show']);

