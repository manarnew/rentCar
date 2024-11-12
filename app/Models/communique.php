<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class communique extends Model
{
    use HasFactory;
    protected $table="communique";
    protected $fillable=['contract_id','communique_number','communique_place','details','date','updated_by','added_by','created_at','updated_at'];
      public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by', 'id');
    }
    public function Contracts(): BelongsTo
    {
        return $this->belongsTo(Contracts::class, 'contract_id', 'id');
    }

}
