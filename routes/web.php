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
    return view('welcome');
});

Route::get('/contacts', function () {
    return "<h1>All contacts</h1>";
});

Route::get('/contacts/create', function () {
    return "<h1>Create new contact</h1>";
});

// Routes parameters
Route::get('/contacts/{id}', function ($id) {
    return "Contact " . $id;
});

// Optional parameters
Route::get('/companies/{name?}', function ($company_name = null) {
    if ($company_name)
        return "Company " . $company_name;
    else
        return "<h1>All companies</h1";
});
