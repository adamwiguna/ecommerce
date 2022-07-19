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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->double('total')->nullable();
            $table->boolean('is_paid')->nullable()->default(false);
            $table->boolean('in_process')->nullable()->default(false);
            $table->boolean('in_delivery')->nullable()->default(false);
            $table->boolean('is_sent')->nullable()->default(false);

            $table->index('user_id');
            $table->index('is_paid');
            $table->index('in_process');
            $table->index('in_delivery');
            $table->index('is_sent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
