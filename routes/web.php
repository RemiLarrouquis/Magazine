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
})->name("/");

Auth::routes();

Route::get("/home", "Gestion\\HomeController@index")->name("home");

//Routage publication
Route::get("/publication/new", "Gestion\\PublicationController@newPublication");
Route::get("/publication/edit/{id}", "Gestion\\PublicationController@editForm");
Route::get("/publication/list", "Gestion\\PublicationController@liste");

Route::post("/publication/save", "Gestion\\PublicationController@savePublication");
Route::post("/publication/addPicture", "Gestion\\PublicationController@upload");

// Routage Clients
Route::get("/client/list", "Gestion\\ClientController@liste");
Route::get("/client/detail/{id}", "Gestion\\ClientController@detail");
Route::post("/client/edit", "Gestion\\ClientController@edit");

// Routage Abonnements
Route::get("/abonnement/list", "Gestion\\AbonnementController@liste");
Route::get("/abonnement/listClient", "Gestion\\AbonnementController@listeClient");

Route::get("/historique/list", "Gestion\\HistoriqueController@liste");
Route::get("/historique/listClient", "Gestion\\HistoriqueController@listeClient");
Route::get("/historique/new", "Gestion\\HistoriqueController@newHistorique");

Route::post("/historique/save", "Gestion\\HistoriqueController@saveHistorique");

