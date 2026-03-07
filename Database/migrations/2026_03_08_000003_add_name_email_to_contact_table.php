<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameEmailToContactTable extends Migration
{
    public function up()
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->string('name')->nullable()->after('userID');
            $table->string('email')->nullable()->after('name');
            $table->string('orderNumber')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('contact', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'orderNumber']);
        });
    }
}