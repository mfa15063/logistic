<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'company_name',
        'company_url',
        'company_address',
        'company_country',
        'company_city',
        'inquiry_id',
        'message',
    ];
    public function inquiry(){
        return $this->belongsTo(Inquery::class,'inquiry_id');
    }

}
