<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;
use App\Models\transaction;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalInvoices = invoices::count();
        $invoicesStatus1 = invoices::where('status_value', 1)->count();
        $invoicesStatus2 = invoices::where('status_value', 2)->count();
        $invoicesStatus3 = invoices::where('status_value', 3)->count();
        $totaltrans = transaction::count();
        return view('index', compact('totalInvoices', 'invoicesStatus1', 'invoicesStatus2', 'invoicesStatus3','totaltrans'));

    }
}
