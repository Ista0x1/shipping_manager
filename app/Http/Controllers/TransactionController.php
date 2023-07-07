<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\{customers,trans_attachments};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class TransactionController extends Controller
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
        $customers = customers::all();
        return view('transactions.send',compact('customers'));
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
            'customer_id' => 'required|exists:customers,id',
            'city' => 'nullable',
            'trans_date' => 'required|date',
            'trans_number' => 'required|unique:transactions,transaction_number',
            'amount' => 'required|numeric',
            'pic' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $transaction = new transaction([
            'customer_id' => $request->input('customer_id'),
            'city' => $request->input('city'),
            'date' => $request->input('trans_date'),
            'transaction_number' => $request->input('trans_number'),
            'remaining_amount' => $request->input('amount'),
            'amount' => $request->input('amount'),
            'Created_by' => (Auth::user()->name),
        ]);

        $transaction->save();

        if ($request->hasFile('pic')) {

            $trans_id = transaction::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();


            $attachments = new trans_attachments();
            $attachments->file_name = $file_name;
            $attachments->Created_by = Auth::user()->name;
            $attachments->transaction_number = $request->trans_number;
            $attachments->transaction_id = $trans_id;
            $attachments->save();
            $imageName = $request->pic->getClientOriginalName();

           // $request->pic->storeAs('public/Attachments/', $imageName);
            // move pic
            $request->pic->move(public_path('Attachments/transactions/' . $request->trans_number), $imageName);
        }
        return redirect()->back()->with('message', 'تم  العملية بنجاح');
    }
    public function send()
    {

    }
    public function receive()
    {

    }
    public function gettrans($id) {

        $customer = DB::table("customers")->where("id", $id)->first();
        $trans = DB::table("transactions")->where("customer_id", $id)->pluck('id','transaction_number','remaining_amount');
        $remianing= DB::table("transactions")->where("customer_id", $id)->pluck('remaining_amount');
        return response()->json($trans);
       // return response()->json($trans);
    }
    public function getremaining($id) {
        $remianing= DB::table("transactions")->where("id", $id)->pluck('remaining_amount');
        return json_encode($remianing);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(transaction $transaction)
    {
        //
    }
    public function customertrans()
    {
        $customers = DB::table('customers')
        ->select('customers.id', 'customers.name' , 'customers.phone' , 'customers.city', DB::raw('COUNT(transactions.id) AS transaction_count'), DB::raw('SUM(transactions.amount) AS total_amount'), DB::raw('SUM(transactions.remaining_amount) AS total_remaining_amount'))
        ->leftJoin('transactions', 'customers.id', '=', 'transactions.customer_id')
        ->groupBy('customers.id', 'customers.name', 'customers.phone' , 'customers.city')
        ->get();

        return view('transactions.customerstrans',compact('customers'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaction $transaction)
    {
        //
    }
}
