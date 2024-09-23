<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarModalsRequest;
use App\Models\Car;
use App\Models\CarModals;

class CarModalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(9);
        $data = CarModals::select()->orderby('id', 'DESC')->paginate(10);
        return view('admin.CarModals.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        check_permission_sub_menue_actions_redirect(10);
        return view('admin.CarModals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarModalsRequest $request)
    {
        check_permission_sub_menue_actions_redirect(10);
        try {
            $com_code = auth()->user()->com_code;
            $id = auth()->user()->id;
            //check if not exsits
            $checkExists = CarModals::where(['name' => $request->name])->first();
            if ($checkExists == null) {
                $data['added_by'] = $id;  
                $data['name'] = $request->name;  
                $data['created_at'] = date("Y-m-d H:i:s");
                CarModals::create($data);
                return redirect()->route('CarModals.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
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

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        check_permission_sub_menue_actions_redirect(11);
        $data = CarModals::select()->find($id);
        return view('admin.CarModals.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarModalsRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(11);
        try {
            $data = CarModals::select()->find($id);
            if (empty($data)) {
                return redirect()->route('CarModals.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists = CarModals::where(['name' => $request->name])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الخزنة مسجل من قبل'])
                    ->withInput();
            }
            $data_to_update['name'] = $request->name;
            $data_to_update['updated_at'] = date("Y-m-d H:i:s");
            $ids = auth()->user()->id;
            $data_to_update['updated_by'] = $ids;
            CarModals::where(['id' => $id])->update($data_to_update);
            return redirect()->route('CarModals.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }
    public function show(string $id){

    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        check_permission_sub_menue_actions_redirect(12);
        try {
            $carType = CarModals::find($id);
            if (!empty($carType)) {
                $checkExists = Car::where(['car_modals_id' => $carType->id])->first();
                if ($checkExists) {
                    return redirect()->back()
                    ->with(['error' => '   عفوا لا يمكن حذف الموديل لوجود سيارات مرتبطة به']);
                }
                    $flag = $carType->delete();
                    if ($flag) {
                        return redirect()->back()
                            ->with(['success' => '   تم حذف البيانات بنجاح']);
                    } else {
                        return redirect()->back()
                            ->with(['error' => 'عفوا حدث خطأ ما']);
                    }
                }else {
                    return redirect()->back()
                        ->with(['error' => 'عفوا لا  يمكن حذف البيانات لوجود منتجات  مرتبطة به']);
                }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }
}
