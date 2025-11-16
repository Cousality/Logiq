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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->integer('wishlistID', true);
            $table->integer('userID')->index('idx_user_wishlist');
            $table->integer('productID')->index('idx_product_wishlist');
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['userID', 'productID'], 'unique_user_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
};
