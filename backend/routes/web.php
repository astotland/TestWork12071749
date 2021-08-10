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

Route::get('/', function () {
    $data = new App\Models\Task;
    $data->firstName = 'New1 value';
    $data->lastName = 'New2 value';
    $data->phone = 'phone';
    $data->save();
    dump(App\Models\Task::all());
});

Route::get('/calendar', function () {
    return view('welcome');
});
