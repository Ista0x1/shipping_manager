<?php

namespace App\Http\Controllers;

use App\Models\balance;
use Illuminate\Http\Request;
use App\Models\balance_activities;
use App\Models\{customers,transaction,trans_attachments,total, wearhouse};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balance = balance::first();
        $warehouse = wearhouse::first();
        $activities = balance_activities::all();
        return view('warehouse.warehouse',compact('balance','activities','warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(balance $balance)
    {
        //
    }
}
