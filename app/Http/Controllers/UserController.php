<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use App\User;
use App\Http\Requests\StoreUserRequest;
use Auth;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index($role)
    {
        $role=substr($role, 0, -1);
        if($role == "manager")
        {
            if(Auth::user()->hasRole('admin'))
            {
                return view('managers.index');
            }
            else
                return redirect('ERROR/1');
        }
        else
        {            
            if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('manager'))
            {
                return view('receptionists.index');
            }
            else
                return redirect('ERROR/1');            
        }

        

    }
    public function create($role)
    {
        $role=substr($role, 0, -1);
        if($role == "manager")
        {
            if(Auth::user()->hasRole('admin'))
            {
                return view('managers.create');
            }
            else
                return redirect('ERROR/1');

        }
        else
        {
            if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('manager'))
            {
                return view('receptionists.create');
            }
            else
                return redirect('ERROR/1');
            
        }    
    }
    public function store($role,StoreUserRequest $request)
    {  
        $role=substr($role, 0, -1);
        if($role == "manager")
        {
            if( $request->file('avatar'))
            {
              $path = $request->file('avatar')->store('public');
            }
            else
              $path = "";
              
            $newManager=User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'national_id' => $request->national_id,
                'created_by' =>Auth::user()->id ,
                'avatar' => $path
            ]);
            $newManager->assignRole('manager');
            return redirect('managers');
        }
        else
        {   
            if( $request->file('avatar'))
            {
              $path = $request->file('avatar')->store('public');
            }
            else
              $path = "";
              
            $newReceptionist=User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'national_id' => $request->national_id,
                'created_by' =>Auth::user()->id ,
                'avatar' => $path
            ]);
            $newReceptionist->assignRole('receptionist');
            return redirect('receptionists');
            
        }  
    }
    public function edit($role,$id)
    {
        $role=substr($role, 0, -1);
        $user = User::find($id);
        if($role == "manager")
        {
            if(Auth::user()->hasRole('admin'))
            {
                return view('managers.edit',['manager' => $user]);
            }
            else
                return redirect('ERROR/1');
        }
        else
        {   
            if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('manager'))
            {
                return view('receptionists.edit',['receptionist' => $user]);
            }
            else
                return redirect('ERROR/1');

        } 
    
    }
    public function update($role,$id,UpdateUserRequest $request)
    {
        $role=substr($role, 0, -1);
        $user = User::find($id);
        if($role == "manager")
        {
            $user->email = $request->email;
            $user->name = $request->name;
            $user->national_id = $request->national_id;
            if($request->avatar)
            {
                Storage::delete(str_replace("/storage", "public", $user->avatar));
                $path = $request->file('avatar')->store('public');  
                $user->avatar = $path;
            }
            $user->save();
            return redirect('managers');
        }
        else
        {   
            $user->email = $request->email;
            $user->name = $request->name;
            $user->national_id = $request->national_id;
            if($request->avatar)
            {
                Storage::delete(str_replace("/storage", "public", $user->avatar));
                $path = $request->file('avatar')->store('public');  
                $user->avatar = $path;
            }
            $user->save();
            return redirect('receptionists');
            
        } 
    }
    public function destroy($id)
    {   
            User::find($id)->delete();

    }
    public function ban($id)
    {   
        $user = User::find($id);
        $user->is_banned = 1;
        $user->save();
        $user->ban();
        return redirect('receptionists');
    }
    public function unban($id)
    {
        $user = User::find($id);
        $user->is_banned = 0;
        $user->save();
        $user->unban();
        return redirect('receptionists');  
    }

    public function editProfile($id){
        $user = User::find($id);
        
        return view('auth.editProfile',[
            'user' => $user,
            
        ]);
    }

    public function updateProfile(UpdateUserRequest $request,$id){
        $user = User::find($id);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->national_id = $request->national_id;
            if($request->avatar)
            {
                Storage::delete(str_replace("/storage", "public", $user->avatar));
                $path = $request->file('avatar')->store('public');  
                $user->avatar = $path;
            }
            $user->save();
        
        
       return redirect('/home'); 
    }

}
