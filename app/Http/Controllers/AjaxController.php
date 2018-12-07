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

    public function productsAjax(){
        return response()->json(Product::all());
    }

    public function productsShopsAjax(){
        $productsShops = DB::table('product_shop')->get();
        return response()->json($productsShops);
    }
    
}
