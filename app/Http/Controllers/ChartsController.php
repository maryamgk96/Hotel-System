<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Client;
use Auth;
use Illuminate\Support\Facades\DB;


class ChartsController extends Controller
{
    public function index()
    {
        $MaleReservations=DB::table('reservations')
        ->join('clients', function ($join) {
            $join->on('reservations.client_id', '=', 'clients.id')
                 ->where('gender','=',0);
        })
        ->get()->count();
        $FemaleReservations=DB::table('reservations')
        ->join('clients', function ($join) {
            $join->on('reservations.client_id', '=', 'clients.id')
                 ->where('gender','=',1);
        })
        ->get()->count();

       $allRevenues=DB::table('reservations')
            ->select(DB::raw('SUM(paid_price) as revenue, MONTH(created_at) as month, YEAR(created_at) as year'))
            ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC'))->get();
            $revenues=[0,0,0,0,0,0,0,0,0,0,0,0];
            foreach($allRevenues as $monthlyRevenue){
                if($monthlyRevenue->year == 2018)
                {
                   $revenues[$monthlyRevenue->month]=$monthlyRevenue->revenue;
                }
            } 


        $countriesReservations=DB::table('reservations')
        ->join('clients','reservations.client_id', '=', 'clients.id')
            
        ->select( 'clients.country as co',DB::raw('COUNT(client_id) as c'))
        ->groupBy(DB::raw('country'))
        ->get()->toArray();


        $topReservations=DB::table('reservations')
        ->join('clients','reservations.client_id', '=', 'clients.id')
            
        ->select( 'clients.name as co',DB::raw('COUNT(client_id) as c'))
        ->groupBy(DB::raw('client_id DESC'))
        ->skip(0)->take(10)
        ->get()->toArray();
        
        return view('statistics.statistics',['top'=>$topReservations,'countries'=>$countriesReservations,'male' => $MaleReservations,'female' => $FemaleReservations,'jan'=>$revenues[0],'feb'=>$revenues[1],'mar'=>$revenues[2],'apr'=>$revenues[3],'may'=>$revenues[4],'jun'=>$revenues[5],'jul'=>$revenues[6],'aug'=>$revenues[7],'sep'=>$revenues[8],'oct'=>$revenues[9],'nov'=>$revenues[10],'dec'=>$revenues[11]]);

        

    }
}
