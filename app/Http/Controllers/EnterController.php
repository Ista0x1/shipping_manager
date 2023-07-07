<?php

namespace App\Http\Controllers;

use App\Models\enter;
use Illuminate\Http\Request;
use App\Models\{customers,trans_attachments,balance_activities,balance,total};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class EnterController extends Controller
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
        return view('tahwilat.send',compact('customers'));
    }
    public function customertrans()
    {
        $customers = customers::join('totals', 'customers.id', '=', 'totals.customer_id')
        ->select(
            'customers.id',
            'customers.code',
            'customers.name',
            'customers.phone',
            'totals.total_euro',
            'totals.remaining_euro',
            'totals.total_dollar',
            'totals.remaining_dollar'
        )
        ->get();


        return view('tahwilat.customerstrans',compact('customers'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'customer_id' => 'required|integer',
        //     'customer_name' => 'required|string',
        //     'city' => 'required|string',
        //     'trans_date' => 'required|date',
        //     'currency' => 'required|string',
        //     'amount' => 'required|numeric',
        //     'exchangecurrency' => 'required|string',
        //     'exchangebuy' => 'required|numeric',
        //     'exchangesell' => 'required|numeric',
        //     'amountexchange' => 'required|numeric',
        //     'pic' => 'nullable|mimes:pdf,jpeg,jpg,png',
        // ]);
        // Store the entered data in the database
        $enter = new enter();
        $enter->customer_id = $request->input('customer_id');
        $enter->city = $request->input('city');
        $enter->date = $request->input('trans_date');
        if ($request->currency=='dinar') {
            $enter->currency = $request->input('exchangecurrency');
            $enter->dinar_amount = $request->input('amount');
            $enter->exchange = $request->input('exchangebuy');
            $enter->amount = $request->input('amountexchange');
            $total = total::firstOrCreate(['customer_id' => $request->customer_id]);
            $total->total_euro += $request->amountexchange;
            $total->remaining_euro += $request->amountexchange;
            $total->save();
            $balance = balance::firstOrCreate([]); // Assuming there's only one row in the "balances" table
            $balance->balance_euro += $request->amountexchange;
            $balance->save();
            $balance_activities = new balance_activities();
        $balance_activities->amount = $request->amountexchange;
        $balance_activities->balance_id = balance::latest()->first()->id;
        $balance_activities->Created_by = (Auth::user()->name); // You can modify this as needed
        $balance_activities->date = $request->input('trans_date');
        $balance_activities->save();
        } else {
            $enter->currency = $request->input('currency');
            $enter->amount = $request->input('amount');
        }
        $enter->Created_by = (Auth::user()->name); // You can modify this as needed
        $enter->save();
        if ($request->currency == 'euro') {
            $balance = balance::firstOrCreate([]); // Assuming there's only one row in the "balances" table
            $balance->balance_euro += $request->amount;
            $balance->save();
            $total = total::firstOrCreate(['customer_id' => $request->customer_id]);
            $total->total_euro += $request->amount;
            $total->remaining_euro += $request->amount;
            $total->save();
            $balance_activities = new balance_activities();
            $balance_activities->amount = $request->amount;
            $balance_activities->currency = $request->currency;
            $balance_activities->plus_moin = 1;
            $balance_activities->balance_id = balance::latest()->first()->id;
            $balance_activities->Created_by = (Auth::user()->name); // You can modify this as needed
            $balance_activities->date = $request->input('trans_date');
            $balance_activities->save();
        } elseif ($request->currency == 'dollar') {
            $balance = Balance::firstOrCreate([]); // Assuming there's only one row in the "balances" table
            $balance->balance_dollar += $request->amount;
            $balance->save();
            $total = total::firstOrCreate(['customer_id' => $request->customer_id]);
            $total->total_dollar += $request->amount;
            $total->remaining_dollar += $request->amount;
            $total->save();
            $balance_activities = new balance_activities();
            $balance_activities->amount = $request->amount;
            $balance_activities->currency = $request->currency;
            $balance_activities->plus_moin = 1;
            $balance_activities->balance_id = balance::latest()->first()->id;
            $balance_activities->Created_by = (Auth::user()->name); // You can modify this as needed
            $balance_activities->date = $request->input('trans_date');
            $balance_activities->save();
        }



        if ($request->hasFile('pic')) {

            $trans_id = enter::latest()->first()->id;
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
      //  return  enter::latest()->first()->id;

        return redirect()->back()->with('message', 'تم  العملية بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function show(enter $enter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function edit(enter $enter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, enter $enter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function destroy(enter $enter)
    {
        //
    }
}
