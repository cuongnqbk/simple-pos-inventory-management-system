<?php

namespace App\Http\Controllers;
use Session;
use Auth;
use App\Sale;
use App\Client;
use App\SaleDetail;
use App\Shop;
use App\Product;
use App\Stock;
use App\CashInOut;
use App\SupplierExpense;
use App\Expense;
use App\Supplier;
use App\ReturnProduct;
use App\ReturnProductDetail;
use App\ReturnSaleDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function returnReport(){
        return view('admin.reports.returnReport')
            ->with('heading', "Today's Return")
            ->with('returnProductDetails', ReturnProductDetail::all())
            ->with('returnSaleDetails', ReturnSaleDetail::all())
            ->with('returnProducts', ReturnProduct::whereDate('created_at', date('Y-m-d'))->orderBy('created_at', 'desc')->get());
    }
    public function viewReturn($id){ 
        return view('admin.reports.viewReturn')
            ->with('returnProduct', ReturnProduct::find($id))
            ->with('returnProductDetails', ReturnProductDetail::where('return_id', $id)->get())
            ->with('returnSaleDetails', ReturnSaleDetail::where('return_id', $id)->get());
    } 

    public function returnReportBetweenDate(Request $request){
        $this->validate($request, [
            'date_from' => 'required',
            'date_to' => 'required',
        ]);
        $date_from = $request->date_from.' '.date('00:00:01');
        $date_to = $request->date_to.' '.date('23:59:59');
        return view('admin.reports.returnReport')
            ->with('heading', '')
            ->with('returnProductDetails', ReturnProductDetail::all())
            ->with('returnSaleDetails', ReturnSaleDetail::all())
            ->with('returnProducts', ReturnProduct::whereBetween('created_at', [$date_from, $date_to])->orderBy('created_at', 'desc')->get());
    }
    public function salesReport(){
        return view('admin.reports.salesReport')
            ->with('heading', "Today's Sale")
            ->with('saleDetails', SaleDetail::all())
            ->with('sales', Sale::whereDate('created_at', date('Y-m-d'))->orderBy('created_at', 'desc')->get());
    }
    public function salesReportBetweenDate(Request $request){
        $this->validate($request, [
            'date_from' => 'required',
            'date_to' => 'required',
        ]);
        $date_from = $request->date_from.' '.date('00:00:01');
        $date_to = $request->date_to.' '.date('23:59:59');
        return view('admin.reports.salesReport')
            ->with('heading', '')
            ->with('saleDetails', SaleDetail::all())
            ->with('sales', Sale::whereBetween('created_at', [$date_from, $date_to])->orderBy('created_at', 'desc')->get());
    }
    public function viewSale($id){ 
        return view('admin.reports.viewSale')
            ->with('sale', Sale::find($id))
            ->with('saleDetails', SaleDetail::where('sale_id', $id)->get());
    }    

    public function productEntryReport(){
        return view('admin.reports.productEntryReport')
            ->with('entries', Stock::all());
    }
    public function financialInsight(){
        $products = Product::all();
        $productsBuyPrice = 0;
        $productsSalePrice = 0;
        foreach($products as $product){
            $productsBuyPrice += $product->stockQuantity * $product->buyPrice;
            $productsSalePrice += $product->stockQuantity * $product->salePrice;
        }
        return view('admin.reports.financialInsight')
            ->with('cashIn', CashInOut::where('transaction_id', 1)->sum('amount'))
            ->with('cashOut', CashInOut::where('transaction_id', 2)->sum('amount'))
            ->with('supplierExpense', SupplierExpense::sum('amount'))
            ->with('productsBuyPrice', $productsBuyPrice)
            ->with('productsSalePrice', $productsSalePrice)
            ->with('accountReceivable', Client::sum('previous_due'))
            ->with('supplierDue', Supplier::sum('previous_due'))
            ->with('totalProfit', Sale::sum('profit'))
            ->with('totalExpense', Expense::sum('amount'))
            ->with('totalSale', Sale::sum('totalBill'));
    }
    public function financialInsightBetweenDate(Request $request){
        $this->validate($request, [
            'date_from' => 'required',
            'date_to' => 'required',
        ]);
        $date_from = $request->date_from.' '.date('00:00:01');
        $date_to = $request->date_to.' '.date('23:59:59');
        $products = Product::all();
        $productsBuyPrice = 0;
        $productsSalePrice = 0;
        foreach($products as $product){
            $productsBuyPrice += $product->stockQuantity * $product->buyPrice;
            $productsSalePrice += $product->stockQuantity * $product->salePrice;
        }
        return view('admin.reports.financialInsight')
            ->with('cashIn', CashInOut::where('transaction_id', 1)->whereBetween('created_at', [$date_from, $date_to])->sum('amount'))
            ->with('cashOut', CashInOut::where('transaction_id', 2)->whereBetween('created_at', [$date_from, $date_to])->sum('amount'))
            ->with('supplierExpense', SupplierExpense::whereBetween('created_at', [$date_from, $date_to])->sum('amount'))
            ->with('productsBuyPrice', $productsBuyPrice)
            ->with('productsSalePrice', $productsSalePrice)
            ->with('accountReceivable', Client::whereBetween('created_at', [$date_from, $date_to])->sum('previous_due'))
            ->with('supplierDue', Supplier::whereBetween('created_at', [$date_from, $date_to])->sum('previous_due'))
            ->with('totalProfit', Sale::whereBetween('created_at', [$date_from, $date_to])->sum('profit'))
            ->with('totalExpense', Expense::whereBetween('created_at', [$date_from, $date_to])->sum('amount'))
            ->with('totalSale', Sale::whereBetween('created_at', [$date_from, $date_to])->sum('totalBill'));
    }
}
