<?php

namespace App\Http\Controllers;

use Session;
use App\ProductType;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.productTypes.productTypes')->with('productTypes', ProductType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productTypes.create')->with('productTypes', ProductType::all());
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
            'productType' => 'required|unique:product_types' 
        ]);

        $productType = ProductType::create([
            'productType' => $request->productType,
            'note' => $request->note
        ]);

        Session::flash('success', 'Product Type Added Successfully');
        return redirect()->route('productTypes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productType = ProductType::find($id);
        return view('admin.productTypes.show')->with('productType', $productType);
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
            'productType' => 'required' 
        ]);

        $productType = ProductType::find($id);
        $productType->productType = $request->productType;
        $productType->note = $request->note;

        $productType->save();
        Session::flash('success', 'Product Type Updated Successfully');
        return redirect()->route('productTypes');
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
