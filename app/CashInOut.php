<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashInOut extends Model
{
    protected $fillable = [
    	'details', 'amount', 'transaction_id'
    ];
}
