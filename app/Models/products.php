<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "products";
    protected $guarded = [];

    public function firm()
    {
        return $this->belongsTo(firm::class, 'id_firm');
    }
    public function image()
    {
        return $this->hasMany(images::class,'id_product', 'id');
    }
}
