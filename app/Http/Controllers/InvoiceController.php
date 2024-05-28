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
        $menus = Menu::all();
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
            $invoices->where('customerid', $request->customer);
        }

        $total_amount = $invoices->sum('total');
        $invoices = $invoices->get();
        $totalpaid = $invoices->sum('total_paid');
        $subtotal = $invoices->sum('subtotal');
        $totalvat = $invoices->sum('vat_amount');
        $discount = $invoices->sum('discount_amount');
        return view('sale.index', compact('invoices', 'menus', 'customers', 'totalpaid', 'totalvat', 'subtotal', 'total_amount', 'discount', 'invoicess'));
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

    public function updateStatus(Request $request)
    {
        $invoiceId = $request->input('invoiceId');
        $status = $request->input('status');

        try {
            $invoice = Invoice::findOrFail($invoiceId);

            if ($status == '0') {
                $invoice->total_paid = 0;
            } else {
                $invoice->total_paid = $invoice->total;
            }

            $invoice->status = $status;
            $invoice->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update invoice status.'], 500);
        }
    }
}
