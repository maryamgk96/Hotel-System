<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Rinvex\Country\CountryLoader;
use App\Client;

class ClientsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $countries = countries();
        return view('clients.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Client::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'mobile'=>$request->phone,
            'country'=>$request->country,
            'gender'=>$request->gender,
            'approved_by'=>1,
            
        ]);
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client=Client::find($id);

        $countries = countries();
        return view('clients.edit',compact('countries','client'));
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
        $client=Client::find($id);
        
            $client->name = $request->name;
            $client->email=$request->email;
            $client->password=$request->password;
            $client->mobile=$request->phone;
            $client->country=$request->country;
            $client->gender=$request->gender;
            $client->save();
            
        
        
            return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id){
        Client::find($id)->delete();

        return redirect(route('client.index')); 
    }

    public function ajaxData()
    {
        return Datatables::of(Client::query())->addColumn('actions', function ($client) {
            return '<a href="/clients/'.$client->id.'/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a><form action="/clients/'.$client->id.'delete/"  method="post">
            @csrf {{method_field("DELETE")}}<button class="btn btn-danger" onclick="return confirm("are you sure?")" type="submit">delete</button></form>';
        })->rawcolumns(['actions'])->make(true);    
    }
}
