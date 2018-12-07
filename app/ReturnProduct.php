<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
	protected $table = 'return_products';
    protected $fillable = [
    	'shop_id', 'client_id', 'returned_item', 'returned_total_bill', 'sale_item', 'sale_total_bill', 'profit', 
    ];
}
