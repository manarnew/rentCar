<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Customer extends Model
{
    use HasFactory;
    protected $table="customers";
    protected $fillable=[
    'name','email','com_name','identity_number','identity_front_image','identity_back_image','phone','address','nationality','driver_license_number'
    ,'driver_license_address','driver_license_release_date','driver_license_address_end_date','driver_license_front_image','driver_license_back_image',
    'contract_number','details','total_money','paid_money','remaining_money','created_at','updated_at','added_by','updated_by','com_code' ,'date',
    'identity_release_date','identity_end_date','identity_address','word_address'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by', 'id');
    }
}
