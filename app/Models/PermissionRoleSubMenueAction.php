<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRoleSubMenueAction extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="permission_roles_sub_menues_actions";
    protected $fillable=[
        'permission_roles_sub_menu_id', 'permission_sub_menues_actions_id', 'added_by', 'created_at','permission_roles_id'     ];

}
