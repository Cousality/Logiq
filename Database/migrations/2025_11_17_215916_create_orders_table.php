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
            $table->integer('orderID', true);
            $table->integer('userID')->index('idx_user_order');
            $table->timestamp('orderDate')->useCurrent();
            $table->enum('orderStatus', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending')->index('idx_order_status');
            $table->decimal('totalAmount', 10);
            $table->integer('addressID')->nullable()->index('addressID');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
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
