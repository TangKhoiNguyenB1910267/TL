<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];
    public function items()
    {
        return $this->hasMany(Detail_Orders::class,'id_order', 'id');
    }
    public function Address()
    {
        return $this->hasMany(Address::class, 'id_order','id');
    }
}
