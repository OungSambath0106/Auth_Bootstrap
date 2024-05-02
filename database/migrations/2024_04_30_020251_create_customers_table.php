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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->boolean('isdefault')->nullable();
            $table->unsignedInteger('ishidden')->default(0);
            $table->string('customername',50);
            $table->string('companyname',50)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('address',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
