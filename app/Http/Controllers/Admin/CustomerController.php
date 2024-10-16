<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\customerRequest;
use App\Models\Contracts;
use App\Models\Black_lists;
use App\Models\Panel_settings;
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
        foreach ($data as $info) {
            $customer = Black_lists::select('id')->where('customer_id', $info->id)->first();
            $info->customer_status = $customer ? 0 : 1;
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
            $checkExists = Customer::where(['name' => $request->name])
                ->where(['phone' => $request->phone])->first();

            if ($checkExists == null) {
                $data = [
                    'name' => $request->name,
                    'com_name' => $request->com_name,
                    'identity_number' => $request->identity_number,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'identity_release_date' => $request->identity_release_date,
                    'identity_end_date' => $request->identity_end_date,
                    'identity_address' => $request->identity_address,
                    'word_address' => $request->word_address,
                    'nationality' => $request->nationality,
                    'driver_license_number' => $request->driver_license_number,
                    'driver_license_address' => $request->driver_license_address,
                    'driver_license_release_date' => $request->driver_license_release_date,
                    'driver_license_address_end_date' => $request->driver_license_address_end_date,
                    'details' => $request->details,
                    'com_code' => $com_code,
                    'added_by' => $id,
                    'created_at' => now(),
                    'date' => now()->toDateString(),
                ];

                if ($request->identity_front_image) {
                    $data['identity_front_image'] = $this->uploadImage($request->identity_front_image);
                }
                if ($request->identity_back_image) {
                    $data['identity_back_image'] = $this->uploadImage($request->identity_back_image);
                }
                if ($request->driver_license_front_image) {
                    $data['driver_license_front_image'] = $this->uploadImage($request->driver_license_front_image);
                }
                if ($request->driver_license_back_image) {
                    $data['driver_license_back_image'] = $this->uploadImage($request->driver_license_back_image);
                }

                Customer::create($data);
                return redirect()->route('admin.customer.index')->with(['success' => __('controller.data_added_successfully')]);
            } else {
                return redirect()->back()
                    ->with(['error' => __('controller.customer_already_exists')])
                    ->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()])
                ->withInput();
        }
    }

    public function uploadImage($imageRequest)
    {
        $image = $imageRequest;
        $extension = strtolower($image->extension());
        $filename = time() . rand(100, 999) . '.' . $extension;
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
        $data = Customer::select()->find($id);
        return view('admin.customers.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        check_permission_sub_menue_actions_redirect(3);
        $data = Customer::select()->find($id);
        return view('admin.customers.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(customerRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(3);
        try {
            $data = Customer::select()->find($id);
            if (empty($data)) {
                return redirect()->route('admin.customers.index')->with(['error' => __('controller.data_not_found')]);
            }

            $checkExists = Customer::where(['name' => $request->name])
                ->where(['phone' => $request->phone])
                ->where('id', '!=', $id)->first();

            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => __('controller.customer_already_exists')])
                    ->withInput();
            }

            $data_to_update = [
                'name' => $request->name,
                'com_name' => $request->com_name,
                'identity_number' => $request->identity_number,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'nationality' => $request->nationality,
                'driver_license_number' => $request->driver_license_number,
                'driver_license_address' => $request->driver_license_address,
                'driver_license_release_date' => $request->driver_license_release_date,
                'driver_license_address_end_date' => $request->driver_license_address_end_date,
                'details' => $request->details,
                'identity_release_date' => $request->identity_release_date,
                'identity_end_date' => $request->identity_end_date,
                'identity_address' => $request->identity_address,
                'word_address' => $request->word_address,
                'updated_by' => auth()->user()->id,
                'updated_at' => now(),
                'date' => now()->toDateString(),
            ];

            if ($request->identity_front_image) {
                $data_to_update['identity_front_image'] = $this->updateImage($request->identity_front_image, $data['identity_front_image'], $request);
            }
            if ($request->identity_back_image) {
                $data_to_update['identity_back_image'] = $this->updateImage($request->identity_back_image, $data['identity_back_image'], $request);
            }
            if ($request->driver_license_front_image) {
                $data_to_update['driver_license_front_image'] = $this->updateImage($request->driver_license_front_image, $data['driver_license_front_image'], $request);
            }
            if ($request->driver_license_back_image) {
                $data_to_update['driver_license_back_image'] = $this->updateImage($request->driver_license_back_image, $data['driver_license_back_image'], $request);
            }

            Customer::where(['id' => $id])->update($data_to_update);
            return redirect()->route('admin.customer.index')->with(['success' => __('controller.data_updated_successfully')]);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()])
                ->withInput();
        }
    }

    public function updateImage($requestImage, $dataImage, $request)
    {
        $image = $requestImage;
        if ($image) {
            $extension = strtolower($image->extension());
            $filename = time() . rand(100, 999) . '.' . $extension;
            $folder = 'assets/admin/uploads';
            $image->move($folder, $filename);
            if (file_exists('assets/admin/uploads/' . $dataImage) && !empty($dataImage)) {
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
            $item_row = Customer::find($id);
            $checkExists = Contracts::where(['customer_id' => $item_row->id])->first();
            if ($checkExists) {
                return redirect()->back()
                    ->with(['error' => __('controller.customer_has_bookings')]);
            }
            if (!empty($item_row)) {
                $flag = $item_row->delete();
                return redirect()->back()
                    ->with(['success' => __('controller.data_deleted_successfully')]);
            } else {
                return redirect()->back()
                    ->with(['error' => __('controller.data_not_found')]);
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()]);
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
                if ($search_searchbyradio == "name") {
                    $field1 = "name";
                    $operator1 = "LIKE";
                    $value1 = $search_by_text;
                } elseif ($search_searchbyradio == "com_name") {
                    $field1 = "com_name";
                    $operator1 = "LIKE";
                    $value1 = $search_by_text;
                } elseif ($search_searchbyradio == "identity_number") {
                    $field1 = "identity_number";
                    $operator1 = "LIKE";
                    $value1 = $search_by_text;
                } elseif ($search_searchbyradio == "driver_license_number") {
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
            $data = Customer::select()->where('identity_number', $search_by_text)->first();
            if (!$data) {
                return view('admin.customers.empty', ['data' => $data]);
            }
            return view('admin.customers.show', ['data' => $data]);
        } elseif ($search_type == 2) {
            check_permission_sub_menue_actions_redirect(43);
            $data = Customer::select()->where('driver_license_number', $search_by_text)->first();
            if (!$data) {
                return view('admin.customers.empty', ['data' => $data]);
            }
            return view('admin.customers.show', ['data' => $data]);
        } else {
            check_permission_sub_menue_actions_redirect(26);
            $data = Contracts::select()->where('id', $search_by_text)->first();
            if (!$data) {
                return view('admin.customers.empty', ['data' => $data]);
            }
            return view('admin.invoice.invoice', ['data' => $data]);
        }
    }

    public function ajax_search_genral_get($id)
    {
        $id_get = base64_decode($id);
        $data = Contracts::select()->where('id', $id_get)->first();
        if (!$data) {
            return view('admin.customers.empty', ['data' => $data]);
        }
        return view('admin.invoice.invoice', ['data' => $data]);
    }

    public function send($id)
    {
        $item_row = Customer::find($id);
        $Panel_settings = Panel_settings::find(1);
        $id_get = base64_encode($id);

        $message = $Panel_settings->message;
        $route = $message . " " . route('admin.customer.ajax_search_genral_get', $id_get);

        // Ensure you have a valid access token
        $access_token = $Panel_settings->access_token; 
        $instance_id = $Panel_settings->Inctance_id;

        $url = "https://waclient.com/api/send?number={$item_row->phone}&type=text&message=$route&instance_id=$instance_id&access_token=$access_token";
        
        // Use Http to send the request
        $response = Http::get($url);
        $response = json_decode($response);
        
        if ($response->status == "success") {
            return redirect()->back()->with(['success' => __('controller.data_sent_successfully')]);
        } else {
            return redirect()->back()->with(['error' => __('controller.data_not_sent')]);
        }
    }
}