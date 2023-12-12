<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; 
    public $incrementing = true;
    protected $fillable = ['name', 'e_mail', 'address', 'telephone_number', 'days_booked', 'total_amount']; 
    public $timestamps = false;
}
