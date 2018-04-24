<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Rinvex\Country\CountryLoader;
use App\Http\Requests\StoreClientRequest;
use App\Client;
use App\User;
use App\Reservation ;

class ClientsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:client');
    }
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
    public function store(StoreClientRequest $request)
    {
        Client::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
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
        

        $res = Reservation::where('client_id', $id)->first();
        if($res){
            $res->delete();
            Client::find($id)->delete();
        }
        else
        {
            Client::find($id)->delete();            
        }
        return redirect('/clients');
    }

    public function ajaxData()
    {
        $clients = Client::with('user');
        return Datatables::of($clients)->addColumn('actions', function ($client) {
            return '<a href="/clients/'.$client->id.'/edit" class="btn btn-xm btn-primary" ><i class="fa fa-edit"></i> Edit</a>
            <form action="clients/'.$client->id.'/delete" 
            onsubmit="return confirm(\'Do you really want to delete?\');" method="post" >'.csrf_field().method_field("Delete").'<input name="_method" value="delete" type="submit" class="btn btn-danger" /></form>';
        })->addColumn('gender',function($client){
            if($client->gender==0)
            {return "Male";}
            else{return "Female";}})
            
            ->rawcolumns(['actions'])->make(true);    
    }
}
