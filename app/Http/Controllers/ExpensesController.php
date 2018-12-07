<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\ExpenseField;
use App\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        if(ExpenseField::all()->count() > 0){
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::whereDate('created_at', date('Y-m-d'))->orderBy('created_at', 'desc')->get());
        }else{
            Session::flash('error', 'There is no Expense Field');
            return redirect()->back();
        }
    }
    public function expenseBetweenDate(Request $request)
    {
        $expense_field_id = $request->expense_field_id;
        $date_from = $request->expense_date_from;
        $date_to = $request->expense_date_to;

        $expense_date_from = $request->expense_date_from.' '.date('00:00:01');
        $expense_date_from_end = $request->expense_date_from.' '.date('23:59:59');
        $expense_date_to = $request->expense_date_to.' '.date('23:59:59');
        $expense_date_to_start = $request->expense_date_to.' '.date('00:00:01');


        if(!isset($expense_field_id) && $date_from === null && $date_to === null){
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::take(10)->orderBy('created_at', 'desc')->get());
        }else if(isset($expense_field_id) && $date_from === null && $date_to === null){
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::where('expense_field_id', $expense_field_id)->orderBy('created_at', 'desc')->get());
        }else if(isset($expense_field_id) && isset($date_from) && $date_to === null){
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::where('expense_field_id', $expense_field_id)->where('created_at', '>=' , $expense_date_from)->orderBy('created_at', 'desc')->get());
        }else if(isset($expense_field_id) && $date_from === null && isset($date_to) ){          
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::where('expense_field_id', $expense_field_id)->whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(!isset($expense_field_id) && isset($date_from) && $date_to === null){          
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::where('created_at', '>=' , $expense_date_from)->orderBy('created_at', 'desc')->get());            
        }else if(!isset($expense_field_id) && $date_from === null && isset($date_to) ){          
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(!isset($expense_field_id) && isset($date_from) && isset($date_to) ){          
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(isset($expense_field_id) && isset($date_from) && isset($date_to) ){          
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::where('expense_field_id', $expense_field_id)->whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else{
            return view('admin.expenses.expenses')
                ->with('expense_fields', ExpenseField::all())
                ->with('expenses', Expense::whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')
                ->get());
        }
    }

    public function create()
    {
        if(ExpenseField::all()->count() > 0){
            return view('admin.expenses.create')
                    ->with('expenses', Expense::all())
                    ->with('expense_fields', ExpenseField::all());
        }else{
            Session::flash('error', 'There is no Expense Field');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'expense_field_id' => 'required',
            'amount' => 'required'
        ]);

        $expense = Expense::create([
            'shop_id' => Auth::user()->shop_id,
            'expense_field_id' => $request->expense_field_id,
            'amount' => $request->amount,
            'added_by' => Auth::user()->name,
            'details' => $request->details,
            'note' => $request->note
        ]);

        Session::flash('success', 'Expense Added Successfully');
        return redirect()->route('expenses');
    }

    public function show($id)
    {
        $expense = Expense::find($id);

        return view('admin.expenses.show')
                ->with('expense', $expense)
                ->with('expense_fields', ExpenseField::all());
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
            'expense_field_id' => 'required',
            'details' => 'required',
            'amount' => 'required',
            'note' => 'required'
        ]);

        $expense = Expense::find($id);

        $expense->expense_field_id = $request->expense_field_id;
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->note = $request->note;

        $expense->save();

        Session::flash('success', 'Expense Updated Successfully');
        return redirect()->route('expenses');*/
    }

    public function destroy($id)
    {
        //
    }
}
