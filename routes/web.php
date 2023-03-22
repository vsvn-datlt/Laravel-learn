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

Route::prefix("contacts")->name("contacts.")->group(
    function () {

        Route::get('/', function () {
            // return "<h1>All contacts</h1>";
            return view("contacts/index");
        })
            ->name("index");

        Route::get('/create', function () {
            // return "<h1>Create new contact</h1>";
            return view("contacts/create");
        })
            ->name("create");;

        // Routes parameters
        Route::get('/{id}', function ($id) {
            // return "Contact " . $id;
            return view("contacts/show");
        })
            // ->where("id", "\d+") // use regex for contraining
            ->whereNumber("id") // use build-in function for constraining
            ->name("show");;
    }
);

// Optional parameters
Route::get('/companies/{name?}', function ($company_name = null) {
    if ($company_name)
        return "Company " . $company_name;
    else
        return "<h1>All companies</h1";
})
    // ->where("name", "[a-zA-Z ]+") // use regex for contraining
    ->whereAlpha("id") // use build-in function for constraining
;

// Fallback routes
Route::fallback(function () {
    return "<h1>Sorry, the page does not exist</h1>";
});
