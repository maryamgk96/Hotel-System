<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function unauthorized($id)
    {
        if($id == 1)
        {
            return view('errors.unauthorised');
        }
        else
        {
            
        }    
    }
}
