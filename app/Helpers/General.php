<?php

use App\Models\PermissionRoleMainMenu;
use App\Models\PermissionRoleSubMenu;
use App\Models\PermissionRoleSubMenueAction;
use App\Models\Admin;


function check_permission_main_menue($permission_main_menues_id = null)
{
    if ($permission_main_menues_id == "" || $permission_main_menues_id == null) {
        return false;
    } else {
        $permission_roles_id = auth()->user()->permission_roles_id;
        $data = PermissionRoleMainMenu::select("id")->where(['permission_roles_id' => $permission_roles_id, 'permission_main_menues_id' => $permission_main_menues_id])->first();
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }
}

function check_permission_sub_menue($permission_sub_menues_id = null)
{
    if ($permission_sub_menues_id == "" || $permission_sub_menues_id == null) {
        return false;
    } else {
        $permission_roles_id = auth()->user()->permission_roles_id;
        $data = PermissionRoleSubMenu::select("id")->where(['permission_roles_id' => $permission_roles_id, 'permission_sub_menues_id' => $permission_sub_menues_id])->first();
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }
}


function check_permission_sub_menue_actions($permission_roles_sub_menues_actions = null)
{
    if ($permission_roles_sub_menues_actions == "" || $permission_roles_sub_menues_actions == null) {
        return false;
    } else {
        $permission_roles_id = auth()->user()->permission_roles_id;
        $data = PermissionRoleSubMenueAction::select("id")->where(['permission_roles_id' => $permission_roles_id, 'permission_sub_menues_actions_id' => $permission_roles_sub_menues_actions])->first();
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }
}


function check_permission_sub_menue_actions_redirect($permission_roles_sub_menues_actions = null)
{
    if ($permission_roles_sub_menues_actions == "" || $permission_roles_sub_menues_actions == null) {
        return false;
    } else {
        $permission_roles_id = auth()->user()->permission_roles_id;
        $data = PermissionRoleSubMenueAction::select("id")->where(['permission_roles_id' => $permission_roles_id, 'permission_sub_menues_actions_id' => $permission_roles_sub_menues_actions])->first();
        if (empty($data)) {
            return redirect()->away(route('admin.dashboard'))->send()->with(['error' => 'عفوا لاتمتلك صلاحيات لهذه الصفحة']);;
        }
    }
}



//we set default value for each parameter in function to avoid error in composer update
//Deprecate required parameters after optional parameters in
/*get some cols by pagination table */
function get_cols_where_p($model = null, $columns_names = array(), $where = array(), $order_field = "id", $order_type = "DESC", $pagination_counter = 13)
{
    $data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->paginate($pagination_counter);
    return $data;
}
/*get some cols by pagination table where 2 */
function get_cols_where2_p($model = null, $columns_names = array(), $where = array(), $where2field = null, $where2operator = null, $where2value = null, $order_field = "id", $order_type = "DESC", $pagination_counter = 13)
{
    $data = $model::select($columns_names)->where($where)->where($where2field, $where2operator, $where2value)->orderby($order_field, $order_type)->paginate($pagination_counter);
    return $data;
}
/*get some cols  table */
function get_cols_where($model = null, $columns_names = array(), $where = array(), $order_field = "id", $order_type = "DESC")
{
    $data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->get();
    return $data;
}
/*get some cols  table */
function get_cols_where_limit($model = null, $columns_names = array(), $where = array(), $order_field = "id", $order_type = "DESC", $limit = 1)
{
    $data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->limit($limit)->get();
    return $data;
}
/*get some cols  table 2 */
function get_cols_where_order2($model = null, $columns_names = array(), $where = array(), $order_field = "id", $order_type = "DESC", $order_field2 = "id", $order_type2 = "DESC")
{
    $data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->orderby($order_field2, $order_type2)->get();
    return $data;
}
/*get some cols  table */
function get_cols($model = null, $columns_names = array(), $order_field = "id", $order_type = "DESC")
{
    $data = $model::select($columns_names)->orderby($order_field, $order_type)->get();
    return $data;
}
/*get some cols row table */
function get_cols_where_row($model = null, $columns_names = array(), $where = array())
{
    $data = $model::select($columns_names)->where($where)->first();
    return $data;
}
/*get some cols row table */
function get_cols_where2_row($model = null, $columns_names = array(), $where = array(), $where2 = "")
{
    $data = $model::select($columns_names)->where($where)->where($where2)->first();
    return $data;
}
/*get some cols row table order by */
function get_cols_where_row_orderby($model, $columns_names = array(), $where = array(), $order_field = "id", $order_type = "DESC")
{
    $data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->first();
    return $data;
}
/*get some cols table */
function insert($model = null, $arrayToInsert = array(), $returnData = false)
{
    $flag = $model::create($arrayToInsert);
    if ($returnData == true) {
        $data = get_cols_where_row($model, array("*"), $arrayToInsert);
        return $data;
    } else {
        return $flag;
    }
}
function get_field_value($model = null, $field_name = null, $where = array())
{
    $data = $model::where($where)->value($field_name);
    return $data;
}
function update($model = null, $data_to_update = array(), $where = array())
{
    $flag = $model::where($where)->update($data_to_update);
    return $flag;
}
function delete($model = null, $where = array())
{
    $flag = $model::where($where)->delete();
    return $flag;
}
function get_sum_where($model = null, $field_name = null, $where = array())
{
    $sum = $model::where($where)->sum($field_name);
    return $sum;
}
function get_user_shift($Admins_Shifts, $Treasuries = null, $Treasuries_transactions = null)
{
    $com_code = auth()->user()->com_code;
    $data = $Admins_Shifts::select("treasuries_id", "shift_code")->where(["com_code" => $com_code, "admin_id" => auth()->user()->id, "is_finished" => 0])->first();
    if (!empty($data)) {
        $data['name'] = $Treasuries::where(["id" => $data["treasuries_id"], "com_code" => $com_code])->value("name");
        $data['balance'] = $Treasuries_transactions::where(["shift_code" => $data["shift_code"], "com_code" => $com_code])->sum("money");
    }
    return $data;
}


/*get counter where from  table */
function get_count_where($model = null,  $where = array())
{
    $counter = $model::where($where)->count();
    return $counter;
}


function uploadImage($folder, $image)
{
    $extension = strtolower($image->extension());
    $filename = time() . rand(100, 999) . '.' . $extension;
    $image->getClientOriginalName = $filename;
    $image->move($folder, $filename);
    return $filename;
}

function uplaodImage($imageRequest)
{
    $image = $imageRequest;
    $extension = strtolower($image->extension());
    $filename = time() . rand(100, 999) . '.' . $extension;
    $image->getClientOriginalName = $filename;
    $folder = 'assets/admin/uploads';
    $image->move($folder, $filename);
    return $filename;
}

function updateImage($requestImage, $dataImage)
{
    $image = $requestImage;
    if ($image) {
        $filename =  uplaodImage($image);
        if (file_exists('assets/admin/uploads/' . $dataImage) and !empty($dataImage)) {
            unlink('assets/admin/uploads/' . $dataImage);
        }
        return $filename;
    }
}
