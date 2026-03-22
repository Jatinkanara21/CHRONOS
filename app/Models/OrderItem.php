<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
    protected $fillable = ['order_id', 'watch_id', 'watch_name', 'price', 'quantity'];
    
    public function watch() {
        return $this->belongsTo(Watch::class);
    }
}