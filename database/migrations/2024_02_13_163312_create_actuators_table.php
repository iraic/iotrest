<?php

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
        Schema::create('actuators', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique(); // nombre del actuador
            $table->string("type"); // tipo de actuador
            $table->decimal("value", 10, 2); // valor del actuador
            $table->datetime("date"); // fecha y hora del registro
            $table->integer("user_id"); // usuario que agrego el actuador
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actuators');
    }
};
