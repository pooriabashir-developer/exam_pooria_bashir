<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Otp extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'mobile',
        'expired_at'
    ];
}
