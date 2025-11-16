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
        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign(['userID'], 'wishlists_ibfk_1')->references(['userID'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['productID'], 'wishlists_ibfk_2')->references(['productID'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropForeign('wishlists_ibfk_1');
            $table->dropForeign('wishlists_ibfk_2');
        });
    }
};
