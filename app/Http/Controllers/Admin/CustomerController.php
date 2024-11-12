<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\customerRequest;
use App\Models\Contract;
use App\Models\BlackList;
use App\Models\PanelSetting;
use Illuminate\Support\Facades\Http;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(1);
        $data = Customer::select()->orderby('id', 'DESC')->paginate(10);
        foreach($data as $info){
           $customer = BlackList::select('id')->where('customer_id',$info->id)->first();
            if($customer){
                $info->customer_status = 0;
            }else{
                $info->customer_status =1;
            }
            
        }
        return view('admin.customers.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        check_permission_sub_menue_actions_redirect(2);
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(customerRequest $request)
    {
        check_permission_sub_menue_actions_redirect(2);
        try {
            $com_code = auth()->user()->com_code;
            $id = auth()->user()->id;
            $checkExists = customer::where(['name' => $request->name])->
            where(['phone' => $request->phone])->first();
            if ($checkExists == null) {
                $data['name'] = $request->name;  
                $data['com_name'] = $request->com_name;  
                $data['identity_number'] = $request->identity_number;  
                $data['phone'] = $request->phone;  
                $data['email'] = $request->email;  
                $data['address'] = $request->address;  
                $data['identity_release_date'] = $request->identity_release_date;  
                $data['identity_end_date'] = $request->identity_end_date;  
                $data['identity_address'] = $request->identity_address;  
                $data['word_address'] = $request->word_address;  
                $data['nationality'] = $request->nationality;  
                $data['driver_license_number'] = $request->driver_license_number;  
                $data['driver_license_address'] = $request->driver_license_address;  
                $data['driver_license_release_date'] = $request->driver_license_release_date;  
                $data['driver_license_address_end_date'] = $request->driver_license_address_end_date;  
                $data['details'] = $request->details;  
                $data['com_code'] = $com_code;  
                $data['added_by'] = $id;  
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['date'] = date("Y-m-d");
                if($request->identity_front_image){
                    $data['identity_front_image'] =  $this->uplaodImage($request->identity_front_image);
                }
                if($request->identity_back_image){
                    $data['identity_back_image'] =  $this->uplaodImage($request->identity_back_image);
                }
                if($request->driver_license_front_image){
                    $data['driver_license_front_image'] =  $this->uplaodImage($request->driver_license_front_image);
                }
                if($request->driver_license_back_image){
                    $data['driver_license_back_image'] =  $this->uplaodImage($request->driver_license_back_image);
                }
                customer::create($data);
                return redirect()->route('admin.customer.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الفئة مسجل من قبل'])
                    ->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }
    public function uplaodImage($imageRequest){
                $image= $imageRequest;
                $extension = strtolower($image->extension());
                $filename = time() . rand(100, 999) . '.' . $extension;
                $image->getClientOriginalName = $filename;
                $folder = 'assets/admin/uploads';
                $image->move($folder, $filename);
                return $filename;
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        check_permission_sub_menue_actions_redirect(43);
        $data = customer::select()->find($id);
        return view('admin.customers.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        check_permission_sub_menue_actions_redirect(3);
        $data = customer::select()->find($id);
        return view('admin.customers.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(customerRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(3);
        try {
            $data = customer::select()->find($id);
            if (empty($data)) {
                return redirect()->route('admin.customers.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists = customer::where(['name' => $request->name])
            ->where(['phone' => $request->phone])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الخزنة مسجل من قبل'])
                    ->withInput();
            }

            $data_to_update['name'] = $request->name;  
            $data_to_update['com_name'] = $request->com_name;  
            $data_to_update['identity_number'] = $request->identity_number;  
            $data_to_update['phone'] = $request->phone;  
            $data_to_update['email'] = $request->email;  
            $data_to_update['address'] = $request->address;  
            $data_to_update['nationality'] = $request->nationality;  
            $data_to_update['driver_license_number'] = $request->driver_license_number;  
            $data_to_update['driver_license_address'] = $request->driver_license_address;  
            $data_to_update['driver_license_release_date'] = $request->driver_license_release_date;  
            $data_to_update['driver_license_address_end_date'] = $request->driver_license_address_end_date;  
            $data_to_update['details'] = $request->details;  
            $data_to_update['identity_release_date'] = $request->identity_release_date;  
            $data_to_update['identity_end_date'] = $request->identity_end_date;  
            $data_to_update['identity_address'] = $request->identity_address;  
            $data_to_update['word_address'] = $request->word_address; 
            $updated_by = auth()->user()->id;
            $data_to_update['updated_by'] = $updated_by;
            $data_to_update['updated_at'] = date("Y-m-d H:i:s");
            $data_to_update['date'] = date("Y-m-d");
            
            if($request->identity_front_image){
                $data_to_update['identity_front_image'] =  $this->updateImage($request->identity_front_image,$data['identity_front_image'],$request);
            }
            if($request->identity_back_image){
                $data_to_update['identity_back_image'] =  $this->updateImage($request->identity_back_image,$data['identity_back_image'],$request);
            }
            if($request->driver_license_front_image){
                $data_to_update['driver_license_front_image'] =  $this->updateImage($request->driver_license_front_image,$data['driver_license_front_image'],$request);
            }
            if($request->driver_license_back_image){
                $data_to_update['driver_license_back_image'] =  $this->updateImage($request->driver_license_back_image,$data['driver_license_back_image'],$request);
            }

            customer::where(['id' => $id])->update($data_to_update);
            return redirect()->route('admin.customer.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }
 public function updateImage($requestImage,$dataImage,$request){
    $image= $requestImage;
    if ( $image) {
        $extension = strtolower($image->extension());
        $filename = time() . rand(100, 999) . '.' . $extension;
        $image->getClientOriginalName = $filename;
        $folder = 'assets/admin/uploads';
        $image->move($folder, $filename);
        if (file_exists('assets/admin/uploads/' .$dataImage) and !empty($dataImage)) {
            unlink('assets/admin/uploads/' . $dataImage);
        }
        return $filename;
        }
 }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        check_permission_sub_menue_actions_redirect(4);
        try {
            $item_row = customer::find($id);
              $checkExists = Contract::where(['customer_id' => $item_row->id])->first();
            if ($checkExists) {
                return redirect()->back()
                ->with(['error' => '   عفوا لا يمكن حذف العميل لوجود حجوزات مرتبطة به']);
            }
            if (!empty($item_row)) {
            $flag = $item_row->delete();
            if ($flag) {
            return redirect()->back()
            ->with(['success' => '   تم حذف البيانات بنجاح']);
            } else {
            return redirect()->back()
            ->with(['error' => 'عفوا حدث خطأ ما']);
            }
            } else {
            return redirect()->back()
            ->with(['error' => 'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
            }
            } catch (\Exception $ex) {
            return redirect()->back()
            ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
            }
    }

    
    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $search_by_text = $request->search_by_text;
            $search_searchbyradio = $request->search_searchbyradio;
            if ($search_by_text == 'all') {     
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else { 
                if($search_searchbyradio=="name"){
                    $field1 = "name";
                    $operator1 = "LIKE";
                    $value1 = $search_by_text;
                }elseif($search_searchbyradio=="com_name"){
                    $field1 = "com_name";
                    $operator1 = "LIKE";
                    $value1 = $search_by_text;
                }elseif($search_searchbyradio=="identity_number"){
                    $field1 = "identity_number";
                    $operator1 = "LIKE";
                    $value1 = $search_by_text;
                }elseif($search_searchbyradio=="driver_license_number"){
                    $field1 = "driver_license_number";
                    $operator1 = "LIKE";
                    $value1 = $search_by_text;
                }
               
            }
          

            $data = Customer::where($field1, $operator1, "%{$value1}%")->paginate(PAGINATION_COUNT);
            return view('admin.customers.ajax_search', ['data' => $data]);
        }
    }
    
       
    public function ajax_search_genral(Request $request)
    {
            $search_type = $request->search_type;
            $search_by_text = $request->search_by_text;
            if ($search_type == 1) {     
                check_permission_sub_menue_actions_redirect(43);
                $data = customer::select()->where('identity_number',$search_by_text)->first();
                if(!$data){
                    return view('admin.customers.empty', ['data' => $data]);
                }
                return view('admin.customers.show', ['data' => $data]);
            } 
            else if ($search_type == 2) {     
                check_permission_sub_menue_actions_redirect(43);
                $data = customer::select()->where('driver_license_number',$search_by_text)->first();
                if(!$data){
                    return view('admin.customers.empty', ['data' => $data]);
                }
                return view('admin.customers.show', ['data' => $data]);
            } 
            else{
                check_permission_sub_menue_actions_redirect(26);
                $data = Contract::select()->where('id',$search_by_text)->first();
                if(!$data){
                    return view('admin.customers.empty', ['data' => $data]);
                }
                return view('admin.invoice.invoice', ['data' => $data]);
            }
           
    }
     public function ajax_search_genral_get($id)
    {
        
                $id_get = base64_decode($id);
                $data = Contract::select()->where('id',$id_get)->first();
                if(!$data){
                    return view('admin.customers.empty', ['data' => $data]);
                }
                return view('admin.invoice.invoice', ['data' => $data]);
    }
    public function send($id)
    {  
        $item_row = customer::find($id);
         $Panel_settings = PanelSetting::find(1);
        $id_get = base64_encode($id);
        
        $message = $Panel_settings->message; 
        $route =$message."                                               " . route('admin.customer.ajax_search_genral_get', $id_get);
        
        // Ensure you have a valid access token
        $access_token =  $Panel_settings->access_token; // Replace with a valid access token
        $instance_id =  $Panel_settings->Inctance_id;
       
        $url = "https://waclient.com/api/send?number={$item_row->phone}&type=text&message=$route&instance_id=$instance_id&access_token=$access_token";
        
        // Use cURL or file_get_contents to send the request if necessary
        $response = Http::get($url);  
       $response =  json_decode($response);
        if($response->status == "success"){
                    return redirect()->back()->with(['success' => 'تم ارسال البيانات بنجاح']);
        }else{
            return redirect()->back()->with(['error' => 'لم يتم ارسال البيانات راجع الرقم المرسل الية']);
        }
        // Handle the response here if needed
        

    }
}
