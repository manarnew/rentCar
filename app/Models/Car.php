<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Car extends Model
{
    use HasFactory;
    protected $table="cars";
    protected $fillable=[
    'plate_number','car_color','type_id','car_status','car_modals_id','full_insurance','third_party','full_cover','UAE','oman','km_number'
    ,'contract_number','created_at','updated_at','added_by','updated_by','com_code' ,'date','image','daily_rent_price',
    'hourly_rent_price','km_rent_price','weekly_rent_price','monthly_rent_price','insurance',
    'car_own_image_front','car_own_image_back','card_run_image_back','card_run_image_front'
    ];      
    public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by', 'id');
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(carType::class, 'type_id', 'id');
    }
    public function carModals(): BelongsTo
    {
        return $this->belongsTo(CarModals::class, 'car_modals_id', 'id');
    }
}
