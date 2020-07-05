<?php

use Illuminate\Support\Facades\Route;
use App\Category;
use App\Client;
use App\Product;
use App\Action;

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

// Route Main(welcome) Page
Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('home');
    }

    return view('welcome');
});

// All Routes for Auth
Auth::routes();

// All Routes for (home) name.
Route::name('home')->group(function(){
    Route::get('/home', 'HomeController@index');

    Route::get('/home', 'HomeController@index');
});

// All Routes for (Import/Export Product) createAction name.
Route::name('CreateAction')->middleware('auth')->group(function(){
    Route::get('/createAction' , function(){
        $arr = [];
        if( Auth::check() ){
            $categories = Category::where( 'company_id' , Auth::id() )->get();
            $arr["categories"] = $categories;

            $clients = Client::where( 'company_id' , Auth::id() )->get();
            $arr["clients"] = $clients;
        }

        return view('createAction' , $arr);
    });

    Route::post('/createAction' ,'productController@store');
});

// All Routes for (Category) name.
Route::name('Category')->middleware('auth')->group(function(){
    Route::get('/category' , function(){
        $arr = [];
        $categories = Category::where( 'company_id' , Auth::id() )->get();
        $arr["categories"] = $categories;
        return view('category' , $arr);
    });

    Route::post('/showCategory', 'categoryController@show');

    Route::post('/category' ,'categoryController@edit');
});


// All Routes for (Product) name.
Route::name('Product')->middleware('auth')->group(function(){
    Route::get('/product' , function(){
        $products = Product::where( 'company_id' , Auth::id() )->get();
        return view('product' , ['products' => $products]);
    });

    Route::post('/showProduct', 'productController@show');

    Route::post('/product' ,'productController@edit');

    Route::post('/REMproduct' ,'productController@destroy');
});


// All Routes for (Client) name.
Route::name('Client')->middleware('auth')->group(function(){
    Route::get('/client' , function(){
        $clients = Client::where( 'company_id' , Auth::id() )->get();
        return view('client' , ['clients' => $clients]);
    });

    Route::post('/showClient', 'clientController@show');

    Route::post('/client' ,'clientController@edit');

    Route::post('/REMclient', 'clientController@destroy');

    Route::post('/addClient' , 'clientController@store');
});


// Routes for (Action) name.
Route::get('/action' , function(){
    $actions = Action::where( 'company_id' , Auth::id() )->orderBy('id', 'desc')->get();
    return view('action' , ['actions' => $actions]);
})->middleware('auth')->name('Action');
