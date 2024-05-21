<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'ishidden',
        'menuname',
        'menutype_id',
        'price',
        'description',
        'image',
    ];

    public function menutype()
    {
        return $this->belongsTo(MenuType::class, 'menutype_id');
    }

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class, 'menuid');
    }
}
