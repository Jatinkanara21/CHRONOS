<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model {
    protected $fillable = ['user_id', 'watch_id', 'quantity'];

    public function watch() {
        return $this->belongsTo(Watch::class);
    }
}