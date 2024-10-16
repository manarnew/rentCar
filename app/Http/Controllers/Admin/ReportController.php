<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Car;
use App\Models\CarExpenses;
use App\Models\Expenses;
use App\Models\expensesType;
use App\Models\Contracts;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function indexBookingReport(){
        check_permission_sub_menue_actions_redirect(45);
        return view('admin.report.indexBookingReport');
    }
   
    
    public function bookingReport(Request $request)
    {
        check_permission_sub_menue_actions_redirect(44);
        $from_date_search = $request->from_date_search;
        $to_date_search = $request->to_date_search;
        $contract_type = $request->contract_type;
        $contract_status = $request->contract_status;
        if ($from_date_search == '') {
            //دائما  true
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "date";
            $operator1 = ">=";
            $value1 = $from_date_search;
        }
        if ($to_date_search == '') {
            //دائما  true
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "date";
            $operator2 = "<=";
            $value2 = $to_date_search;
        }
        if ($contract_type == '') {
            //دائما  true
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "contract_type";
            $operator3 = "=";
            $value3 = $contract_type;
        }
        if ($contract_status == '') {
            //دائما  true
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = "contract_status";
            $operator4 = "=";
            $value4 = $contract_status;
        }
         
         if ($to_date_search == "") {
            $to_date_search = date("Y-m-d");
        }
        if ($from_date_search == "") {
            $from_date_search = Contracts::first()->value("date");
        }
        
            $total_price = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->sum('total_price');

            $total_canceld = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('contract_status',4)->sum('total_price');
            $total_blocked = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('contract_status',3)->sum('total_price');
            $total_inWait = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('contract_status',2)->sum('total_price');
            $total_completed = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('contract_status',1)->sum('total_price');

            $car_number = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->get()->groupBy('car_id');
            $customer_number = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->get()->groupBy('customer_id');
            $number_reserved_car = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->count();
            $car_number =count($car_number);
            $customer_number =count($customer_number);
            $contracts = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->get();
            return view('admin.report.bookingReport', ['total_price' => $total_price,'from_date_search'=>$from_date_search,'to_date_search'=>$to_date_search
                        ,'number_reserved_car'=>$number_reserved_car,'car_number'=>$car_number,'customer_number'=>$customer_number,'contracts'=>$contracts
                    ,'total_canceld'=>$total_canceld,'total_blocked'=>$total_blocked,'total_inWait'=>$total_inWait,'total_completed'=>$total_completed]);
    }


    public function indexUserReport(){
        check_permission_sub_menue_actions_redirect(47);
        $user =  Admin::select()->orderby('id', 'DESC')->get();
        return view('admin.report.indexUserReport',['user'=>$user]);
    }

    public function userReport(Request $request)
    {
        check_permission_sub_menue_actions_redirect(46);
        $from_date_search = $request->from_date_search;
        $to_date_search = $request->to_date_search;
        $user = $request->user;
        if ($from_date_search == '') {
            //دائما  true
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "date";
            $operator1 = ">=";
            $value1 = $from_date_search;
        }
        if ($to_date_search == '') {
            //دائما  true
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "date";
            $operator2 = "<=";
            $value2 = $to_date_search;
        }
        if ($user == 'all') {
            //دائما  true
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "added_by";
            $operator3 = "=";
            $value3 = $user;
        }
       
         
         if ($to_date_search == "") {
            $to_date_search = date("Y-m-d");
        }
        if ($from_date_search == "") {
            $from_date_search = Contracts::first()->value("date");
        }
        
            $total_price = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->sum('total_price');
            $total_canceld = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('contract_status',4)->sum('total_price');
            $total_blocked = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('contract_status',3)->sum('total_price');
            $total_inWait = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('contract_status',2)->sum('total_price');
            $total_completed = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('contract_status',1)->sum('total_price');
            $car_number = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->get()->groupBy('car_id');
            $customer_number = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->get()->groupBy('customer_id');
            $added_by = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->get()->groupBy('added_by');
            $number_reserved_car = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->count();
            $car_number =count($car_number);
            $customer_number =count($customer_number);
            $added_by =count($added_by);
            $user_contracts = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->get();
            $identity_number =  Admin::where('id', $request->user)->value('identity_number');
            if($user != 'all'){  
                $user_name =  Admin::where('id', $request->user)->value('name');
                
            }else{
                $user_name ="";
            }
            return view('admin.report.userReport', ['total_price' => $total_price,'from_date_search'=>$from_date_search,'to_date_search'=>$to_date_search
                        ,'number_reserved_car'=>$number_reserved_car,'car_number'=>$car_number,'customer_number'=>$customer_number,'user_name'=>$user_name
                        ,'added_by'=>$added_by,'user_contracts'=>$user_contracts,'identity_number'=>$identity_number
                        ,'total_canceld'=>$total_canceld,'total_blocked'=>$total_blocked,'total_inWait'=>$total_inWait,'total_completed'=>$total_completed]);
    }

  
    public function indexCarExpensesReport(){
        check_permission_sub_menue_actions_redirect(48);
        return view('admin.report.indexCarExpensesReport');
    }
    public function carExpensesReport(Request $request)
    {
        check_permission_sub_menue_actions_redirect(49);
        $from_date_search = $request->from_date_search;
        $to_date_search = $request->to_date_search;
        $search_by_text = $request->search_by_text;
        if ($from_date_search == '') {
            //دائما  true
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "date";
            $operator1 = ">=";
            $value1 = $from_date_search;
        }
        if ($to_date_search == '') {
            //دائما  true
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "date";
            $operator2 = "<=";
            $value2 = $to_date_search;
        }
        if ($search_by_text == '') {
            //دائما  true
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "car_id";
            $operator3 = "LIKE";
            $value3 = $search_by_text;
        }
       
         
         if ($to_date_search == "") {
            $to_date_search = date("Y-m-d");
        }
        if ($from_date_search == "") {
            $from_date_search = CarExpenses::first()->value("date");
        }
        
            $total_price = CarExpenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, "%{$value3}%")->sum('total_price_tax');
            $car_number = CarExpenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, "%{$value3}%")->get()->groupBy('car_id');
            $car_number =count($car_number);
            $carExpenses = CarExpenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, "%{$value3}%")->get();
            if($search_by_text != ''){  
                $car =  Car::where('plate_number',"LIKE", "%{$search_by_text}%")->first();
            }else{
                $car ="";
            }
            return view('admin.report.carExpensesReport', ['total_price' => $total_price,'from_date_search'=>$from_date_search,'to_date_search'=>$to_date_search
                        ,'car_number'=>$car_number,'car'=>$car,'carExpenses'=>$carExpenses]);
    }
    public function indexTaxReport(){
        check_permission_sub_menue_actions_redirect(48);
        return view('admin.report.indexTaxReport');
    }
    public function taxReport(Request $request)
    {
        check_permission_sub_menue_actions_redirect(49);
        $from_date_search = $request->from_date_search;
        $to_date_search = $request->to_date_search;
        $taxType = $request->taxType;
        if ($from_date_search == '') {
            //دائما  true
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "date";
            $operator1 = ">=";
            $value1 = $from_date_search;
        }
        if ($to_date_search == '') {
            //دائما  true
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "date";
            $operator2 = "<=";
            $value2 = $to_date_search;
        }
      
       
         
         if ($to_date_search == "") {
            $to_date_search = date("Y-m-d");
        }
        if ($from_date_search == "") {
            $from_date_search = Contracts::first()->value("date");
        }
        
            $total_CarExpenses_tax = CarExpenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where("tax",'!=',0)->sum('tax');
            $carExpenses = CarExpenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where("tax",'!=',0)->get();

            $total_Contracts_tax  = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where("tax_price",'!=',0)->where('contract_status','!=',3)->sum('tax_price');
            $contracts = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where("tax_price",'!=',0)->where('contract_status','!=',3)->where('contract_status','!=',4)->get();
            return view('admin.report.taxReport', ['total_Contracts_tax' => $total_Contracts_tax,'from_date_search'=>$from_date_search,'to_date_search'=>$to_date_search
                        ,'contracts'=>$contracts,'total_CarExpenses_tax' => $total_CarExpenses_tax,'carExpenses'=>$carExpenses,'taxType'=>$taxType]);
    }

    
    public function indexExpensesReport(){
        check_permission_sub_menue_actions_redirect(48);
        $expenses_type = expensesType::select()->orderby('id', 'DESC')->get();
        return view('admin.report.indexExpensesReport', ['expenses_type'=>$expenses_type]);
    }
    public function expensesReport(Request $request)
    {
        check_permission_sub_menue_actions_redirect(49);
        $from_date_search = $request->from_date_search;
        $to_date_search = $request->to_date_search;
        $expenses_type_id_search = $request->expenses_type_id_search;
        if ($from_date_search == '') {
            //دائما  true
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "date";
            $operator1 = ">=";
            $value1 = $from_date_search;
        }
        if ($to_date_search == '') {
            //دائما  true
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "date";
            $operator2 = "<=";
            $value2 = $to_date_search;
        }
        if ($expenses_type_id_search == '') {
            //دائما  true
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "expenses_type";
            $operator3 = "=";
            $value3 = $expenses_type_id_search;
        }
       
         
         if ($to_date_search == "") {
            $to_date_search = date("Y-m-d");
        }
        if ($from_date_search == "") {
            $from_date_search = Expenses::first()->value("date");
        }
        
            $total_price = Expenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->sum('total');
            $carExpenses = Expenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->get();
            if($expenses_type_id_search != ''){  
                $expensesType =  expensesType::where('id', $expenses_type_id_search)->first();
            }else{
                $expensesType ="";
            }
            return view('admin.report.expensesReport', ['total_price' => $total_price,'from_date_search'=>$from_date_search,'to_date_search'=>$to_date_search
                        ,'expensesType'=>$expensesType,'carExpenses'=>$carExpenses]);
    }

    public function indexProfitsReport(){
        check_permission_sub_menue_actions_redirect(48);
        $expenses_type = expensesType::select()->orderby('id', 'DESC')->get();
        return view('admin.report.indexProfitsReport', ['expenses_type'=>$expenses_type]);
    }
    public function profitsReport(Request $request)
    {
        check_permission_sub_menue_actions_redirect(49);
        $from_date_search = $request->from_date_search;
        $to_date_search = $request->to_date_search;
        if ($from_date_search == '') {
            //دائما  true
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "date";
            $operator1 = ">=";
            $value1 = $from_date_search;
        }
        if ($to_date_search == '') {
            //دائما  true
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "date";
            $operator2 = "<=";
            $value2 = $to_date_search;
        }
         
         if ($to_date_search == "") {
            $to_date_search = date("Y-m-d");
        }
        if ($from_date_search == "") {
            $from_date_search = Contracts::first()->value("date");
        }
            $total_Contracts = Contracts::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->sum('total_price');
            $total_CarExpenses = CarExpenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->sum('total_price_tax');
            $total_Expenses = Expenses::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->sum('total');
            return view('admin.report.profitsReport', ['total_Contracts' => $total_Contracts,'total_CarExpenses' => $total_CarExpenses,'total_Expenses' => $total_Expenses,'from_date_search'=>$from_date_search,'to_date_search'=>$to_date_search]);
    }

    public function indexDebtReport(){
        $customer = Customer::select()->where('remaining_money','>',0)->orderby('id', 'DESC')->get();
        return view('admin.report.indexDebtReport', ['customer'=>$customer]);
    }
    public function debtReport(Request $request)
    {
        $from_date_search = $request->from_date_search;
        $to_date_search = $request->to_date_search;
        $customer = $request->customer;
        if ($from_date_search == '') {
            //دائما  true
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "date";
            $operator1 = ">=";
            $value1 = $from_date_search;
        }
        if ($to_date_search == '') {
            //دائما  true
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "date";
            $operator2 = "<=";
            $value2 = $to_date_search;
        }
        if ($customer == 'all') {
            //دائما  true
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "id";
            $operator3 = "=";
            $value3 = $customer;
        }
       
         
         if ($to_date_search == "") {
            $to_date_search = date("Y-m-d");
        }
            $total_debt = Customer::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where('remaining_money','>',0)->sum('remaining_money');
            $customers = Customer::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where('remaining_money','>',0)->get();
            return view('admin.report.debtReport', ['customers' => $customers,'total_debt'=>$total_debt,
        'to_date_search'=>$to_date_search,'from_date_search'=>$from_date_search]);
    }

}
