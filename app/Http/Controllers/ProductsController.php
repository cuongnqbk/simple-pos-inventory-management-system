<?php

namespace App\Http\Controllers;

use Session;
use App\Shop;
use App\Product;
use App\ProductType;
use App\Stock;
use App\Transfer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $productsBuyPrice = 0;
        $productsSalePrice = 0;
        foreach($products as $product){
            $productsBuyPrice += $product->stockQuantity * $product->buyPrice;
            $productsSalePrice += $product->stockQuantity * $product->salePrice;
        }

        // dd($productsSalePrice);
        return view('admin.products.showInventory')
                ->with('productTypes', ProductType::all())
                ->with('productsCount', Product::count('id'))
                ->with('productsSalePrice', $productsSalePrice)
                ->with('productsBuyPrice', $productsBuyPrice)
                ->with('products', Product::all());
    }


    public function create()
    {
        return view('admin.products.create')
                ->with('productTypes', ProductType::all())
                ->with('products', Product::all());
    }

    public function store(Request $request)
    {
        //dd(request()->all());
        $this->validate($request, [
            'productName' => 'required|unique:products',
            'product_type_id' => 'required',
            'salePrice' => 'required|numeric'
        ]);
        $product = Product::create([
            'productName' => $request->productName,
            'productBarcode' => 1000,
            'product_type_id' => $request->product_type_id,
            'stockQuantity' => 0,
            'salePrice' => $request->salePrice,
            'buyPrice' => $request->buyPrice,
            'description' => $request->description,
            'note' => $request->note
        ]);
        $product->update(['productBarcode' => 1000 + $product->id]);
        //$product->save();
        Session::flash('success', 'New Product added to Stock Successfully');
        return redirect()->route('showInventory');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $proShop = DB::table('product_shop')
                    ->select('shop_id', DB::raw('SUM(quantity) as total'))
                    ->where('product_id', $product->id)
                    ->groupBy('shop_id')
                    ->get();
        return view('admin.products.show')
                ->with('productTypes', ProductType::all())
                ->with('product', $product)
                ->with('shops', Shop::all())
                ->with('stocks', Stock::all())
                ->with('proShops', $proShop);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'productName' => 'required',
            'product_type_id' => 'required',
            'salePrice' => 'required|numeric'
        ]);
        $product = Product::find($id);
        $product->productName = $request->productName;
        $product->product_type_id = $request->product_type_id;
        $product->salePrice = $request->salePrice;
        $product->stockQuantity = $request->stockQuantity;
        $product->description = $request->description;
        $product->note = $request->note;
        $product->save();
        Session::flash('success', 'Product added to Stock Successfully');
        return redirect()->route('showInventory');
    }

    public function destroy($id)
    {
        
    }

    public function transfer()
    {
        return view('admin.products.transfer')
                ->with('shops', Shop::all())
                ->with('products', Product::all());
    }

    public function storeTransfer(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'shop_from_id' => 'required',
            'shop_to_id' => 'required',
            'quantity' => 'required|numeric'
        ]);
        if($request->quantity <= $request->stockQuantityFrom){
            if($request->shop_from_id != $request->shop_to_id){
                $shopFrom =  DB::table('product_shop')
                            ->select('quantity')
                            ->where('product_id', $request->product_id)
                            ->where('shop_id', $request->shop_from_id)
                            ->first();
                DB::table('product_shop')
                            ->where('product_id', $request->product_id)
                            ->where('shop_id', $request->shop_from_id)
                            ->update(['quantity' => $shopFrom->quantity - $request->quantity]);
               
                $shopTo = DB::table('product_shop')
                            ->select('quantity')
                            ->where('product_id', $request->product_id)
                            ->where('shop_id', $request->shop_to_id)
                            ->first();

                DB::table('product_shop')
                            ->select('quantity')
                            ->where('product_id', $request->product_id)
                            ->where('shop_id', $request->shop_to_id)
                            ->update(['quantity' => $shopTo->quantity + $request->quantity]);

                $transfer = Transfer::create([
                    'product_id' => $request->product_id,
                    'shop_from_id' => $request->shop_from_id,
                    'shop_to_id' => $request->shop_to_id,
                    'quantity' => $request->quantity,
                    'reference' => $request->reference,
                    'note' => $request->note
                ]);

                Session::flash('success', 'Product Transfered Successfully');
                return redirect()->route('showInventory');
            }else{
                Session::flash('error', 'Transfer from shop and transfer to shop cannot be same');
                return back();
            }
        }
        
    }
}
