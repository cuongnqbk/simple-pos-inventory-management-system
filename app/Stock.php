<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
    	'product_id', 'shop_id', 'quantity', 'total_cost', 'unit_cost', 'previous_quantity', 'new_quantity','buyPrice', 'previous_buyPrice' 
    ];
    
    public function shops(){
    	return $this->hasMany('App\Shop');
    }
}
