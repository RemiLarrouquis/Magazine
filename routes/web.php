<?php

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

Route::get("/", function () {
    if (Auth::guest()) {
        return view("welcome");
    } else {
        return redirect("home");
    }
});

Auth::routes();

Route::get("/home", "HomeController@index")->name("home");


//Routage publication
Route::get("/publication/new","PublicationController@newPublication");
Route::get("/publication/edit/{id}","PublicationController@editForm");
Route::get("/publication/list","PublicationController@liste");

Route::post("/publication/save","PublicationController@savePublication");
Route::post("/publication/addPicture","PublicationController@upload");

// API routes
Route::group(["middleware" => ["api"],"prefix" => "api"], function () {
    Route::get("register", "APIController@register");
    Route::get("login", "APIController@login");

    Route::group(["middleware" => "jwt-auth"], function () {

        // Clients
        Route::get("/user/details", "ApiUserController@details");
        Route::get("/user/edit", "ApiUserController@update");
        Route::get("/user/exist", "ApiUserController@userExist");

        // Abonnements
        Route::get("/abonnement/list", "AbonnementController@getAbonnements");
    });
});
