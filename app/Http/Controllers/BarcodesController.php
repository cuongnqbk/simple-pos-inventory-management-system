<?php

namespace App\Http\Controllers;

use Auth;
use Cart;
use Session;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use App\Product;
use App\Shop;
class BarcodesController extends Controller
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
        
        return view('admin.barcodes.create')->with('products', Product::all());
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required|numeric'
        ]);
        $product = Product::find($request->product_id);
        $qty = $request->quantity;
        $pastBuy=0;
        $carts = Cart::instance('barcode')->content();
        if($carts != null){          
            foreach($carts as $cart){
                if($cart->id == $product->id){
                    $pastBuy = $cart->qty;
                }
            }  
        }
        Cart::instance('barcode')->add([
            'id' => $product->id,
            'name' => $product->productName,
            'qty' => $qty,
            'price' => $product->salePrice,
            'options' => ['productBarcode' => $product->productBarcode, ]
            // 'options' => ['total_quantity' => $availableQuantity->quantity]
        ]);
        $carts=Cart::instance('barcode')->content();
        $numItems = Cart::instance('barcode')->content()->count();
        $i = 0;
        foreach(Cart::instance('barcode')->content() as $cart) { 
            if($i+1 == $numItems) { 
                $saved_rowid = $cart->rowId; 
            } 
            $i++;
        }
        
        if($pastBuy>0){
            $data = array(
                'product_id'=>$product->id,
                'name'=>$product->productName,
                'productBarcode' => $product->productBarcode,
                'quantity'=>$qty+$pastBuy,
                'price'=>$product->salePrice,
                'rowid'=>$saved_rowid,
                'status'=>true,
                'past_buy'=>true
            );
        }
        else{
            $data = array(
                'product_id'=>$product->id,
                'name'=>$product->productName,
                'productBarcode' => $product->productBarcode,
                'quantity'=>$qty,
                'price'=>$product->salePrice,
                'rowid'=>$saved_rowid,
                'status'=>true,
                'past_buy'=>false
            );
        }
        echo json_encode($data);        
    }
    public function printBarcode()
    {
        $item = Cart::instance('barcode')->content(); 
        //Cart::instance('barcode')->destroy();    
        //dd(Cart::instance('barcode')->content()));   
        return view('admin.barcodes.printBarcode')->with('items', $item);
    }
    
    public function destroy($id)
    {
        
    }
    public function destroyPrintBarcode()
    {
        Cart::instance('barcode')->destroy();
        Session::flash('success', 'Cart Destroyed Successfully');
        return redirect()->route('barcode.create');
    }
}
