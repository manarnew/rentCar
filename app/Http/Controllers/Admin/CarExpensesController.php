<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarExpensesRequest;
use App\Models\Car;
use App\Models\CarExpenses;
use App\Models\carType;
use Illuminate\Http\Request;

class CarExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(55);
        $data = CarExpenses::select()->orderby('id', 'DESC')->paginate(10);
        $carType = carType::select()->orderby('id', 'DESC')->get();
        return view('admin.CarExpenses.index', ['data' => $data, 'carType' => $carType]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        check_permission_sub_menue_actions_redirect(56);
        $car_id = Car::select()->orderby('id', 'DESC')->get();
        return view('admin.CarExpenses.create', ['car_id' => $car_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarExpensesRequest $request)
    {
        check_permission_sub_menue_actions_redirect(56);
        try {
            $id = auth()->user()->id;
            $data['car_id'] = $request->car_id;  
            $data['type_id'] = $request->type_id;  
            $data['supplier'] = $request->supplier;  
            $data['price'] = $request->price;  
            $data['tax'] = $request->tax;  
            $data['total_price_tax'] = $request->tax + $request->price;  
            $data['note'] = $request->note;  
            $data['date'] = date("Y-m-d");  
            $data['added_by'] = $id;  
            $data['created_at'] = date("Y-m-d H:i:s");
            if ($request->image) {
                $data['image'] =  $this->uploadImage($request->image);
            }
            CarExpenses::create($data);
            return redirect()->route('CarExpenses.index')->with(['success' => __('controller.data_added')]);
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        check_permission_sub_menue_actions_redirect(57);
        $car_id = Car::select()->orderby('id', 'DESC')->get();
        $data = CarExpenses::select()->find($id);
        return view('admin.CarExpenses.edit', ['data' => $data, 'car_id' => $car_id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarExpensesRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(57);
        try {
            $data = CarExpenses::select()->find($id);
            if (empty($data)) {
                return redirect()->route('CarExpenses.index')->with(['error' => __('controller.data_not_found')]);
            }
            $data_to_update['car_id'] = $request->car_id;  
            $data_to_update['type_id'] = $request->type_id;  
            $data_to_update['supplier'] = $request->supplier;  
            $data_to_update['price'] = $request->price;  
            $data_to_update['tax'] = $request->tax;  
            $data_to_update['total_price_tax'] = $request->tax + $request->price;  
            $data_to_update['note'] = $request->note;  
            $data_to_update['updated_at'] = now();
            $data_to_update['updated_by'] = auth()->user()->id;

            if ($request->image) {
                $data_to_update['image'] =  $this->updateImage($request->image, $data->image);
            }
            CarExpenses::where(['id' => $id])->update($data_to_update);
            return redirect()->route('CarExpenses.index')->with(['success' => __('controller.data_updated')]);
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

    public function show(string $id)
    {
        check_permission_sub_menue_actions_redirect(58);
        $data = CarExpenses::select()->find($id);
        return view('admin.CarExpenses.show', ['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        check_permission_sub_menue_actions_redirect(59);
        try {
            $CarExpenses = CarExpenses::find($id);
            if (!empty($CarExpenses)) {
                $flag = $CarExpenses->delete();
                if ($flag) {
                    return redirect()->back()->with(['success' => __('controller.data_deleted')]);
                } else {
                    return redirect()->back()->with(['error' => __('controller.error_occurred')]);
                }
            } else {
                return redirect()->back()->with(['error' => __('controller.cannot_delete_linked_data')]);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('controller.error_occurred') . $ex->getMessage()]);
        }
    }

    public function ajax_get_car(Request $request)
    {
        if ($request->ajax()) {
            $search_car_type = $request->search_car_type_id_search;
            $data = Car::select()->where("plate_number", "=", $search_car_type)->orderBy('id', 'DESC')->first();

            return view('admin.CarExpenses.ajax_get_car', ['data' => $data]);
        }
    }

    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $search_by_text = $request->search_by_text;
            $search_car_type_id_search = $request->search_car_type_id_search;

            if ($search_by_text == 'all') {     
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "car_id";
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

            $data = CarExpenses::where($field1, $operator1, "%{$value1}%")
                ->where($field2, $operator2, $value2)
                ->paginate(PAGINATION_COUNT);
            return view('admin.CarExpenses.ajax_search', ['data' => $data]);
        }
    }
}