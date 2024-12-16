<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->integer('order_id')->nullable(); // Adjust type and nullability as needed
        });
    }

    public function down()
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->dropColumn('order_id');
        });
    }

};
