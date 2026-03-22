<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    protected $fillable = [
        'user_id', 
        'email_new_product', 
        'email_price_drop', 
        'email_back_in_stock'
    ];

    protected $casts = [
        'email_new_product' => 'boolean',
        'email_price_drop' => 'boolean',
        'email_back_in_stock' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
