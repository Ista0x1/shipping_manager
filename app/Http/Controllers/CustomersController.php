<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\customer_attachments;
use Illuminate\Http\Request;
use App\Models\{taxes , invoices,shipping,receive,transaction,trans_attachments , enter , out, total,shipping_out_detail};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $customers = customers::all();
       return view('customers.customers',compact('customers'));
       // $taxes = taxes::all();
      // return view('customers.taxes',compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last_id = 1;

        $latestCustomer = customers::latest()->first();
        if ($latestCustomer) {
            $last_id = $latestCustomer->id + 1;
        }

        return view('customers.add_customer', compact('last_id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{

    $validator = $this->validate($request, [
        'code' => 'required|unique:customers',
        'name' => 'required',
    ], [
        'code.required' => 'The code field is required.',
        'code.unique' => 'The code must be unique.',
        'name.required' => 'The name field is required.',
    ]);


        $customer = customers::create([
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->adress,
            'city' => $request->city,
            'note' => $request->note,
            'country' => $request->country,
        ]);
        if ($request->hasFile('pic')) {

            $customer_id = customers::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $customer_name = $request->name;
            $attachments = new customer_attachments();
            $attachments->file_name = $file_name;
            $attachments->Created_by = Auth::user()->name;
            $attachments->customer_id = $customer_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $customer_name), $imageName);
        }
       return redirect()->back()->with('message','تم إضافة العميل بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = customers::findorfail($id);
        $invoices =invoices::where('customer_id',$id)->get();
        $shippings= shipping::where('customer_id',$id)->get();
        $receivs= out::where('customer_id',$id)->get();
        $trans = enter::where('customer_id',$id)->get();
        $total = total::where('customer_id',$id)->first();
        $customer_attachments = customer_attachments::where('customer_id',$id)->get();
        $products =shipping_out_detail::where('customer_id',$id)->get();
        return view('customers.customer_details',compact('customer','invoices','shippings','customer_attachments','trans','receivs','total','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = customers::findorfail($id);
        return view('customers.edit_customer',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customers $customers)
    {
        $customer = customers::findorfail($request->id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->adress= $request->adress;
        $customer->city=$request->city;
        $customer->country =$request->country;
        $customer->note =$request->note;
        $customer->save();
        return redirect()->back()->with('message','تم التعديل بنجاح');
    }
    public function getcustomer($id)
    {
        $customer = customers::where('code', $id)->first();

        if ($customer) {
            $customer_name = $customer->name;
            $customer_id = $customer->id;
            $customer_email = $customer->email;
            return response()->json([
                'id' => $customer_id,
                'name' => $customer_name,
                'email' =>$customer_email
            ]);
        }

        // Handle the case when the customer is not found
        return response()->json(['error' => 'Customer not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->customer_id;
        $customers = customers::where('id', $id)->first();
        $Details = customer_attachments::where('customer_id', $id)->first();

         $id_page =$request->id_page;


        if (!$id_page==2) {

        if (!empty($Details->customer_id)) {

            Storage::disk('public_uploads')->deleteDirectory($customers->name);
        }

        $customers->forceDelete();
        session()->flash('delete_customer');
        return redirect('/customers');

        }

        else {

            $customers->delete();
            session()->flash('archive_invoice');
            return redirect('/Archive');
        }

        return "hello hi ";
    }
}
