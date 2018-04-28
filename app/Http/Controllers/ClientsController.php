<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Rinvex\Country\CountryLoader;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Notifications\ClientApproved;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Client;
use App\User;
use App\Reservation ;
use Auth;

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
        $countries =  Cache::rememberForever('countries', function() {
            return countries();
        });
        
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
        if( $request->file('avatar'))
        {
          $path = $request->file('avatar')->store('public');
        }
        else
          $path = "";
    
        Client::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'mobile'=>$request->phone,
            'country'=>$request->country,
            'gender'=>$request->gender,
            'avatar'=>$path
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
        $client = Client::find($id);
        $countries =  Cache::rememberForever('countries', function() {
            return countries();
        });

        return view('clients.edit',compact('countries','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $client=Client::find($id);
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public');
        
          }
            $client->name = $request->name;
            $client->email=$request->email;
            $client->mobile=$request->phone;
            $client->country=$request->country;
            $client->gender=$request->gender;

            if($request->avatar)
            {
                Storage::delete(str_replace("/storage", "public", $client->avatar));
                $path = $request->file('avatar')->store('public');  
                $client->avatar = $path;
            }
            
            $client->save();
        
            return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        
        $id = $request->input('id');
        $res = Reservation::where('client_id', $id)->first();
        if($res){
            $res->delete();
            Client::find($id)->delete();
        }
        else
        {
            Client::find($id)->delete();            
        }
       
    }


    public function approve($id){
      $client=  client::find($id);
      $client->update(['is_approved' => 1,'approved_by'=>Auth::user()->id]);
      $client->notify(new ClientApproved($client));      
        return redirect('/clients');


    }


    public function showMyClients(){

        return view('clients.myClients');
    }
   
}
