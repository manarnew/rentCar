<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carType extends Model
{
    use HasFactory;
    protected $table="car_types";
    protected $fillable=['name','added_by','updated_by'];
}
