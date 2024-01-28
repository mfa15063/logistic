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
    //    'number_of_parcels', //int 0
    //    'weight_of_goods', //two decimal float 0.00
    //    'parcel_width', //two decimal float 0.00
    //    'parcel_length', //two decimal float 0.00
    //    'parcel_height' //two decimal float 0.00
    ];
    public function client(){
        return $this->belongsTo(User::class,'user_id');
    }
}
