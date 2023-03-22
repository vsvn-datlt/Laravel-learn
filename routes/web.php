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
    $html_content = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laravel learn</title>
    </head>
    <body>
        <h1>My Contact app</h1>
        <a href="' . route("contacts.index") . '">All contacts</a>
        <a href="' . route("contacts.create") . '">Add new contact</a>
        <a href="' . route("contacts.show", 1) . '">Show contact</a>
    </body>
    </html>
    ';
    // return view('welcome');
    return $html_content;
});

Route::get('/contacts', function () {
    return "<h1>All contacts</h1>";
})
    ->name("contacts.index");

Route::get('/contacts/create', function () {
    return "<h1>Create new contact</h1>";
})
    ->name("contacts.create");;

// Routes parameters
Route::get('/contacts/{id}', function ($id) {
    return "Contact " . $id;
})
    // ->where("id", "\d+") // use regex for contraining
    ->whereNumber("id") // use build-in function for constraining
    ->name("contacts.show");;

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
