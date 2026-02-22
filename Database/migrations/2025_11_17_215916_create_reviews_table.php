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
        Schema::create('reviews', function (Blueprint $table) {
            $table->integer('reviewID', true);
            $table->integer('userID');
            $table->integer('productID');
            $table->decimal('rating', 2, 1); // supports 0.5 increments, e.g. 3.5
            $table->text('reviewComment')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();

            $table->unique(['userID', 'productID'], 'idx_unique_user_product');
            $table->index(['productID', 'rating'], 'idx_product_rating');
            $table->index('userID', 'idx_user_review');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
