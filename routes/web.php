<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApexController;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return \File::get(public_path() . '/myPublic/index.html');
});
// Route::get('/profile', [ApexController::class, 'getProfile']);
Route::get('/profile', function (Request $request) {
    return response()->json($request);
});
Route::get('/apex', [ApexController::class, 'getUser']);

// Route::get('/', function () {
//     return view('welcome');
// });