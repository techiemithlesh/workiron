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
        Schema::create('inspection_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('report_no')->unique();
            $table->string('location')->nullable()->default(null);
            $table->string('inspection_date')->nullable()->default(null);
            $table->string('inspector_name')->nullable()->default(null);
            $table->string('fleet_no')->nullable()->default(null);
            $table->string('unit_number')->nullable();
            $table->string('vin_no')->nullable();
            $table->string('po_no')->nullable();
            $table->string('model_year')->nullable();
            $table->string('model_make')->nullable();
            $table->string('interior_color')->nullable();
            $table->boolean('powr_steering')->default(0);
            $table->string('engine_make')->nullable();
            $table->string('engine_model')->nullable();
            $table->string('engine_hp')->nullable();
            $table->integer('engine_serial')->nullable();
            $table->boolean('cruise')->default(0);
            $table->boolean('clean_air_idle')->default(0);
            $table->string('ov_length')->nullable();
            $table->string('ov_width')->nullable();
            $table->string('ov_height')->nullable();
            $table->string('odometer')->nullable();
            $table->string('hub_odometer')->nullable();
            $table->string('ecu_hp')->nullable();
            $table->string('ecu_miles')->nullable();
            $table->string('ecu_hours')->nullable();
            $table->string('engine_brake')->nullable();
            $table->string('fuel')->nullable();
            $table->string('ft1')->nullable();
            $table->string('air_horns')->nullable();
            $table->string('mirrors')->nullable();
            $table->string('exterior_color')->nullable();
            $table->string('wheelbase')->nullable();
            $table->string('rear_ratio')->nullable();
            $table->string('f_axle')->nullable();
            $table->string('r_axle')->nullable();
            $table->string('gvwr')->nullable();
            $table->string('suspension')->nullable();
            $table->string('tag_axie_capacity')->nullable();
            $table->string('rear_axie_model')->nullable();
            $table->string('trans_make')->nullable();
            $table->string('trans_model')->nullable();
            $table->boolean('independent_suspension')->default(0);
            $table->boolean('full_coach_suspension')->default(0);
            $table->boolean('tag_axie_unloading')->default(0);
            $table->boolean('front_sus_kleening')->default(0);
            $table->integer('total_tyres')->nullable();
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
        Schema::dropIfExists('inspection_details');
    }
};
