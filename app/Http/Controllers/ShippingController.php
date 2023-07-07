<?php

namespace App\Http\Controllers;

use App\Models\shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\customers;
use App\Models\{taxes, products , shipping_attachments, wearhouse};
use App\Models\shipping_method;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::with('products', 'customer', 'tax' ,'method')->get();

        //$employee = employees::with('feedbacks')->find($id);
     //   return $shippings;
        if (!$shippings) {
            // Handle case when employee is not found
            return redirect()->back()->with('error', 'لا يوجد شحن');
        }
        return view('shipping.shippings',compact('shippings'));
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

        return view('shipping.add_shipping' , compact('customers', 'methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $shipping = Shipping::create([
        'name' => $request->name,
        'description' => $request->description,
        'city_origin' => $request->city_origin,
        'city_final' => $request->city_final,
        'adress_origin' => $request->adress_origin,
        'adress_final' => $request->adress_final,
        'zip_origin' => $request->zip_origin,
        'zip_final' => $request->zip_final,
        'phone_origin' => $request->phone_origin,
        'phone_final' => $request->phone_final,
        'date_origin' => $request->date_origin,
        'status' => 'قيد الإنتظار',
        'status_value' => 3,
        'note' => $request->note,
        'method_id' => $request->method_id,
        'customer_id' => $request->customer_id,
        'user_id' => (Auth::user()->id),
        'total' => $request->Total,
        'tax_amount' => $request->tax,
    ]);
    $shipping_id = Shipping::latest()->first()->id;
    $customer_id = $request->customer_id;
    $productNames = $request->product_name;
    $productDescriptions = $request->input('product_description');
    $quantities = $request->input('quantity');
    $prices = $request->input('price');
    $volumes = $request->input('volume');
    $markas = $request->input('marka');
    $productsData = [];
    // Iterate over the input arrays and create an array of products
    for ($i = 0; $i < count($productNames); $i++) {
        $productsData[] = [
            'name' => $productNames[$i],
            'description' => $productDescriptions[$i],
            'quantity' => $quantities[$i],
            'priceperitem' =>$prices[$i],
            'volume' => $volumes[$i],
            'brand' => $markas[$i],
            'shipping_id'=>$shipping_id,
            'customer_id'=>$customer_id,

        ];
    }


    // Store the products in the database
    products::insert($productsData);
    $warehouse = wearhouse::firstOrCreate([]);

foreach ($productsData as $product) {
    $volume = $product['volume'];
    $quantity = $product['quantity'];

    if ($volume === 'شوال') {
        $warehouse->chwal += $quantity;
    } elseif ($volume === 'نص') {
        $warehouse->nas += $quantity;
    }
    elseif ($volume === 'كولي كبير') {
        $warehouse->grand_coli += $quantity;
    }
    elseif ($volume === 'كولي صغير ') {
        $warehouse->petit_coli += $quantity;
    }
}

