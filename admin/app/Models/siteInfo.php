<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siteInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'address',
        'location',
        'phone_no',
        'whatsapp_no',
        'facebook_profile',
        'instagram_profile',
    ];
}
