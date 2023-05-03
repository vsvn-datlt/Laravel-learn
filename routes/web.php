<?php

use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;
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

// Route::get("/", [WelcomeController::class, "home"])
Route::get("/", WelcomeController::class)
    ->name("index");

Route::controller(ContactController::class)->prefix("contacts")->name("contacts.")->group(
    function () {
        Route::get("/", [ContactController::class, "index"])->name("index");
        Route::get("/create", [ContactController::class, "create"])->name("create");
        Route::post("/", [ContactController::class, "store"])->name("store");
        Route::get("/{id}", [ContactController::class, "show"])->whereNumber("id")->name("show");
        Route::get("/{id}/edit", [ContactController::class, "edit"])->where("id", "\d+")->name("edit");
        Route::put("/{id}", [ContactController::class, "update"])->name("update");
        Route::delete("/{id}", [ContactController::class, "destroy"])->name("destroy");
        Route::delete("/{contact}/restore", [ContactController::class, "restore"])->name("restore");
        Route::delete("/{contact}/force-delete", [ContactController::class, "forceDelete"])->name("force-delete");
        // Route::resource("/", ContactController::class);
    }
);

// Optional parameters
Route::get("/companies/{name?}", function ($company_name = null) {
    if ($company_name)
        return "Company " . $company_name;
    else
        return "<h1>All companies</h1";
})
    // ->where("name", "[a-zA-Z ]+") // use regex for contraining
    ->whereAlpha("id") // use build-in function for constraining
    ->name("company_name");

Route::resource("/companies", CompanyController::class);

Route::resources([
    "/tags" => TagController::class,
    "/tasks" => TaskController::class
]);

Route::resource("/activities", ActivityController::class)
    // ->except()
    ->only(["create", "store", "index", "show", "update", "destroy"])
    ->names(
        [
            "index" => "activities.all",
            "show" => "activities.view"
        ]
    );

Route::resource("contacts.notes", ContactNoteController::class)->shallow();

// Fallback routes
// Route::fallback(function () {
//     return "<h1>Sorry, the page does not exist</h1>";
// })
//     ->name("fallback");
