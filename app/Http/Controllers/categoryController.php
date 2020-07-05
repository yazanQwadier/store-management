<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    // get info for specific id of category and count of products in a category.
    public function show(Request $request)
    {
        $input = $request->all();
        $category = Category::find($input['id']);
        $c = count( Product::where('cate_id' , $input['id'])->get() );
        return response()->json(['cate_info'=> $category , 'count'=>  $c ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    // edit on info of category
    public function edit(Request $request)
    {
        $request->validate([
            'E_Name_C' => 'required' ,
            'E_Desc_C' => 'required'
        ]);

        $input = $request->all();
        Category::where('id' , $input['idCate'])
                ->update( ['name' => $input['E_Name_C'] , 'description' => $input['E_Desc_C']] );

        return redirect()->back()->with('success', "updated successfully !");
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
