<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Menutype;

class OrderController extends Controller
{
    public function index()
    {
        $menus = Menu::where('menutype_id', 1)->where('ishidden', 1)->get();

        // Retrieve all menu types
        $menuTypes = Menutype::all();

        // Pass menus and menu types to the view
        return view('order.index', compact('menus', 'menuTypes'));
    }
}
