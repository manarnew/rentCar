<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\carTypeRequest;
use App\Models\Car;
use App\Models\carType;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(5);
        $data = carType::select()->orderby('id', 'DESC')->paginate(10);
        return view('admin.carTypes.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        check_permission_sub_menue_actions_redirect(6);
        return view('admin.carTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(carTypeRequest $request)
    {
        check_permission_sub_menue_actions_redirect(6);
        try {
            $id = auth()->user()->id;
            // Check if not exists
            $checkExists = carType::where(['name' => $request->name])->first();
            if ($checkExists == null) {
                $data['added_by'] = $id;  
                $data['name'] = $request->name;  
                $data['created_at'] = now();
                carType::create($data);
                return redirect()->route('carType.index')->with(['success' => __('controller.data_added')]);
            } else {
                return redirect()->back()
                    ->with(['error' => __('controller.category_name_exists')])
                    ->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        check_permission_sub_menue_actions_redirect(7);
        $data = carType::select()->find($id);
        return view('admin.carTypes.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(carTypeRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(7);
        try {
            $data = carType::select()->find($id);
            if (empty($data)) {
                return redirect()->route('carType.index')->with(['error' => __('controller.data_not_found')]);
            }
            $checkExists = carType::where(['name' => $request->name])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => __('controller.category_name_exists')])
                    ->withInput();
            }
            $data_to_update['name'] = $request->name;
            $data_to_update['updated_at'] = now();
            $data_to_update['updated_by'] = auth()->user()->id;
            carType::where(['id' => $id])->update($data_to_update);
            return redirect()->route('carType.index')->with(['success' => __('controller.data_updated')]);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()])
                ->withInput();
        }
    }

    public function show(string $id)
    {
        // Implementation for show method if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        check_permission_sub_menue_actions_redirect(8);
        try {
            $carType = carType::find($id);
            if (!empty($carType)) {
                $checkExists = Car::where(['type_id' => $carType->id])->first();
                if ($checkExists) {
                    return redirect()->back()
                        ->with(['error' => __('controller.cannot_delete_linked_data')]);
                }
                $flag = $carType->delete();
                if ($flag) {
                    return redirect()->back()->with(['success' => __('controller.data_deleted')]);
                } else {
                    return redirect()->back()->with(['error' => __('controller.error_occurred')]);
                }
            } else {
                return redirect()->back()->with(['error' => __('controller.data_not_found')]);
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()]);
        }
    }
}