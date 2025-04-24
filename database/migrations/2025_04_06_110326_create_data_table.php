<?php

use App\Enums\SensorDataType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
			$table->enum('type', SensorDataType::getValuesArray());
			$table->string('data');
			$table->dateTime('timestamp');
          	$table->timestamps();

			$table->index('type');
			$table->index(['timestamp','type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
