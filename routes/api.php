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

/**
 * Connexion à l'application
 * params : email l'identifiant
 * params : password le mot de passe
 */
Route::post("login", "APIController@login");

/**
 * Inscription et validation par mail
 * params : tout les champs du model 'User'
 */
Route::post("register", "APIController@register");
/**
 * Vérifie si un utilisateur existe
 * params : email -> l'email à vérifier
 */
Route::post("/user/exist", "ApiUserController@userExist");
/**
 * Vérification de l'adresse mail
 * params : to_confirm -> id de l'utilisateur à confirmer
 */
Route::get("confirm", "APIController@confirm");


Route::group(["middleware" => "jwt-auth"], function () {

    // --------- Clients --------- //
    /**
     * Récupère les informations de l'utilisateur connecté.
     * return : json du model 'User'
     */
    Route::get("/user/details", "ApiUserController@details");
    /**
     * Met à jours l'utilisateur connecté.
     * params : Tout les champs du model 'User' sauf le mot de passe
     * return : Le token de connexion mis à jours.
     */
    Route::post("/user/edit", "ApiUserController@update");

    // ------- Fin Clients ------- //

    // ------- Abonnements ------- //
    /**
     * Retourne la liste des abonnements de l'utilisateur connecté.
     * params : filterEtat -> l'id de l'état (encours, stop,...) à filtrer
     * params : filterPaye -> l'id de l'état de paiement à filtrer
     * params : filterEnCours -> true pour les abonnements en cours, false pour les ancients
     * return : list json du model 'Abonnement'
     */
    Route::get("/abonnement/liste", "ApiAbonnementController@liste");
    /**
     * Retourne le detail d'un abonnement
     * param : id -> l'id d'un abonnement
     * return : json du model 'Abonnement'
     */
    Route::get("/abonnement/detail", "ApiAbonnementController@detail");
    /**
     * Créé un nouvel abonnement ou change le status d'un abonnement existant (En cours <-> Stoppé)
     * param : id -> l'id de la publication concerné
     * return : success
     */
    Route::post("/abonnement/new", "ApiAbonnementController@create");
    /**
     * Relance d'un an l'abonnement sélectionné
     * param : id -> l'id de l'abonnement à relancer
     * return : success
     */
    Route::post("/abonnement/relance", "ApiAbonnementController@relance");

    // ----- Fin Abonnements ----- //
});

// ------- Publications ------- //

Route::get("/publication/liste", "ApiPublicationsController@liste");
Route::get("/publication/detail", "ApiPublicationsController@detail");

// ----- Fin Publications ----- //

// ------ Liste des status ------ //
/**
 * Récupère la liste des status possible pour 'sexe' ou une valeur en particulier
 * params : id -> l'id du status à récupérer
 * return : liste de status ou un seul status conrespondant au paramètre.
 */
Route::get("status/sexe", "ApiStatusController@listeSexe");
/**
 * Récupère la liste des status possible pour 'EtatAbonnement' ou une valeur en particulier
 * params : id -> l'id du status à récupérer
 * return : liste de status ou un seul status conrespondant au paramètre.
 */
Route::get("status/encours", "ApiStatusController@listeAboEnCours");
/**
 * Récupère la liste des status possible pour 'Paiement' ou une valeur en particulier
 * params : id -> l'id du status à récupérer
 * return : liste de status ou un seul status conrespondant au paramètre.
 */
Route::get("status/paye", "ApiStatusController@listeAboPaye");

// ---- Fin Liste des status ---- //
