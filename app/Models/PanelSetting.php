<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PanelSetting extends Model
{
    use HasFactory;
    protected $table="panel_settings";
    protected $fillable=[
        'system_name','photo','photo_two','phone_one','address_two','email','theme_color','address',
        'cr_number','intro','created_at','updated_at','added_by','updated_by',
        'tax_number' ,'ar_contract','en_contract','mark_image','currency_type','Inctance_id',
        'access_token','message','notfication_number','country_key','number_of_km_mantince'
        ];
        public function user(): BelongsTo
        {
            return $this->belongsTo(Admin::class, 'updated_by', 'id');
        }
} 
