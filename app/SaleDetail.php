<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
    	'sale_id', 'product_id', 'quantity', 'price', 'subTotal', 'shop_id', 'client_id'
    ];
    
    public function products(){
    	return $this->belongsToMany('App\Product');
    }
}
