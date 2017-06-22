<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Connexion à l'application
Route::post("login", "APIController@login");

// Inscription et validation par mail
Route::post("register", "APIController@register");
Route::get("confirm", "APIController@confirm");
Route::post("/user/exist", "ApiUserController@userExist");


Route::group(["middleware" => "jwt-auth"], function () {

    // Clients
    Route::get("/user/details", "ApiUserController@details");
    Route::post("/user/edit", "ApiUserController@update");

    // Abonnements
    Route::get("/abonnement/liste", "AbonnementController@getAbonnements");

    // Publications
    Route::get("/publication/liste", "ApiPublicationsController@liste");
});

// Liste des status.
Route::get("status/sexe", "ApiStatusController@listeSexe");
Route::get("status/encours", "ApiStatusController@listeAboEnCours");
Route::get("status/paye", "ApiStatusController@listeAboPaye");