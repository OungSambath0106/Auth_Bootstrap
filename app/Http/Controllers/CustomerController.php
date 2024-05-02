<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::get();
        return view('customer.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customername' => 'required|string|max:50',
        ]);

        // Create a new User instance
        $customer = new Customer();
        $customer->customername = $request->customername;
        $customer->companyname = $request->companyname;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;

        // Set ishidden attribute based on the request
        $customer->ishidden = $request->has('ishidden') ? 1 : 0;

        if ($request->hasFile('image')) {
            $customer->image = $this->uploadImage($request->file('image'));
        }

        // Save the user
        $customer->save();

        return redirect('customers')->with('status', 'Customer Created Successfully.');
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
    public function edit(string $id)
    {
        $customers = Customer::findOrFail($id);
        return view('customer.edit', compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'customername' => 'required|string|max:50',
        ]);

        $data = [
            'customername' => $request->customername,
            'companyname' => $request->companyname,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'ishidden' => $request->ishidden == 'on' ? 1 : 0,
        ];

        $customer->update($data);

        return redirect('/customers')->with('status', 'Customer Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->delete();

        return redirect('/customers');
    }
}
