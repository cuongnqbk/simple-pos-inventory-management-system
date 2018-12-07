<?php

namespace App\Http\Controllers;

use Session;
use App\Shop;
use App\Stock;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stocks.create')
            ->with('shops', Shop::all())
            ->with('products', Product::all());
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
            'product_id' => 'required',
            'shop_id' => 'required',
            'quantity' => 'required|numeric',
            'unit_cost' => 'required|numeric',
            //'custom_unit_cost' => 'required|numeric'
        ]);

        $stock = Stock::create([
            'product_id' => $request->product_id,
            'shop_id' => $request->shop_id,
            'quantity' => $request->quantity,
            'total_cost' => $request->total_cost,
            'description' => $request->description,
            'unit_cost' => $request->unit_cost,
            'description' => $request->description,
            'note' => $request->note
        ]);

        $product = Product::find($request->product_id);
        $product->update([
            'stockQuantity' => $request->new_quantity,
            'buyPrice' => $request->buyPrice
        ]);

        $existProShop = DB::table('product_shop')
                        ->where('product_id', $product->id)
                        ->where('shop_id', $request->shop_id)
                        ->first();

        $quantity = DB::table('product_shop')
                        ->select('quantity')
                        ->where('product_id', $request->product_id)
                        ->where('shop_id', $request->shop_id)
                        ->first();

        if(!$existProShop){
            $product->shops()->attach($request->shop_id, ['quantity' => $request->quantity]);
        }else{
            DB::table('product_shop')
                        ->where('product_id', $product->id)
                        ->where('shop_id', $request->shop_id)
                        ->update(['quantity'=> $quantity->quantity+$request->quantity]);
        }

        Session::flash('success', 'Product added to Stock Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
