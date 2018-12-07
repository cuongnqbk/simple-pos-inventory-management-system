<?php

namespace App\Http\Controllers;

use Session;
Use App\Client;
Use App\DebitNote;
use Illuminate\Http\Request;

class DebitNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.debitNotes.debitNotes')
                ->with('clients', Client::all())
                ->with('debitNotes', DebitNote::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.debitNotes.create')
                ->with('clients', Client::all())
                ->with('debitNotes', DebitNote::all());
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
            'date' => 'required',
            'client_id' => 'required',
            'amount' => 'required'
        ]);

        $debitNote = DebitNote::create([
            'date' => $request->date.' '. date('H:i:s'),
            'client_id' => $request->client_id,
            'amount' => $request->amount,
            'details' => $request->details,
            'note' => $request->note
        ]);

        $client = Client::find($request->client_id);
        $client->update(['previous_due'=> $client->previous_due+$request->amount]);

        Session::flash('success', 'Debit Note Created Successfully');
        return redirect()->route('debitNotes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $debitNote = DebitNote::find($id);

        return view('admin.debitNotes.show')->with('debitNote', $debitNote);
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
