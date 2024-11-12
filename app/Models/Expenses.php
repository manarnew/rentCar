<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expenses extends Model
{
    use HasFactory;
    protected $table="expenses";
    protected $fillable=['expenses_type','image','price','tax','total','note','date','added_by','updated_by'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by', 'id');
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(expensesType::class, 'expenses_type', 'id');
    }
}
