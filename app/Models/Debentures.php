<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Debentures extends Model
{
    use HasFactory;
    protected $table="debentures";
    protected $fillable=[
    'car_id','customer_id','paid_price','remind_price','contract_id','check_number'
    ,'updated_at','added_by' ,'updated_by' ,'date','payment_type','note','count'
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
