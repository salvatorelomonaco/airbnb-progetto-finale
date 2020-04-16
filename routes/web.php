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

// ROTTE PUBBLICHE (controllers in Public1)
// +-----------+-----------------------------------+-------------------------+--------------------------------------------------------+--------------+
// | Method    | URI in barra indirizzi            | Nome della rotta        | Controller @ metodo invocato                           | Middleware   |
// +-----------+-----------------------------------+-------------------------+--------------------------------------------------------+--------------+
// | GET|HEAD  | /                                 | public                  | App\Http\Controllers\Public1\HomeController@index      | web          |
// +-----------+-----------------------------------+-------------------------+--------------------------------------------------------+--------------+
Route::get('/', 'Public1\HomeController@index')->name('public');

Route::get('/apartment/{apartment}', 'Public1\HomeController@show')->name('public.show');
Route::post('/apartment/{apartment}', 'Public1\HomeController@mail')->name('public.mail');

Route::get('/back', 'Public1\HomeController@go_back')->name('public.go_back');

Route::post('/search', 'Public1\SearchController@search')->name('public.search');



// ROTTE DI DEFAULT PER GESTIRE LOGIN E REGISTRAZIONE (controllers in Auth)
Auth::routes();


// ROTTE AUTENTICATE (controllers in Admin)
// +-----------+-----------------------------------+-------------------------+--------------------------------------------------------+--------------+
// | Method    | URI in barra indirizzi            | Nome della rotta        | Controller @ metodo invocato                           | Middleware   |
// +-----------+-----------------------------------+-------------------------+--------------------------------------------------------+--------------+
// |  POST      | admin/apartment                  | admin.apartment.store   | App\Http\Controllers\Admin\ApartmentController@store   | web,auth     |
// |  GET|HEAD  | admin/apartment                  | admin.apartment.index   | App\Http\Controllers\Admin\ApartmentController@index   | web,auth     |
// |  GET|HEAD  | admin/apartment/create           | admin.apartment.create  | App\Http\Controllers\Admin\ApartmentController@create  | web,auth     |
// |  DELETE    | admin/apartment/{apartment}      | admin.apartment.destroy | App\Http\Controllers\Admin\ApartmentController@destroy | web,auth     |
// |  PUT|PATCH | admin/apartment/{apartment}      | admin.apartment.update  | App\Http\Controllers\Admin\ApartmentController@update  | web,auth     |
// |  GET|HEAD  | admin/apartment/{apartment}      | admin.apartment.show    | App\Http\Controllers\Admin\ApartmentController@show    | web,auth     |
// |  GET|HEAD  | admin/apartment/{apartment}/edit | admin.apartment.edit    | App\Http\Controllers\Admin\ApartmentController@edit    | web,auth     |
// |  GET|HEAD  | admin/home                       | admin.home              | App\Http\Controllers\Admin\HomeController@index        | web,auth     |
// +-----------+-------------------------+---------------------+----------------------------------------------------------------------+--------------+

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    // ->(middleware('auth') : queste rotte private sono accesibili solo da utente autenticato ,
    // ->(namespace('Admin') : hanno i controllers corrispondenti nella cartella Controllers/Admin/
    // ->(prefix('admin')) : hanno tutte l'url che comincia con 'admin'
    // ->(name('admin.')) : hanno un nome(name) che comincia con 'admin.'

    // queste 7, definite con ::resource(), sono le rotte di default per implementare le CRUD
    Route::resource('/apartment', 'ApartmentController');

    // la 'admin.home' è la rotta autenticata iniziale, che ritorna la view 'admin\home.blade.php'
    Route::get('/home', 'HomeController@index')->name('home'); // homepage della parte autenticata: 'admin.home'

    // questa rotta invoca la funzione account che ritorna una view con il profilo dell'utente (nome, cognome, etc)
    // +-----------+-------------------------+---------------------+----------------------------------------------------+--------------+
    // | Method    | URI in barra indirizzi  | Nome della rotta    | Controller @ metodo invocato                       | Middleware   |
    // +-----------+-------------------------+---------------------+----------------------------------------------------+--------------+
    // | GET|HEAD  | admin/account           | admin.account       | App\Http\Controllers\Admin\HomeController@account  | web,auth     |
    // +-----------+-------------------------+---------------------+----------------------------------------------------+--------------+
    Route::get('/account', 'HomeController@account')->name('account');

    Route::get('/apartment/restore/{id}', 'ApartmentController@restore')->name('apartment.restore');

    Route::get('apartment/{apartment}/sponsor', 'ApartmentController@sponsor')->name('apartment.sponsor');

    Route::get('apartment/{apartment}/checkout', 'ApartmentController@checkout')->name('apartment.checkout');

    Route::post('/payment/{apartment}/make', 'PaymentsController@make')->name('payment.make');

    Route::get('apartment/{apartment}/message', 'DataController@message')->name('apartment.messages');

    Route::get('apartment/{apartment}/statistics', 'DataController@statistics')->name('apartment.statistics');

});

?>
