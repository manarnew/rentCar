<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Panel_settings extends Model
{
    use HasFactory;
    protected $table="panel_settings";
    protected $fillable=[
        'system_name','photo','phone_one','phone_two','email','address',
        'cr_number','intro','created_at','updated_at','added_by','updated_by',
        'tax_number' ,'ar_contract','en_contract','mark_image','currency_type'
        ];
        public function user(): BelongsTo
        {
            return $this->belongsTo(Admin::class, 'updated_by', 'id');
        }
} 



