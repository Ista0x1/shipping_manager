<?php

namespace App\Http\Controllers;

use App\Models\receive;
use Illuminate\Http\Request;
use App\Models\{customers,transaction,trans_attachments};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = customers::all();
        $trans = transaction::all();
        return view('transactions.receive',compact('customers','trans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = transaction::findorfail($request->trans);
        $transaction->remaining_amount =$request->remaining;
        $transaction->save();
        $receive = receive::create([
            'transaction_id' => $request->trans,
            'customer_id' => $request->customer_id,
            'transaction_number'=>$transaction->transaction_number,
            'amount' => $request->amount,
            'Created_by' => (Auth::user()->name),
            'receiver_city' => $request->city,
            'receiver_date' => $request->trans_date,
            'received_amount' => $request->amount,
        ]);

        if ($request->hasFile('pic')) {

            $trans_id = $transaction->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();


            $attachments = new trans_attachments();
            $attachments->file_name = $file_name;
            $attachments->Created_by = Auth::user()->name;
            $attachments->transaction_number = $transaction->transaction_number;
            $attachments->transaction_id = $trans_id;
            $attachments->save();
            $imageName = $request->pic->getClientOriginalName();

           // $request->pic->storeAs('public/Attachments/', $imageName);
            // move pic
            $request->pic->move(public_path('Attachments/transactions/' . $transaction->transaction_number), $imageName);
        }
        return redirect()->back()->with('message', 'تم  العملية بنجاح');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function show(receive $receive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function edit(receive $receive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, receive $receive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function destroy(receive $receive)
    {
        //
    }
}
