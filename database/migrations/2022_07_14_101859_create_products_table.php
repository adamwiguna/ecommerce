<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->string('name', 100)->nullable()->default('no-text-name-product');
            $table->string('size', 100)->nullable();
            $table->float('price')->nullable()->default(null);
            $table->integer('minimum_order')->nullable()->default(null);
            $table->boolean('is_best_seller')->nullable()->default(false);
            $table->boolean('is_new_arrival')->nullable()->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->index('price');
            $table->index('name');
            $table->index('product_id');
            $table->index('is_best_seller');
            $table->index('is_new_arrival');
            $table->index('created_at', 'updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
