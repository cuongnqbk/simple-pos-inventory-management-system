<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
    	'expense_field_id', 'details', 'amount', 'note', 'expense_date_from', 'expense_date_to', 'added_by', 'shop_id'
    ];

    public function expenseField(){
    	return $this->belongsTo('App\ExpenseField');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
