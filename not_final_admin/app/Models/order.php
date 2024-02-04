<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'price',
       'receiver_name',
       'received_country',
       'received_city',
       'received_address',
       'delivered_country',
       'delivered_city',
       'delivered_address',
       'status',
       'received_date',
       'delivered_date',
       'product_pic',
       'payment_recipt',
       'packet_length',
       'packet_height',
       'packet_width',
       'packet_weight',
       'no_of_packet'
    ];
    public function client(){
        return $this->belongsTo(User::class,'user_id');
    }
}
