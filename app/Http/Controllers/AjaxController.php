<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use App\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function clientsAjax(){
        return response()->json(Client::all());
    }

    public function suppliersAjax(){
        return response()->json(Supplier::all());
    }

    // public function productsAjax(Request $request){
    //     $product = Product::where('productBarcode', $request->productBarcode)->first();
    //     $data = array(
    //         'productBarcode' => $product->productBarcode,
    //         'price' => $product->salePrice,
    //     );
    //     echo json_encode($data);
    // }

    public function allProductsAjax(){
        return response()->json(Product::all());
    }

    // public function productsBarcodeAjax(Request $request){
    //     $product = Product::where('productBarcode', $request->productBarcode)->first();
    //     $data = array(
    //         'productBarcode' => $product->productBarcode,
    //         'price' => $product->salePrice,
    //     );
    //     echo json_encode($data);
    // }

    public function productsShopsAjax(){
        $productsShops = DB::table('product_shop')->get();
        return response()->json($productsShops);
    }
    
}
