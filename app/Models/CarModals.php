<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModals extends Model
{
    use HasFactory;
    protected $table="car_modals";
    protected $fillable=['name','added_by','updated_by'];
}