$warehouse->save();
    // products::create([
    //     'shipping_id' => $shipping_id,
    //     'name' => $request->product_name,
    //     'description' => $request->product_description,
    //     'price'=>2,
    //     'weight' => $request->weight,
    //     'depth' => $request->depth,
    //     'width' => $request->width,
    // ]);
    if ($request->hasFile('pic')) {

        $shipping_id = shipping::latest()->first()->id;
        $image = $request->file('pic');
        $file_name = $image->getClientOriginalName();
        $shipping_name = shipping::latest()->first()->name;
        $attachments = new shipping_attachments();
        $attachments->file_name = $file_name;
        $attachments->Created_by = Auth::user()->name;
        $attachments->shipping_id = $shipping_id;
        $attachments->save();

        // move pic
        $imageName = $request->pic->getClientOriginalName();
        $request->pic->move(public_path('Attachments/'.$shipping_name), $imageName);
    }
    // Return a response or redirect as needed
   return redirect()->back()->with('message', 'Shipping created successfully');


 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipping = shipping::where('id', $id)->first();
        $products = products::where('shipping_id',$id)->get();
        $shipping_attachments = shipping_attachments::where('shipping_id',$id)->get();

        return view('shipping.shipping_details' , compact('shipping','shipping_attachments','products')) ?? 'none';
    }

    public function gettaxes($id) {
        $shipping = DB::table("shippings")->where("id", $id)->first();
        $taxId = $shipping->tax_id;
        $customerId= $shipping->customer_id;
        $tax = DB::table("taxes")->where("id", $taxId)->first();
        $customer = DB::table("customers")->where("id", $customerId)->first();

        if ($tax) {
            $taxes = [
                [
                    'id' => $tax->id,
                    'name' => $tax->name
                ]
            ];
        } else {
            $taxes = [];
        }
        if ($customer) {
            $customers = [
                [
                    'id' => $customer->id,
                    'name' => $customer->name
                ]
            ];
        } else {
            $customers = [];
        }

        return response()->json(['taxes' => $taxes,'customers'=>$customers, 'shipping'=> $shipping]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = shipping::findorfail($id);
        $products = products::where('shipping_id',$id)->get();
        $customers = customers::all();
        $methods = shipping_method::all();
        $taxes=taxes::all();
        //return $products;
       return view('shipping.edit_shipping',compact('shipping','customers','methods','taxes','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shipping = Shipping::findOrFail($id);

        // Update the shipping attributes
        $shipping->update([
            'name' => $request->name,
            'description' => $request->description,
            'city_origin' => $request->city_origin,
            'city_final' => $request->city_final,
            'adress_origin' => $request->adress_origin,
            'adress_final' => $request->adress_final,
            'phone_origin' => $request->phone_origin,
            'phone_final' => $request->phone_final,
            'date_origin' => $request->date_origin,
            'note' => $request->note,
            'method_id' => $request->method_id,
            'customer_id' => $request->customer_id,
            'total' => $request->total,
            'tax_amount' => $request->tax_amount,
        ]);

        // Delete existing products associated with the shipping
        $shipping->products()->delete();


        $customer_id = $request->customer_id;
        $productNames = $request->product_name;
        $productDescriptions = $request->input('product_description');
        $quantities = $request->input('quantity');
        $prices = $request->input('price');
        $volumes = $request->input('volume');
        $markas = $request->input('marka');
        $productsData = [];
        // Iterate over the input arrays and create an array of products
        for ($i = 0; $i < count($productNames); $i++) {
            $volume = isset($volumes[$i]) ? $volumes[$i] : null;
            $productsData[] = [
                'name' => $productNames[$i],
                'description' => $productDescriptions[$i],
                'quantity' => $quantities[$i],
                'priceperitem' => $prices[$i],
                'volume' => $volume,
                'brand' => $markas[$i],
                'customer_id' => $customer_id,
            ];
        }


        // Store the products in the database
        products::insert($productsData);

        // Redirect or perform additional actions after the update
        // For example:
        return redirect()->back()->with('success', 'Shipping updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(shipping $shipping)
    {
        //
    }
    public function Status_show($id)
    {
        $shipping = shipping::where('id', $id)->first();
        $products = products::where('shipping_id',$id)->get();
        return view('shipping.update_status', compact('shipping','products'));
    }
    public function Status_update(Request $request)
    {
      //  return $request;
        $shipping = shipping::findorfail($request->id);
        $shipping->status = $request->Status;
        switch ($request->Status) {
            case 'تم الشحن':
                $shipping->status_value=1;
                break;
          case 'قيد الانتظار':
            $shipping->status_value=2;
          break;
          case 'تحت التوصيل':
            $shipping->status_value=3;
            break;
            case 'ملغى':
                $shipping->status_value=4;
                break;
            default:
                $shipping->status_value=2;
                break;
        }

        $shipping->save();
        return redirect()->back()->with('success', 'shipping updated successfully.');
    }
    public function Print_invoice($id)
    {
        $shipping = shipping::where('id', $id)->first();
        $products = products::where('shipping_id',$id)->get();
        return view('shipping.print_shipping',compact('shipping','products','shipping','products'));
    }
}
