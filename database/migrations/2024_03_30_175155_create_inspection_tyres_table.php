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
        Schema::create('vehicle_tires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_detail_id')->constrained('inspection_details');
            $table->string('tyre_thread')->nullable()->comment('Thread condition of the tire');
            $table->string('tyre_company')->nullable()->comment('Company or manufacturer of the tire');
            $table->string('tyre_size')->nullable()->comment('Size of the tire (e.g., 10 / 32nd)');
            $table->float('brake_work_precentage')->nullable()->comment('Steer Axle Brakes: (Fron-left) eg., 70% 50% 40');
            $table->string('position')->nullable()->comment('Position of the tire (e.g., front-left, front-right, rear-left, rear-right)');
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
        Schema::dropIfExists('inspection_tyres');
    }
};
