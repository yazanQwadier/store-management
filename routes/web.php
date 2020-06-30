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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/* the following routes are for testing just.*/
Route::get('/category/{id}' , function($id){
    $cat = new App\Category();
    $cat->company_id = 1;
    $cat->name = "c ".$id;
    $cat->description = "this is description of cat ".$id;
    $cat->save();
});

Route::get('/product/{catId}/{prodId}' , function($catId , $prodId){
    $product = new App\Product();
    $product->cate_id = $catId;
    $product->name = "p ".$prodId;
    $product->price = 50;
    $product->quantity = 12;
    $product->img = "..." ;
    $product->save();
});

Route::get('/clients/{id}' , function($id){
    $c = new App\Client();
    $c->company_id = 1;
    $c->name = "c ".$id;
    $c->phone =786862369;
    $c->section = "techeniques";
    $c->save();
});

Route::get('/actions/{Company}/{client}/{product}' , function($Company , $client , $product){
    $action = new App\Action();
    $action->type = "invoice";
    $action->company_id = $Company;
    $action->client_id =  $client;
    $action->product_id = $product;
    $action->date =  date("2020-06-30 13:00");
    $action->notes = "notes".$product;
    $action->save();
});
/* the above routes are for testing just.*/
