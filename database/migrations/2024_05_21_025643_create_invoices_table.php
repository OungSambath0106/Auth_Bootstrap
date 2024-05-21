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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ishidden')->default(1);
            $table->foreignId('customerid')->constrained('customers');
            $table->date('orderdate');
            $table->decimal('vat', 8, 2); // Adjust the precision and scale as needed
            $table->string('memo', 500);
            $table->unsignedInteger('ispaid')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
