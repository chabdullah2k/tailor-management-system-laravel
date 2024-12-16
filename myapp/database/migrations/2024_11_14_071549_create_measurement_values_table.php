    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateMeasurementValuesTable extends Migration
    {
        public function up()
        {
            Schema::create('measurement_values', function (Blueprint $table) {
                $table->id();
                $table->foreignId('measurement_id')->constrained()->onDelete('cascade');
                $table->foreignId('measurement_fields_id')->constrained('measurement_fields')->onDelete('cascade');
    //
    //

    $table->string('fieldname');
                $table->text('value')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('measurement_values');
        }
    }
