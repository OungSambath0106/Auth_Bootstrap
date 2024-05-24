<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

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
        $users = User::count();
        $usersInactive = User::where('ishidden', 0)->count();
        $menus = Menu::count();
        $invoices = Invoice::count();
        $invoice = Invoice::all();
        $total_amount = $invoice->sum('total');
        $total_paid = $invoice->sum('total_paid');
        $total_amount_today = $invoice->sum('total');
        $customers = Customer::count();
        return view('dashboard', compact('users', 'usersInactive', 'menus', 'customers', 'invoices', 'invoice', 'total_amount', 'total_paid', 'total_amount_today'));


        
        return view('home', compact('product', 'transactions', 'total_income', 'total_amount_today', 'customers', 'total_paid','total_due'));
    }
}
