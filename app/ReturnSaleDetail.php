<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnSaleDetail extends Model
{
    protected $fillable = [
    	'return_id', 'shop_id', 'client_id', 'product_id', 'quantity', 'price', 'subTotal',
    ];
}
