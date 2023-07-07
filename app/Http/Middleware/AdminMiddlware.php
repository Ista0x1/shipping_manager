<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\customers;

class AdminMiddlware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (in_array('owner', Auth::user()->roles_name) || in_array('user', Auth::user()->roles_name)) {
                return $next($request);
            } else if (in_array('client', Auth::user()->roles_name)) {
                $customer = customers::where('account_id', Auth::user()->id)->first();
                $customer_id = $customer->id;
                return redirect()->route('customers.show', $customer_id);
    }
}
}
}








