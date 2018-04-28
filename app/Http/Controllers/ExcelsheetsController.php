<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Excel;

class ExcelsheetsController extends Controller
{
    
    public function downloadExcel($type)
    {
        return Excel::download(new Client, 'clients.xlsx');
    }
}
