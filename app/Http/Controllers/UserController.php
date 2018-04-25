<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use App\User;

class UserController extends Controller
{
    public function index($role)
    {
        $role=substr($role, 0, -1);
        if($role == "manager")
        {
            return view('managers.index');
        }
        else
        {
            return view('receptionists.index');
        }

        

    }
    public function create($role)
    {
        $role=substr($role, 0, -1);
        if($role == "manager")
        {
            return view('managers.create');
        }
        else
        {
            return view('receptionists.create');
        }    
    }
    public function store($role)
    {   
    }
    public function show($role,$id)
    {   
    }
    public function edit($role,$id)
    {

    
    }
    public function update($role,$id)
    {
    }
    public function destroy($role,$id)
    {   
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

}
