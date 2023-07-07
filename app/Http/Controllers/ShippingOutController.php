<?php

namespace App\Http\Controllers;

use App\Models\shipping_out;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\customers;
use App\Models\shipping;
use App\Models\{taxes, products , shipping_attachments};
use App\Models\shipping_method;
use App\Models\shipping_out_detail;

class ShippingOutController extends Controller
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
        $methods = shipping_method::all();
        $shipping = shipping::all();
        return view('shipping.shipping_out' , compact('customers', 'methods','shipping'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shipping = shipping_out::create([
         'description' => $request->description,
            'date' => $request->date_origin,
            'note' => $request->note,
            'method_id' => $request->method_id,
            'customer_id' => $request->customer_id,
        ]);
        $shipping_id = shipping_out::latest()->first()->id;
        $customer_id = $request->customer_id;
        $productNames = $request->product_name;
        $quantities = $request->input('quantity');
        $volumes = $request->input('volume');
        $markas = $request->input('marka');
        $productsData = [];
        // Iterate over the input arrays and create an array of products
        for ($i = 0; $i < count($productNames); $i++) {
            $productsData[] = [
                'product_name' => $productNames[$i],
                'quantity' => $quantities[$i],
                'volume' => $volumes[$i],
                'brand' => $markas[$i],
                'shipping_id'=>$shipping_id,
                'customer_id'=>$customer_id,
            ];
        }
        // Store the products in the database
        shipping_out_detail::insert($productsData);
        return redirect()->back()->with('تمت العملية بنجاح');
    }
    public function getproducts($id) {
        $customer = customers::where('code',$id)->first();
        if ($customer) {
            $customer_name = $customer->name;
            $customer_id = $customer->id;
            $products = products::where('customer_id',$customer_id)->get();
            return response()->json([ 'products'=>$products]);
        }
        // Handle the case when the customer is not found
        return response()->json(['error' => 'Customer not found'], 404);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shipping_out  $shipping_out
     * @return \Illuminate\Http\Response
     */
    public function show(shipping_out $shipping_out)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shipping_out  $shipping_out
     * @return \Illuminate\Http\Response
     */
    public function edit(shipping_out $shipping_out)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shipping_out  $shipping_out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shipping_out $shipping_out)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shipping_out  $shipping_out
     * @return \Illuminate\Http\Response
     */
    public function destroy(shipping_out $shipping_out)
    {
        //
    }
}
