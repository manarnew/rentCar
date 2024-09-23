<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin_panel_setting;
use App\Models\Car;
use App\Models\Contracts;
use App\Models\Customer;
use App\Models\Debentures;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $available_car = Car::where('car_status',1)->count();
        $not_available_car = Car::where('car_status',0)->count();
        $Customer = Customer::where('id','>',0)->count();
        $today_reserved_car = Contracts::where('date',date("Y-m-d"))->count();
        $today_end_reserved_car = Contracts::where('return_date',date("Y-m-d"))->count();
        $Contracts = Contracts::where('id','>',0)->count();
        $debentures = Debentures::where('id','>',0)->count();
        return view('admin.dashboard',['available_car'=>$available_car,'not_available_car'=>$not_available_car,
                    'Customer'=>$Customer,'Contracts'=>$Contracts,'today_reserved_car'=>$today_reserved_car,
                    'today_end_reserved_car'=>$today_end_reserved_car,'debentures'=>$debentures]);
    }
}
