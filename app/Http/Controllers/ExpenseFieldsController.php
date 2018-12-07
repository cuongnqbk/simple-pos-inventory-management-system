<?php

namespace App\Http\Controllers;

use Session;
use App\ExpenseField;
use Illuminate\Http\Request;

class ExpenseFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expenseFields.expenseFields')->with('expenseFields', ExpenseField::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expenseFields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'expense_field' => 'required'
        ]);
        $expense_field = ExpenseField::create([
            'expense_field' => $request->expense_field
        ]);

        Session::flash('success', 'Expense Field Created Successfully');
        return redirect()->route('expenseFields');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense_field = ExpenseField::find($id);
        return view('admin.expenseFields.show')->with('expenseField', $expense_field);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'expense_field' => 'required'
        ]);
        $expense_field = ExpenseField::find($id);
        $expense_field->expense_field = $request->expense_field;

        $expense_field->save();
        Session::flash('success', 'Expense Field Updated Successfully');
        return redirect()->route('expenseFields');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
