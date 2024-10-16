<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use App\Models\Expenses;
use App\Models\expensesType;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(13);
        $data = Expenses::select()->orderby('id', 'DESC')->paginate(10);
        $expenses_type = expensesType::select()->orderby('id', 'DESC')->get();
        return view('admin.expenses.index', ['data' => $data, 'expenses_type' => $expenses_type]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        check_permission_sub_menue_actions_redirect(14);
        $expenses_type = expensesType::select()->orderby('id', 'DESC')->get();
        return view('admin.expenses.create', ['expenses_type' => $expenses_type]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpensesRequest $request)
    {
        check_permission_sub_menue_actions_redirect(14);
        try {
            $id = auth()->user()->id;
            $data = [
                'expenses_type' => $request->expenses_type,
                'price' => $request->price,
                'tax' => $request->tax,
                'total' => $request->tax + $request->price,
                'note' => $request->note,
                'date' => date("Y-m-d"),
                'added_by' => $id,
                'created_at' => date("Y-m-d H:i:s"),
            ];
            if ($request->image) {
                $data['image'] = $this->uplaodImage($request->image);
            }
            Expenses::create($data);
            return redirect()->route('expenses.index')->with(['success' => __('controller.data_added_successfully')]);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()])
                ->withInput();
        }
    }

    public function uplaodImage($imageRequest)
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
        check_permission_sub_menue_actions_redirect(15);
        $expenses_type = expensesType::select()->orderby('id', 'DESC')->get();
        $data = Expenses::select()->find($id);
        return view('admin.expenses.edit', ['data' => $data, 'expenses_type' => $expenses_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpensesRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(15);
        try {
            $data = Expenses::select()->find($id);
            if (empty($data)) {
                return redirect()->route('expenses.index')->with(['error' => __('controller.data_not_found')]);
            }
            $data_to_update = [
                'expenses_type' => $request->expenses_type,
                'price' => $request->price,
                'tax' => $request->tax,
                'total' => $request->tax + $request->price,
                'note' => $request->note,
                'updated_at' => date("Y-m-d H:i:s"),
                'updated_by' => auth()->user()->id,
            ];

            if ($request->image) {
                $data_to_update['image'] = $this->updateImage($request->image, $data['image']);
            }
            Expenses::where(['id' => $id])->update($data_to_update);
            return redirect()->route('expenses.index')->with(['success' => __('controller.data_updated_successfully')]);
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
        $data = Expenses::select()->find($id);
        return view('admin.expenses.show', ['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        check_permission_sub_menue_actions_redirect(16);
        try {
            $expenses = Expenses::find($id);
            if (!empty($expenses)) {
                $flag = $expenses->delete();
                if ($flag) {
                    return redirect()->back()
                        ->with(['success' => __('controller.data_deleted_successfully')]);
                } else {
                    return redirect()->back()
                        ->with(['error' => __('controller.error_occurred')]);
                }
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
            $expenses_type_id_search = $request->expenses_type_id_search;
            if ($expenses_type_id_search == 'all') {
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "expenses_type";
                $operator2 = "=";
                $value2 = $expenses_type_id_search;
            }

            $data = Expenses::where($field2, $operator2, $value2)->paginate(10);
            return view('admin.expenses.ajax_search', ['data' => $data]);
        }
    }
}