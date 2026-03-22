<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'watch_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function watch()
    {
        return $this->belongsTo(Watch::class);
    }
}
