<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractsRequest;
use App\Models\Car;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Debentures;
use App\Models\BlackList;
use App\Models\PanelSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(42);
        $data = Contract::select()->orderby('id', 'DESC')->paginate(10);
        return view('admin.contracts.index', ['data' => $data]);
    }
    public function invoice($id)
    {
        check_permission_sub_menue_actions_redirect(26);
        $data = Contract::find($id);
        return view('admin.invoice.invoice', ['data' => $data]);
    }
    public function create_signature_image(Request $request)
    {
                 $data = Contract::find($request->id);
                 
        return view('admin.contracts.signature_image', ['id' => $request->id,'data'=>$data]);
    }
    public function store_signature_image(Request $request)
    {
        $data = Contract::find($request->id);
        if(!empty($data->signature_image)){
            return view('admin.invoice.invoice', ['data' => $data]);
        }
        $folderPath = 'upload/';
        
        $image_parts = explode(";base64,", $request->signed);
              
        $image_type_aux = explode("image/", $image_parts[0]);
           
        $image_type = $image_type_aux[1];
           
        $image_base64 = base64_decode($image_parts[1]);
           
        $file = $folderPath . uniqid() . '.'.$image_type;
        
        file_put_contents($file, $image_base64);
        $data_to_update['signature_image']=$file;
        Contract::where(['id' => $request->id])->update($data_to_update);
       $data = Contract::find($request->id);
        return view('admin.invoice.invoice', ['data' => $data]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $time =   date("H:i:s");
        check_permission_sub_menue_actions_redirect(23);
        $customer_id = Customer::select()->orderby('id', 'DESC')->get();
        $car_id = Car::find($id);
          foreach($customer_id as $info){
            $customer = BlackList::select('id')->where('customer_id',$info->id)->first();
             if($customer){
                 $info->customer_status = 0;
             }else{
                 $info->customer_status =1;
             }
             
         }
        return view('admin.contracts.create', ['car_id' => $car_id, 'customer_id' => $customer_id,'time'=>$time]);
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(ContractsRequest $request)
    {
        check_permission_sub_menue_actions_redirect(23);
        try {
            if ( $request->exist_date < date("Y-m-d")) {
                return redirect()->back()
                ->with(['error' => 'لايمكن ان يكون تاريخ المغادرة اقل من تاريخ اليوم' ])
                ->withInput();
            }
            if ( $request->return_date < date("Y-m-d")) {
                return redirect()->back()
                ->with(['error' => 'لايمكن ان يكون تاريخ العودة اقل من تاريخ اليوم' ])
                ->withInput();
            }
            if ( $request->return_date < $request->exist_date) {
                return redirect()->back()
                ->with(['error' => 'لايمكن ان يكون تاريخ العودة اقل من تاريخ المغادرة' ])
                ->withInput();
            }
            $id = auth()->user()->id;
             if($request->exist_km_old != $request->exist_km ){
                 $data_to_update_car_exist_km['km_number'] = $request->exist_km;
                 Car::where(['id' => $request->car_id])->update($data_to_update_car_exist_km);
             }
            $data['car_id'] = $request->car_id;
            $data['customer_id'] = $request->customer_id;
            $data['contract_status'] = $request->contract_status;
            $data['contract_type'] = $request->contract_type;
            $data['contract_number'] = $request->contract_number;
            $data['contract_price'] = $request->contract_price;
            $data['pre_paid_price'] = $request->pre_paid_price;
            $data['paid_price'] = $request->paid_price;
            $data['tax_price'] = $request->tax_price;
            $data['total_price'] = $request->total_price;
            $data['payment_type'] = $request->payment_type;
            $data['excess_km_price'] = $request->excess_km_price;
            $data['remind_price'] = $request->remind_price;
            $data['penalty_price'] = $request->penalty_price;
            $data['patrol_price'] = $request->patrol_price;
            $data['washing_price'] = $request->washing_price;
            $data['insurance_price'] = $request->insurance_price;
            $data['exist_date'] = $request->exist_date;
            $data['exist_time'] = $request->exist_time;
            $data['return_date'] = $request->return_date;
            $data['return_time'] = $request->return_time;
            $data['exist_km'] = $request->exist_km;
            $data['return_km'] = $request->return_km;
            $data['free_km'] = $request->free_km;
            $data['due_km'] = $request->due_km;
            $data['total_km'] = $request->total_km;
            $data['excess_km'] = $request->excess_km;
            $data['driver_name'] = $request->driver_name;
            $data['discount'] = $request->discount;
            $data['contract_type_price'] = $request->contract_type_price;
            $data['added_by'] = $id;
            $data['date'] = $request->date;
            $data['created_at'] = date("Y-m-d H:i:s");
              $contract_id =  Contract::create($data);
            /*** customer update data ****/
            $customer_id = customer::select()->find($request->customer_id);
            $data_to_update_customer['contract_number'] = 1;
                if (empty($customer_id->contract_number)) {
                    $data_to_update_customer['total_money'] = $request->total_price;
                    $data_to_update_customer['paid_money'] =  ($request->paid_price + $request->pre_paid_price);
                    $data_to_update_customer['remaining_money'] =  $request->remind_price;
                } else {
                    $data_to_update_customer['contract_number'] = $customer_id->contract_number + 1;
                    $data_to_update_customer['total_money'] = $customer_id->total_money + $request->total_price;
                    $data_to_update_customer['paid_money'] = $customer_id->paid_money + ($request->paid_price + $request->pre_paid_price);
                    $data_to_update_customer['remaining_money'] = $customer_id->remaining_money + $request->remind_price;
                }
            customer::where(['id' => $request->customer_id])->update($data_to_update_customer);
            //create the debentures
                        
            $data_Debentures['car_id'] = $request->car_id;
            $data_Debentures['customer_id'] = $request->customer_id;
            $data_Debentures['paid_price'] =   ($request->paid_price + $request->pre_paid_price);
            $data_Debentures['contract_id'] = $contract_id->id;
            $data_Debentures['payment_type'] = $request->payment_type;
            $data_Debentures['note'] = "مبلغ مستلم مع العقد";
            $data_Debentures['remind_price'] = $request->remind_price;
            $data_Debentures['added_by'] = $id;
            $data_Debentures['date'] = $request->date;
            $data_Debentures['created_at'] = date("Y-m-d H:i:s");
            $debentures = Debentures::where('contract_id',$contract_id->id)->count();
            if($debentures == 0){
                $data_Debentures['count'] = 1;
            }else{
                $data_Debentures['count'] = $debentures + 1;
            }
            debentures::create($data_Debentures);

            $car = Car::select()->find($request->car_id);
            if (empty($car->contract_number)) {
                $data_to_update_car['contract_number'] = 1;
            } else {
                $data_to_update_car['contract_number'] = $car->contract_number + 1;
            }

            if ($request->contract_status == 2) {
                $data_to_update_car['car_status'] = 0;
            } else {
                $data_to_update_car['car_status'] = 1;
            }
            if (!empty($request->return_km)) {
                $data_to_update_car['km_number'] = $request->return_km;
                 $data_to_update_car['km_for_mantince'] = $car->km_for_mantince + $request->total_km;
            }
            Car::where(['id' => $request->car_id])->update($data_to_update_car);
            
        $Panel_settings = PanelSetting::find(1);
        
  
$name = auth()->user()->name;
$message = " تم انشاء عقد اجار جديد رقم  $contract_id->id بواسطة $name";
switch ($request->contract_status) {
    case 1:
        $status = 'مكتمل'; // Completed
        break;
    case 2:
        $status = 'في الانتظار'; // Pending
        break;
    case 3:
        $status = 'مرفوض'; // Rejected
        break;
    default:
        $status = 'ملغي'; // Cancelled
}
$route =$message.'                                               '.
'نوع الحجز:'. (($request->contract_type==1?'يومي':$request->contract_type==2)?' اسبوعي':'شهري').'                                               '.
' العدد/اليوم:'. $request->contract_number.'                                               '
.'حالة الحجز:'. $status .'                                               '
 .'رقم اللوحة:'. $car->plate_number.'                                               '
 .'تاريخ المغادرة:'. $request->exist_date.'                                               '
 .'وقت المغادرة:'. $request->exist_time.'                                               '
 .'تاريخ العودة:'. $request->return_date.'                                               '
 .'وقت العودة:'. $request->return_time.'                                               '
.'نوع السيارة:'.$car->type->name.'                                               '
.'موديل السيارة:'.$car->carModals->name.'                                               '.
'لون السيارة:'.$car->car_color.'                                               ' 
.'اسم العميل:'.$customer_id->name.'                                               '.
'رقم الهاتف:'.$customer_id->phone.'                                               '.
'رقم الهوية:'.$customer_id->identity_number;
   // Ensure you have a valid access token
        $access_token =  $Panel_settings->access_token; // Replace with a valid access token
        $instance_id =  $Panel_settings->Inctance_id;
       
        $url = "https://waclient.com/api/send?number={$Panel_settings->notfication_number}&type=text&message=$route&instance_id=$instance_id&access_token=$access_token";
        // Use cURL or file_get_contents to send the request if necessary
        $response = Http::get($url);  
       $response =  json_decode($response);
      
            return redirect()->route('contracts.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
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
        check_permission_sub_menue_actions_redirect(26);
        $data = Contract::select()->find($id);
        return view('admin.contracts.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        check_permission_sub_menue_actions_redirect(24);
        $data = Contract::select()->find($id);
        $customer_id = Customer::select()->orderby('id', 'DESC')->get();
        $car_id = Car::find($data->car_id);
          foreach($customer_id as $info){
            $customer = BlackList::select('id')->where('customer_id',$info->id)->first();
             if($customer){
                 $info->customer_status = 0;
             }else{
                 $info->customer_status =1;
             }
             
         }
        return view('admin.contracts.edit', ['data' => $data, 'car_id' => $car_id, 'customer_id' => $customer_id]);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(ContractsRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(24);
        try {
            $data = Contract::select()->find($id);
            if (empty($data)) {
                return redirect()->route('contracts.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
           
            if ( $request->return_date < date("Y-m-d")) {
                return redirect()->back()
                ->with(['error' => 'لايمكن ان يكون تاريخ العودة اقل من تاريخ اليوم' ])
                ->withInput();
            }
            if ( $request->return_date < $request->exist_date) {
                return redirect()->back()
                ->with(['error' => 'لايمكن ان يكون تاريخ العودة اقل من تاريخ المغادرة' ])
                ->withInput();
            }
            
            $data_to_update['car_id'] = $request->car_id;
            $data_to_update['customer_id'] = $request->customer_id;
            $data_to_update['contract_status'] = $request->contract_status;
            $data_to_update['contract_type'] = $request->contract_type;
            $data_to_update['contract_number'] = $request->contract_number;
            $data_to_update['contract_price'] = $request->contract_price;
            $data_to_update['pre_paid_price'] = $request->pre_paid_price;
            $data_to_update['paid_price'] = $request->paid_price;
            $data_to_update['tax_price'] = $request->tax_price;
            $data_to_update['total_price'] = $request->total_price;
            $data_to_update['excess_km_price'] = $request->excess_km_price;
            $data_to_update['remind_price'] = $request->remind_price;
            $data_to_update['penalty_price'] = $request->penalty_price;
            $data_to_update['patrol_price'] = $request->patrol_price;
            $data_to_update['washing_price'] = $request->washing_price;
            $data_to_update['insurance_price'] = $request->insurance_price;
            $data_to_update['payment_type'] = $request->payment_type;
            $data_to_update['exist_date'] = $request->exist_date;
            $data_to_update['exist_time'] = $request->exist_time;
            $data_to_update['return_date'] = $request->return_date;
            $data_to_update['return_time'] = $request->return_time;
            $data_to_update['exist_km'] = $request->exist_km;
            $data_to_update['return_km'] = $request->return_km;
            $data_to_update['free_km'] = $request->free_km;
            $data_to_update['due_km'] = $request->due_km;
            $data_to_update['total_km'] = $request->total_km;
            $data_to_update['excess_km'] = $request->excess_km;
            $data_to_update['driver_name'] = $request->driver_name;
            $data_to_update['discount'] = $request->discount;
            $data_to_update['contract_type_price'] = $request->contract_type_price;
            $customer_id = customer::select()->find($request->customer_id);
            $customer_id_old = customer::select()->find($data->customer_id);
            if(($data->contract_status == 1 || $data->contract_status == 2) && ($request->contract_status == 3 || $request->contract_status == 4)){
                //if change the status from in wait to  cancle and blocked 
                $customer_old['remaining_money'] = $customer_id_old->remaining_money - $data->remind_price;
                $customer_old['paid_money'] = $customer_id_old->paid_money - ($data->pre_paid_price + $data->paid_price);
                $customer_old['total_money'] = $customer_id_old->total_money - $data->total_price;
                customer::where(['id' => $request->customer_id])->update($customer_old);
            }if(($data->contract_status == 3 || $data->contract_status == 4) && ($request->contract_status == 1 || $request->contract_status == 2)){
                //if change the status from  cancle and blocked to in wait  
                if ($data->total_price == $request->total_price) {
                    $data_to_update_customer['total_money'] = $customer_id->total_money +  $request->total_price;
                }
                if ($data->remind_price == $request->remind_price){
                    $data_to_update_customer['remaining_money'] = $customer_id->remaining_money +  $request->remind_price;
                }
                if (($data->pre_paid_price + $data->paid_price) == ($request->pre_paid_price + $request->paid_price)) {
                    $data_to_update_customer['paid_money'] = $customer_id->paid_money + ($request->pre_paid_price + $request->paid_price);
                }
            }
            else{
            if($request->customer_id != $data->customer_id){
                //if change the cutomer take the money to the new customer  
                $customer_old['remaining_money'] = $customer_id_old->remaining_money - $data->remind_price;
                $customer_old['paid_money'] = $customer_id_old->paid_money - ($data->pre_paid_price + $data->paid_price);
                $customer_old['total_money'] = $customer_id_old->total_money - $data->total_price;
                customer::where(['id' => $data->customer_id])->update($customer_old);
                if ($data->total_price == $request->total_price) {
                    $data_to_update_customer['total_money'] = $customer_id->total_money +  $request->total_price;
                }
                if ($data->remind_price == $request->remind_price){
                    $data_to_update_customer['remaining_money'] = $customer_id->remaining_money +  $request->remind_price;
                }
                if (($data->pre_paid_price + $data->paid_price) == ($request->pre_paid_price + $request->paid_price)) {
                    $data_to_update_customer['paid_money'] = $customer_id->paid_money + ($request->pre_paid_price + $request->paid_price);
                }
            }else{
                //if change the money  
                $customer_total_money = 0;
                if ($data->total_price < $request->total_price) {
                    $customer_total_money = $data->total_price - $request->total_price;
                    $data_to_update_customer['total_money'] = $customer_id->total_money -  $customer_total_money;
                } elseif ($data->total_price > $request->total_price) {
                    $customer_total_money = $request->total_price - $data->total_price;
                    $data_to_update_customer['total_money'] = $customer_id->total_money +  $customer_total_money;
                }
                $customer_remaining_money = 0;
                if ($data->remind_price < $request->remind_price) {
                    $customer_remaining_money = $data->remind_price - $request->remind_price;
                    $data_to_update_customer['remaining_money'] = $customer_id->remaining_money -  $customer_remaining_money;
                } elseif ($data->remind_price > $request->remind_price) {
                    $customer_remaining_money = $request->remind_price - $data->remind_price;
                    $data_to_update_customer['remaining_money'] = $customer_id->remaining_money +  $customer_remaining_money;
                }

                if (($data->pre_paid_price + $data->paid_price) < ($request->pre_paid_price + $request->paid_price)) {
                    $customer_paid_money = ($data->pre_paid_price + $data->paid_price) - ($request->pre_paid_price + $request->paid_price);
                    $data_to_update_customer['paid_money'] = $customer_id->paid_money -  $customer_paid_money;
                } elseif (($data->pre_paid_price + $data->paid_price) > ($request->pre_paid_price + $request->paid_price)) {
                    $customer_paid_money =  ($request->pre_paid_price + $request->paid_price) - ($data->pre_paid_price + $data->paid_price);
                    $data_to_update_customer['paid_money'] = $customer_id->paid_money + $customer_paid_money;
                }

            } 
                
        }
        if(isset($data_to_update_customer)){
            customer::where(['id' => $request->customer_id])->update($data_to_update_customer);
        }
        //create the debentures
        $data_Debentures['customer_id'] = $request->customer_id;
        $data_Debentures['paid_price'] =  ($request->pre_paid_price + $request->paid_price);
        $data_Debentures['payment_type'] = $request->payment_type;
        $data_Debentures['remind_price'] = $request->remind_price;
        debentures::where(['contract_id' => $id])->update($data_Debentures);

            if ($request->contract_status == 2) {
                $data_to_update_car['car_status'] = 0;
                Car::where(['id' => $request->car_id])->update($data_to_update_car);
            } else {
                $data_to_update_car['car_status'] = 1;
                Car::where(['id' => $request->car_id])->update($data_to_update_car);
            }
                 $car = Car::select()->find($request->car_id);
            if (!empty($request->return_km)) {
                $data_to_update_car['km_number'] = $request->return_km;
                 $data_to_update_car['km_for_mantince'] = $car->km_for_mantince + $request->total_km;
                Car::where(['id' => $request->car_id])->update($data_to_update_car);
            }

            $data_to_update['updated_at'] = date("Y-m-d H:i:s");
            $updated_by = auth()->user()->id;
            $data_to_update['updated_by'] = $updated_by;
           $contract =  Contract::where(['id' => $id])->update($data_to_update);
            if($data->contract_status != $request->contract_status ){
                            
        $Panel_settings = PanelSetting::find(1);
        
  
$name = auth()->user()->name;
$message = " تم تعديل حالة عقد اجار  رقم  $data->id بواسطة $name";
switch ($request->contract_status) {
    case 1:
        $status = 'مكتمل'; // Completed
        break;
    case 2:
        $status = 'في الانتظار'; // Pending
        break;
    case 3:
        $status = 'مرفوض'; // Rejected
        break;
    default:
        $status = 'ملغي'; // Cancelled
}
$route =$message.'                                               '.
'نوع الحجز:'. (($request->contract_type==1?'يومي':$request->contract_type==2)?' اسبوعي':'شهري').'                                               '.
' العدد/اليوم:'. $request->contract_number.'                                               '
.'حالة الحجز:'. $status .'                                               '
 .'رقم اللوحة:'. $car->plate_number.'                                               '
 .'تاريخ المغادرة:'. $request->exist_date.'                                               '
 .'وقت المغادرة:'. $request->exist_time.'                                               '
 .'تاريخ العودة:'. $request->return_date.'                                               '
 .'وقت العودة:'. $request->return_time.'                                               '
.'نوع السيارة:'.$car->type->name.'                                               '
.'موديل السيارة:'.$car->carModals->name.'                                               '.
'لون السيارة:'.$car->car_color.'                                               ' 
.'اسم العميل:'.$customer_id->name.'                                               '.
'رقم الهاتف:'.$customer_id->phone.'                                               '.
'رقم الهوية:'.$customer_id->identity_number;
   // Ensure you have a valid access token
        $access_token =  $Panel_settings->access_token; // Replace with a valid access token
        $instance_id =  $Panel_settings->Inctance_id;
       
        $url = "https://waclient.com/api/send?number={$Panel_settings->notfication_number}&type=text&message=$route&instance_id=$instance_id&access_token=$access_token";
        // Use cURL or file_get_contents to send the request if necessary
        $response = Http::get($url);  
       $response =  json_decode($response);
      
            }
            return redirect()->route('contracts.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        check_permission_sub_menue_actions_redirect(25);
        try {
            $Contracts = Contract::find($id);
  $checkExists = Debentures::where(['contract_id' => $Contracts->id])->first();
            if ($checkExists) {
                return redirect()->back()
           ->with(['error' => '   عفوا لا يمكن حذف الحجز لوجود سندات  مرتبطة به']);
            }
            if (!empty($Contracts)) {
                if ($Contracts->contract_status == 1) {
                    $customer_id = customer::select('contract_number', 'total_money', 'paid_money', 'remaining_money')->find($Contracts->customer_id);
                    $data_to_update_customer['total_money'] = $customer_id->total_money -  $Contracts->total_price;
                    $data_to_update_customer['remaining_money'] = $customer_id->remaining_money +  $Contracts->remind_price;
                    $data_to_update_customer['paid_money'] = $customer_id->paid_money - ($Contracts->pre_paid_price + $Contracts->paid_price);
                }
                $data_to_update_customer['contract_number'] = $customer_id->contract_number - 1;
                customer::where(['id' => $Contracts->customer_id])->update($data_to_update_customer);
                $Car = Car::select('contract_number', 'km_number')->find($Contracts->car_id);
                $data_to_update_car['car_status'] = 1;
                if (!empty($Contracts->return_km)) {
                    $data_to_update_car['km_number'] = $Car->km_number - $Contracts->return_km;
                }
                Car::where(['id' => $Contracts->car_id])->update($data_to_update_car);
                $flag = $Contracts->delete();
                if ($flag) {
                    return redirect()->back()
                        ->with(['success' => '   تم حذف البيانات بنجاح']);
                } else {
                    return redirect()->back()
                        ->with(['error' => 'عفوا حدث خطأ ما']);
                }
            } else {
                return redirect()->back()
                    ->with(['error' => 'عفوا لا  يمكن حذف البيانات لوجود منتجات  مرتبطة به']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }

    public function ajax_search(Request $request)
    {
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

            $data = Contract::where($field3, $operator3, $value3)->paginate(PAGINATION_COUNT);
            return view('admin.contracts.ajax_search', ['data' => $data]);
        }
    }
}
