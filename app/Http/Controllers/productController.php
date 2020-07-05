<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Client;
use App\Action;
use Auth;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // create new products (maybe 1 or 2 or 3 products) , (with type import/export) , with create action.
    public function store(Request $request)
    {
        $arr_actions = [];
        for( $i=1; $i <= $request->countForms; $i++ ){
            $this->validate($request , [
                'nameP'.$i  => 'required | min:5' ,
                'categP'.$i => 'required' ,
                'priceP'.$i => 'required' ,
                'quantP'.$i => 'required' ,
                'dateA'.$i  => 'required' ,
                'clientName'=> 'required'
            ]);

            // if type is export
            if($request["typeA"] == "export"){
                $arr_result[$i - 1] = $this->exportProduct($request , $i);
            }

            // if type is import
            else if($request["typeA"] == "import"){
                $arr_result[$i - 1] = $this->importProduct($request , $i);
            }

            // create new action if there are changes on products (import/export) , mean success.
            if($arr_result[$i - 1]['title'] != "danger"){
                $this->create_action( $request , $i );
            }
        }

        return redirect()->back()->with( 'result' , json_encode( $arr_result ) );
    }

    // doing export changes in specifc product info($i).
    public function exportProduct($request , $i){
        $result = [];

        // check if the name product is found or not
        $found_prod = count( Product::where("name" , $request["nameP".$i] )->get() );
        if($found_prod == 0){
            $result = ["title" => "danger" , "message" => "you haven't this product (product $i) for sell it !"];
            return $result;
        }

        // doing export product ( - )
        $p = Product::where("name" , $request["nameP".$i] )->get()[0];
        Product::where("name" , $request['nameP'.$i])
                ->update(['quantity' => ( $p->quantity - $request['quantP'.$i] ) ]);

        $result = ["title" => "success" , "message" => "you have sell this product (product $i)."];
        return $result;
    }


    // doing import changes in specifc product info($i).
    public function importProduct($request , $i){
        $result = [];

        // check if there client name same as input
        $found_client = count( Client::where("name" , $request["clientName"] )->get() );
        if($found_client == 0){ // if there no clients the same
            $this->validate($request , [    // check validation of the aother info of client
                'phoneC'=> 'required' ,
                'sectionC' => 'required'
            ]);

            Client::create([    // create new client record
                'company_id' => Auth::id() ,
                'name'       =>  $request["clientName"] ,
                'phone'      =>  $request["phoneC"] ,
                'section'    =>  $request["sectionC"]
            ]);
        }

        // check if the name product is found or not
        $found_prod = count( Product::where("name" , $request["nameP".$i] )->get() );
        if($found_prod == 0){

            $found_cat = Category::where("name" , $request["categP".$i] )->get();
            if( count($found_cat) == 0){
                $cat = Category::create([
                    'company_id' => Auth::id() ,
                    'name'      =>  $request["categP".$i]
                ]);

                Product::create([
                    'cate_id' => $cat->id ,
                    'company_id' => Auth::id() ,
                    'name'    => $request['nameP'.$i] ,
                    'price'   => $request['priceP'.$i] ,
                    'quantity'=> $request['quantP'.$i] ,
                    'img'     => 'https://placeholder.com/150'
                ]);
                $result = ["title" => "success" , "message" => "you have buy this product (product $i) "];
            }
            else{
                Product::create([
                    'cate_id' => $found_cat[0]->id ,
                    'company_id' => Auth::id() ,
                    'name'    => $request['nameP'.$i] ,
                    'price'   => $request['priceP'.$i] ,
                    'quantity'=> $request['quantP'.$i] ,
                    'img'     => 'https://placeholder.com/150'
                ]);
                $result = ["title" => "success" , "message" => "you have buy this product (product $i)."];
            }
        }
        else{
            // doing import product ( + ) on exisit product
            $p = Product::where('name' , $request['nameP'.$i])->get()[0];
            Product::where( 'name', $request['nameP'.$i] )
                    ->update( ['quantity' => ($p->quantity + $request['quantP'.$i]) ] );

            $result = ["title" => "warning" , "message" => "you have updated on this product (product $i)."];
        }

        return $result;
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    // get info of specific product , and it's category , and all categories of company_id as a suggestions.
    public function show(Request $request)
    {
        $input = $request->all();
        $product = Product::find($input['id']);
        $categories = Category::where( 'company_id' , Auth::id() )->get();
        $category = Category::find($product['cate_id'] );
        return response()->json(['product'=> $product , 'category' => $category , 'categories' => $categories]);
    }

    // get name of category by it's id.
    public static function getNameCategory($id){
        return Category::find($id)['name'];
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    // edit on product
    public function edit(Request $request)
    {
        $request->validate([
            'E_Name_P' => 'required | min:5' ,
            'E_Price_P' => 'required' ,
            'E_Quan_P' => 'required' ,
            'E_cate_P' => 'required' ,
            'idProd'  => 'required'
        ]);

        $input = $request->all();
        // get name of current category of product from database
        $current_cate = Product::find( $input['idProd'] )->get()[0]['cate_id'];
        $name_current_cate = Category::find($current_cate)->get()[0]['name'];

        // if entered category the same the category in database
        $new_category = $current_cate;
        if( $input['E_cate_P'] !=  $name_current_cate){
            $c = Category::create([
                'name' => $input['E_cate_P'] ,
                'company_id' => Auth::id() ,
                'description'  => null
            ]);

            $new_category = $c->id;
        }

        // edit on product info
        Product::find( $input['idProd'] )
                ->update( [
                    'name' => $input['E_Name_P'] ,
                    'price' => $input['E_Price_P'] ,
                    'quantity' => $input['E_Quan_P'] ,
                    'cate_id' => $new_category
                ]);

        return redirect()->back()->with('success', "updated successfully !");
    }

    // create new  Action on specific product ($i)
    public function create_action(Request $request , $i){
        Action::create([
            'type'          => $request['typeA'] ,
            'company_id'    => Auth::id() ,
            'client_name'   => $request["clientName"] ,
            'product_name'  => $request["nameP".$i] ,
            'price'         => $request['priceP'.$i] ,
            'quantity'      => $request['quantP'.$i] ,
            'date'          => $request['dateA'.$i],
            'notes'         => null
        ]);
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    // delete specific product
    public function destroy(Request $request)
    {
        Product::find($request['idProd'])->delete();
        return redirect()->back()->with('success' , 'success');
    }
}
