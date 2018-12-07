<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivePayment extends Model
{
    protected $fillable = ['client_id', 'previous_due', 'paid_amount', 'due', 'note', 'receive_date_from', 'receive_date_to', 'shop_id', 'received_by'
	];
	
    public function client(){
    	return $this->belongsTo('App\Client');
    }
}
