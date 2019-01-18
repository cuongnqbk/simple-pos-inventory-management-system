<?php

namespace App\Http\Controllers;

use Session;
use App\Supplier;
use App\SupplierExpense;
use App\SupplierBill;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{

    public function index()
    {
        return view('admin.suppliers.suppliers')->with('suppliers', Supplier::orderBy('created_at', 'desc')->get());
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact_no' => 'required',
            'previous_due' => 'required',
        ]);

        $supplier = Supplier::create([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'previous_due' => $request->previous_due,
            'details' => $request->details,
        ]);

        Session::flash('success', 'Supplier Added Successfully');
        return redirect()->route('suppliers');
    }

    public function show($id)
    {
        return view('admin.suppliers.show')->with('supplier', Supplier::find($id));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact_no' => 'required',
            'previous_due' => 'required',
        ]);

        $supplier = Supplier::find($id);

        $supplier->name = $request->name;
        $supplier->contact_no = $request->contact_no;
        $supplier->previous_due = $request->previous_due;
        $supplier->details = $request->details;

        $supplier->save();

        Session::flash('success', 'Supplier Updated Successfully');
        return redirect()->route('suppliers');
    }
    
    public function destroy($id)
    {
        //
    }

    public function allSupplierExpenses()
    {
        return view('admin.suppliers.allSupplierExpenses')
            ->with('suppliers', Supplier::all())
            ->with('totalExpense', SupplierExpense::whereDay('created_at', date('d'))->whereYear('created_at', date('Y'))->sum('amount'))
            ->with('supplierExpenses', SupplierExpense::whereDay('created_at', date('d'))->whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get());
    }
    public function allSupplierExpensesBetweenDate(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $date_from = $request->expense_date_from;
        $date_to = $request->expense_date_to;

        $expense_date_from = $request->expense_date_from.' '.date('00:00:01');
        $expense_date_from_end = $request->expense_date_from.' '.date('23:59:59');
        $expense_date_to = $request->expense_date_to.' '.date('23:59:59');
        $expense_date_to_start = $request->expense_date_to.' '.date('00:00:01');


        if(!isset($supplier_id) && $date_from === null && $date_to === null){
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::all()->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::orderBy('created_at', 'desc')->get());
        }else if(isset($supplier_id) && $date_from === null && $date_to === null){
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::where('supplier_id', $supplier_id)->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::where('supplier_id', $supplier_id)->orderBy('created_at', 'desc')->get());
        }else if(isset($supplier_id) && isset($date_from) && $date_to === null){
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::where('supplier_id', $supplier_id)->where('created_at', '>=' , $expense_date_from)->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::where('supplier_id', $supplier_id)->where('created_at', '>=' , $expense_date_from)->orderBy('created_at', 'desc')->get());
        }else if(isset($supplier_id) && $date_from === null && isset($date_to) ){          
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::where('supplier_id', $supplier_id)->whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::where('supplier_id', $supplier_id)->whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(!isset($supplier_id) && isset($date_from) && $date_to === null){          
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::where('created_at', '>=' , $expense_date_from)->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::where('created_at', '>=' , $expense_date_from)->orderBy('created_at', 'desc')->get());            
        }else if(!isset($supplier_id) && $date_from === null && isset($date_to) ){          
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(!isset($supplier_id) && isset($date_from) && isset($date_to) ){          
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::whereBetween('created_at', [$expense_date_from, $expense_date_to])->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(isset($supplier_id) && isset($date_from) && isset($date_to) ){          
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::where('supplier_id', $supplier_id)->whereBetween('created_at', [$expense_date_from, $expense_date_to])->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::where('supplier_id', $supplier_id)->whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else{
            return view('admin.suppliers.allSupplierExpenses')
                ->with('suppliers', Supplier::all())
                ->with('totalExpense', SupplierExpense::whereBetween('created_at', [$expense_date_from, $expense_date_to])->sum('amount'))
                ->with('supplierExpenses', SupplierExpense::whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')
                ->get());
        }
    }
    public function supplierExpense()
    {
        return view('admin.suppliers.supplierExpense')->with('suppliers', Supplier::all());
    }
    public function storeSupplierExpense(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required',
            'amount' => 'required',
        ]);

        $supplierExpense = SupplierExpense::create([
            'supplier_id' => $request->supplier_id,
            'amount' => $request->amount,
            'due' => $request->due,
            'note' => $request->note,
        ]);

        $supplier = Supplier::find($request->supplier_id);

        $supplier->update([
            'previous_due'=> $request->due
        ]);

        $supplier->save();

        Session::flash('success', 'Supplier Expense Created Successfully');
        return redirect()->route('supplier.allSupplierExpenses');
    }

    public function allSupplierBills()
    {
        return view('admin.suppliers.allSupplierBills')
                ->with('totalBill', SupplierBill::whereDay('created_at', date('d'))->whereYear('created_at', date('Y'))->sum('amount'))
                ->with('supplierBills', SupplierBill::whereDay('created_at', date('d'))->whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->get());
    }
    public function allSupplierBillsBetweenDate(Request $request)
    {
        $date_from = $request->expense_date_from;
        $date_to = $request->expense_date_to;

        $expense_date_from = $request->expense_date_from.' '.date('00:00:01');
        $expense_date_from_end = $request->expense_date_from.' '.date('23:59:59');
        $expense_date_to = $request->expense_date_to.' '.date('23:59:59');
        $expense_date_to_start = $request->expense_date_to.' '.date('00:00:01');


        if($date_from === null && $date_to === null){
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::all()->sum('amount'))
                ->with('supplierBills', SupplierBill::orderBy('created_at', 'desc')->get());
        }else if($date_from === null && $date_to === null){
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::all()->sum('amount'))
                ->with('supplierBills', SupplierBill::orderBy('created_at', 'desc')->get());
        }else if(isset($date_from) && $date_to === null){
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::where('created_at', '>=' , $expense_date_from)->orderBy('created_at', 'desc')->sum('amount'))
                ->with('supplierBills', SupplierBill::where('created_at', '>=' , $expense_date_from)->orderBy('created_at', 'desc')->get());
        }else if($date_from === null && isset($date_to) ){          
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->orderBy('created_at', 'desc')->sum('amount'))
                ->with('supplierBills', SupplierBill::whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(isset($date_from) && $date_to === null){          
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::where('created_at', '>=' , $expense_date_from)->orderBy('created_at', 'desc')->sum('amount'))
                ->with('supplierBills', SupplierBill::where('created_at', '>=' , $expense_date_from)->orderBy('created_at', 'desc')->get());            
        }else if($date_from === null && isset($date_to) ){          
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->sum('amount'))
                ->with('supplierBills', SupplierBill::whereBetween('created_at', [$expense_date_to_start, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(isset($date_from) && isset($date_to) ){          
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::whereBetween('created_at', [$expense_date_from, $expense_date_to])->sum('amount'))
                ->with('supplierBills', SupplierBill::whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else if(isset($date_from) && isset($date_to) ){          
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::whereBetween('created_at', [$expense_date_from, $expense_date_to])->sum('amount'))
                ->with('supplierBills', SupplierBill::whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')->get());
        }else{
            return view('admin.suppliers.allSupplierBills')
                ->with('suppliers', Supplier::all())
                ->with('totalBill', SupplierBill::whereBetween('created_at', [$expense_date_from, $expense_date_to])->sum('amount'))
                ->with('supplierBills', SupplierBill::whereBetween('created_at', [$expense_date_from, $expense_date_to])->orderBy('created_at', 'desc')
                ->get());
        }
    }
    public function supplierBill()
    {
        return view('admin.suppliers.supplierBill')->with('suppliers', Supplier::all());
    }
    public function storeSupplierBill(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required',
            'amount' => 'required',
        ]);

        $supplierbill = SupplierBill::create([
            'supplier_id' => $request->supplier_id,
            'amount' => $request->amount,
            'details' => $request->note,
        ]);

        $supplier = Supplier::find($request->supplier_id);
        $oldDue = $supplier->previous_due;

        $supplier->update([
            'previous_due'=> $request->amount + $oldDue
        ]);

        $supplier->save();

        Session::flash('success', 'Supplier Bill Created Successfully');
        return redirect()->route('supplier.allSupplierBills');
    }
}
