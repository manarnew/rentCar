<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\blackListsRequest;
use App\Models\Customer;
use App\Models\Black_lists;
use Illuminate\Http\Request;

class Black_listsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        check_permission_sub_menue_actions_redirect(5);
        $data = Black_lists::select()->orderby('id', 'DESC')->paginate(10);
        return view('admin.black_lists.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        check_permission_sub_menue_actions_redirect(23);
        $customer_id = Customer::select('name', 'id')->where('id', $id)->first();
        return view('admin.black_lists.create', ['customer_id' => $customer_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(blackListsRequest $request)
    {
        check_permission_sub_menue_actions_redirect(6);
        try {
            $com_code = auth()->user()->com_code;
            $id = auth()->user()->id;

            $data = [
                'added_by' => $id,
                'customer_id' => $request->customer_id,
                'note' => $request->note,
                'date' => now()->format('Y-m-d'),
                'created_at' => now(),
            ];

            Black_lists::create($data);
            return redirect()->route('Black_lists.index')->with(['success' => __('controller.data_added')]);
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
        $data = Black_lists::select()->find($id);
        return view('admin.black_lists.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(blackListsRequest $request, string $id)
    {
        check_permission_sub_menue_actions_redirect(7);
        try {
            $data = Black_lists::select()->find($id);
            if (empty($data)) {
                return redirect()->route('Black_lists.index')->with(['error' => __('controller.data_not_found')]);
            }

            $data_to_update = [
                'note' => $request->note,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id,
            ];

            Black_lists::where(['id' => $id])->update($data_to_update);
            return redirect()->route('Black_lists.index')->with(['success' => __('controller.data_updated')]);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => __('controller.error_occurred') . $ex->getMessage()])
                ->withInput();
        }
    }

    public function show(string $id)
    {
        // Implement show functionality if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        check_permission_sub_menue_actions_redirect(8);
        try {
            $Black_lists = Black_lists::find($id);
            if (!empty($Black_lists)) {
                $flag = $Black_lists->delete();
                if ($flag) {
                    return redirect()->back()
                        ->with(['success' => __('controller.data_deleted')]);
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
}