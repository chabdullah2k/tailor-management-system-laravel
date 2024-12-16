<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeasurementFieldIdToMeasurementsTable extends Migration
{
    public function up()
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->foreignId('measurement_field_id')->nullable()->constrained('measurement_fields')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->dropForeign(['measurement_field_id']);
            $table->dropColumn('measurement_field_id');
        });
    }
}
