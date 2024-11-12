<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expensesType extends Model
{
    use HasFactory;
    protected $table="expenses_type";
    public $timestamps = false;
    protected $fillable=['name'];
}
