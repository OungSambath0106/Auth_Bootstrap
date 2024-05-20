<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
        $customers = Customer::count();
        return view('dashboard', compact('users', 'usersInactive', 'menus', 'customers'));
    }
}
