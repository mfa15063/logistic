<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'otp',
        'expire_at',
        'created_at',
        'updated_at',
    ];
}
