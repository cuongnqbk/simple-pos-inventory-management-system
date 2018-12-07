<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['productName', 'productBarcode', 'product_type_id', 'stockQuantity', 'salePrice', 'buyPrice', 'description', 'note', 'product_id', 'shop_from_id', 'shop_to_id', 'quantity', 'reference'];

    public function productType(){
    	return $this->belongsTo('App\ProductType');
    }
    public function shops(){
    	return $this->belongsToMany('App\Shop');
    }
}
