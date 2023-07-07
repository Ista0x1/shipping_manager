<?php

namespace App\Http\Controllers;

use App\Models\shipping_method;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = shipping_method::all();
        return view('shipping.shipping_method',compact('methods'));
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

            'name.required' =>'يرجي ادخال اسم النوع',
            'name.unique' =>'هدا الإسم  مسجل مسبقا',
        ]);

            shipping_method::create([
                'name' => $request->name,
                'description' => $request->description,

            ]);
            session()->flash('Add', 'تم اضافة  بنجاح ');
            return redirect()->back();
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shipping_method  $shipping_method
     * @return \Illuminate\Http\Response
     */
    public function show(shipping_method $shipping_method)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shipping_method  $shipping_method
     * @return \Illuminate\Http\Response
     */
    public function edit(shipping_method $shipping_method)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shipping_method  $shipping_method
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shipping_method $shipping_method)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shipping_method  $shipping_method
     * @return \Illuminate\Http\Response
     */
    public function destroy(shipping_method $shipping_method)
    {
        //
    }
}
