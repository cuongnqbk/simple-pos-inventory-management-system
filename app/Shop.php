<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
    	'name', 'address'
    ];
    public function products(){
    	return $this->belongsToMany('App\Product');
    }
    public function stock(){
    	return $this->belongsTo('App\Stock');
    }
    public function sales(){
        return $this->hasMany('App\Sale');
    }
    public function manager(){
    	return $this->hasMany('App\Manager');
    }
}
