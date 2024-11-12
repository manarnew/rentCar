<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\PermissionRole;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminRequestUpdate;

class AdminController extends Controller
{
    public function index()
    {
        check_permission_sub_menue_actions_redirect(41);

        $com_code = auth()->user()->com_code;

        $data = Admin::where('com_code', $com_code)->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

        $Permission_rols = PermissionRole::select("id", "name")->where(["active" => 1, 'com_code' => $com_code, 'active' => 1])->orderBy('id', 'ASC');

        return view('admin.admins_accounts.index', ['data' => $data, 'Permission_rols' => $Permission_rols]);
    }
    public function show(string $id)
    {
        $data = Admin::select()->find($id);
        return view('admin.admins_accounts.show', ['data' => $data]);
    }
    public function create()
    {
        check_permission_sub_menue_actions_redirect(27);

        $com_code = auth()->user()->com_code;
        $Permission_rols = get_cols_where(new PermissionRole(), array("id", "name"), array("active" => 1, 'com_code' => $com_code, 'active' => 1), 'id', 'ASC');
        return view('admin.admins_accounts.create', ['Permission_rols' => $Permission_rols]);
    }
    public function store(AdminRequest $request)
    {
        check_permission_sub_menue_actions_redirect(27);

        try {
            $com_code = auth()->user()->com_code;
            //check if not exsits
            $checkExists_name = Admin::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if (!empty($checkExists_name)) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم المستخدم كاملا  مسجل من قبل'])
                    ->withInput();
            }
            $checkExists_email = Admin::where(['email' => $request->email, 'com_code' => $com_code])->first();
            if (!empty($checkExists_email)) {
                return redirect()->back()
                    ->with(['error' => 'عفوا البريد الالكتروني للمتسخدم    مسجل من قبل'])
                    ->withInput();
            }
            $checkExists_username = Admin::where(['username' => $request->username, 'com_code' => $com_code])->first();
            if (!empty($checkExists_username)) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم المستخدم للدخول   مسجل من قبل'])
                    ->withInput();
            }
            $data['name'] = $request->name;
            $data['permission_roles_id'] = $request->permission_roles_id;
            $data['username'] = $request->username;
            $data['email'] = $request->email;
            $data['password'] = bcrypt($request->password);
            $data['active'] = $request->active;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['added_by'] = auth()->user()->id;
            $data['com_code'] = $com_code;
            $data['date'] = date("Y-m-d");
            $data['identity_number'] = $request->identity_number;
            if ($request->image) {
                $data['image'] =  $this->uplaodImage($request->image);
            }
            if ($request->identity_front_image) {
                $data['identity_front_image'] = uplaodImage($request->identity_front_image);
            }
            if ($request->identity_back_image) {
                $data['identity_back_image'] =  uplaodImage($request->identity_back_image);
            }
            Admin::create($data);
            return redirect()->route('admin.admins_accounts.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        check_permission_sub_menue_actions_redirect(28);

        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, "id" => $id));
        $Permission_rols = get_cols_where(new PermissionRole(), array("id", "name"), array("active" => 1, 'com_code' => $com_code, 'active' => 1), 'id', 'ASC');
        return view('admin.admins_accounts.edit', ['data' => $data, 'Permission_rols' => $Permission_rols]);
    }

    public function update($id, AdminRequestUpdate $request)
    {
        check_permission_sub_menue_actions_redirect(28);
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, "id" => $id));

            if (empty($data)) {
                return redirect()->route('admin.admins_accounts.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
            //check if not exsits
            $checkExists_name = Admin::where(['name' => $request->name, 'com_code' => $com_code])->where('id', '!=', $id)->first();
            if (!empty($checkExists_name)) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم المستخدم كاملا  مسجل من قبل'])
                    ->withInput();
            }
            $checkExists_email = Admin::where(['email' => $request->email, 'com_code' => $com_code])->where('id', '!=', $id)->first();
            if (!empty($checkExists_email)) {
                return redirect()->back()
                    ->with(['error' => 'عفوا البريد الالكتروني للمتسخدم    مسجل من قبل'])
                    ->withInput();
            }
            $checkExists_username = Admin::where(['username' => $request->username, 'com_code' => $com_code])->where('id', '!=', $id)->first();
            if (!empty($checkExists_username)) {
                return redirect()->back()
                    ->with(['error' => 'عفوا اسم المستخدم للدخول   مسجل من قبل'])
                    ->withInput();
            }
            $data_to_update['identity_number'] = $request->identity_number;
            $data_to_update['name'] = $request->name;
            $data_to_update['permission_roles_id'] = $request->permission_roles_id;
            $data_to_update['username'] = $request->username;
            $data_to_update['email'] = $request->email;
            if ($request->checkForUpdatePassword == 1) {
                $data_to_update['password'] = bcrypt($request->password);
            }
            if ($request->image) {
                $data_to_update['image'] =  updateImage($request->image, $data['image']);
            }
            if ($request->identity_front_image) {
                $data_to_update['identity_front_image'] = updateImage($request->identity_front_image, $data['identity_front_image'], $request);
            }
            if ($request->identity_back_image) {
                $data_to_update['identity_back_image'] =  updateImage($request->identity_back_image, $data['identity_back_image'], $request);
            }
            $data_to_update['active'] = $request->active;
            $data_to_update['updated_by'] = auth()->user()->id;
            $data_to_update['updated_at'] = date("Y-m-d H:i:s");
            Admin::where(['id' => $id, 'com_code' => $com_code])->update($data_to_update);
            return redirect()->back()->with(['success' => 'لقد تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                ->withInput();
        }
    }

    public function details($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data =  Admin::where(["com_code" => $com_code, "id" => $id])->orderBy('id', 'DESC')->first();
            dd($data);
            if (empty($data)) {
                return redirect()->route('admin.admins_accounts.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
            }
         

            return view("admin.admins_accounts.details", ['data' => $data]);
        } catch (\Exception $ex) {
            return redirect()->back()
                ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
        }
    }

    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $com_code = auth()->user()->com_code;
            $search_by_name = $request->search_by_name;
            $permission_roles_id_search = $request->permission_roles_id_search;

            if ($permission_roles_id_search == 'all') {
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "permission_roles_id";
                $operator1 = "=";
                $value1 = $permission_roles_id_search;
            }


            if ($search_by_name != '') {

                $field2 = "name";
                $operator2 = "like";
                $value2 = "%{$search_by_name}%";
            } else {
                //true 
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            }


            $data = Admin::where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where('com_code', '=', $com_code)->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
            if (!empty($data)) {
                foreach ($data as $info) {
                    $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
                    $info->permission_roles_name = PermissionRole::where('id', $info->permission_roles_id)->value('name');
                    if ($info->updated_by > 0 and $info->updated_by != null) {
                        $info->updated_by_admin = Admin::where('id', $info->updated_by)->value('name');
                    }
                }
            }
            return view('admin.admins_accounts.ajax_search', ['data' => $data]);
        }
    }

    public function delete($id)
    {
        try {
            $Admin = Admin::find($id);
            if ($Admin->id == 1) {
                return redirect()->back()
                    ->with(['error' => 'عفوا لا  يمكن حذف مدير النظام     ']);
            }
            if (!empty($Admin)) {
                $flag = $Admin->delete();
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
}
