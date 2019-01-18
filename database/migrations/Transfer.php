<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
    	'product_id', 'shop_from_id',  'shop_to_id',  'quantity',  'reference',  'note' 
    ];
}
