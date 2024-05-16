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
        Schema::create('vehicle_inspection_extras_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_detail_id')->constrained('inspection_details');
            $table->boolean('abs')->default(0);
            $table->boolean('hyd')->default(0);
            $table->boolean('air')->default(0);
            $table->boolean('disk')->default(0);
            $table->boolean('drum')->default(0);
            $table->string('break_plates')->nullable();
            $table->string('wheels')->nullable();
            $table->string('tyre_size_f')->nullable();
            $table->string('tyre_size_r')->nullable();
            $table->string('detail_f')->nullable();
            $table->string('detail_r')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_inspection_extras_details');
    }
};
