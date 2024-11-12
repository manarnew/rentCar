<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Contract;
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
        $today_reserved_car = Contract::where('date',date("Y-m-d"))->count();
        $today_end_reserved_car = Contract::where('return_date',date("Y-m-d"))->count();
        $Contracts = Contract::where('id','>',0)->count();
        $Contracts_on_wait = Contract::where('contract_status',2)->count();
        $debentures = Debentures::where('id','>',0)->count();
        return view('admin.dashboard',['available_car'=>$available_car,'not_available_car'=>$not_available_car,
                    'Customer'=>$Customer,'Contracts'=>$Contracts,'today_reserved_car'=>$today_reserved_car,
                    'today_end_reserved_car'=>$today_end_reserved_car,'debentures'=>$debentures,'Contracts_on_wait'=>$Contracts_on_wait]);
    }
    public function car_dashboard($status)
    {
        if($status == 1){
             $data = Car::where('car_status',1)->paginate(10);
             return view('admin.cars.car_dashboard',['data'=>$data,'status'=>$status]);
        }elseif($status == 2){
             $data = Car::where('car_status',0)->paginate(10);
             return view('admin.cars.car_dashboard',['data'=>$data,'status'=>$status]);
        }
    }
       public function contracts_dashboard($status)
    {
        if($status == 1){
             $data =  Contract::where('date',date("Y-m-d"))->paginate(10);
             return view('admin.contracts.contracts_dashboard',['data'=>$data,'status'=>$status]);
        }elseif($status == 2){
             $data = Contract::where('return_date',date("Y-m-d"))->paginate(10);
             return view('admin.contracts.contracts_dashboard',['data'=>$data,'status'=>$status]);
        }else{
              $data = Contract::where('contract_status',2)->paginate(10);
             return view('admin.contracts.contracts_dashboard',['data'=>$data,'status'=>$status]);
        }
    }
}
