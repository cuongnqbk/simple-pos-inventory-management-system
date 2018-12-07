<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DebitNote extends Model
{
    protected $fillable = [
    	'date', 'client_id', 'amount', 'details', 'note'
    ];

    public function client(){
    	return $this->belongsTo('App\Client');
    }
}
