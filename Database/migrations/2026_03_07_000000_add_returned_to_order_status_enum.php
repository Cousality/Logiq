<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN orderStatus ENUM('cart','pending','processing','shipped','delivered','cancelled','returned') NOT NULL DEFAULT 'cart'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN orderStatus ENUM('cart','pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'cart'");
    }
};
