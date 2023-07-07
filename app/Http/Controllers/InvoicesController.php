<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\customers;
use App\Models\{taxes, products , shipping, invoice_details, invoice_attachments};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices' , compact('invoices'));
    }
    public function indexpage()
    {
        $totalInvoices = invoices::count();
        $invoicesStatus1 = invoices::where('status_value', 1)->count();
        $invoicesStatus2 = invoices::where('status_value', 2)->count();
        $invoicesStatus3 = invoices::where('status_value', 3)->count();

        return view('index', compact('totalInvoices', 'invoicesStatus1', 'invoicesStatus2', 'invoicesStatus3'));

    }
 public function notpaid()
 {
    $invoices = invoices::where('status_value',2)->get();
    return view('invoices.invoicesnotpaid' , compact('invoices'));
 }
 public function notcomplet()
 {
    $invoices = invoices::where('status_value',3)->get();
    return view('invoices.invoicesnotcomplet' , compact('invoices'));
 }
 public function paid()
 {
    $invoices = invoices::where('status_value',1)->get();
    return view('invoices.paidinvoice' , compact('invoices'));
 }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = customers::all();
        $shippings = shipping::all();
        $taxes = taxes::all();
        return view('invoices.addinvoice',compact('customers','shippings','taxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


public function store(Request $request)
{
    // Create a new invoice
    $invoice = invoices::create([
        'name' => $request->invoice_number,
        'description' => $request->note,
        'invoice_date' => $request->invoice_Date,
        'due_date' => $request->Due_date,
        'customer_id' => $request->customer,
        'tax_id' => $request->tax,
        'total' => $request->Total,
        'tax_amount' => $request->Value_VAT,
    ]);

    // Create invoice details
    $shippingId = $request->shipping;
    if ($shippingId) {
        $shipping = shipping::find($shippingId);
        if ($shipping) {
            invoice_details::create([
                'product_name' => $shipping->name,
                'priceperitem' => 0, // Set a default value or calculate based on shipping information
                'quantity' => 1, // Set a default value or calculate based on shipping information
                'invoice_id' => $invoice->id,
                'Created_by' => (Auth::user()->name),
            ]);
        }
    } else {
        $productNames = $request->product_name;
        $quantities = $request->quantity;
        $pricePerItems = $request->priceperitem;

        if (count($productNames) === count($quantities) && count($quantities) === count($pricePerItems)) {
            for ($i = 0; $i < count($productNames); $i++) {
                invoice_details::create([
                    'product_name' => $productNames[$i],
                    'priceperitem' => $pricePerItems[$i],
                    'quantity' => $quantities[$i],
                    'invoice_id' => $invoice->id,
                    'Created_by' => (Auth::user()->name),
                ]);
            }
        }
    }

    // Process attachments if provided
    if ($request->hasFile('pic')) {

        $invoice_id = Invoices::latest()->first()->id;
        $image = $request->file('pic');
        $file_name = $image->getClientOriginalName();


        $attachments = new invoice_attachments();
        $attachments->file_name = $file_name;
        $attachments->Created_by = Auth::user()->name;
        $attachments->invoice_id = $invoice_id;
        $attachments->save();

        // move pic
        $imageName = $request->pic->getClientOriginalName();
        $request->pic->move(public_path('Attachments/' . $invoice_id), $imageName);
    }



    // Redirect or return a response
    return redirect()->back()->with('success', 'Invoice created successfully');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $invoice_details = invoice_details::where('invoice_id',$id)->get();
        $invoice_attachments = invoice_attachments::where('invoice_id',$id)->get();
        return view('invoices.invoice_details' , compact('invoices','invoice_details','invoice_attachments')) ?? 'none';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $invoice_details = invoice_details::where('invoice_id',$id)->first();
        $customer = customers::where('id',$invoices->customer_id)->first();
        $tax = taxes::where('id',$invoices->tax_id)->first();
        $customers = customers::all();
        $shippings = shipping::where('name',$invoice_details->product_name);
        $taxes = taxes::all();
        return view('invoices.edit_invoice', compact('customer','customers', 'taxes' ,'shippings', 'invoices','invoice_details','tax'));
    }
    public function Print_invoice($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $invoice_details = invoice_details::where('invoice_id',$id)->get();
        $invoice_detailss = invoice_details::where('invoice_id',$id)->first();

        if ($invoice_detailss->priceperitem >0) {
            $isshipping = 0;

        //   return $invoices->tax;
        return view('invoices.Print_invoice',compact('invoices','invoice_details','isshipping'));
        }
        else {
            $isshipping = 1;
            $pro = $invoice_detailss->product_name;
            $shipping = shipping::where('name',$pro)->first();
            $products = products::where('shipping_id',$shipping->id)->get();
            return view('invoices.Print_invoice',compact('invoices','invoice_details','shipping','isshipping','products'));
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
            // Find the invoice record
            $invoice = invoices::findOrFail($request->invoice_id);

            // Update the invoice details
            $invoice->name = $request->invoice_number;
            $invoice->description = $request->note;
            $invoice->invoice_date = $request->invoice_Date;
            $invoice->due_date = $request->Due_date;
            $invoice->customer_id = $request->customer;
            $invoice->tax_id = $request->tax;
            $invoice->total = $request->Total;
            $invoice->tax_amount = $request->Value_VAT;
            $invoice->save();

            // Update invoice details
            $shippingId = $request->shipping;
            if ($shippingId) {
                $shipping = shipping::find($shippingId);
                if ($shipping) {
                    // Check if invoice details exist for the invoice
                    $invoiceDetails = invoice_details::where('invoice_id', $invoice->id)->first();
                    if ($invoiceDetails) {
                        // Update existing invoice details
                        $invoiceDetails->product_name = $shipping->name;
                        // Update other fields if needed
                        $invoiceDetails->save();
                    } else {
                        // Create new invoice details
                        invoice_details::create([
                            'product_name' => $shipping->name,
                            'priceperitem' => 0, // Set a default value or calculate based on shipping information
                            'quantity' => 1, // Set a default value or calculate based on shipping information
                            'invoice_id' => $invoice->id,
                            'Created_by' => Auth::user()->name,
                        ]);
                    }
                }
            } else {
                $productNames = $request->product_name;
                $quantities = $request->quantity;
                $pricePerItems = $request->priceperitem;

                if (count($productNames) === count($quantities) && count($quantities) === count($pricePerItems)) {
                    // Delete existing invoice details for the invoice
                    invoice_details::where('invoice_id', $invoice->id)->delete();

                    // Create/update invoice details based on the updated data
                    for ($i = 0; $i < count($productNames); $i++) {
                        invoice_details::create([
                            'product_name' => $productNames[$i],
                            'priceperitem' => $pricePerItems[$i],
                            'quantity' => $quantities[$i],
                            'invoice_id' => $invoice->id,
                            'Created_by' => Auth::user()->name,
                        ]);
                    }
                }
            }

            // Redirect or return a response indicating the update was successful
            // For example:
            return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::where('id', $id)->first();
        $Details = invoice_attachments::where('invoice_id', $id)->first();

         $id_page =$request->id_page;


        if (!$id_page==2) {

        if (!empty($Details->invoice_number)) {

            Storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
        }

        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/invoices');

        }

        else {

            $invoices->delete();
            session()->flash('archive_invoice');
            return redirect('/Archive');
        }


    }
    public function Status_show($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $invoice_details = invoice_details::where('invoice_id',$id)->first();
        $customer = customers::where('id',$invoices->customer_id)->first();
        $tax = taxes::where('id',$invoices->tax_id)->first();
        $customers = customers::all();
        $shippings = shipping::where('name',$invoice_details->product_name);
        $taxes = taxes::all();
        return view('invoices.update_status', compact('customer','customers', 'taxes' ,'shippings', 'invoices','invoice_details','tax'));
    }
    public function Status_update(Request $request)
    {
      //  return $request;
        $invoice = invoices::findorfail($request->id);
        $invoice->status = $request->Status;
        if ($request->Status=='مدفوعة') {
            $invoice->status_value=1;
        }
        else {
            $invoice->status_value =3;
        }
        $invoice->save();
        return redirect()->back()->with('success', 'Invoice updated successfully.');
    }
}
