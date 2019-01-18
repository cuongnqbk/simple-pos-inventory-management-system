<?php

namespace App\Http\Controllers;

Use Auth;
use Session;
use Cart;
use App\Sale;
use App\SaleDetail;
use App\Product;
use App\Client;
use App\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view('admin.sales.addInvoice')
                    ->with('clients', Client::all())
                    ->with('products', Product::all());
    }

    public function productsBarcodeAjax(Request $request){
        $product = Product::where('productBarcode', $request->productBarcode)->first();
        $data = array(
            'productBarcode' => $request->productBarcode,
            'price' => $product->salePrice,
        );
        echo json_encode($data);
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'productBarcode' => 'required',
            'quantity' => 'required|numeric'
        ]);
        $product = Product::where('productBarcode', $request->productBarcode)->first();
        $proQuantity = $product->stockQuantity;
        $buyPrice = $product->buyPrice;   
        $qty = $request->quantity;

        if(empty($request->special_price)){
            $price = $product->salePrice;
        }else{
            $price = $request->special_price;
        }

        $availableQuantity = 
            DB::table('product_shop')
            ->select('quantity')
            ->where('product_id', $product->id)
            ->where('shop_id', Auth::user()->shop_id)
            ->first();

        $pastBuy=0;
        $carts = Cart::content();
        if($carts != null){
            foreach($carts as $cart){
                if($cart->id == $product->id){
                    $pastBuy = $cart->qty;
                }
            }  
        }

        if($availableQuantity && 
            $proQuantity == $availableQuantity->quantity 
            && $proQuantity > 0){
            if(($qty+$pastBuy) > $availableQuantity->quantity){
            $data = array(
                'errors' => 'Stock Quantity: '.($availableQuantity->quantity-$pastBuy),
                'status'=> false
                );
            }else{
                Cart::add([
                    'id' => $product->id,
                    'name' => $product->productName,
                    'qty' => $qty,
                    'price' => $price,
                    'options' => [
                        'total_quantity' => $availableQuantity->quantity, 
                        'productBarcode' => $product->productBarcode, 
                        'buyPrice'=>$product->buyPrice, 
                        'profit'=> $price - $product->buyPrice,
                    ]
                ]);
                $carts=Cart::content();
                $numItems = Cart::content()->count();
                $i = 0;
                foreach(Cart::content() as $cart) { 
                    if($i+1 == $numItems) { 
                        $saved_rowid = $cart->rowId; 
                    } 
                    $i++;
                }

                
                $profit = 0;
                if(Cart::count() > 0){
                    foreach(Cart::content() as $cart){
                        $subProfit = $cart->options->profit;
                        $profit += $subProfit;
                    }                        
                }              
                
                if($pastBuy>0){
                    $data = array(
                        'product_id'=>$product->id,
                        'productBarcode'=>$product->productBarcode,
                        'quantity'=>$qty+$pastBuy,
                        'price'=>$price,
                        'buyPrice'=>$product->buyPrice,
                        'total_quantity'=>$availableQuantity->quantity,
                        'proQuantity' => $proQuantity,
                        'rowid'=>$saved_rowid,
                        'status'=>true,
                        'past_buy'=>true,
                        'uniqueQuantity' => Cart::content()->count(),
                        'profit'=> $profit,
                    );
                }
                else{
                    $data = array(
                        'product_id'=>$product->id,
                        'productBarcode'=>$product->productBarcode,
                        'quantity'=>$qty,
                        'price'=>$price,
                        'buyPrice'=>$product->buyPrice,
                        'name'=>$product->productName,
                        'total_quantity'=>$availableQuantity->quantity,
                        'proQuantity' => $proQuantity,
                        'rowid'=>$saved_rowid,
                        'status'=>true,
                        'past_buy'=>false,
                        'uniqueQuantity' => Cart::content()->count(),
                        'profit'=> $profit,
                    );
                }
            }
        }else{
            $data = array(
                'errors' => 'Product not available in Shop',
                'status'=> false
            );
        }
        echo json_encode($data);     
    }


    public function cartStore(Request $request)
    {
        $this->validate($request, [
            'paidAmount' => 'required'
        ]);
        if($request->has('discount')){
            $discount = $request->discount; 
        }else{
            $discount = 0;
        }
        if($request->has('additionalCost')){
            $additionalCost = $request->additionalCost;
        }else{
            $additionalCost = 0;
        }
        $uniqueItem = Cart::content()->count();
        $saleDetails = Cart::content();
        $subProfit = 0;
        foreach($saleDetails as $item){
            $product = Product::find($item->id);
            $buyPrice = $product->buyPrice;
            $price = $item->price;
            $quantity = $item->qty;
            $subProfit += ($price-$buyPrice)*$quantity;
        }

        $sale = Sale::create([
            'shop_id' => Auth::user()->shop_id,
            'client_id' => $request->client_id,
            'items' => $request->totalItems,
            'subTotal' => $request->subTotal,
            'additionalCost' => $additionalCost,
            'discount' => $discount,
            'totalBill' => $request->grandTotal,
            'paidAmount' => $request->paidAmount,
            'profit' => $subProfit - $discount + $additionalCost
        ]);
        foreach($saleDetails as $item){
            $saleDetail = SaleDetail::create([
                'sale_id' => $sale->id,
                'shop_id' => Auth::user()->shop_id,
                'client_id' => $request->client_id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
                'subTotal' => $item->qty*$item->price
            ]);
            if($request->has('client_id')){
                $client = Client::find($request->client_id);
                $client->update(['previous_due'=> $request->totalDue]);                
            }

            $product = Product::find($item->id);
            $product->update(['stockQuantity' => $product->stockQuantity - $item->qty]);
            $quantity = DB::table('product_shop')
                    ->select('quantity')
                    ->where('product_id', $product->id)
                    ->where('shop_id', Auth::user()->shop_id)
                    ->first();
            $newQuantity =  $quantity->quantity - $item->qty;
            DB::table('product_shop')
                    ->where('product_id', $product->id)
                    ->where('shop_id', Auth::user()->shop_id)
                    ->update(['quantity' => $newQuantity]);

        }
        Session::flash('success', 'Sale Created Successfully');
        Cart::destroy();
        return view('admin.sales.printInvoice')
                    ->with('saleDetails', SaleDetail::where('sale_id', $sale->id)->get())
                    ->with('uniqueItem', $uniqueItem)
                    ->with('sale', $sale);
    }


    // public function printInvoice(Request $request){
    //     return view('admin.sales.printInvoice')
    //                 ->with('shop', Shop::all())
    //                 ->with('sale', Sale::where('id', $request->sale_id));
    // }

    public function removeItem(Request $request, $id){
        $item = Cart::get($id);
        $data = array(
            'rowId'=> $request->rowId,    
            'status'=>true,
            'uniqueQuantity'=> Cart::content()->count(),
        );
        echo json_encode($data);

        Cart::remove($id);
    }

    public function increment(Request $request, $id){
        $rowId=$request->rowId;
        $item = Cart::get($rowId);
        $product = Product::find($item->id);
        $salePrice = $product->salePrice;
        $buyPrice = $product->buyPrice;
        $productqty = $item->qty;
        $qty = $productqty+1;
        Cart::update($rowId, $qty);
        $data = array(
            'rowId'=> $rowId,
            'status'=>true,
            'profit' => $salePrice - $buyPrice,
        );
        echo json_encode($data);
    }
    public function decrement(Request $request, $id){
        $rowId=$request->rowId;
        $item = Cart::get($rowId);
        $product = Product::find($item->id);
        $salePrice = $product->salePrice;
        $buyPrice = $product->buyPrice;
        $productqty = $item->qty;
        $qty = $productqty-1;
        Cart::update($rowId, $qty);
        $data = array(
            'rowId'=> $rowId,
            'status'=>true,
            'profit' => $salePrice - $buyPrice,
        );
        echo json_encode($data);
    }
    public function changeQuantity(Request $request, $id){
        $rowId=$request->rowId;
        $item = Cart::get($rowId);
        $productqty = $item->qty;
        $product = Product::find($item->id);
        $totalQty = $product->stockQuantity;
        $salePrice = $product->salePrice;
        $buyPrice = $product->buyPrice;
        $qty = $request->qty;
        if($qty > $totalQty){
            $data = array(
                'errors' => 'Stock Quantity: '. $totalQty,
                'status'=> false,
                'old_qty'=> $productqty,
                'profit' => $salePrice - $buyPrice,
            );
            //$qty = 1;
        }else if($qty < 1){
            $data = array(
                'errors' => 'Quantity Must be at least 1',
                'status'=> false,
                'old_qty'=> $productqty,
                'profit' => $salePrice - $buyPrice,
            );
            //$qty = 1;
        }else{
            $old_qty = $request->qty - $item->qty;
            Cart::update($rowId, $qty);
            $data = array(
                'rowId'=> $rowId,
                'status'=>true,
                'qty' => $request->qty,
                'old_qty'=> $productqty,
                'profit' => $salePrice - $buyPrice,
            );
        }
        echo json_encode($data);
    }

    public function destroyCart(){
        Cart::destroy();
        Session::flash('success', 'Cart Destroyed Successfully');
        return back();
    }
}
