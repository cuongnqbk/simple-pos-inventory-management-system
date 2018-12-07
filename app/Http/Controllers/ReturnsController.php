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
use App\ReturnProduct;
use App\ReturnProductDetail;
use App\ReturnSaleDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReturnsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.returns.create')
                ->with('clients', Client::all())
                ->with('products', Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addReturn(Request $request)
    {
        $this->validate($request, [
            'productBarcodeReturn' => 'required',
            'quantityReturn' => 'required|numeric'
        ]);
        $product = Product::where('productBarcode', $request->productBarcodeReturn)->first();
        if(empty($request->special_price_return)){
            $price = $product->salePrice;
        }else{
            $price = $request->special_price_return;
        }
        $availableQuantity = DB::table('product_shop')
                    ->select('quantity')
                    ->where('product_id', $product->id)
                    ->where('shop_id', Auth::user()->shop_id)
                    ->first();

        $qty = $request->quantityReturn;

        $pastBuy=0;
        $carts = Cart::instance('returnProduct')->content();
        if($carts != null){          
            foreach($carts as $cart){
                if($cart->id == $product->id){
                    $pastBuy = $cart->qty;
                }
            }  
        }
        
        Cart::instance('returnProduct')->add([
            'id' => $product->id,
            'name' => $product->productName,
            'qty' => $qty,
            'price' => $price,
            'options' => ['total_quantity' => $availableQuantity->quantity, 'productBarcode' => $product->productBarcode]
        ]);
        $carts=Cart::instance('returnProduct')->content();
        $numItems = Cart::instance('returnProduct')->content()->count();
        $i = 0;
        foreach(Cart::instance('returnProduct')->content() as $cart) { 
            if($i+1 == $numItems) { 
                $saved_rowid = $cart->rowId; 
            } 
            $i++;
        }
        
        if($pastBuy>0){
            $data = array(
                'product_id'=>$product->id,
                'productBarcode'=>$product->productBarcode,
                'quantity'=>$qty+$pastBuy,
                'price'=>$price,
                'buyPrice'=>$product->buyPrice,
                'total_quantity'=>$availableQuantity->quantity,
                'rowid'=>$saved_rowid,
                'status'=>true,
                'past_buy'=>true,
                'uniqueQuantity' => Cart::instance('returnProduct')->content()->count(),
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
                'rowid'=>$saved_rowid,
                'status'=>true,
                'past_buy'=>false,
                'uniqueQuantity' => Cart::instance('returnProduct')->content()->count(),
            );
        }
        echo json_encode($data);        
    }
    public function addSale(Request $request)
    {
        $this->validate($request, [
            'productBarcodeSale' => 'required',
            'quantitySale' => 'required|numeric'
        ]);
        $product = Product::where('productBarcode', $request->productBarcodeSale)->first();
        $proQuantity = $product->stockQuantity;
        if(empty($request->special_price_sale)){
            $price = $product->salePrice;
        }else{
            $price = $request->special_price_sale;
        }
        $availableQuantity = DB::table('product_shop')
                    ->select('quantity')
                    ->where('product_id', $product->id)
                    ->where('shop_id', Auth::user()->shop_id)
                    ->first();

        $qty = $request->quantitySale;

        $pastBuy=0;
        $carts = Cart::instance('sale')->content();
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
                Cart::instance('sale')->add([
                    'id' => $product->id,
                    'name' => $product->productName,
                    'qty' => $qty,
                    'price' => $price,
                    'options' => ['total_quantity' => $availableQuantity->quantity, 'productBarcode' => $product->productBarcode]
                ]);
                $carts=Cart::instance('sale')->content();
                $numItems = Cart::instance('sale')->content()->count();
                $i = 0;
                foreach(Cart::instance('sale')->content() as $cart) { 
                    if($i+1 == $numItems) { 
                        $saved_rowid = $cart->rowId; 
                    } 
                    $i++;
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
                        'uniqueQuantity' => Cart::instance('sale')->content()->count(),
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
                        'uniqueQuantity' => Cart::instance('sale')->content()->count(),
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


    public function returnSaleStore(Request $request)
    {
        //dd(request()->all());
        $returnDetails = Cart::instance('returnProduct')->content();
        $saleDetails = Cart::instance('sale')->content();


        $profit = 0;
        if(Cart::instance('sale')->count() > 0){
            foreach($saleDetails as $item){
                $product = Product::find($item->id);
                $buyPrice = $product->buyPrice;
                $price = $item->price;
                $quantity = $item->qty;
                $profit += ($price-$buyPrice)*$quantity;
            }
        }

        $returnProduct = ReturnProduct::create([
            'shop_id' => Auth::user()->shop_id,
            'client_id' => $request->client_id,
            'returned_item' => $request->totalItemsReturn,
            'returned_total_bill' => $request->subTotalReturn,
            'sale_item' => $request->totalItemsSale,
            'sale_total_bill' => $request->subTotalSale,
            'profit' => $profit > 0 ? $profit : 0,
        ]);

        if(Cart::instance('sale')->count() > 0){
            foreach($saleDetails as $item){
                $saleDetail = ReturnSaleDetail::create([
                    'return_id' => $returnProduct->id,
                    'shop_id' => Auth::user()->shop_id,
                    'client_id' => $request->client_id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                    'subTotal' => $item->qty*$item->price
                ]);

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
        }

        foreach($returnDetails as $item){
            $returnDetail = ReturnProductDetail::create([
                'return_id' => $returnProduct->id,
                'shop_id' => Auth::user()->shop_id,
                'client_id' => $request->client_id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
                'subTotal' => $item->qty*$item->price
            ]);

            $product = Product::find($item->id);
            $product->update(['stockQuantity' => $product->stockQuantity + $item->qty]);
            $quantity = DB::table('product_shop')
                    ->select('quantity')
                    ->where('product_id', $product->id)
                    ->where('shop_id', Auth::user()->shop_id)
                    ->first();
            $newQuantity =  $quantity->quantity + $item->qty;
            DB::table('product_shop')
                    ->where('product_id', $product->id)
                    ->where('shop_id', Auth::user()->shop_id)
                    ->update(['quantity' => $newQuantity]);
        }

        Session::flash('success', 'Product Returned Successfully');
        Cart::instance('sale')->destroy();
        Cart::instance('returnProduct')->destroy();
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

    public function removeItemReturn(Request $request, $id){
        Cart::instance('returnProduct')->remove($id);
        $data = array(
            'rowId'=> $request->rowId,
            'status'=> true,
            'uniqueQuantity'=> Cart::instance('returnProduct')->content()->count(),
        );
        echo json_encode($data);
    }

    public function removeItemSale(Request $request, $id){
        Cart::instance('sale')->remove($id);
        $data = array(
            'rowId'=> $request->rowId,
            'status'=> true,
            'uniqueQuantity'=> Cart::instance('sale')->content()->count(),
        );
        echo json_encode($data);
    }


    public function destroyReturn(){
        Cart::instance('returnProduct')->destroy();
        Session::flash('success', 'Cart Destroyed Successfully');
        return back();
    }

    public function destroySale(){
        Cart::instance('sale')->destroy();
        Session::flash('success', 'Cart Destroyed Successfully');
        return back();
    }

    public function changeReturnProductQuantity(Request $request, $id){
        $rowId=$request->rowId;
        $item = Cart::instance('returnProduct')->get($rowId);
        $productqty = $item->qty;
        $product = Product::find($item->id);
        $totalQty = $product->stockQuantity;
        $qty = $request->qty;
        if($qty > $totalQty){
            $data = array(
                'errors' => 'Stock Quantity: '. $totalQty,
                'status'=> false,
                'old_qty'=> $productqty
            );
        }else if($qty < 1){
            $data = array(
                'errors' => 'Quantity Must be at least 1',
                'status'=> false,
                'old_qty'=> $productqty
            );
        }else{
            $old_qty = $request->qty - $item->qty;
            Cart::instance('returnProduct')->update($rowId, $qty);
            $data = array(
                'rowId'=> $rowId,
                'status'=>true,
                'qty' => $request->qty,
                'old_qty'=> $productqty
            );
        }
        echo json_encode($data);
    }

    public function changeSaleQuantity(Request $request, $id){
        $rowId=$request->rowId;
        $item = Cart::instance('sale')->get($rowId);
        $productqty = $item->qty;
        $product = Product::find($item->id);
        $totalQty = $product->stockQuantity;
        $qty = $request->qty;
        if($qty > $totalQty){
            $data = array(
                'errors' => 'Stock Quantity: '. $totalQty,
                'status'=> false,
                'old_qty'=> $productqty
            );
        }else if($qty < 1){
            $data = array(
                'errors' => 'Quantity Must be at least 1',
                'status'=> false,
                'old_qty'=> $productqty
            );
        }else{
            $old_qty = $request->qty - $item->qty;
            Cart::instance('sale')->update($rowId, $qty);
            $data = array(
                'rowId'=> $rowId,
                'status'=>true,
                'qty' => $request->qty,
                'old_qty'=> $productqty
            );
        }
        echo json_encode($data);
    }
}
