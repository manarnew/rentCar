<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionSubMenue;
use App\Models\PermissionMainMenue;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionSubMenueRequest;
use App\Models\PermissionSubMenuesAction;

class PermissionSubMenueController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;

        $data = PermissionSubMenue::select()->where('com_code', '=', $com_code)->orderby('id', 'DESC')->paginate(PAGINATION_COUNT);
        if (!empty($data)) {
            foreach ($data as $info) {
                $info->Permission_main_menues_name = PermissionMainMenue::where('id', $info->permission_main_menues_id)->value('name');
                $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
                if ($info->updated_by > 0 and $info->updated_by != null) {
                    $info->updated_by_admin = Admin::where('id', $info->updated_by)->value('name');
                }


                $info->permission_sub_menues_actions = get_cols_where(new PermissionSubMenuesAction(), array("*"), array('com_code' => $com_code, "permission_sub_menues_id" => $info->id), 'id', 'DESC');
                if (!empty($info->permission_sub_menues_actions)) {
                    foreach ($info->permission_sub_menues_actions as $action) {
                        $action->added_by_admin = Admin::where('id', $action->added_by)->value('name');
                        if ($action->updated_by > 0 and $action->updated_by != null) {
                            $action->updated_by_admin = Admin::where('id', $action->updated_by)->value('name');
                        }
                    }
                }
            }
        }
        $Permission_main_menues = get_cols_where(new PermissionMainMenue(), array("id", "name"), array("active" => 1, 'com_code' => $com_code), 'id', 'ASC');
        return view('admin.permission_sub_menues.index', ['data' => $data, 'Permission_main_menues' => $Permission_main_menues]);
    }



    public function create()
    {
        $com_code = auth()->user()->com_code;
        $Permission_main_menues = get_cols_where(new PermissionMainMenue(), array("id", "name"), array("active" => 1, 'com_code' => $com_code), 'id', 'ASC');
        return view('admin.permission_sub_menues.create', ['Permission_main_menues' => $Permission_main_menues]);
    }




    public function store(PermissionSubMenueRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            //check if not exsits
            $checkExists = PermissionSubMenue::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if ($checkExists == null) {
                $data['name'] = $request->name;
                $data['permission_main_menues_id'] = $request->permission_main_menues_id;
                $data['active'] = $request->active;
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['added_by'] = auth()->user()->id;
                $data['com_code'] = $com_code;
                $data['date'] = date("Y-m-d");
                PermissionSubMenue::create($data);
                return redirect()->route('admin.permission_sub_menues.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الدور  مسجل من قبل'])
                    ->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = PermissionSubMenue::select()->find($id);
        $Permission_main_menues = get_cols_where(new PermissionMainMenue(), array("id", "name"), array("active" => 1, 'com_code' => $com_code), 'id', 'ASC');
        return view('admin.permission_sub_menues.edit', ['data' => $data, 'Permission_main_menues' => $Permission_main_menues]);
    }
    public function update($id, PermissionSubMenueRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = PermissionSubMenue::select()->find($id);
            if (empty($data)) {
                return redirect()->route('admin.permission_sub_menues.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            $checkExists = PermissionSubMenue::where(['name' => $request->name, 'com_code' => $com_code])->where('id', '!=', $id)->first();
            if ($checkExists != null) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم الصلاحية مسجل من قبل'])
                    ->withInput();
            }
            $data_to_update['name'] = $request->name;
            $data_to_update['permission_main_menues_id'] = $request->permission_main_menues_id;
            $data_to_update['active'] = $request->active;
            $data_to_update['updated_by'] = auth()->user()->id;
            $data_to_update['updated_at'] = date("Y-m-d H:i:s");
            PermissionSubMenue::where(['id' => $id, 'com_code' => $com_code])->update($data_to_update);
            return redirect()->route('admin.permission_sub_menues.index')->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }


    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $com_code = auth()->user()->com_code;
            $search_by_text = $request->search_by_text;
            $permission_main_menues_id_search = $request->permission_main_menues_id_search;
            if ($search_by_text == '') {
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "name";
                $operator1 = "LIKE";
                $value1 = "%{$search_by_text}%";
            }
            if ($permission_main_menues_id_search == 'all') {
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "permission_main_menues_id";
                $operator2 = "=";
                $value2 = $permission_main_menues_id_search;
            }
            $data = PermissionSubMenue::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->orderBy('id', 'ASC')->paginate(PAGINATION_COUNT);
            if (!empty($data)) {
                foreach ($data as $info) {
                    $info->Permission_main_menues_name = PermissionMainMenue::where('id', $info->permission_main_menues_id)->value('name');
                    $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
                    if ($info->updated_by > 0 and $info->updated_by != null) {
                        $info->updated_by_admin = Admin::where('id', $info->updated_by)->value('name');
                    }


                    $info->permission_sub_menues_actions = get_cols_where(new PermissionSubMenuesAction(), array("*"), array('com_code' => $com_code, "permission_sub_menues_id" => $info->id), 'id', 'DESC');
                    if (!empty($info->permission_sub_menues_actions)) {
                        foreach ($info->permission_sub_menues_actions as $action) {
                            $action->added_by_admin = Admin::where('id', $action->added_by)->value('name');
                            if ($action->updated_by > 0 and $action->updated_by != null) {
                                $action->updated_by_admin = Admin::where('id', $action->updated_by)->value('name');
                            }
                        }
                    }
                }
            }
            return view('admin.permission_sub_menues.ajax_search', ['data' => $data]);
        }
    }

    public function ajax_do_add_permission(Request $request)
    {
        if ($request->ajax()) {
            $com_code = auth()->user()->com_code;
            //check if not exsits
            $checkExists = PermissionSubMenuesAction::where(['name' => $request->name, 'com_code' => $com_code, 'permission_sub_menues_id' => $request->permission_sub_menues_id])->first();
            if ($checkExists == null) {
                $data['name'] = $request->name;
                $data['permission_sub_menues_id'] = $request->permission_sub_menues_id;
                $data['active'] = 1;
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['added_by'] = auth()->user()->id;
                $data['com_code'] = $com_code;
                $data['date'] = date("Y-m-d");
                PermissionSubMenuesAction::create($data);
                echo json_encode("done");
            } else {
                echo json_encode("found");
            }
        }
    }

    public function ajax_load_edit_permission(Request $request)
    {
        if ($request->ajax()) {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new PermissionSubMenuesAction(), array("id", "name"), array("com_code" => $com_code, 'id' => $request->id));
            return view('admin.permission_sub_menues.ajax_load_edit_permission', ['data' => $data]);
        }
    }
    public function ajax_do_edit_permission(Request $request)
    {
        if ($request->ajax()) {
            $com_code = auth()->user()->com_code;
            $data_to_update['name'] = $request->name;
            $data_to_update['updated_by'] = auth()->user()->id;
            $data['updated_at'] = date("Y-m-d H:i:s");
            update(new PermissionSubMenuesAction(), $data_to_update, array("com_code" => $com_code, 'id' => $request->id));
            echo json_encode("done");
        }
    }

    public function delete($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $item_row = PermissionSubMenue::find($id);
            if (!empty($item_row)) {
                $flag = $item_row->delete();
                if ($flag) {
                    delete(new PermissionSubMenuesAction(), array("com_code" => $com_code, 'permission_sub_menues_id' => $id));
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
    public function ajax_do_delete_permission(Request $request)
    {
        if ($request->ajax()) {
            $item_row = PermissionSubMenuesAction::find($request->id);
            if (!empty($item_row)) {
                $flag = $item_row->delete();
                if ($flag) {
                    echo json_encode("done");
                }
            }
        }
    }
}
