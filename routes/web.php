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

function getContacts()
{
    return [
        1 => ['first_name' => 'Alfred', "last_name" => "Kuhlman", "email" => "alfred@gmail.com", 'phone' => '7863510562', "company" => "Company One", "address" => "Lorem ipsum dolor"],
        2 => ['first_name' => 'Frederick', "last_name" => "Jerde", "email" => "frederick@gmail.com", 'phone' => '9465258086', "company" => "Company One", "address" => "Lorem ipsum dolor"],
        3 => ['first_name' => 'Joannie', "last_name" => "McLaughlin", "email" => "joannie@gmail.com", 'phone' => '2568876437', "company" => "Company Two", "address" => "Lorem ipsum dolor"],
        4 => ['first_name' => 'Odie', "last_name" => "Koss", "email" => "odie@gmail.com", 'phone' => '9896874639', "company" => "Company Two", "address" => "Lorem ipsum dolor"],
        5 => ['first_name' => 'Edna', "last_name" => "Ondricka", "email" => "edna@gmail.com", 'phone' => '4698596834', "company" => "Company Three", "address" => "Lorem ipsum dolor"],
    ];
}

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("contacts")->name("contacts.")->group(
    function () {

        Route::get('/', function () {
            $contacts = getContacts();
            // return "<h1>All contacts</h1>";
            // return view("contacts/index", ["contacts"=>$contacts]);
            return view("contacts/index")->with("contacts", $contacts);
        })
            ->name("index");

        Route::get('/create', function () {
            // return "<h1>Create new contact</h1>";
            return view("contacts/create");
        })
            ->name("create");;

        // Routes parameters
        Route::get('/{id}', function ($id) {
            $contacts = getContacts();
            // abort_if(!isset($contacts[$id]), 404);
            abort_unless(isset($contacts[$id]), 404);
            $contact = $contacts[$id];
            // return "Contact " . $id;
            // return view("contacts/show");
            return view("contacts/show")->with("contact", $contact);
        })
            // ->where("id", "\d+") // use regex for contraining
            ->whereNumber("id") // use build-in function for constraining
            ->name("show");
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
