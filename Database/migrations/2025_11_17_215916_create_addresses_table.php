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
        Schema::create('addresses', function (Blueprint $table) {
            $table->integer('addressID', true);
            $table->integer('userID')->index('idx_user_address');
            $table->string('recipientFirstName', 50);
            $table->string('recipientLastName', 50);
            $table->string('phone', 20)->nullable();
            $table->string('addressLine1');
            $table->string('addressLine2')->nullable();
            $table->string('city', 100);
            $table->string('postCode', 20);
            $table->boolean('isDefault')->default(false);
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
        Schema::dropIfExists('addresses');
    }
};
