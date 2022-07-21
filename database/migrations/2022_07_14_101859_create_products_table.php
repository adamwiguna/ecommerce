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
            $table->timestamps();

            $table->index(['price', 'name', 'product_id']);
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
