<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Menutype;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve menus that are not hidden and all menu types
        $menus = Menu::where('ishidden', 1)->get();
        $menuTypes = Menutype::all();
        $customers = Customer::where('ishidden', 1)->get();

        // Pass menus and menu types to the view
        return view('order.index', compact('menus', 'menuTypes', 'customers'));
    }

    public function checkout(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $total = $request->input('total');
            $totalPaid = $request->input('total_paid');
            $vat = $request->vat;
            $discount = $request->discount;
            $vat_amount = $request->vat_amount;
            $discount_amount = $request->discount_amount;
            $status = 0;
            if ($totalPaid > 0 && $totalPaid < $total) {
                $status = 0;
            } elseif ($totalPaid == $total) {
                $status = 1;
            }
            $invoice = new Invoice;
            // dd($request->all());
            $invoice->total_qty = $request->input('total_qty');
            $invoice->subtotal = $request->input('subtotal');
            $invoice->total = $request->input('total');
            $invoice->total_paid = $request->input('total_paid');
            $invoice->vat = $vat;
            $invoice->discount = $discount;
            $invoice->vat_amount = $vat_amount;
            $invoice->discount_amount = $discount_amount;
            $invoice->status = $status;
            $invoice->saler_id = auth()->user()->id;
            $invoice->customerid = $request->input('customerid');
            $invoice->save();

            //  dd($request ->all());
            foreach ($request->input('menus') as $detail) {
                $menu = Menu::find($detail['id']);
                InvoiceDetail::create([
                    'invoiceid' => $invoice->id,
                    'menuid' => $detail['id'],
                    'orderquantity' => $detail['qty'],
                    'orderprice' => $detail['price'],
                    // 'discount' => $detail['discount'],
                    // 'unit_price' => $menu->price,
                    // $detail->menu_id = $detail['menu_id'];
                    // $detail->qty = $detail['qty'];
                    // $detail->unit_price = $detail['unit_price'];
                    // $detail->subtotal = $detail['subtotal'];
                ]);
            }

            DB::commit();
            return redirect()->route('order')->with('status', 'Checkout successfully !');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('order')->with('error', 'Something went wrong!');
        }
    }
}
