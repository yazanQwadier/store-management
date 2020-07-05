<?php

namespace App\Http\Controllers;

use App\Client;
use Auth;
use Illuminate\Http\Request;

class clientController extends Controller
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
    // add new client (if there the same name of client , then won't added it)
    public function store(Request $request)
    {
        $this->validate($request , [    // check validation of the aother info of client
            'clientName'=> 'required' ,
            'phoneC'=> 'required' ,
            'sectionC' => 'required'
        ]);

        // check if there client name same as input
        $found_client = count( Client::where("name" , $request["clientName"] )->get() );
        if($found_client == 0){ // if there no clients the same
            Client::create([    // create new client record
                'company_id' => Auth::id() ,
                'name'       =>  $request["clientName"] ,
                'phone'      =>  $request["phoneC"] ,
                'section'    =>  $request["sectionC"]
            ]);
        }
        else{
            return redirect()->back()->with(['title' => 'danger' , 'message' => 'the client alrady exisits !']);
        }
        return redirect()->back()->with(['title' => 'success' , 'message' => 'the client added successfully !']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    // show info of specific client
    public function show(Request $request)
    {
        $input = $request->all();
        $client = Client::find($input['id']);
        return response()->json(['client'=> $client ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $request->validate([
            'E_Name_C' => 'required',
            'E_Phone_C' => 'required | min:10',
            'E_Section_C' => 'required',
            'idClient' => 'required'
        ]);

        $input = $request->all();
        Client::where('id' , $input['idClient'])
                ->update( ['name' => $input['E_Name_C'] , 'phone' => $input['E_Phone_C'] , 'section' => $input['E_Section_C'] ] );

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
     * @return \Illuminate\Http\Response
     */
    // delete specific client
    public function destroy(Request $request)
    {
        Client::find($request['idClient'])->delete();
        return redirect()->back()->with('success' , 'success');
    }
}
