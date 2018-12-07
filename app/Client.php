<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    	'business_started_since', 'name', 'address', 'contact_no', 'reference', 'note ', 'previous_due' 
    ];

    public function debitNotes(){
    	return $this->hasMany('App\DebitNote');
    }
}
