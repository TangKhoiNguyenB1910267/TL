<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Orders extends Model
{
    use HasFactory;
    protected $table = "detail_orders";
    protected $guarded = [];
    public function products()
    {
        return $this->belongsTo(products::class, 'id_product');
    }
    public function orders()
    {
        return $this->belongsTo(Order::class,'id_order');
    }
}
