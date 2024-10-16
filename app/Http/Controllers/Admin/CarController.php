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
use App\Models\Panel_settings;
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
        $data = Car::select()->whereDate('driver_license_end_date', '<=', now())->orderby('id', 'DESC')->paginate(10);
        return view('admin.cars.license_end_date', ['data' => $data]);
    }

    public function mantince_notf()
    {
        $Panel_settings = Panel_settings::first();
        $data = Car::select()->where('km_for_mantince', '>=', $Panel_settings->number_of_km_mantince)->orderby('id', 'DESC')->paginate(10);
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
                $data = [
                    'plate_number' => $request->plate_number,
                    'car_color' => $request->car_color,
                    'type_id' => $request->type_id,
                    'insurance' => $request->insurance,
                    'car_modals_id' => $request->car_modals_id,
                    'car_status' => 1,
                    'full_insurance' => $request->full_insurance,
                    'third_party' => $request->third_party,
                    'full_cover' => $request->full_cover,
                    'UAE' => $request->UAE,
                    'oman' => $request->oman,
                    'daily_rent_price' => $request->daily_rent_price,
                    'weekly_rent_price' => $request->weekly_rent_price,
                    'monthly_rent_price' => $request->monthly_rent_price,
                    'hourly_rent_price' => $request->hourly_rent_price,
                    'km_rent_price' => $request->km_rent_price,
                    'km_number' => $request->km_number,
                    'km_for_mantince' => $request->km_for_mantince,
                    'driver_license_end_date' => $request->driver_license_end_date,
                    'com_code' => $com_code,
                    'added_by' => $id,
                    'created_at' => now(),
                    'date' => now()->format('Y-m-d'),
                ];

                if ($request->image) {
                    $data['image'] = $this->uploadImage($request->image);
                }
                if ($request->car_own_image_front) {
                    $data['car_own_image_front'] = $this->uploadImage($request->car_own_image_front);
                }
                if ($request->car_own_image_back) {
                    $data['car_own_image_back'] = $this->uploadImage($request->car_own_image_back);
                }
                if ($request->card_run_image_back) {
                    $data['card_run_image_back'] = $this->uploadImage($request->card_run_image_back);
                }
                if ($request->card_run_image_front) {
                    $data['card_run_image_front'] = $this->uploadImage($request->card_run_image_front);
                }
                Car::create($data);
                return redirect()->route('admin.car.index')->with(['success' => __('controller.data_added')]);
            } else {
                return redirect()->back()
                    ->with(['error' => __('controller.plate_number_exists')])
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
                return redirect()->route('admin.car.index')->with(['error' => __('controller.data_not_found')]);
            }
            $checkExists = Car::where(['plate_number' => $request->plate_number])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => __('controller.plate_number_exists')])
                    ->withInput();
            }

            $data_to_update = [
                'plate_number' => $request->plate_number,
                'car_color' => $request->car_color,
                'type_id' => $request->type_id,
                'insurance' => $request->insurance,
                'car_modals_id' => $request->car_modals_id,
                'car_status' => 1,
                'full_insurance' => $request->full_insurance,
                'third_party' => $request->third_party,
                'full_cover' => $request->full_cover,
                'UAE' => $request->UAE,
                'oman' => $request->oman,
                'daily_rent_price' => $request->daily_rent_price,
                'weekly_rent_price' => $request->weekly_rent_price,
                'monthly_rent_price' => $request->monthly_rent_price,
                'hourly_rent_price' => $request->hourly_rent_price,
                'km_rent_price' => $request->km_rent_price,
                'km_number' => $request->km_number,
                'km_for_mantince' => $request->km_for_mantince,
                'driver_license_end_date' => $request->driver_license_end_date,
                'date' => now()->format('Y-m-d'),
                'updated_at' => now(),
                'updated_by' => auth()->user()->id,
            ];

            if ($request->image) {
                $data_to_update['image'] = $this->updateImage($request->image, $data['image']);
            }
            if ($request->car_own_image_front) {
                $data_to_update['car_own_image_front'] = $this->updateImage($request->car_own_image_front, $data['car_own_image_front']);
            }
            if ($request->car_own_image_back) {
                $data_to_update['car_own_image_back'] = $this->updateImage($request->car_own_image_back, $data['car_own_image_back']);
            }
            if ($request->card_run_image_back) {
                $data_to_update['card_run_image_back'] = $this->updateImage($request->card_run_image_back, $data['card_run_image_back']);
            }
            if ($request->card_run_image_front) {
                $data_to_update['card_run_image_front'] = $this->updateImage($request->card_run_image_front, $data['card_run_image_front']);
            }

            Car::where(['id' => $id])->update($data_to_update);
            return redirect()->route('admin.car.index')->with(['success' => __('controller.data_updated')]);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()])
                ->withInput();
        }
    }

    public function updateImage($requestImage, $dataImage)
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
        check_permission_sub_menue_actions_redirect(21);
        try {
            $item_row = Car::find($id);
            if (!empty($item_row)) {
                $checkExists = Contracts::where(['car_id' => $item_row->id])->first();
                if ($checkExists) {
                    return redirect()->back()->with(['error' => __('controller.cannot_delete_linked_contracts')]);
                }
                $checkExists = CarExpenses::where(['car_id' => $item_row->id])->first();
                if ($checkExists) {
                    return redirect()->back()->with(['error' => __('controller.cannot_delete_linked_expenses')]);
                }
                $flag = $item_row->delete();
                if ($flag) {
                    return redirect()->back()->with(['success' => __('controller.data_deleted')]);
                } else {
                    return redirect()->back()->with(['error' => __('controller.error_occurred')]);
                }
            } else {
                return redirect()->back()->with(['error' => __('controller.data_not_found')]);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('controller.error_occurred') . $ex->getMessage()]);
        }
    }

    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $search_by_text = $request->search_by_text;
            $search_car_type_id_search = $request->search_car_type_id_search;
            $search_car_status_id_search = $request->search_car_status_id_search;

            $field1 = $search_by_text == 'all' ? "id" : "plate_number";
            $operator1 = $search_by_text == 'all' ? ">" : "LIKE";
            $value1 = $search_by_text == 'all' ? 0 : $search_by_text;

            $field2 = $search_car_type_id_search == 'all' ? "id" : "type_id";
            $operator2 = $search_car_type_id_search == 'all' ? ">" : "=";
            $value2 = $search_car_type_id_search == 'all' ? 0 : $search_car_type_id_search;

            $field3 = $search_car_status_id_search == 'all' ? "id" : "car_status";
            $operator3 = $search_car_status_id_search == 'all' ? ">" : "=";
            $value3 = $search_car_status_id_search == 'all' ? 0 : $search_car_status_id_search;

            $data = Car::where($field1, $operator1, "%{$value1}%")
                ->where($field2, $operator2, $value2)
                ->where($field3, $operator3, $value3)
                ->paginate(PAGINATION_COUNT);

            return view('admin.cars.ajax_search', ['data' => $data]);
        }
    }
}