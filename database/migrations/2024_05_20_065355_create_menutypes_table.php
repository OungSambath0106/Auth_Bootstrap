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
        Schema::create('menutypes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('menutype');
            $table->foreignId('menutype_id')->nullable()->constrained('menutypes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['menutype_id']);
            $table->dropColumn('menutype_id');
            $table->string('menutype', 50)->nullable();
        });

        Schema::dropIfExists('menutypes');
    }
};
