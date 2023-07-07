<?php

namespace App\Http\Controllers;

use App\Models\taxes;
use Illuminate\Http\Request;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = taxes::all();
        return view('taxes.taxes',compact('taxes'));
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
        $validatedData = $request->validate([
            'name' => 'required|unique:taxes|max:255',
        ],[

            'name.required' =>'يرجي ادخال اسم الضريبة',
            'name.unique' =>'اسم الضريبة مسجل مسبقا',


        ]);

            taxes::create([
                'name' => $request->name,
                'description' => $request->description,
                'tax_rate' => $request->tax_rate,

            ]);
            session()->flash('Add', 'تم اضافة الضريبة بنجاح ');
            return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function show(taxes $taxes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function edit(taxes $taxes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, taxes $taxes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function destroy(taxes $taxes)
    {
        //
    }
}
