<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars'; 
    protected $fillable = ['name', 'img_src', 'daily_price', 'status']; 
    public $timestamps = false;
    public $incrementing = true;

    public function getImagePathAttribute()
    {
        return $this->attributes['img_src'] ? asset('storage/' . $this->attributes['img_src']) : null;
    }
}
