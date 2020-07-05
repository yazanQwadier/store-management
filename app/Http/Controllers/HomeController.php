<?php

namespace App\Http\Controllers;
use App\Client;
use App\Category;
use App\Action;
use App\Product;

use Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if( Auth::check() ){
            $com_id = Auth::id();
            $clients    = Client::where('company_id' ,  $com_id)->get();
            $categories = Category::where('company_id' , $com_id)->get();
            $actions    = Action::where('company_id' ,  $com_id)->get();
            $products    = Product::where('company_id' ,  $com_id)->get();

            $arr = array('clients' => $clients , 'categories' => $categories , 'actions' => $actions , 'products' => $products);

            return view('home' , $arr);
        }

        return view('home');
    }


}
