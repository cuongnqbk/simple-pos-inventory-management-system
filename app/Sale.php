<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $table = 'sales';

    protected $fillable = [
    	'items', 'subTotal', 'shop_id', 'additionalCost',  'discount',  'totalBill',  'paidAmount', 'client_id', 'totalItems', 'grandTotal', 'profit'
    ];

    public function shop(){
    	return $this->belongsTo('App\Shop');
    }
    public function products(){
    	return $this->belongsToMany('App\Product');
    }
}
