<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierExpense extends Model
{
    protected $fillable = [
    	'amount', 'note', 'supplier_id', 'due', 'previous_due'
    ];
}
