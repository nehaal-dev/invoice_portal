<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Invoice;

class DashboardController extends Controller
{  

    public function index()
    {

        $total_invoice = Invoice::where('user_id', auth()->id())->count();  //Total invoices count
        $total_client = Client::where('user_id', auth()->id())->count();
        $total_revenue = Invoice::where('user_id', auth()->id())->sum('total');
        $pending_invoice = Invoice::where('user_id', auth()->id())
            ->where('status', 'unpaid')
            ->count();

            return view('dashboard',compact('total_invoice','total_client','total_revenue','pending_invoice'));
    }
}
