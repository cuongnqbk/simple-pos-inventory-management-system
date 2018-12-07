<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierBill extends Model
{
    protected $fillable = [
    	'supplier_id', 'amount', 'details'
    ];
}
