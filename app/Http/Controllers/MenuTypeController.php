<?php

namespace App\Http\Controllers;

use App\Models\Menutype;
use Illuminate\Http\Request;

class MenuTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menutypes = Menutype::get();
        return view('menu-type.index', [
            'menutypes' => $menutypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:menutypes,name'
            ]
        ]);

        Menutype::create([
            'name' => $request->name
        ]);

        return redirect('menutypes')->with('status', 'MenuType Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menutype $menutype)
    {
        return view('menu-type.edit', [
            'menutype' => $menutype
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menutype $menutype)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:menutypes,name,' . $menutype->id
            ]
        ]);

        $menutype->update([
            'name' => $request->name
        ]);

        return redirect('menutypes')->with('status', 'MenuType Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($menutypeId)
    {
        $menutype = Menutype::find($menutypeId);
        $menutype->delete();

        return redirect('menutypes');
    }
}
