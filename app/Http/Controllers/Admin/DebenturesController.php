<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\debenturesRequest;
use App\Models\Car;
use App\Models\Contracts;
use App\Models\Customer;
use App\Models\Debentures;
use Illuminate\Http\Request;

class DebenturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(50);
        $data = Debentures::select()->orderby('id', 'DESC')->paginate(10);
        return view('admin.debentures.index', ['data' => $data]);
    }
    public function invoice($id)
    {
        check_permission_sub_menue_actions_redirect(26);
        $data = debentures::find($id);
        return view('admin.invoice.invoice', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        check_permission_sub_menue_actions_redirect(52);
        $Contracts_id = Contracts::find($id);
        $customer_id = Customer::find($Contracts_id->customer_id);
        $car_id = Car::find($Contracts_id->car_id);
        return view('admin.debentures.create', ['Contracts_id' => $Contracts_id, 'car_id' => $car_id, 'customer_id' => $customer_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(debenturesRequest $request)
    {
        check_permission_sub_menue_actions_redirect(52);
        try {
            $id = auth()->user()->id;

            $data['car_id'] = $request->car_id;
            $data['customer_id'] = $request->customer_id;
            $data['paid_price'] = $request->paid_price;
            $data['contract_id'] = $request->contract_id;
            $data['payment_type'] = $request->payment_type;
            $data['note'] = $request->note;
            $data['remind_price'] = $request->remind_price;
            $data['check_number'] = $request->check_number;
            $data['added_by'] = $id;
            $data['date'] = $request->date;
            $data['created_at'] = date("Y-m-d H:i:s");
            $debentures = Debentures::where('contract_id',$request->contract_id)->count();
            if($debentures == 0){
                $data['count'] = 1;
            }else{
                $data['count'] =  $debentures + 1;
            }
            /*** customer update data ****/
            $customer_id = customer::select('contract_number', 'paid_money', 'remaining_money')->find($request->customer_id);
            $data_to_update_customer['paid_money'] = $customer_id->paid_money + $request->paid_price;
            $data_to_update_customer['remaining_money'] = $customer_id->remaining_money - $request->paid_price;
            customer::where(['id' => $request->customer_id])->update($data_to_update_customer);
            $Contracts_id = Contracts::find($request->contract_id);
            $data_to_update_contracts['paid_price'] = $Contracts_id->paid_price + $request->paid_price;
            $data_to_update_contracts['remind_price'] = $request->remind_price;
            Contracts::where(['id' => $request->contract_id])->update($data_to_update_contracts);
            debentures::create($data);
            return redirect()->route('debentures.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)  
    {
        check_permission_sub_menue_actions_redirect(51);
        $data = debentures::select()->find($id);
        $customer_id = Customer::find($data->customer_id);
        $car_id = Car::find($data->car_id);
        return view('admin.invoice.payment', ['data' => $data, 'car_id' => $car_id, 'customer_id' => $customer_id]);
    }


    public function ajax_search(Request $request)
    {
        check_permission_sub_menue_actions_redirect(50);
        if ($request->ajax()) {
            $contract_status_search = $request->contract_status_search;

            if ($contract_status_search == 'all') {
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "contract_status";
                $operator3 = "=";
                $value3 = $contract_status_search;
            }

            $data = debentures::where($field3, $operator3, $value3)->paginate(PAGINATION_COUNT);
            return view('admin.debentures.ajax_search', ['data' => $data]);
        }
    }
}
