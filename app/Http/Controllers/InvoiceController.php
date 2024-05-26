<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Menu;
use App\Models\Menutype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::all();
        $invoices = Invoice::query();
        $invoicess = Invoice::count();
        if ($request->start_date) {
            $invoices->where('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $invoices->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        if ($request->has('status') && $request->status !== '') {
            $invoices->where('status', $request->status);
        }

        if ($request->has('customer') && $request->customer !== '') {
            $invoices->where('customer_id', $request->customer);
        }
        $total_amount = $invoices->sum('total');
        $invoices = $invoices->get();
        $totalpaid = $invoices->sum('total_paid');
        $subtotal = $invoices->sum('subtotal');
        $totalvat = $invoices->sum('vat_amount');
        $discount = $invoices->sum('discount_amount');
        return view('sale.index', compact('invoices', 'customers', 'totalpaid', 'totalvat', 'subtotal', 'total_amount', 'discount', 'invoicess'));
    }

    public function show(string $id)
    {
        $invoice = Invoice::with('invoiceDetails')->findOrFail($id);
        $menus = Menu::all();
        $invoiceDetails = $invoice->invoiceDetails;

        return view('sale.invoice', compact('invoice', 'menus', 'invoiceDetails'));
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $customers = Customer::all();
        $menus = Menu::all();
        $invoiceDetails = $invoice->invoiceDetails;

        // Pass data to the edit view
        return view('sale.edit', compact('invoice', 'customers', 'menus', 'invoiceDetails'));
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());

        // Delete existing details
        InvoiceDetail::where('invoiceid', $id)->delete();

        // Insert new details
        foreach ($request->menus as $menu) {
            InvoiceDetail::create([
                'invoiceid' => $invoice->id,
                'menuid' => $menu['id'],
                'orderquantity' => $menu['quantity'],
                'orderprice' => $menu['price'],
            ]);
        }

        return redirect()->route('invoices.index')->with('status', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            InvoiceDetail::where('invoiceid', $id)->delete();
            Invoice::find($id)->delete();

            DB::commit();
            return redirect()->route('invoice.index')->with('status', 'Invoice deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('invoice.index')->with('error', 'Failed to delete transaction!');
        }
    }
}
