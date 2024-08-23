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
        Schema::create('product_cats', function (Blueprint $table) {
            $table->id();
            $table->string('seo_url')->unique();
            $table->string('seo_title');
            $table->string('title');
            $table->unsignedBigInteger('parent_id')->nullable()->default(0);
            $table->foreign('parent_id')->references('id')->on('product_cats')->onUpdate('cascade')->onDelete('set null');
            $table->string('pic')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_cats');
    }
};
