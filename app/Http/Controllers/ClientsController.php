<?php

namespace App\Http\Controllers;

use Session;
use App\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.clients.clients')->with('clients', Client::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd(request()->all());
        $this->validate($request, [
            'name' => 'required',
            'contact_no' => 'required|numeric',
            'business_started_since' => 'required',
            'previous_due' => 'required|numeric',
        ]);

        $client = Client::create([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'business_started_since' => $request->business_started_since.' '. date('H:i:s'),
            'address' => $request->address,
            'note' => $request->note,
            'reference' => $request->reference,
            'previous_due' => $request->previous_due
        ]);

        Session::flash('success', 'Client Added Successfully');
        return redirect()->route('clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('admin.clients.show')->with('client', $client);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact_no' => 'required|numeric'
        ]);
        $client = Client::find($id);
        $client->name = $request->name;
        $client->contact_no = $request->contact_no;
        $client->business_started_since = $request->business_started_since;
        $client->address = $request->address;
        $client->note = $request->note;
        $client->reference = $request->reference;
        $client->previous_due = $request->previous_due;

        $client->save();
        Session::flash('success', 'Client Updated Successfully');
        return redirect()->route('clients');

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

