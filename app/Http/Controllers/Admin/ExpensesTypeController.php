<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\expensesTypeRequest;
use App\Models\expensesType;
use Illuminate\Http\Request;

class ExpensesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         check_permission_sub_menue_actions_redirect(5);
        $data = expensesType::select()->orderby('id', 'DESC')->paginate(10);
        return view('admin.expensesType.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         check_permission_sub_menue_actions_redirect(6);
        return view('admin.expensesType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(expensesTypeRequest $request)
    {
         check_permission_sub_menue_actions_redirect(6);
        try {
            $com_code = auth()->user()->com_code;
            $id = auth()->user()->id;
            //check if not exsits
            $checkExists = expensesType::where(['name' => $request->name])->first();
            if ($checkExists == null) {
                $data['name'] = $request->name;  
                expensesType::create($data);
                return redirect()->route('expensesType.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
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
         check_permission_sub_menue_actions_redirect(7);
        $data = expensesType::select()->find($id);
        return view('admin.expensesType.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(expensesTypeRequest $request, string $id)
    {
         check_permission_sub_menue_actions_redirect(7);
        try {
            $data = expensesType::select()->find($id);
            if (empty($data)) {
                return redirect()->route('expensesType.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists = expensesType::where(['name' => $request->name])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم النوع مسجل من قبل'])
                    ->withInput();
            }
            $data_to_update['name'] = $request->name;
            expensesType::where(['id' => $id])->update($data_to_update);
            return redirect()->route('expensesType.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
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
         check_permission_sub_menue_actions_redirect(8);
        try {
            $expensesType = expensesType::find($id);
            if (!empty($expensesType)) {
                // $checkExists = expenses::where(['type_id' => $expensesType->id])->first();
                // if ($checkExists) {
                //     return redirect()->back()
                //     ->with(['error' => '   عفوا لا يمكن حذف النوع لوجود سيارات مرتبطة به']);
                // }
                    $flag = $expensesType->delete();
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
