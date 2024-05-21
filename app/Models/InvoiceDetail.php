<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoicedetails';

    protected $fillable = [
        'invoiceid',
        'menuid',
        'orderquantity',
        'orderprice',
        'discount',
    ];

    /**
     * Get the invoice that owns the invoice detail.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoiceid');
    }

    /**
     * Get the menu associated with the invoice detail.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menuid');
    }
}
