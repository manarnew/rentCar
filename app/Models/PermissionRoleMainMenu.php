<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRoleMainMenu extends Model
{
    use HasFactory;
    protected $table="permission_roles_main_menus";
    public $timestamps = false;
    protected $fillable=[
        'permission_roles_id', 'permission_main_menues_id', 'added_by', 'created_at' ,'com_code' ];

}

