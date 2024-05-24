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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->boolean('isdefault')->nullable();
            $table->unsignedInteger('ishidden')->default(1);
            $table->string('menuname',100);
            $table->string('menutype',50)->nullable();
            $table->decimal('price',8, 2)->nullable();
            $table->string('description',255)->nullable();
            $table->text("image", 255) -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
