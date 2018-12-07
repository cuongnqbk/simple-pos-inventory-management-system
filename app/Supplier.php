<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
    	'name', 'contact_no', 'previous_due', 'details', 'supplier_id'
    ];
}
