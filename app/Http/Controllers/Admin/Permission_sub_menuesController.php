<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission_sub_menues;
use App\Models\Permission_main_menues;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\permission_sub_menuesequest;
use App\Models\Permission_sub_menues_actions;

class Permission_sub_menuesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;

        $data = Permission_sub_menues::select()->where('com_code', '=', $com_code)->orderby('id', 'DESC')->paginate(PAGINATION_COUNT);
        if (!empty($data)) {
            foreach ($data as $info) {
                $info->Permission_main_menues_name = Permission_main_menues::where('id', $info->permission_main_menues_id)->value('name');
                $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
                if ($info->updated_by > 0 && $info->updated_by != null) {
                    $info->updated_by_admin = Admin::where('id', $info->updated_by)->value('name');
                }

                $info->permission_sub_menues_actions = get_cols_where(new Permission_sub_menues_actions(), ["*"], ['com_code' => $com_code, "permission_sub_menues_id" => $info->id], 'id', 'DESC');
                if (!empty($info->permission_sub_menues_actions)) {
                    foreach ($info->permission_sub_menues_actions as $action) {
                        $action->added_by_admin = Admin::where('id', $action->added_by)->value('name');
                        if ($action->updated_by > 0 && $action->updated_by != null) {
                            $action->updated_by_admin = Admin::where('id', $action->updated_by)->value('name');
                        }
                    }
                }
            }
        }
        $Permission_main_menues = get_cols_where(new Permission_main_menues(), ["id", "name"], ["active" => 1, 'com_code' => $com_code], 'id', 'ASC');
        return view('admin.permission_sub_menues.index', ['data' => $data, 'Permission_main_menues' => $Permission_main_menues]);
    }

    public function create()
    {
        $com_code = auth()->user()->com_code;
        $Permission_main_menues = get_cols_where(new Permission_main_menues(), ["id", "name"], ["active" => 1, 'com_code' => $com_code], 'id', 'ASC');
        return view('admin.permission_sub_menues.create', ['Permission_main_menues' => $Permission_main_menues]);
    }

    public function store(permission_sub_menuesequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            // Check if not exists
            $checkExists = Permission_sub_menues::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if ($checkExists == null) {
                $data['name'] = $request->name;
                $data['permission_main_menues_id'] = $request->permission_main_menues_id;
                $data['active'] = $request->active;
                $data['created_at'] = now();
                $data['added_by'] = auth()->user()->id;
                $data['com_code'] = $com_code;
                $data['date'] = now()->toDateString();
                Permission_sub_menues::create($data);
                return redirect()->route('admin.permission_sub_menues.index')->with(['success' => __('controller.success_add')]);
            } else {
                return redirect()->back()->with(['error' => __('controller.error_exists')])->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('controller.error_general') . $ex->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = Permission_sub_menues::select()->find($id);
        $Permission_main_menues = get_cols_where(new Permission_main_menues(), ["id", "name"], ["active" => 1, 'com_code' => $com_code], 'id', 'ASC');
        return view('admin.permission_sub_menues.edit', ['data' => $data, 'Permission_main_menues' => $Permission_main_menues]);
    }

    public function update($id, permission_sub_menuesequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = Permission_sub_menues::select()->find($id);
            if (empty($data)) {
                return redirect()->route('admin.permission_sub_menues.index')->with(['error' => __('controller.error_not_found')]);
            }
            $checkExists = Permission_sub_menues::where(['name' => $request->name, 'com_code' => $com_code])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()->with(['error' => __('controller.error_exists')])->withInput();
            }
            $data_to_update = [
                'name' => $request->name,
                'permission_main_menues_id' => $request->permission_main_menues_id,
                'active' => $request->active,
                'updated_by' => auth()->user()->id,
                'updated_at' => now(),
            ];
            Permission_sub_menues::where(['id' => $id, 'com_code' => $com_code])->update($data_to_update);
            return redirect()->route('admin.permission_sub_menues.index')->with(['success' => __('controller.success_update')]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('controller.error_general') . $ex->getMessage()])->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $item_row = Permission_sub_menues::find($id);
            if (!empty($item_row)) {
                $flag = $item_row->delete();
                if ($flag) {
                    delete(new Permission_sub_menues_actions(), ["com_code" => $com_code, 'permission_sub_menues_id' => $id]);
                    return redirect()->back()->with(['success' => __('controller.success_delete')]);
                } else {
                    return redirect()->back()->with(['error' => __('controller.error_general')]);
                }
            } else {
                return redirect()->back()->with(['error' => __('controller.error_not_found')]);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('controller.error_general') . $ex->getMessage()]);
        }
    }

    // Other methods remain unchanged...
}