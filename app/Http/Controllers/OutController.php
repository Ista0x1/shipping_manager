<?php

namespace App\Http\Controllers;

use App\Models\out;
use Illuminate\Http\Request;
use App\Models\balance;
use App\Models\balance_activities;
use App\Models\{customers,transaction,trans_attachments,total};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class OutController extends Controller
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
        return view('tahwilat.receive',compact('customers','trans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'recipient_name' => 'string',
            'city' => 'string',
            'trans_date' => 'required|date',
            'currency' => 'required|string',
            'amount' => 'required|numeric',
            'pic' => 'nullable|mimes:pdf,jpeg,jpg,png',
        ]);

        // Store the entered data in the database
        $out = new Out;

    // Set the values from the request data
        $out->customer_id = $request->customer_id;
        $out->currency = $request->currency;
        $out->recipient_name = $request->recipient_name;
        $out->amount_taken = $request->amount;
        $out->date = $request->trans_date;
        $out->city = $request->city;
        $out->Created_by = Auth::user()->name;
        // Save the new record
        $out->save();
        if ($request->currency === 'euro') {
            $balance = balance::firstOrCreate([]); // Assuming there's only one row in the "balances" table
            $balance->balance_euro -= $request->amount;
            $balance->save();
            $total = total::where('customer_id', $request->customer_id)->firstOrFail();
            $total->remaining_euro = $request->remaining;
            $total->save();
            $balance_activities = new balance_activities();
            $balance_activities->amount = $request->amount;
            $balance_activities->currency = $request->currency;
            $balance_activities->plus_moin = 0;
            $balance_activities->balance_id = balance::latest()->first()->id;
            $balance_activities->Created_by = (Auth::user()->name); // You can modify this as needed
            $balance_activities->date = $request->input('trans_date');
            $balance_activities->save();
        } elseif ($request->currency === 'dollar') {
            $balance = balance::firstOrCreate([]); // Assuming there's only one row in the "balances" table
            $balance->balance_dollar-= $request->amount;
            $balance->save();
            $total = total::where('customer_id', $request->customer_id)->firstOrFail();
            $total->remaining_dollar = $request->remaining;
            $total->save();
            $balance_activities = new balance_activities();
            $balance_activities->amount = $request->amount;
            $balance_activities->currency = $request->currency;
            $balance_activities->plus_moin = 0;
            $balance_activities->balance_id = balance::latest()->first()->id;
            $balance_activities->Created_by = (Auth::user()->name); // You can modify this as needed
            $balance_activities->date = $request->input('trans_date');
            $balance_activities->save();
        }

        // Save the file attachment if provided
        if ($request->hasFile('pic')) {
            $transId = out::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();

            $attachments = new TransAttachments();
            $attachments->file_name = $file_name;
            $attachments->created_by = Auth::user()->name;
            $attachments->transaction_id = $transId;
            $attachments->save();

            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/transactions/' . $transId), $imageName);
        }

        return redirect()->back()->with('message', 'تم العملية بنجاح');
    }

    public function getremaining($customerId) {
        $customer = customers::where('code', $customerId)->first();
        $id = $customer->id;
        $total = total::where('customer_id', $id)->first();
        if ($total) {
            $remaining = [
                'remaining_euro' => $total->remaining_euro,
                'remaining_dollar' => $total->remaining_dollar
            ];
            return response()->json($remaining);
        }
        return response()->json(['error' => 'Total not found'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\out  $out
     * @return \Illuminate\Http\Response
     */
    public function show(out $out)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\out  $out
     * @return \Illuminate\Http\Response
     */
    public function edit(out $out)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\out  $out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, out $out)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\out  $out
     * @return \Illuminate\Http\Response
     */
    public function destroy(out $out)
    {
        //
    }
}
