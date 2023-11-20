<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class firm extends Model
{
    use HasFactory;
    protected $table = "firms";
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(products::class,'id_firm', 'id');
    }
}
