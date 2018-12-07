<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\ReceivePayment;
use App\Client;
use Illuminate\Http\Request;

class ReceivePaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.receivePayments.receivePayments')
                ->with('clients', Client::all())
                ->with('receivePayments', ReceivePayment::take(10)->orderBy('created_at', 'desc')->get());
    }
    public function receiveBetweenDate(Request $request)
    {
        //dd($request->all());
        $date_from = $request->receive_date_from;
        $date_to = $request->receive_date_to;

        $receive_date_from = $request->receive_date_from.' '.date('00:00:01');
        $receive_date_to = $request->receive_date_to.' '.date('23:59:59');
        $receive_date_to_start = $request->receive_date_to.' '.date('00:00:01');
        //$receive_date_to_end = $request->receive_date_to.' '.date('23:59:59');
        //dd(ReceivePayment::whereBetween('created_at', [$receive_date_to_start, $receive_date_to])->orderBy('created_at', 'desc')->get());
        if(isset($date_from) && isset($date_to)){
            return view('admin.receivePayments.receivePayments')
                ->with('clients', Client::all())
                ->with('receivePayments', ReceivePayment::whereBetween('created_at', [$receive_date_from, $receive_date_to])->orderBy('created_at', 'desc')->get());
        }else if(isset($date_from) && $date_to === null){
            return view('admin.receivePayments.receivePayments')
                ->with('clients', Client::all())
                ->with('receivePayments', ReceivePayment::where('created_at', '>=', $receive_date_from)->orderBy('created_at', 'desc')->get());
        }else if(isset($date_to) && $date_from === null){
            return view('admin.receivePayments.receivePayments')
                ->with('clients', Client::all())
                ->with('receivePayments', ReceivePayment::whereBetween('created_at', [$receive_date_to_start, $receive_date_to])->orderBy('created_at', 'desc')->get());
        }else{
            return view('admin.receivePayments.receivePayments')
                ->with('clients', Client::all())
                ->with('receivePayments', ReceivePayment::take(10)->orderBy('created_at', 'desc')->get());
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.receivePayments.create')
                ->with('clients', Client::all());
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
            'client_id' => 'required',
            'paid_amount' => 'required|numeric'
        ]);
        $receivePayment = ReceivePayment::create([
            'shop_id' => Auth::user()->shop_id,
            'received_by' => Auth::user()->name,
            'client_id' => $request->client_id,
            'paid_amount' => $request->paid_amount,
            'due' => $request->due,
            'note' => $request->note
        ]);

        $client = Client::find($request->client_id);
        $client->update(['previous_due'=> $request->due]);

        Session::flash('success', 'Payment Received Successfully');
        return redirect()->route('receivePayments');

        //dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receivePayment = ReceivePayment::find($id);
        return view('admin.receivePayments.show')
                ->with('clients', Client::all())
                ->with('receivePayment', $receivePayment);
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
        
        $receivePayment = ReceivePayment::find($id);
        $receivePayment->note = $request->note;
        $receivePayment->save();

        Session::flash('success', 'Payment Updated Successfully');
        return redirect()->route('receivePayments');
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
