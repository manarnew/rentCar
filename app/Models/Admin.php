<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use HasFactory;
     
    protected $table="admins";
    protected $fillable=[
    'name','email','username','image','password','created_at','updated_at','added_by','updated_by','com_code' ,'permission_roles_id','date','active'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by', 'id');
    }
}
