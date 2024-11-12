<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\PermissionRole;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $com_code = auth()->user()->com_code;

        $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, "id" => $id));

        $Permission_rols = get_cols_where(new PermissionRole(), array("id", "name"), array("active" => 1, 'com_code' => $com_code, 'active' => 1), 'id', 'ASC');

        return view('admin.admins_accounts.profile', ['data' => $data, 'Permission_rols' => $Permission_rols]);
    }

}
