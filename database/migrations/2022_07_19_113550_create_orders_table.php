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
            $table->dateTime('is_paid')->nullable()->default(null);
            $table->dateTime('in_process')->nullable()->default(null);
            $table->dateTime('canceled')->nullable()->default(null);
            $table->dateTime('done')->nullable()->default(null);

            $table->index('id');
            $table->index('done');
            $table->index('canceled');
            $table->index('done', 'canceled');
            $table->index('user_id');
            $table->index('is_paid');
            $table->index('in_process');
            $table->index('updated_at');
            $table->index('created_at');
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
