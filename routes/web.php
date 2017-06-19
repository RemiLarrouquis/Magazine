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

Route::get('/', function () {
    if (Auth::guest()) {
        return view('welcome');
    } else {
        return redirect('home');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');







//Routage publication
Route::get("/publication/new","PublicationController@newPublication");
Route::get("/publication/edit/{id}","PublicationController@editForm");
Route::get("/publication/list","PublicationController@liste");

Route::post("/publication/save","PublicationController@savePublication");
Route::post("/publication/addPicture","PublicationController@upload");


Route::get("/api/abonnements", "AbonnementController@getAbonnements");

Route::get("/user/get/{id}", 'ApiUserController@user');
Route::post("/user/edit", 'ApiUserController@updateUser');
Route::get("/user/exist/{email}", 'ApiUserController@userExist');