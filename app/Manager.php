<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'shop_id', 'user_image', 'user_id', 'manager_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function shop(){
    	return $this->belongsTo('App\Shop');
    }
}
