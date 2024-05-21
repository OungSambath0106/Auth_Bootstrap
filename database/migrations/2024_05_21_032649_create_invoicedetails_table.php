<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoicedetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoiceid');
            $table->unsignedBigInteger('menuid');
            $table->integer('orderquantity');
            $table->decimal('orderprice', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('invoiceid')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('menuid')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoicedetails');
    }
};
