<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use App\User;
use Auth;

class AjaxController extends Controller
{
    public function managersDataAjax()
    {
        $managers = User::role('manager')->get();
        return Datatables::of($managers) ->addColumn('actions', function ($manager) {
            return view('managers.action',['id'=>$manager->id]);
        })->rawcolumns(['actions'])->make(true);
    }
    

    public function receptionistsDataAjax()
    {              
        $user = Auth::user();
        $receptionists = User::role('receptionist')->with('user')->get();
        if($user->hasRole('admin'))
        {
            return Datatables::of($receptionists) ->addColumn('actions', function ($receptionist) {
                return view('receptionists.action',['id'=>$receptionist->id,'banFlag'=>$receptionist->is_banned]);
            })->rawcolumns(['actions'])->make(true); 
        }
        else
        {
            $receptionists = User::role('receptionist')->with('user')->get();
            return Datatables::of($receptionists) ->addColumn('actions', function ($receptionist) {
                if(Auth::user()->id == $receptionist->created_by)
                {
                  return view('receptionists.action',['id'=>$receptionist->id,'banFlag'=>$receptionist->is_banned]);
                }
                else
                  return 'You Cannot CRUD On This Receptionist';
            })->rawcolumns(['actions'])->make(true); 
        }
    }
    

}
