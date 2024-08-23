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
        Schema::table('product_cats', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('pic');
            $table->enum('state',['0','1'])->default(0)->after('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_cats', function (Blueprint $table) {
            $table->dropColumn('order');
            // $table->dropColumn('state');
        });
    }
};
