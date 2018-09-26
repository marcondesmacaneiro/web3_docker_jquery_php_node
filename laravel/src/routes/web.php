<?php

use App\User;

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

Route::get('/users', function () {
    return User::all();
});

Route::get('/docs', function () {
    return view('api.docs.index');
});

Route::get('/testDatabase', function () {
    User::create([
        'email' => uniqid() . '@example.com',
        'name' => 'Test User',
        'password' => 'secret'
    ]);

    return response()->json(App\User::all());
});

Route::get('/putCache', function () {
    Cache::put('umaKey', 'marcondes', 10);

    return "ok";
});

Route::get('/getCache', function () {
    return Cache::get('umaKey');
});