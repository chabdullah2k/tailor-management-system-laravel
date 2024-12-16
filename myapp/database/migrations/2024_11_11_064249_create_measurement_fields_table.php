<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('measurement_fields', function (Blueprint $table) {
            $table->id();
            $table->string('fieldname');
            $table->integer('order')->nullable();
            $table->string('type');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->text('description')->nullable();
            $table->boolean('is_required')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('measurement_fields');
    }
}


