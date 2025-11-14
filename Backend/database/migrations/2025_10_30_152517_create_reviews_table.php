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
            $table->integer('userID')->index('idx_user_review');
            $table->integer('productID');
            $table->unsignedTinyInteger('rating');
            $table->string('reviewTitle', 100)->nullable();
            $table->text('reviewText')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();

            $table->index(['productID', 'rating'], 'idx_product_rating');
            $table->check('rating >= 1 AND rating <= 5');
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
