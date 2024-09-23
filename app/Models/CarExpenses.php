<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarExpenses extends Model
{
    use HasFactory;
    protected $table="car_expenses";
    protected $fillable=['car_id','type_id','image','supplier','price','tax','total_price_tax','note','date','added_by','updated_by'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by', 'id');
    }
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id', 'plate_number');
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(carType::class, 'type_id', 'id');
    }
}
