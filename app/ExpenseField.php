<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseField extends Model
{
    protected $fillable = ['expense_field'];

    public function expenses(){
    	return $this->hasMany('App\Expense');
    }
}
