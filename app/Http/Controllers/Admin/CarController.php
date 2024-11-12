<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\carRequest;
use App\Models\Car;
use App\Models\CarExpenses;
use App\Models\CarModals;
use App\Models\CarStatus;
use App\Models\carType;
use App\Models\Contracts;
use App\Models\PanelSetting;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(18);
        $carModals = CarModals::select()->orderby('id', 'DESC')->get();
        $carType = carType::select()->orderby('id', 'DESC')->get();
        $data = Car::select()->orderby('id', 'DESC')->paginate(10);
        return view('admin.cars.index', ['data' => $data, 'carModals' => $carModals, 'carType' => $carType]);
    }
       public function license_end_date()
    {
      
        $data = Car::select()->whereDate('driver_license_end_date','<=',Date("Y-m-d"))->orderby('id', 'DESC')->paginate(10);
        return view('admin.cars.license_end_date', ['data' => $data]);
    }
    public function mantince_notf()
    {
       $Panel_settings = PanelSetting::first();
        $data = Car::select()->where('km_for_mantince','>=',$Panel_settings->number_of_km_mantince)->orderby('id', 'DESC')->paginate(10);
        return view('admin.cars.license_end_date', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        check_permission_sub_menue_actions_redirect(19);
        $carModals = CarModals::select()->orderby('id', 'DESC')->get();
        $carType = carType::select()->orderby('id', 'DESC')->get();
        return view('admin.cars.create', ['carModals' => $carModals, 'carType' => $carType]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(carRequest $request)
    {
        check_permission_sub_menue_actions_redirect(19);
        try {
            $com_code = auth()->user()->com_code;
            $id = auth()->user()->id;
            $checkExists = Car::where(['plate_number' => $request->plate_number])->first();
            if ($checkExists == null) {
                $data['plate_number'] = $request->plate_number;
                $data['car_color'] = $request->car_color;
                $data['type_id'] = $request->type_id;
                $data['insurance'] = $request->insurance;
                $data['car_modals_id'] = $request->car_modals_id;
                $data['car_status'] = 1;
                $data['full_insurance'] = $request->full_insurance;
                $data['third_party'] = $request->third_party;
                $data['full_cover'] = $request->full_cover;
                $data['UAE'] = $request->UAE;
                $data['oman'] = $request->oman;
                $data['daily_rent_price'] = $request->daily_rent_price;
                $data['weekly_rent_price'] = $request->weekly_rent_price;
                $data['monthly_rent_price'] = $request->monthly_rent_price;
                $data['hourly_rent_price'] = $request->hourly_rent_price;
                $data['km_rent_price'] = $request->km_rent_price;
                $data['km_number'] = $request->km_number;
                $data['km_for_mantince'] = $request->km_for_mantince;
                $data['driver_license_end_date'] = $request->driver_license_end_date;
                $data['com_code'] = $com_code;
                $data['added_by'] = $id;
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['date'] = date("Y-m-d");
                if ($request->image) {
                    $data['image'] =  $this->uplaodImage($request->image);
                }
                
                 if ($request->car_own_image_front) {
                    $data['car_own_image_front'] =  $this->uplaodImage($request->car_own_image_front);
                }
                if ($request->car_own_image_back) {
                    $data['car_own_image_back'] =  $this->uplaodImage($request->car_own_image_back);
                }
                if ($request->card_run_image_back) {
                    $data['card_run_image_back'] =  $this->uplaodImage($request->card_run_image_back);
                }
                if ($request->card_run_image_front) {
                    $data['card_run_image_front'] =  $this->uplaodImage($request->card_run_image_front);
                }
                Car::create($data);
                return redirect()->route('admin.car.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
                return redirect()->back()
                    ->with(['error' => 'عفوا رقم اللوحة مسجل من قبل'])
                    ->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }
    public function uplaodImage($imageRequest)
    {
        $image = $imageRequest;
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
        check_permission_sub_menue_actions_redirect(22);
        $data = Car::select()->find($id);
        return view('admin.cars.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        check_permission_sub_menue_actions_redirect(20);
        $carModals = CarModals::select()->orderby('id', 'DESC')->get();
        $carType = carType::select()->orderby('id', 'DESC')->get();
        $data = Car::select()->find($id);
        return view('admin.cars.edit', ['data' => $data, 'carModals' => $carModals, 'carType' => $carType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(carRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(20);
        try {
            $data = Car::select()->find($id);
            if (empty($data)) {
                return redirect()->route('admin.car.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists = Car::where(['plate_number' => $request->name])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => 'عفوا رقم اللوحة مسجل من قبل'])
                    ->withInput();
            }


            if ($checkExists == null) {
                $data_to_update['plate_number'] = $request->plate_number;
                $data_to_update['car_color'] = $request->car_color;
                $data_to_update['type_id'] = $request->type_id; 
                $data_to_update['insurance'] = $request->insurance;
                $data_to_update['car_modals_id'] = $request->car_modals_id;
                $data_to_update['car_status'] = 1;
                $data_to_update['full_insurance'] = $request->full_insurance;
                $data_to_update['third_party'] = $request->third_party;
                $data_to_update['full_cover'] = $request->full_cover;
                $data_to_update['UAE'] = $request->UAE;
                $data_to_update['oman'] = $request->oman;
                $data_to_update['daily_rent_price'] = $request->daily_rent_price;
                $data_to_update['weekly_rent_price'] = $request->weekly_rent_price;
                $data_to_update['monthly_rent_price'] = $request->monthly_rent_price;
                $data_to_update['hourly_rent_price'] = $request->hourly_rent_price;
                $data_to_update['km_rent_price'] = $request->km_rent_price;
                $data_to_update['km_number'] = $request->km_number;
                $data_to_update['km_for_mantince'] = $request->km_for_mantince;
                $data_to_update['driver_license_end_date'] = $request->driver_license_end_date;
                $data_to_update['date'] = date("Y-m-d");
                if ($request->image) {
                    $data_to_update['image'] =  $this->updateImage($request->image, $data['image']);
                }
                 if ($request->car_own_image_front) {
                    $data_to_update['car_own_image_front'] =  $this->updateImage($request->car_own_image_front, $data['car_own_image_front']);
                }
                if ($request->car_own_image_back) {
                    $data_to_update['car_own_image_back'] =  $this->updateImage($request->car_own_image_back, $data['car_own_image_back']);
                }
                if ($request->card_run_image_back) {
                    $data_to_update['card_run_image_back'] =  $this->updateImage($request->card_run_image_back, $data['card_run_image_back']);
                }
                if ($request->card_run_image_front) {
                    $data_to_update['card_run_image_front'] =  $this->updateImage($request->card_run_image_front, $data['card_run_image_front']);
                }
                $data_to_update['updated_at'] = date("Y-m-d H:i:s");
                $ids = auth()->user()->id;
                $data_to_update['updated_by'] = $ids;
                Car::where(['id' => $id])->update($data_to_update);
                return redirect()->route('admin.car.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }
    public function updateImage($requestImage, $dataImage)
    {
        $image = $requestImage;
        if ($image) {
            $extension = strtolower($image->extension());
            $filename = time() . rand(100, 999) . '.' . $extension;
            $image->getClientOriginalName = $filename;
            $folder = 'assets/admin/uploads';
            $image->move($folder, $filename);
            if (file_exists('assets/admin/uploads/' . $dataImage) and !empty($dataImage)) {
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
        check_permission_sub_menue_actions_redirect(21);
        try {
            $item_row = Car::find($id);
            if (!empty($item_row)) {
                $checkExists = Contracts::where(['car_id' => $item_row->id])->first();
                if ($checkExists) {
                    return redirect()->back()
                    ->with(['error' => '   عفوا لا يمكن حذف السيارة  لوجود عقود مرتبطة بهاء']);
                }
                $checkExists = CarExpenses::where(['car_id' => $item_row->id])->first();
                if ($checkExists) {
                    return redirect()->back()
                    ->with(['error' => '   عفوا لا يمكن حذف السيارة  لوجود منصرفات مرتبطة بهاء']);
                }
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
            $search_car_type_id_search = $request->search_car_type_id_search;
            $search_car_status_id_search = $request->search_car_status_id_search;
            if ($search_by_text == 'all') {     
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "plate_number";
                $operator1 = "LIKE";
                $value1 = $search_by_text;
            }
            if ($search_car_type_id_search == 'all') {
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "type_id";
                $operator2 = "=";
                $value2 = $search_car_type_id_search;
            }
            if ($search_car_status_id_search == 'all') {
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "car_status";
                $operator3 = "=";
                $value3 = $search_car_status_id_search;
            }

            $data = Car::where($field1, $operator1, "%{$value1}%")->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->paginate(PAGINATION_COUNT);
            return view('admin.cars.ajax_search', ['data' => $data]);
        }
    }
}
