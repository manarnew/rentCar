<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Contracts extends Model
{
    use HasFactory;
    protected $table="contracts";
    protected $fillable=[
    'car_id','customer_id','contract_status','contract_type','contract_number','contract_price','pre_paid_price','paid_price','tax_price','total_price','excess_km_price','remind_price'
    ,'remind_price','penalty_price','patrol_price','washing_price','insurance_price','exist_date',
    'exist_time','return_date','return_time','exist_km','return_km','due_km','free_km','total_km','excess_km'
    ,'updated_at','added_by' ,'updated_by' ,'date','payment_type','driver_name','signature_image','discount','contract_type_price'
    ];   
    public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by', 'id');
    }
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}


